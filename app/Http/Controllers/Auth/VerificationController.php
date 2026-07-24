<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailVerificationService;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    protected $verificationService;

    public function __construct(EmailVerificationService $verificationService)
    {
        $this->verificationService = $verificationService;
    }

    /**
     * Show the OTP verification form.
     */
    public function showVerifyForm()
    {
        if (!session()->has('verify_email')) {
            return redirect()->route('register');
        }

        return view('frontend.otp');
    }

    /**
     * Handle verification code submission.
     */
    public function verify(Request $request)
    {
        $email = session('verify_email');
        if (!$email) {
            return redirect()->route('register');
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('register');
        }

        // Join submitted digit inputs
        $code = is_array($request->otp) ? implode('', $request->otp) : $request->otp;

        if ($this->verificationService->verifyOTP($user, $code)) {
            // Activation success, redirect to login
            return redirect()->route('login', ['activated' => 'true']);
        }

        return back()->withErrors(['otp' => 'The provided security code is invalid or has expired.']);
    }

    /**
     * Resend verification code.
     */
    public function resend()
    {
        $email = session('verify_email');
        if (!$email) {
            return response()->json(['success' => false, 'message' => 'No active session found.'], 400);
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }

        $this->verificationService->sendOTP($user);

        return back()->with('resent', 'A fresh OTP code has been dispatched to your email address.');
    }
}
