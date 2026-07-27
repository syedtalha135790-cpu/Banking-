<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBeneficiaryController extends Controller
{
    /**
     * Display all beneficiaries for review.
     */
    public function index(Request $request)
    {
        $query = Beneficiary::with(['user', 'verifiedBy']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('beneficiary_name', 'like', "%{$search}%")
                  ->orWhere('account_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('verification_status', $request->status);
        }

        $beneficiaries = $query->orderBy('id', 'desc')->paginate(15)->withQueryString();

        return view('admin.beneficiaries.index', compact('beneficiaries'));
    }

    /**
     * Show beneficiary details.
     */
    public function show($id)
    {
        $beneficiary = Beneficiary::with(['user', 'verifiedBy'])->findOrFail($id);
        return view('admin.beneficiaries.show', compact('beneficiary'));
    }

    /**
     * Verify/Approve beneficiary.
     */
    public function verify($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->update([
            'verification_status' => 'verified',
            'verified_at' => now(),
            'verified_by' => Auth::id(),
        ]);

        return redirect()->route('admin.beneficiaries.index')->with('success', "Beneficiary link approved successfully.");
    }

    /**
     * Reject beneficiary.
     */
    public function reject($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->update([
            'verification_status' => 'rejected',
            'verified_at' => null,
            'verified_by' => null,
        ]);

        return redirect()->route('admin.beneficiaries.index')->with('success', "Beneficiary link has been rejected.");
    }

    /**
     * Delete beneficiary.
     */
    public function destroy($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->delete();

        return redirect()->route('admin.beneficiaries.index')->with('success', "Beneficiary soft-deleted successfully.");
    }
}
