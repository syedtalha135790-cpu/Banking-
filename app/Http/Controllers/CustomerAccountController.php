<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerAccountController extends Controller
{
    /**
     * Display customer accounts list.
     */
    public function index()
    {
        $accounts = Account::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('customer.accounts.index', compact('accounts'));
    }

    /**
     * Show self account registration.
     */
    public function create()
    {
        return view('customer.accounts.create');
    }

    /**
     * Store self account.
     */
    public function store(Request $request)
    {
        $request->validate([
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
                'user_id' => Auth::id(),
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

            if ($request->initial_deposit > 0) {
                Transaction::create([
                    'account_id' => $account->id,
                    'type' => 'deposit',
                    'amount' => $request->initial_deposit,
                    'description' => 'Initial Deposit on Account Opening',
                ]);
            }
        });

        return redirect()->route('customer.accounts.index')->with('success', 'Your bank account has been opened successfully.');
    }

    /**
     * View account details.
     */
    public function details($id)
    {
        $account = Account::where('user_id', Auth::id())->findOrFail($id);
        return view('customer.accounts.details', compact('account'));
    }

    /**
     * Show edit personal information on the account.
     */
    public function edit($id)
    {
        $account = Account::where('user_id', Auth::id())->findOrFail($id);
        return view('customer.accounts.edit', compact('account'));
    }

    /**
     * Update account personal information.
     */
    public function update(Request $request, $id)
    {
        $account = Account::where('user_id', Auth::id())->findOrFail($id);

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

        return redirect()->route('customer.account.details', $account->id)->with('success', 'Your account profile details updated successfully.');
    }

    /**
     * View transaction history.
     */
    public function transactions($id)
    {
        $account = Account::where('user_id', Auth::id())->findOrFail($id);
        $transactions = Transaction::where('account_id', $account->id)->orderBy('id', 'desc')->paginate(15);

        return view('customer.accounts.transactions', compact('account', 'transactions'));
    }

    /**
     * Show deposit form.
     */
    public function showDepositForm($id)
    {
        $account = Account::where('user_id', Auth::id())->findOrFail($id);
        return view('customer.accounts.deposit', compact('account'));
    }

    /**
     * Show withdraw form.
     */
    public function showWithdrawForm($id)
    {
        $account = Account::where('user_id', Auth::id())->findOrFail($id);
        return view('customer.accounts.withdraw', compact('account'));
    }
}
