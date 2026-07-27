<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Loan;
use App\Models\LoanPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LoanController extends Controller
{
    /**
     * Customer Loan Dashboard.
     */
    public function index()
    {
        $loans = Loan::where('user_id', Auth::id())->with(['account'])->orderBy('id', 'desc')->get();
        
        $activeLoans = $loans->whereIn('status', ['approved', 'disbursed'])->where('outstanding_balance', '>', 0);
        $pendingApplications = $loans->whereIn('status', ['pending', 'under_review']);
        
        // Next due payment details
        $nextPayment = LoanPayment::whereHas('loan', function($q) {
            $q->where('user_id', Auth::id());
        })->where('payment_status', 'pending')
          ->orderBy('due_date', 'asc')
          ->first();

        // Total EMI Due (past due and next due)
        $emiDueSum = LoanPayment::whereHas('loan', function($q) {
            $q->where('user_id', Auth::id());
        })->where('payment_status', 'pending')
          ->where('due_date', '<=', now()->endOfMonth())
          ->sum('amount');

        $remainingBalance = $activeLoans->sum('outstanding_balance');

        // Repayment History (paid payments)
        $repaymentHistory = LoanPayment::whereHas('loan', function($q) {
            $q->where('user_id', Auth::id());
        })->where('payment_status', 'paid')
          ->with('loan')
          ->orderBy('payment_date', 'desc')
          ->take(10)
          ->get();

        return view('customer.loans.index', compact(
            'loans',
            'activeLoans',
            'pendingApplications',
            'nextPayment',
            'emiDueSum',
            'remainingBalance',
            'repaymentHistory'
        ));
    }

    /**
     * Show loan application form.
     */
    public function applyForm()
    {
        $accounts = Account::where('user_id', Auth::id())->where('status', 'active')->get();

        if ($accounts->isEmpty()) {
            return redirect()->route('customer.loans.index')
                ->withErrors(['account' => 'You must have an Active bank account before applying for a loan.']);
        }

        return view('customer.loans.apply', compact('accounts'));
    }

    /**
     * Store loan application.
     */
    public function storeApplication(Request $request)
    {
        $request->validate([
            'account_id' => ['required', 'exists:accounts,id'],
            'loan_type' => ['required', 'string', 'in:personal,home,car,education,business'],
            'amount' => ['required', 'numeric', 'min:1000'],
            'duration' => ['required', 'integer', 'min:3', 'max:120'], // 3 months to 10 years
            'monthly_income' => ['required', 'numeric', 'min:100'],
            'employment_status' => ['required', 'string', 'in:employed,self-employed,unemployed'],
            'employer_name' => ['nullable', 'string', 'required_if:employment_status,employed', 'max:255'],
            'purpose_of_loan' => ['required', 'string', 'max:500'],
            'cnic' => ['required', 'string', 'max:20'],
            'supporting_documents' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'], // max 5MB
        ]);

        $account = Account::where('id', $request->account_id)->where('user_id', Auth::id())->firstOrFail();

        if (!$account->isActive()) {
            return back()->withErrors(['account_id' => 'The selected bank account is Inactive.'])->withInput();
        }

        // Handle supporting document upload
        $documentPath = null;
        if ($request->hasFile('supporting_documents')) {
            $file = $request->file('supporting_documents');
            $filename = 'doc_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $documentPath = $file->storeAs('loans', $filename, 'public');
        }

        Loan::create([
            'user_id' => Auth::id(),
            'account_id' => $account->id,
            'loan_type' => $request->loan_type,
            'amount' => $request->amount,
            'interest_rate' => 0.00, // Initial placeholders, calculated upon admin approval
            'duration' => $request->duration,
            'monthly_emi' => 0.00,
            'total_interest' => 0.00,
            'total_payment' => 0.00,
            'outstanding_balance' => 0.00,
            'status' => 'pending',
            'application_date' => now(),
            'purpose_of_loan' => $request->purpose_of_loan,
            'employment_status' => $request->employment_status,
            'employer_name' => $request->employer_name,
            'monthly_income' => $request->monthly_income,
            'cnic' => $request->cnic,
            'supporting_documents' => $documentPath,
        ]);

        return redirect()->route('customer.loans.index')->with('success', 'Your loan application has been submitted successfully and is pending review.');
    }

    /**
     * Show loan details and EMI schedule.
     */
    public function show($id)
    {
        $loan = Loan::where('user_id', Auth::id())->with(['account', 'loanPayments'])->findOrFail($id);
        return view('customer.loans.show', compact('loan'));
    }
}
