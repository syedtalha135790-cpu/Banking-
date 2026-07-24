<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\EmailVerificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $verificationService;

    public function __construct(EmailVerificationService $verificationService)
    {
        $this->verificationService = $verificationService;
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('frontend.login');
    }

    /**
     * Handle user authentication.
     */
    public function login(LoginRequest $request)
    {
        // Check if identifier is email or phone number
        $identifier = $request->login_identifier;
        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        $credentials = [
            $field => $identifier,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            // Check if user has verified/activated their account
            if (is_null($user->email_verified_at)) {
                // Keep verify_email in session, trigger new OTP, and logout
                session(['verify_email' => $user->email]);
                $this->verificationService->sendOTP($user);
                
                Auth::logout();
                
                return redirect()->route('verification.notice')
                    ->withErrors(['otp' => 'Please verify your email/phone to activate your account. A fresh OTP has been sent.']);
            }

            // Intended page or dashboard
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'login_identifier' => 'The provided credentials do not match our records.',
        ])->onlyInput('login_identifier');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
