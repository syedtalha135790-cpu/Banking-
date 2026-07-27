<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class BeneficiaryController extends Controller
{
    /**
     * Display customer's beneficiaries.
     */
    public function index(Request $request)
    {
        $query = Beneficiary::where('user_id', Auth::id());

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('beneficiary_name', 'like', "%{$search}%")
                  ->orWhere('account_number', 'like', "%{$search}%")
                  ->orWhere('nickname', 'like', "%{$search}%");
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('verification_status', $request->status);
        }

        $beneficiaries = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('customer.beneficiaries.index', compact('beneficiaries'));
    }

    /**
     * Show form to add beneficiary.
     */
    public function create()
    {
        return view('customer.beneficiaries.create');
    }

    /**
     * Store beneficiary.
     */
    public function store(Request $request)
    {
        $request->validate([
            'beneficiary_name' => ['required', 'string', 'max:255'],
            'account_number' => ['required', 'string', 'exists:accounts,account_number'],
            'bank_name' => ['required', 'string', 'max:255'],
            'branch_name' => ['required', 'string', 'max:255'],
            'branch_code' => ['required', 'string', 'max:50'],
            'swift_code' => ['nullable', 'string', 'max:50'],
            'relationship' => ['required', 'string', 'max:100'],
            'nickname' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        // Enforcement: Cannot add own account
        $isOwn = Account::where('user_id', Auth::id())
            ->where('account_number', $request->account_number)
            ->exists();
        if ($isOwn) {
            return back()->withErrors(['account_number' => 'You cannot register your own account as a beneficiary.'])->withInput();
        }

        // Enforcement: Duplicate check
        $isDuplicate = Beneficiary::where('user_id', Auth::id())
            ->where('account_number', $request->account_number)
            ->exists();
        if ($isDuplicate) {
            return back()->withErrors(['account_number' => 'This account number is already registered in your beneficiaries.'])->withInput();
        }

        Beneficiary::create([
            'user_id' => Auth::id(),
            'beneficiary_name' => $request->beneficiary_name,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'branch_code' => $request->branch_code,
            'swift_code' => $request->swift_code,
            'relationship' => $request->relationship,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'phone' => $request->phone,
            'verification_status' => 'pending', // default pending verification
        ]);

        return redirect()->route('customer.beneficiaries.index')->with('success', 'Beneficiary registered successfully. Verification is pending approval.');
    }

    /**
     * Show edit beneficiary form.
     */
    public function edit($id)
    {
        $beneficiary = Beneficiary::where('user_id', Auth::id())->findOrFail($id);
        return view('customer.beneficiaries.edit', compact('beneficiary'));
    }

    /**
     * Update beneficiary.
     */
    public function update(Request $request, $id)
    {
        $beneficiary = Beneficiary::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'beneficiary_name' => ['required', 'string', 'max:255'],
            'account_number' => ['required', 'string', 'exists:accounts,account_number'],
            'bank_name' => ['required', 'string', 'max:255'],
            'branch_name' => ['required', 'string', 'max:255'],
            'branch_code' => ['required', 'string', 'max:50'],
            'swift_code' => ['nullable', 'string', 'max:50'],
            'relationship' => ['required', 'string', 'max:100'],
            'nickname' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        // Enforcement: Cannot add own account
        $isOwn = Account::where('user_id', Auth::id())
            ->where('account_number', $request->account_number)
            ->exists();
        if ($isOwn) {
            return back()->withErrors(['account_number' => 'You cannot register your own account as a beneficiary.'])->withInput();
        }

        // Enforcement: Duplicate check (excluding self)
        $isDuplicate = Beneficiary::where('user_id', Auth::id())
            ->where('account_number', $request->account_number)
            ->where('id', '!=', $beneficiary->id)
            ->exists();
        if ($isDuplicate) {
            return back()->withErrors(['account_number' => 'This account number is already registered under another beneficiary.'])->withInput();
        }

        // If account number is changed, reset status back to pending verification!
        $status = $beneficiary->verification_status;
        if ($beneficiary->account_number !== $request->account_number) {
            $status = 'pending';
        }

        $beneficiary->update([
            'beneficiary_name' => $request->beneficiary_name,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'branch_code' => $request->branch_code,
            'swift_code' => $request->swift_code,
            'relationship' => $request->relationship,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'phone' => $request->phone,
            'verification_status' => $status,
        ]);

        return redirect()->route('customer.beneficiaries.index')->with('success', 'Beneficiary details updated successfully.');
    }

    /**
     * Soft delete beneficiary.
     */
    public function destroy($id)
    {
        $beneficiary = Beneficiary::where('user_id', Auth::id())->findOrFail($id);
        $beneficiary->delete();

        return redirect()->route('customer.beneficiaries.index')->with('success', 'Beneficiary removed successfully.');
    }
}
