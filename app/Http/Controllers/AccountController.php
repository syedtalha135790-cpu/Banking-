<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Handle deposits.
     */
    public function deposit(Request $request, $id)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $account = Account::findOrFail($id);

        // Security / Ownership check
        if (Auth::user()->role !== 'admin' && $account->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Active status check
        if (!$account->isActive()) {
            return back()->withErrors(['status' => 'Transactions are disabled. This account is currently Inactive.']);
        }

        DB::transaction(function () use ($account, $request) {
            $account->increment('balance', $request->amount);

            Transaction::create([
                'account_id' => $account->id,
                'type' => 'deposit',
                'amount' => $request->amount,
                'description' => $request->description ?? 'Cash Deposit',
            ]);
        });

        $redirectRoute = Auth::user()->role === 'admin' 
            ? redirect()->route('admin.accounts.details', $account->id)
            : redirect()->route('customer.account.details', ['id' => $account->id]);

        return $redirectRoute->with('success', "Successfully deposited {$request->amount} to account.");
    }

    /**
     * Handle withdrawals.
     */
    public function withdraw(Request $request, $id)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $account = Account::findOrFail($id);

        // Security / Ownership check
        if (Auth::user()->role !== 'admin' && $account->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Active status check
        if (!$account->isActive()) {
            return back()->withErrors(['status' => 'Transactions are disabled. This account is currently Inactive.']);
        }

        // Specific savings & current limits checks
        if ($account->account_type === 'savings') {
            if ($request->amount > 15000) {
                return back()->withErrors(['amount' => 'Savings account withdrawal limit is 15,000 per transaction.']);
            }
            if (($account->balance - $request->amount) < $account->minimum_balance) {
                return back()->withErrors(['amount' => "Savings account must maintain a minimum balance of {$account->minimum_balance}."]);
            }
        } else { // current account
            if ($request->amount > 100000) {
                return back()->withErrors(['amount' => 'Current account withdrawal limit is 100,000 per transaction.']);
            }
            if (($account->balance - $request->amount) < 0) {
                return back()->withErrors(['amount' => 'Insufficient funds. Current accounts cannot have negative balances.']);
            }
        }

        DB::transaction(function () use ($account, $request) {
            $account->decrement('balance', $request->amount);

            Transaction::create([
                'account_id' => $account->id,
                'type' => 'withdrawal',
                'amount' => $request->amount,
                'description' => $request->description ?? 'Cash Withdrawal',
            ]);
        });

        $redirectRoute = Auth::user()->role === 'admin' 
            ? redirect()->route('admin.accounts.details', $account->id)
            : redirect()->route('customer.account.details', ['id' => $account->id]);

        return $redirectRoute->with('success', "Successfully withdrew {$request->amount} from account.");
    }
}
