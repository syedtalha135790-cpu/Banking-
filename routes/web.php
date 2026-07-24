<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;

// Public Guest Views
Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/services', function () {
    return view('frontend.services');
})->name('services');

Route::get('/accounts', function () {
    return view('frontend.accounts');
})->name('accounts');

Route::get('/loans', function () {
    return view('frontend.loans');
})->name('loans');

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::get('/online-banking', function () {
    return view('frontend.online-banking');
})->name('online-banking');

Route::get('/forgot-password', function () {
    return view('frontend.forgot-password');
})->name('forgot-password');

// Authentication Guest Routes
Route::middleware('guest')->group(function () {
    // Signup
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

// Verification OTP Routes (Accessed when user needs to verify account activation)
Route::get('/verify-otp', [VerificationController::class, 'showVerifyForm'])->name('verification.notice');
Route::post('/verify-otp', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/verify-otp/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated & Activated Customer Dashboard (Protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('frontend.dashboard');
    })->name('dashboard');

    Route::get('/transactions', function () {
        return view('frontend.transactions');
    })->name('transactions');
});

// Admin-Only Panel (Protected by base session auth)
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('backend.admin');
    })->name('admin');
});
