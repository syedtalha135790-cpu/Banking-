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

            // Log successful login
            \App\Services\ActivityLogger::log('login', 'auth', "User {$user->name} logged in successfully.", $user->id, 'success');

            // Check if user has verified/activated their account
            if (is_null($user->email_verified_at)) {
                // Keep verify_email in session, trigger new OTP, and logout
                session(['verify_email' => $user->email]);
                $this->verificationService->sendOTP($user);
                
                Auth::logout();
                
                return redirect()->route('verification.notice')
                    ->withErrors(['otp' => 'Please verify your email/phone to activate your account. A fresh OTP has been sent.']);
            }

            // Redirect based on role
            $request->session()->regenerate();
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }
            return redirect()->intended(route('customer.dashboard'));
        }

        // Log failed login attempt
        \App\Services\ActivityLogger::log('login', 'auth', "Failed login attempt using identifier: {$request->login_identifier}.", null, 'failed');

        return back()->withErrors([
            'login_identifier' => 'The provided credentials do not match our records.',
        ])->onlyInput('login_identifier');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            \App\Services\ActivityLogger::log('logout', 'auth', "User {$user->name} logged out.", $user->id, 'success');
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
