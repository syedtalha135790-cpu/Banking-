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

    // Transactions Audits & Exports
    Route::get('/transactions', [\App\Http\Controllers\AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/export', [\App\Http\Controllers\AdminTransactionController::class, 'exportCsv'])->name('transactions.export');
    Route::get('/transactions/{id}', [\App\Http\Controllers\AdminTransactionController::class, 'show'])->name('transactions.show');

    // Beneficiary Audits
    Route::get('/beneficiaries', [\App\Http\Controllers\AdminBeneficiaryController::class, 'index'])->name('beneficiaries.index');
    Route::get('/beneficiaries/{id}', [\App\Http\Controllers\AdminBeneficiaryController::class, 'show'])->name('beneficiaries.show');
    Route::post('/beneficiaries/{id}/verify', [\App\Http\Controllers\AdminBeneficiaryController::class, 'verify'])->name('beneficiaries.verify');
    Route::post('/beneficiaries/{id}/reject', [\App\Http\Controllers\AdminBeneficiaryController::class, 'reject'])->name('beneficiaries.reject');
    Route::delete('/beneficiaries/{id}', [\App\Http\Controllers\AdminBeneficiaryController::class, 'destroy'])->name('beneficiaries.delete');

    // Loan Management review & approvals
    Route::get('/loans', [\App\Http\Controllers\AdminLoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/{id}', [\App\Http\Controllers\AdminLoanController::class, 'show'])->name('loans.show');
    Route::post('/loans/{id}/review', [\App\Http\Controllers\AdminLoanController::class, 'underReview'])->name('loans.review');
    Route::post('/loans/{id}/approve', [\App\Http\Controllers\AdminLoanController::class, 'approve'])->name('loans.approve');
    Route::post('/loans/{id}/reject', [\App\Http\Controllers\AdminLoanController::class, 'reject'])->name('loans.reject');

    // Card Management review & status updates
    Route::get('/cards', [\App\Http\Controllers\AdminCardController::class, 'index'])->name('cards.index');
    Route::get('/cards/{id}', [\App\Http\Controllers\AdminCardController::class, 'show'])->name('cards.show');
    Route::post('/cards/{id}/approve', [\App\Http\Controllers\AdminCardController::class, 'approve'])->name('cards.approve');
    Route::post('/cards/{id}/reject', [\App\Http\Controllers\AdminCardController::class, 'reject'])->name('cards.reject');
    Route::post('/cards/{id}/toggle-status', [\App\Http\Controllers\AdminCardController::class, 'toggleStatus'])->name('cards.toggleStatus');
    Route::post('/cards/{id}/delivery-status', [\App\Http\Controllers\AdminCardController::class, 'updateDeliveryStatus'])->name('cards.deliveryStatus');

    // Notification Logs
    Route::get('/notifications', [\App\Http\Controllers\AdminNotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/resend', [\App\Http\Controllers\AdminNotificationController::class, 'resend'])->name('notifications.resend');

    // Reports Engine logs
    Route::get('/reports', [\App\Http\Controllers\AdminDashboardController::class, 'reports'])->name('reports');
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

    // Transactions General Portals
    Route::get('/deposit', [\App\Http\Controllers\CustomerTransactionController::class, 'depositForm'])->name('deposit');
    Route::post('/deposit', [\App\Http\Controllers\TransactionController::class, 'deposit'])->name('deposit.post');
    Route::get('/withdraw', [\App\Http\Controllers\CustomerTransactionController::class, 'withdrawForm'])->name('withdraw');
    Route::post('/withdraw', [\App\Http\Controllers\TransactionController::class, 'withdraw'])->name('withdraw.post');
    Route::get('/transfer', [\App\Http\Controllers\CustomerTransactionController::class, 'transferForm'])->name('transfer');
    Route::post('/transfer', [\App\Http\Controllers\TransactionController::class, 'transfer'])->name('transfer.post');
    Route::get('/transactions', [\App\Http\Controllers\CustomerTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}/receipt', [\App\Http\Controllers\CustomerTransactionController::class, 'receipt'])->name('transactions.receipt');

    // Beneficiary CRUD
    Route::get('/beneficiaries', [\App\Http\Controllers\BeneficiaryController::class, 'index'])->name('beneficiaries.index');
    Route::get('/beneficiaries/create', [\App\Http\Controllers\BeneficiaryController::class, 'create'])->name('beneficiaries.create');
    Route::post('/beneficiaries', [\App\Http\Controllers\BeneficiaryController::class, 'store'])->name('beneficiaries.store');
    Route::get('/beneficiaries/{id}/edit', [\App\Http\Controllers\BeneficiaryController::class, 'edit'])->name('beneficiaries.edit');
    Route::put('/beneficiaries/{id}', [\App\Http\Controllers\BeneficiaryController::class, 'update'])->name('beneficiaries.update');
    Route::delete('/beneficiaries/{id}', [\App\Http\Controllers\BeneficiaryController::class, 'destroy'])->name('beneficiaries.delete');

    // Loan Management self service
    Route::get('/loans', [\App\Http\Controllers\LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/apply', [\App\Http\Controllers\LoanController::class, 'applyForm'])->name('loans.apply');
    Route::post('/loans', [\App\Http\Controllers\LoanController::class, 'storeApplication'])->name('loans.store');
    Route::get('/loans/{id}', [\App\Http\Controllers\LoanController::class, 'show'])->name('loans.show');
    Route::get('/loan-payments', [\App\Http\Controllers\LoanPaymentController::class, 'index'])->name('loans.payments');
    Route::post('/loan-payments/{id}/pay', [\App\Http\Controllers\LoanPaymentController::class, 'pay'])->name('loans.pay');
    Route::get('/loan-payments/{id}/receipt', [\App\Http\Controllers\LoanPaymentController::class, 'receipt'])->name('loans.receipt');

    // Card Management self service
    Route::get('/cards', [\App\Http\Controllers\CardController::class, 'index'])->name('cards.index');
    Route::get('/cards/request-debit', [\App\Http\Controllers\CardController::class, 'requestDebitForm'])->name('cards.requestDebit');
    Route::post('/cards/request-debit', [\App\Http\Controllers\CardController::class, 'storeDebitRequest'])->name('cards.storeDebit');
    Route::get('/cards/request-credit', [\App\Http\Controllers\CardController::class, 'requestCreditForm'])->name('cards.requestCredit');
    Route::post('/cards/request-credit', [\App\Http\Controllers\CardController::class, 'storeCreditRequest'])->name('cards.storeCredit');
    Route::post('/cards/{id}/block', [\App\Http\Controllers\CardController::class, 'block'])->name('cards.block');
    Route::post('/cards/{id}/replace', [\App\Http\Controllers\CardController::class, 'replace'])->name('cards.replace');
    Route::get('/cards/{id}/track', [\App\Http\Controllers\CardController::class, 'track'])->name('cards.track');

    // Notification Center self service
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'read'])->name('notifications.read');
    Route::delete('/notifications/{id}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.delete');
    Route::post('/notifications/mark-all-read', [\App\Http\Controllers\NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
});
