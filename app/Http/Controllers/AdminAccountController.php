<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AdminAccountController extends Controller
{
    /**
     * Display accounts listing with search, filter, and pagination.
     */
    public function index(Request $request)
    {
        $query = Account::with('user');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('account_number', 'like', "%{$search}%")
                  ->orWhere('cnic', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filters
        if ($request->filled('type')) {
            $query->where('account_type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $accounts = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        // Dashboard Stats
        $totalAccounts = Account::count();
        $totalSavings = Account::where('account_type', 'savings')->count();
        $totalCurrent = Account::where('account_type', 'current')->count();
        $activeAccounts = Account::where('status', 'active')->count();
        $inactiveAccounts = Account::where('status', 'inactive')->count();

        return view('admin.accounts.index', compact(
            'accounts', 'totalAccounts', 'totalSavings', 'totalCurrent', 'activeAccounts', 'inactiveAccounts'
        ));
    }

    /**
     * Show create account form.
     */
    public function create()
    {
        $users = User::where('role', 'customer')->get();
        return view('admin.accounts.create', compact('users'));
    }

    /**
     * Store new account.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'cnic' => ['required', 'string', 'max:20', 'unique:accounts,cnic'],
            'dob' => ['required', 'date', 'before:today'],
            'address' => ['required', 'string'],
            'occupation' => ['required', 'string', 'max:255'],
            'monthly_income' => ['required', 'numeric', 'min:0'],
            'account_type' => ['required', 'string', Rule::in(['savings', 'current'])],
            'initial_deposit' => ['required', 'numeric', 'min:0'],
            'ifsc_code' => ['nullable', 'string', 'max:20'],
        ]);

        // Auto-generate account number
        do {
            $accountNumber = 'BMS' . mt_rand(100000000, 999999999);
        } while (Account::where('account_number', $accountNumber)->exists());

        // Default configurations based on type
        $interestRate = $request->account_type === 'savings' ? 2.50 : 0.00;
        $minimumBalance = $request->account_type === 'savings' ? 500.00 : 0.00;

        if ($request->initial_deposit < $minimumBalance) {
            return back()->withErrors(['initial_deposit' => "Initial deposit must be at least {$minimumBalance} for savings accounts."])->withInput();
        }

        DB::transaction(function () use ($request, $accountNumber, $interestRate, $minimumBalance) {
            $account = Account::create([
                'user_id' => $request->user_id,
                'cnic' => $request->cnic,
                'dob' => $request->dob,
                'address' => $request->address,
                'occupation' => $request->occupation,
                'monthly_income' => $request->monthly_income,
                'account_number' => $accountNumber,
                'account_type' => $request->account_type,
                'balance' => $request->initial_deposit,
                'interest_rate' => $interestRate,
                'minimum_balance' => $minimumBalance,
                'status' => 'active',
                'ifsc_code' => $request->ifsc_code,
            ]);

            // Log Initial Deposit Transaction
            if ($request->initial_deposit > 0) {
                Transaction::create([
                    'account_id' => $account->id,
                    'type' => 'deposit',
                    'amount' => $request->initial_deposit,
                    'description' => 'Initial Deposit on Account Opening',
                ]);
            }
        });

        return redirect()->route('admin.accounts.index')->with('success', 'Bank account created successfully.');
    }

    /**
     * Show account details page.
     */
    public function details($id)
    {
        $account = Account::with(['user', 'transactions' => function($q) {
            $q->orderBy('id', 'desc');
        }])->findOrFail($id);

        return view('admin.accounts.details', compact('account'));
    }

    /**
     * Show edit account form.
     */
    public function edit($id)
    {
        $account = Account::findOrFail($id);
        return view('admin.accounts.edit', compact('account'));
    }

    /**
     * Update account details.
     */
    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        $request->validate([
            'cnic' => ['required', 'string', 'max:20', Rule::unique('accounts')->ignore($account->id)],
            'dob' => ['required', 'date', 'before:today'],
            'address' => ['required', 'string'],
            'occupation' => ['required', 'string', 'max:255'],
            'monthly_income' => ['required', 'numeric', 'min:0'],
            'ifsc_code' => ['nullable', 'string', 'max:20'],
        ]);

        $account->update([
            'cnic' => $request->cnic,
            'dob' => $request->dob,
            'address' => $request->address,
            'occupation' => $request->occupation,
            'monthly_income' => $request->monthly_income,
            'ifsc_code' => $request->ifsc_code,
        ]);

        return redirect()->route('admin.accounts.details', $account->id)->with('success', 'Account credentials updated successfully.');
    }

    /**
     * Toggle status.
     */
    public function toggleStatus($id)
    {
        $account = Account::findOrFail($id);
        $account->status = $account->status === 'active' ? 'inactive' : 'active';
        $account->save();

        // Trigger Notification
        $title = $account->status === 'active' ? 'Account Activated' : 'Account Deactivated';
        $message = $account->status === 'active' 
            ? "Your bank account ending in " . substr($account->account_number, -4) . " has been successfully Activated."
            : "Your bank account ending in " . substr($account->account_number, -4) . " has been suspended / Deactivated.";

        \App\Services\NotificationService::send(
            $account->user_id,
            $title,
            $message,
            'account',
            $account->account_number,
            [
                'details' => [
                    'Account Number' => '••••  ••••  ••••  ' . substr($account->account_number, -4),
                    'Account Status' => ucfirst($account->status),
                    'Action Date' => now()->toDateString(),
                ]
            ]
        );

        return redirect()->route('admin.accounts.details', $account->id)->with('success', "Account status toggled to {$account->status}.");
    }

    /**
     * Soft delete account.
     */
    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('admin.accounts.index')->with('success', 'Account soft-deleted successfully.');
    }
}
