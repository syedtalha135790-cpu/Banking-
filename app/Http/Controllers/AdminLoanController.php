<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminLoanController extends Controller
{
    /**
     * Display all loan applications & metrics.
     */
    public function index(Request $request)
    {
        $query = Loan::with(['user', 'account']);

        // Search name/cnic/purpose
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('cnic', 'like', "%{$search}%")
                  ->orWhere('purpose_of_loan', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQ) use ($search) {
                      $userQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $loans = $query->orderBy('id', 'desc')->paginate(15)->withQueryString();

        // Admin dashboard metrics
        $totalApplications = Loan::count();
        $pendingLoans = Loan::whereIn('status', ['pending', 'under_review'])->count();
        $approvedLoansCount = Loan::where('status', 'approved')->count();
        $rejectedLoans = Loan::where('status', 'rejected')->count();
        $activeLoans = Loan::where('status', 'disbursed')->where('outstanding_balance', '>', 0)->count();
        $totalLoanAmount = Loan::whereIn('status', ['approved', 'disbursed'])->sum('amount');
        $totalEmiCollected = LoanPayment::where('payment_status', 'paid')->sum('amount');

        return view('admin.loans.index', compact(
            'loans',
            'totalApplications',
            'pendingLoans',
            'approvedLoansCount',
            'rejectedLoans',
            'activeLoans',
            'totalLoanAmount',
            'totalEmiCollected'
        ));
    }

    /**
     * View loan application details.
     */
    public function show($id)
    {
        $loan = Loan::with(['user', 'account', 'loanPayments'])->findOrFail($id);
        return view('admin.loans.show', compact('loan'));
    }

    /**
     * Update status to Under Review.
     */
    public function underReview($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['status' => 'under_review']);
        return redirect()->route('admin.loans.show', $loan->id)->with('success', 'Loan status updated to Under Review.');
    }

    /**
     * Approve and Disburse Loan.
     */
    public function approve(Request $request, $id)
    {
        $request->validate([
            'interest_rate' => ['required', 'numeric', 'min:0', 'max:50'],
        ]);

        $loan = Loan::findOrFail($id);

        if (in_array($loan->status, ['approved', 'disbursed', 'rejected'])) {
            return back()->withErrors(['status' => 'This loan application has already been processed.']);
        }

        $amount = $loan->amount;
        $rate = $request->interest_rate;
        $duration = $loan->duration;

        // EMI Math calculations
        if ($rate == 0) {
            $emi = $amount / $duration;
            $totalPayment = $amount;
            $totalInterest = 0;
        } else {
            $r = $rate / (12 * 100); // monthly interest rate
            $n = $duration; // total installments
            $emi = ($amount * $r * pow(1 + $r, $n)) / (pow(1 + $r, $n) - 1);
            $totalPayment = $emi * $n;
            $totalInterest = $totalPayment - $amount;
        }

        $emi = round($emi, 2);
        $totalPayment = round($totalPayment, 2);
        $totalInterest = round($totalInterest, 2);

        DB::beginTransaction();
        try {
            // Update loan details and disburse immediately
            $loan->update([
                'interest_rate' => $rate,
                'monthly_emi' => $emi,
                'total_interest' => $totalInterest,
                'total_payment' => $totalPayment,
                'outstanding_balance' => $totalPayment,
                'status' => 'disbursed', // disbursed
                'approval_date' => now(),
            ]);

            // Add loan amount directly to the client's account balance
            $account = Account::where('id', $loan->account_id)->lockForUpdate()->first();
            $account->increment('balance', $amount);

            // Log Transaction
            Transaction::create([
                'account_id' => $account->id,
                'transaction_type' => 'deposit',
                'amount' => $amount,
                'balance_after_transaction' => $account->balance,
                'description' => "Loan Disbursal Credit (Ref: Loan ID #{$loan->id})",
                'status' => 'completed',
                'reference_number' => 'DISB-' . strtoupper(Str::random(10)),
            ]);

            // Generate EMI Repayment schedule
            for ($i = 1; $i <= $duration; $i++) {
                LoanPayment::create([
                    'loan_id' => $loan->id,
                    'installment_number' => $i,
                    'due_date' => now()->addMonths($i)->toDateString(),
                    'amount' => $emi,
                    'payment_status' => 'pending',
                ]);
            }

            DB::commit();

            // Trigger Loan Approved Notification
            \App\Services\NotificationService::send(
                $loan->user_id,
                'Loan Application Approved',
                "Congratulations! Your loan request for " . number_format($loan->amount, 2) . " has been approved and disbursed.",
                'loan',
                'LOAN-' . $loan->id,
                [
                    'details' => [
                        'Loan Type' => ucfirst($loan->loan_type) . ' Loan',
                        'Approved Amount' => number_format($loan->amount, 2),
                        'Interest Rate' => $loan->interest_rate . '%',
                        'EMI Amount (Monthly)' => number_format($loan->monthly_emi, 2),
                        'Duration' => $loan->duration . ' Months',
                        'Disbursement Date' => now()->toDateString(),
                    ]
                ]
            );

            return redirect()->route('admin.loans.index')->with('success', "Loan application approved and {$amount} disbursed successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred during approval processing. Please try again.']);
        }
    }

    /**
     * Reject Loan Application.
     */
    public function reject($id)
    {
        $loan = Loan::findOrFail($id);

        if (in_array($loan->status, ['approved', 'disbursed', 'rejected'])) {
            return back()->withErrors(['status' => 'This loan application has already been processed.']);
        }

        $loan->update(['status' => 'rejected']);

        // Trigger Loan Rejected Notification
        \App\Services\NotificationService::send(
            $loan->user_id,
            'Loan Application Rejected',
            "We regret to inform you that your application for " . ucfirst($loan->loan_type) . " loan ID #{$loan->id} has been rejected after compliance evaluation.",
            'loan',
            'LOAN-' . $loan->id,
            [
                'details' => [
                    'Loan Category' => ucfirst($loan->loan_type) . ' Loan',
                    'Requested Amount' => number_format($loan->amount, 2),
                    'Evaluation Status' => 'Rejected',
                    'Review Date' => now()->toDateString(),
                ]
            ]
        );

        return redirect()->route('admin.loans.index')->with('success', 'Loan application rejected.');
    }
}
