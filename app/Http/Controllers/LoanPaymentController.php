<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoanPaymentController extends Controller
{
    /**
     * Display all loan payments for the customer.
     */
    public function index(Request $request)
    {
        $payments = LoanPayment::whereHas('loan', function($q) {
            $q->where('user_id', Auth::id());
        })->with('loan')
          ->orderBy('due_date', 'asc')
          ->paginate(15);

        return view('customer.loans.payments_index', compact('payments'));
    }

    /**
     * Process EMI repayment transaction.
     */
    public function pay($id)
    {
        $payment = LoanPayment::whereHas('loan', function($q) {
            $q->where('user_id', Auth::id());
        })->with('loan.account')->findOrFail($id);

        if ($payment->payment_status === 'paid') {
            return back()->withErrors(['error' => 'This installment has already been paid.']);
        }

        $loan = $payment->loan;
        $account = $loan->account;

        if (!$account->isActive()) {
            return back()->withErrors(['error' => 'Your linked bank account is Inactive. Please activate it first.']);
        }

        if ($account->balance < $payment->amount) {
            return back()->withErrors(['error' => 'Insufficient funds in your linked bank account. Please deposit money first.']);
        }

        $refNumber = 'EMI-' . strtoupper(Str::random(12));

        DB::beginTransaction();
        try {
            // Lock account for update
            $account = Account::where('id', $account->id)->lockForUpdate()->first();
            $loan = Loan::where('id', $loan->id)->lockForUpdate()->first();

            // Deduct from bank account balance
            $account->decrement('balance', $payment->amount);

            // Log Transaction
            Transaction::create([
                'account_id' => $account->id,
                'sender_account_id' => $account->id,
                'receiver_account_id' => null,
                'transaction_type' => 'withdrawal',
                'amount' => $payment->amount,
                'balance_after_transaction' => $account->balance,
                'description' => "Loan ID #{$loan->id} Installment #{$payment->installment_number} Repayment",
                'status' => 'completed',
                'reference_number' => $refNumber,
            ]);

            // Update loan outstanding balance
            $newOutstanding = max(0.00, $loan->outstanding_balance - $payment->amount);
            $loan->update([
                'outstanding_balance' => $newOutstanding,
                'status' => ($newOutstanding <= 0.00) ? 'completed' : $loan->status,
            ]);

            // Update installment payment status
            $payment->update([
                'payment_status' => 'paid',
                'payment_date' => now(),
                'reference_number' => $refNumber,
            ]);

            DB::commit();
            return redirect()->route('customer.loans.show', $loan->id)->with('success', "EMI installment #{$payment->installment_number} paid successfully. Ref: {$refNumber}");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred during payment processing. Please try again.']);
        }
    }

    /**
     * View/Print EMI Payment Receipt.
     */
    public function receipt($id)
    {
        $payment = LoanPayment::whereHas('loan', function($q) {
            $q->where('user_id', Auth::id());
        })->with(['loan.user', 'loan.account'])->findOrFail($id);

        if ($payment->payment_status !== 'paid') {
            abort(404, 'Receipt not available for unpaid installments.');
        }

        return view('customer.loans.receipt', compact('payment'));
    }
}
