<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\EmailVerificationService;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $verificationService;

    public function __construct(EmailVerificationService $verificationService)
    {
        $this->verificationService = $verificationService;
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('frontend.register');
    }

    /**
     * Handle user account registration.
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        // Send OTP
        $this->verificationService->sendOTP($user);

        // Store user email in session for verification mapping
        session(['verify_email' => $user->email]);

        return redirect()->route('verification.notice');
    }
}
