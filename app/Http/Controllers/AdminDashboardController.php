<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Loan;
use App\Models\Card;
use App\Models\CardRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * Display the Admin Dashboard with charts & logs.
     */
    public function index(Request $request)
    {
        // 1. Basic Stats Metrics
        $totalUsers = User::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        
        $totalAccounts = Account::count();
        $activeAccounts = Account::where('status', 'active')->count();
        $inactiveAccounts = Account::where('status', 'inactive')->count();
        
        $totalDeposits = Transaction::where('transaction_type', 'deposit')->sum('amount');
        $totalWithdrawals = Transaction::where('transaction_type', 'withdrawal')->sum('amount');
        $totalTransfers = Transaction::where('transaction_type', 'transfer_out')->sum('amount');
        $totalTransactions = Transaction::count();
        
        $totalLoans = Loan::count();
        $pendingLoans = Loan::where('status', 'pending')->count();
        $approvedLoans = Loan::whereIn('status', ['approved', 'disbursed'])->count();
        
        $totalDebitCards = Card::where('card_type', 'debit')->count();
        $totalCreditCards = Card::where('card_type', 'credit')->count();
        $pendingCardRequests = CardRequest::whereIn('request_status', ['pending', 'under_review'])->count();
        
        $totalBankBalance = Account::sum('balance');
        $todayTransactions = Transaction::whereDate('created_at', Carbon::today())->count();
        $monthlyTransactions = Transaction::whereMonth('created_at', Carbon::now()->month)->count();

        // 2. Compile Chart.js Datasets
        // Daily Transactions last 7 days
        $dailyData = Transaction::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        $chartDailyLabels = $dailyData->pluck('date')->map(fn($d) => Carbon::parse($d)->format('M d'))->toArray();
        $chartDailyValues = $dailyData->pluck('count')->toArray();

        // Monthly Transactions last 6 months
        $monthlyData = Transaction::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subMonths(5))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
        $chartMonthlyLabels = $monthlyData->pluck('month')->map(fn($m) => Carbon::parse($m . '-01')->format('F'))->toArray();
        $chartMonthlyValues = $monthlyData->pluck('count')->toArray();

        // Deposits vs Withdrawals sum totals
        $depositsSum = Transaction::where('transaction_type', 'deposit')->sum('amount');
        $withdrawalsSum = Transaction::where('transaction_type', 'withdrawal')->sum('amount');

        // Loan status distribution counts
        $loansPending = Loan::where('status', 'pending')->count();
        $loansDisbursed = Loan::where('status', 'disbursed')->count();
        $loansRejected = Loan::where('status', 'rejected')->count();

        // Account types
        $savingsCount = Account::where('account_type', 'savings')->count();
        $currentCount = Account::where('account_type', 'current')->count();

        // Card Requests
        $cardsPending = CardRequest::where('request_status', 'pending')->count();
        $cardsApproved = CardRequest::where('request_status', 'approved')->count();
        $cardsRejected = CardRequest::where('request_status', 'rejected')->count();

        // Customer Growth over time (User registrations count)
        $growthData = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('role', 'customer')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->take(10)
            ->get();
        $chartGrowthLabels = $growthData->pluck('date')->map(fn($d) => Carbon::parse($d)->format('M d'))->toArray();
        $chartGrowthValues = $growthData->pluck('count')->toArray();

        // 3. Recent Activities
        $recentUsers = User::orderBy('id', 'desc')->take(5)->get();
        $recentDeposits = Transaction::where('transaction_type', 'deposit')->orderBy('id', 'desc')->take(5)->get();
        $recentWithdrawals = Transaction::where('transaction_type', 'withdrawal')->orderBy('id', 'desc')->take(5)->get();
        $recentTransfers = Transaction::where('transaction_type', 'transfer_out')->orderBy('id', 'desc')->take(5)->get();
        $recentLoans = Loan::orderBy('id', 'desc')->take(5)->get();
        $recentCards = CardRequest::orderBy('id', 'desc')->take(5)->get();
        $recentNotifications = Notification::orderBy('id', 'desc')->take(5)->get();

        // User list for the table grid in dashboard
        $users = User::orderBy('id', 'desc')->paginate(10, ['*'], 'users_page');

        return view('admin.dashboard', compact(
            'totalUsers', 'totalCustomers', 'totalAdmins', 'totalAccounts', 'activeAccounts', 'inactiveAccounts',
            'totalDeposits', 'totalWithdrawals', 'totalTransfers', 'totalTransactions', 'totalLoans', 'pendingLoans',
            'approvedLoans', 'totalDebitCards', 'totalCreditCards', 'pendingCardRequests', 'totalBankBalance',
            'todayTransactions', 'monthlyTransactions',
            'chartDailyLabels', 'chartDailyValues',
            'chartMonthlyLabels', 'chartMonthlyValues',
            'depositsSum', 'withdrawalsSum',
            'loansPending', 'loansDisbursed', 'loansRejected',
            'savingsCount', 'currentCount',
            'cardsPending', 'cardsApproved', 'cardsRejected',
            'chartGrowthLabels', 'chartGrowthValues',
            'recentUsers', 'recentDeposits', 'recentWithdrawals', 'recentTransfers', 'recentLoans', 'recentCards', 'recentNotifications',
            'users'
        ));
    }

    /**
     * Reports generation console.
     */
    public function reports(Request $request)
    {
        $category = $request->input('category', 'transactions'); // transactions, accounts, loans, cards
        $range = $request->input('range', 'daily'); // daily, weekly, monthly, yearly

        $startDate = match ($range) {
            'daily' => Carbon::today(),
            'weekly' => Carbon::now()->subWeek(),
            'monthly' => Carbon::now()->subMonth(),
            'yearly' => Carbon::now()->subYear(),
            default => Carbon::today(),
        };

        $records = collect();

        if ($category === 'transactions') {
            $records = Transaction::with('account')->where('created_at', '>=', $startDate)->orderBy('id', 'desc')->get();
        } elseif ($category === 'accounts') {
            $records = Account::with('user')->where('created_at', '>=', $startDate)->orderBy('id', 'desc')->get();
        } elseif ($category === 'loans') {
            $records = Loan::with('user')->where('created_at', '>=', $startDate)->orderBy('id', 'desc')->get();
        } elseif ($category === 'cards') {
            $records = CardRequest::with('user')->where('created_at', '>=', $startDate)->orderBy('id', 'desc')->get();
        }

        return view('admin.reports.index', compact('records', 'category', 'range'));
    }

    /**
     * Show create user form.
     */
    public function createUserForm()
    {
        return view('admin.users.create');
    }

    /**
     * Store new user.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['nullable', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['admin', 'customer'])],
        ]);

        // Enforcement: Only an existing admin can create another admin
        if ($request->role === 'admin' && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Only admins can create admin accounts.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(), // Auto-activate for administrative ease
        ]);

        // Log User Created activity
        \App\Services\ActivityLogger::log('user_created', 'admin', "Admin Created User account: {$request->name} ({$request->role}).", Auth::id(), 'success');

        return redirect()->route('admin.dashboard')->with('success', 'User account created successfully.');
    }

    /**
     * Show edit user form.
     */
    public function editUserForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user details.
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone_number' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['admin', 'customer'])],
        ]);

        // Enforcement: Only an existing admin can assign another admin
        if ($request->role === 'admin' && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Only admins can assign the admin role.');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Log User Updated activity
        \App\Services\ActivityLogger::log('user_updated', 'admin', "Admin Updated User account details: {$user->name} (#{$user->id}).", Auth::id(), 'success');

        return redirect()->route('admin.dashboard')->with('success', 'User account updated successfully.');
    }

    /**
     * Delete user.
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent self-deletion
        if ($user->id === Auth::id()) {
            return back()->withErrors(['delete' => 'You cannot delete your own admin account.']);
        }

        $user->delete();

        // Log User Deleted activity
        \App\Services\ActivityLogger::log('user_deleted', 'admin', "Admin Deleted User account: {$user->name} (#{$user->id}).", Auth::id(), 'success');

        return redirect()->route('admin.dashboard')->with('success', 'User account deleted successfully.');
    }

    /**
     * Show admin profile.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Update admin profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone_number' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Log Profile update activity
        \App\Services\ActivityLogger::log('profile_update', 'admin', "Admin updated profile credentials.", Auth::id(), 'success');

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }
}
