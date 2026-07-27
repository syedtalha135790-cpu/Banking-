<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminTransactionController extends Controller
{
    /**
     * Display listing of all transactions with filters & queries.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['account.user', 'senderAccount', 'receiverAccount']);

        // Search (ref, desc, holder name, account number)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('reference_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('account', function($accQ) use ($search) {
                      $accQ->where('account_number', 'like', "%{$search}%")
                           ->orWhereHas('user', function($uQ) use ($search) {
                               $uQ->where('name', 'like', "%{$search}%")
                                  ->orWhere('email', 'like', "%{$search}%");
                           });
                  });
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

        // Filter suspicious transactions (arbitrarily defined as amount > 50,000.00 for compliance review)
        if ($request->filled('suspicious')) {
            $query->where('amount', '>', 50000);
        }

        $transactions = $query->orderBy('id', 'desc')->paginate(15)->withQueryString();

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * View transaction details receipt.
     */
    public function show($id)
    {
        $transaction = Transaction::with(['account.user', 'senderAccount.user', 'receiverAccount.user'])->findOrFail($id);
        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Export all filtered transactions to CSV (Excel compatible).
     */
    public function exportCsv(Request $request)
    {
        $query = Transaction::with(['account.user', 'senderAccount', 'receiverAccount']);

        // Re-apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('reference_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('account', function($accQ) use ($search) {
                      $accQ->where('account_number', 'like', "%{$search}%")
                           ->orWhereHas('user', function($uQ) use ($search) {
                               $uQ->where('name', 'like', "%{$search}%");
                           });
                  });
            });
        }

        if ($request->filled('type')) {
            $query->where('transaction_type', $request->type);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        if ($request->filled('suspicious')) {
            $query->where('amount', '>', 50000);
        }

        $transactions = $query->orderBy('id', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="bms_transactions_ledger_' . date('Ymd_His') . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Reference Code', 'Account Number', 'Customer Name', 'Type', 'Amount', 'Post Balance', 'Sender', 'Receiver', 'Status', 'Date Time']);

            foreach ($transactions as $txn) {
                fputcsv($file, [
                    $txn->id,
                    $txn->reference_number,
                    $txn->account->account_number,
                    $txn->account->user->name,
                    ucfirst(str_replace('_', ' ', $txn->transaction_type)),
                    $txn->amount,
                    $txn->balance_after_transaction,
                    $txn->senderAccount ? $txn->senderAccount->account_number : 'N/A',
                    $txn->receiverAccount ? $txn->receiverAccount->account_number : 'N/A',
                    ucfirst($txn->status),
                    $txn->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
