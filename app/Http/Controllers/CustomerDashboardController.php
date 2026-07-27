<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerDashboardController extends Controller
{
    /**
     * Display the Customer Dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        return view('customer.dashboard', compact('user'));
    }

    /**
     * Show edit profile form.
     */
    public function editProfileForm()
    {
        $user = Auth::user();
        return view('customer.profile.edit', compact('user'));
    }

    /**
     * Update customer profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone_number' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();

        // Log Profile update activity
        \App\Services\ActivityLogger::log('profile_update', 'profile', "Customer {$user->name} updated profile details.", $user->id, 'success');

        return redirect()->route('customer.dashboard')->with('success', 'Profile updated successfully.');
    }

    /**
     * Show change password form.
     */
    public function changePasswordForm()
    {
        return view('customer.profile.change-password');
    }

    /**
     * Update customer password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided current password does not match our records.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Log Password change activity
        \App\Services\ActivityLogger::log('password_change', 'profile', "Customer {$user->name} changed account password.", $user->id, 'success');

        return redirect()->route('customer.dashboard')->with('success', 'Password updated successfully.');
    }
}
