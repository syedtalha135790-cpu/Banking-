<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Helper to generate unique reference number.
     */
    private function generateReference()
    {
        do {
            $ref = 'TXN-' . strtoupper(Str::random(12));
        } while (Transaction::where('reference_number', $ref)->exists());

        return $ref;
    }

    /**
     * Process Deposit.
     */
    public function deposit(Request $request)
    {
        $request->validate([
            'account_number' => ['required', 'string', 'exists:accounts,account_number'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $account = Account::where('account_number', $request->account_number)->firstOrFail();

        // Customer can only deposit into their own account
        if (Auth::user()->role !== 'admin' && $account->user_id !== Auth::id()) {
            abort(403, 'Unauthorized account access.');
        }

        if (!$account->isActive()) {
            return back()->withErrors(['account_number' => 'Deposit failed. This account is Inactive.'])->withInput();
        }

        $refNumber = $this->generateReference();

        DB::beginTransaction();
        try {
            // Lock row for update
            $account = Account::where('id', $account->id)->lockForUpdate()->first();

            $account->increment('balance', $request->amount);

            $transaction = Transaction::create([
                'account_id' => $account->id,
                'sender_account_id' => null,
                'receiver_account_id' => $account->id,
                'transaction_type' => 'deposit',
                'amount' => $request->amount,
                'balance_after_transaction' => $account->balance,
                'description' => $request->description ?? 'Self Cash Deposit',
                'status' => 'completed',
                'reference_number' => $refNumber,
            ]);

            DB::commit();

            // Trigger alert notification
            \App\Services\NotificationService::send(
                $account->user_id,
                'Successful Deposit Alert',
                "A cash deposit of {$request->amount} has been successfully credited to your account.",
                'transaction',
                $refNumber,
                [
                    'details' => [
                        'Account Number' => '••••  ••••  ••••  ' . substr($account->account_number, -4),
                        'Deposit Amount' => number_format($request->amount, 2),
                        'Updated Balance' => number_format($account->balance, 2),
                        'Transaction Reference' => $refNumber,
                        'Date & Time' => now()->toDateTimeString(),
                    ]
                ]
            );

            $redirectRoute = Auth::user()->role === 'admin' 
                ? redirect()->route('admin.transactions.index')
                : redirect()->route('customer.account.details', $account->id);

            return $redirectRoute->with('success', "Successfully deposited {$request->amount}. Ref: {$refNumber}");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['amount' => 'An error occurred during transaction processing. Please try again.'])->withInput();
        }
    }

    /**
     * Process Withdrawal.
     */
    public function withdraw(Request $request)
    {
        $request->validate([
            'account_number' => ['required', 'string', 'exists:accounts,account_number'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $account = Account::where('account_number', $request->account_number)->firstOrFail();

        // Customer can only withdraw from their own account
        if (Auth::user()->role !== 'admin' && $account->user_id !== Auth::id()) {
            abort(403, 'Unauthorized account access.');
        }

        if (!$account->isActive()) {
            return back()->withErrors(['account_number' => 'Withdrawal failed. This account is Inactive.'])->withInput();
        }

        // Limit validation
        if ($account->account_type === 'savings') {
            if ($request->amount > 15000) {
                return back()->withErrors(['amount' => 'Savings account withdrawal limit is 15,000 per transaction.'])->withInput();
            }
            if (($account->balance - $request->amount) < $account->minimum_balance) {
                return back()->withErrors(['amount' => "Savings account must maintain a minimum balance of {$account->minimum_balance}."])->withInput();
            }
        } else { // current
            if ($request->amount > 100000) {
                return back()->withErrors(['amount' => 'Current account withdrawal limit is 100,000 per transaction.'])->withInput();
            }
            if (($account->balance - $request->amount) < 0) {
                return back()->withErrors(['amount' => 'Insufficient funds. Overdrafts not permitted.'])->withInput();
            }
        }

        $refNumber = $this->generateReference();

        DB::beginTransaction();
        try {
            $account = Account::where('id', $account->id)->lockForUpdate()->first();

            $account->decrement('balance', $request->amount);

            $transaction = Transaction::create([
                'account_id' => $account->id,
                'sender_account_id' => $account->id,
                'receiver_account_id' => null,
                'transaction_type' => 'withdrawal',
                'amount' => $request->amount,
                'balance_after_transaction' => $account->balance,
                'description' => $request->description ?? 'Self Cash Withdrawal',
                'status' => 'completed',
                'reference_number' => $refNumber,
            ]);

            DB::commit();

            // Trigger alert notification
            \App\Services\NotificationService::send(
                $account->user_id,
                'Successful Withdrawal Alert',
                "A cash withdrawal of {$request->amount} has been successfully completed from your account.",
                'transaction',
                $refNumber,
                [
                    'details' => [
                        'Account Number' => '••••  ••••  ••••  ' . substr($account->account_number, -4),
                        'Withdrawal Amount' => number_format($request->amount, 2),
                        'Remaining Balance' => number_format($account->balance, 2),
                        'Transaction Reference' => $refNumber,
                        'Date & Time' => now()->toDateTimeString(),
                    ]
                ]
            );

            $redirectRoute = Auth::user()->role === 'admin' 
                ? redirect()->route('admin.transactions.index')
                : redirect()->route('customer.account.details', $account->id);

            return $redirectRoute->with('success', "Successfully withdrew {$request->amount}. Ref: {$refNumber}");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['amount' => 'An error occurred during transaction processing. Please try again.'])->withInput();
        }
    }

    /**
     * Process Transfer.
     */
    public function transfer(Request $request)
    {
        $request->validate([
            'sender_account_number' => ['required', 'string', 'exists:accounts,account_number'],
            'receiver_account_number' => ['required', 'string', 'exists:accounts,account_number'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->sender_account_number === $request->receiver_account_number) {
            return back()->withErrors(['receiver_account_number' => 'Sender and receiver accounts cannot be the same.'])->withInput();
        }

        $sender = Account::where('account_number', $request->sender_account_number)->firstOrFail();
        $receiver = Account::where('account_number', $request->receiver_account_number)->firstOrFail();

        // Security check
        if (Auth::user()->role !== 'admin' && $sender->user_id !== Auth::id()) {
            abort(403, 'Unauthorized account access.');
        }

        // Customer Transfer Rule: Must transfer only to verified beneficiaries
        if (Auth::user()->role === 'customer') {
            $isVerifiedBeneficiary = \App\Models\Beneficiary::where('user_id', Auth::id())
                ->where('account_number', $request->receiver_account_number)
                ->where('verification_status', 'verified')
                ->exists();

            if (!$isVerifiedBeneficiary) {
                return back()->withErrors(['receiver_account_number' => 'You can only transfer funds to verified beneficiaries. Please add and verify this account first.'])->withInput();
            }
        }

        if (!$sender->isActive()) {
            return back()->withErrors(['sender_account_number' => 'Transfer failed. Sender account is Inactive.'])->withInput();
        }

        if (!$receiver->isActive()) {
            return back()->withErrors(['receiver_account_number' => 'Transfer failed. Target receiver account is Inactive.'])->withInput();
        }

        // Balance check for sender
        if ($sender->account_type === 'savings') {
            if (($sender->balance - $request->amount) < $sender->minimum_balance) {
                return back()->withErrors(['amount' => "Transfer failed. Sender savings account must maintain a minimum balance of {$sender->minimum_balance}."])->withInput();
            }
        } else {
            if (($sender->balance - $request->amount) < 0) {
                return back()->withErrors(['amount' => 'Transfer failed. Insufficient funds in sender current account.'])->withInput();
            }
        }

        $refNumber = $this->generateReference();

        DB::beginTransaction();
        try {
            // Lock both accounts to prevent deadlocks (always lock in order of ID)
            $firstId = min($sender->id, $receiver->id);
            $secondId = max($sender->id, $receiver->id);

            Account::where('id', $firstId)->lockForUpdate()->first();
            Account::where('id', $secondId)->lockForUpdate()->first();

            // Fetch clean records
            $sender = Account::find($sender->id);
            $receiver = Account::find($receiver->id);

            // Execute transfers
            $sender->decrement('balance', $request->amount);
            $receiver->increment('balance', $request->amount);

            // Log double entries linked via correlation Reference code
            Transaction::create([
                'account_id' => $sender->id,
                'sender_account_id' => $sender->id,
                'receiver_account_id' => $receiver->id,
                'transaction_type' => 'transfer_out',
                'amount' => $request->amount,
                'balance_after_transaction' => $sender->balance,
                'description' => $request->description ?? 'Fund Transfer Out',
                'status' => 'completed',
                'reference_number' => $refNumber,
            ]);

            Transaction::create([
                'account_id' => $receiver->id,
                'sender_account_id' => $sender->id,
                'receiver_account_id' => $receiver->id,
                'transaction_type' => 'transfer_in',
                'amount' => $request->amount,
                'balance_after_transaction' => $receiver->balance,
                'description' => $request->description ?? 'Fund Transfer In',
                'status' => 'completed',
                'reference_number' => $refNumber,
            ]);

            DB::commit();

            // Load users for notification details
            $senderUser = $sender->user()->first();
            $receiverUser = $receiver->user()->first();

            // Trigger Alert for Sender
            if ($senderUser) {
                \App\Services\NotificationService::send(
                    $senderUser->id,
                    'Funds Sent Alert',
                    "You have successfully transferred {$request->amount} to {$receiverUser->name}.",
                    'transaction',
                    $refNumber,
                    [
                        'details' => [
                            'Amount Sent' => number_format($request->amount, 2),
                            'Receiver Name' => $receiverUser->name,
                            'Receiver Account' => '••••  ••••  ••••  ' . substr($receiver->account_number, -4),
                            'Updated Balance' => number_format($sender->balance, 2),
                            'Reference Number' => $refNumber,
                            'Date & Time' => now()->toDateTimeString(),
                        ]
                    ]
                );
            }

            // Trigger Alert for Receiver
            if ($receiverUser) {
                \App\Services\NotificationService::send(
                    $receiverUser->id,
                    'Funds Received Alert',
                    "You have received {$request->amount} from {$senderUser->name}.",
                    'transaction',
                    $refNumber,
                    [
                        'details' => [
                            'Amount Received' => number_format($request->amount, 2),
                            'Sender Name' => $senderUser->name,
                            'Sender Account' => '••••  ••••  ••••  ' . substr($sender->account_number, -4),
                            'Updated Balance' => number_format($receiver->balance, 2),
                            'Reference Number' => $refNumber,
                            'Date & Time' => now()->toDateTimeString(),
                        ]
                    ]
                );
            }

            $redirectRoute = Auth::user()->role === 'admin' 
                ? redirect()->route('admin.transactions.index')
                : redirect()->route('customer.account.details', $sender->id);

            return $redirectRoute->with('success', "Successfully transferred {$request->amount} to account {$request->receiver_account_number}. Ref: {$refNumber}");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['amount' => 'An error occurred during transaction processing. Please try again.'])->withInput();
        }
    }
}
