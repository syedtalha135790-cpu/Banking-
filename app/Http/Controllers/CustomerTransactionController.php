<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerTransactionController extends Controller
{
    /**
     * Display customer forms for transactions.
     */
    public function depositForm()
    {
        $accounts = Account::where('user_id', Auth::id())->where('status', 'active')->get();
        return view('customer.transactions.deposit', compact('accounts'));
    }

    public function withdrawForm()
    {
        $accounts = Account::where('user_id', Auth::id())->where('status', 'active')->get();
        return view('customer.transactions.withdraw', compact('accounts'));
    }

    public function transferForm()
    {
        $accounts = Account::where('user_id', Auth::id())->where('status', 'active')->get();
        return view('customer.transactions.transfer', compact('accounts'));
    }

    /**
     * Display customer's own transaction ledger history with search & filters.
     */
    public function index(Request $request)
    {
        // Get customer account IDs
        $accountIds = Account::where('user_id', Auth::id())->pluck('id')->toArray();

        $query = Transaction::whereIn('account_id', $accountIds)->with(['account', 'senderAccount', 'receiverAccount']);

        // Search in description or ref code
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('reference_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter Type
        if ($request->filled('type')) {
            $query->where('transaction_type', $request->type);
        }

        // Date Range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        // Filter by Account Number
        if ($request->filled('account_id')) {
            $query->where('account_id', $request->account_id);
        }

        $transactions = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
        $accounts = Account::where('user_id', Auth::id())->get();

        return view('customer.transactions.index', compact('transactions', 'accounts'));
    }

    /**
     * Show print-friendly receipt.
     */
    public function receipt($id)
    {
        $accountIds = Account::where('user_id', Auth::id())->pluck('id')->toArray();

        // Security check: Customer can only view receipt of their own transaction
        $transaction = Transaction::whereIn('account_id', $accountIds)
            ->with(['account.user', 'senderAccount.user', 'receiverAccount.user'])
            ->findOrFail($id);

        return view('customer.transactions.receipt', compact('transaction'));
    }
}
