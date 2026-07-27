<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Loan;
use App\Models\Card;
use App\Models\CardRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchController extends Controller
{
    /**
     * Display the main unified search dashboard page.
     */
    public function index()
    {
        return view('admin.search.index');
    }

    /**
     * AJAX Search Users.
     */
    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhereHas('loans', function($lQ) use ($search) {
                      $lQ->where('cnic', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('id', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.search.partials.users_table', compact('users'))->render();
        }

        return redirect()->route('admin.search.index');
    }

    /**
     * AJAX Search Accounts.
     */
    public function accounts(Request $request)
    {
        $query = Account::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('account_number', 'like', "%{$search}%")
                  ->orWhere('cnic', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQ) use ($search) {
                      $userQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('type')) {
            $query->where('account_type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('balance_min')) {
            $query->where('balance', '>=', $request->balance_min);
        }
        if ($request->filled('balance_max')) {
            $query->where('balance', '<=', $request->balance_max);
        }

        $accounts = $query->orderBy('id', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.search.partials.accounts_table', compact('accounts'))->render();
        }

        return redirect()->route('admin.search.index');
    }

    /**
     * AJAX Search Transactions.
     */
    public function transactions(Request $request)
    {
        $query = Transaction::with('account.user');

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

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('amount_min')) {
            $query->where('amount', '>=', $request->amount_min);
        }
        if ($request->filled('amount_max')) {
            $query->where('amount', '<=', $request->amount_max);
        }

        if ($request->filled('date_start')) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->date_start));
        }
        if ($request->filled('date_end')) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->date_end));
        }

        $transactions = $query->orderBy('id', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.search.partials.transactions_table', compact('transactions'))->render();
        }

        return redirect()->route('admin.search.index');
    }

    /**
     * AJAX Search Loans.
     */
    public function loans(Request $request)
    {
        $query = Loan::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('loan_type', 'like', "%{$search}%")
                  ->orWhere('purpose_of_loan', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQ) use ($search) {
                      $userQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('type')) {
            $query->where('loan_type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_start')) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->date_start));
        }
        if ($request->filled('date_end')) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->date_end));
        }

        $loans = $query->orderBy('id', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.search.partials.loans_table', compact('loans'))->render();
        }

        return redirect()->route('admin.search.index');
    }

    /**
     * AJAX Search Cards.
     */
    public function cards(Request $request)
    {
        $query = Card::with(['user', 'account']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('card_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQ) use ($search) {
                      $userQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('type')) {
            $query->where('card_type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $cards = $query->orderBy('id', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.search.partials.cards_table', compact('cards'))->render();
        }

        return redirect()->route('admin.search.index');
    }
}
