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

// General Dashboard Redirect Route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (\Illuminate\Support\Facades\Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('customer.dashboard');
    })->name('dashboard');
});

// Admin Route Group
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users/create', [\App\Http\Controllers\AdminDashboardController::class, 'createUserForm'])->name('users.create');
    Route::post('/users', [\App\Http\Controllers\AdminDashboardController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{id}/edit', [\App\Http\Controllers\AdminDashboardController::class, 'editUserForm'])->name('users.edit');
    Route::put('/users/{id}', [\App\Http\Controllers\AdminDashboardController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [\App\Http\Controllers\AdminDashboardController::class, 'deleteUser'])->name('users.delete');
    Route::get('/profile', [\App\Http\Controllers\AdminDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [\App\Http\Controllers\AdminDashboardController::class, 'updateProfile'])->name('profile.update');

    // Accounts Management
    Route::get('/accounts', [\App\Http\Controllers\AdminAccountController::class, 'index'])->name('accounts.index');
    Route::get('/accounts/create', [\App\Http\Controllers\AdminAccountController::class, 'create'])->name('accounts.create');
    Route::post('/accounts', [\App\Http\Controllers\AdminAccountController::class, 'store'])->name('accounts.store');
    Route::get('/accounts/{id}/details', [\App\Http\Controllers\AdminAccountController::class, 'details'])->name('accounts.details');
    Route::get('/accounts/{id}/edit', [\App\Http\Controllers\AdminAccountController::class, 'edit'])->name('accounts.edit');
    Route::put('/accounts/{id}', [\App\Http\Controllers\AdminAccountController::class, 'update'])->name('accounts.update');
    Route::post('/accounts/{id}/status', [\App\Http\Controllers\AdminAccountController::class, 'toggleStatus'])->name('accounts.status');
    Route::delete('/accounts/{id}', [\App\Http\Controllers\AdminAccountController::class, 'destroy'])->name('accounts.delete');

    // Transactions triggers
    Route::post('/accounts/{id}/deposit', [\App\Http\Controllers\AccountController::class, 'deposit'])->name('accounts.deposit');
    Route::post('/accounts/{id}/withdraw', [\App\Http\Controllers\AccountController::class, 'withdraw'])->name('accounts.withdraw');
});

// Customer Route Group
Route::middleware(['auth', 'verified', 'customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\CustomerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/edit', [\App\Http\Controllers\CustomerDashboardController::class, 'editProfileForm'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\CustomerDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/password/change', [\App\Http\Controllers\CustomerDashboardController::class, 'changePasswordForm'])->name('password.change');
    Route::put('/password', [\App\Http\Controllers\CustomerDashboardController::class, 'updatePassword'])->name('password.update');

    // Accounts Management
    Route::get('/accounts', [\App\Http\Controllers\CustomerAccountController::class, 'index'])->name('accounts.index');
    Route::get('/accounts/create', [\App\Http\Controllers\CustomerAccountController::class, 'create'])->name('accounts.create');
    Route::post('/accounts', [\App\Http\Controllers\CustomerAccountController::class, 'store'])->name('accounts.store');
    Route::get('/accounts/{id}/details', [\App\Http\Controllers\CustomerAccountController::class, 'details'])->name('account.details');
    Route::get('/accounts/{id}/edit', [\App\Http\Controllers\CustomerAccountController::class, 'edit'])->name('accounts.edit');
    Route::put('/accounts/{id}', [\App\Http\Controllers\CustomerAccountController::class, 'update'])->name('accounts.update');
    Route::get('/accounts/{id}/transactions', [\App\Http\Controllers\CustomerAccountController::class, 'transactions'])->name('account.transactions');

    // Self Transactions
    Route::get('/accounts/{id}/deposit', [\App\Http\Controllers\CustomerAccountController::class, 'showDepositForm'])->name('accounts.deposit.form');
    Route::post('/accounts/{id}/deposit', [\App\Http\Controllers\AccountController::class, 'deposit'])->name('accounts.deposit');
    Route::get('/accounts/{id}/withdraw', [\App\Http\Controllers\CustomerAccountController::class, 'showWithdrawForm'])->name('accounts.withdraw.form');
    Route::post('/accounts/{id}/withdraw', [\App\Http\Controllers\AccountController::class, 'withdraw'])->name('accounts.withdraw');
});
