<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Customer Dashboard') - BMS</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #0f172a;
            color: #f8fafc;
            z-index: 1000;
            transition: all 0.3s;
        }
        .sidebar .nav-link {
            color: #94a3b8;
            font-weight: 500;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            margin: 0.2rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #ffffff;
            background-color: #1e293b;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
        }
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 2rem;
            margin-bottom: 2rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .card-custom {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01);
            background-color: #ffffff;
        }
        .btn-custom-primary {
            background-color: #2563eb;
            color: #ffffff;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            border: none;
        }
        .btn-custom-primary:hover {
            background-color: #1d4ed8;
            color: #ffffff;
        }
        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: -250px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-col justify-content-between py-4">
        <div>
            <div class="px-4 mb-4 d-flex align-items-center gap-2">
                <div class="p-2 bg-primary rounded-3 text-white d-inline-flex">
                    <i class="bi bi-bank fs-4"></i>
                </div>
                <span class="fw-bold fs-4 text-white">BMS Client</span>
            </div>
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.dashboard')) active @endif" href="{{ route('customer.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Welcome Page
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.accounts.index') || Route::is('customer.account.details') || Route::is('customer.accounts.edit') || Route::is('customer.account.transactions') || Route::is('customer.accounts.deposit.form') || Route::is('customer.accounts.withdraw.form')) active @endif" href="{{ route('customer.accounts.index') }}">
                        <i class="bi bi-wallet2"></i> My Bank Accounts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.accounts.create')) active @endif" href="{{ route('customer.accounts.create') }}">
                        <i class="bi bi-plus-square"></i> Open New Account
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.deposit')) active @endif" href="{{ route('customer.deposit') }}">
                        <i class="bi bi-cash-coin"></i> Deposit Money
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.withdraw')) active @endif" href="{{ route('customer.withdraw') }}">
                        <i class="bi bi-cash-stack"></i> Withdraw Money
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.transfer')) active @endif" href="{{ route('customer.transfer') }}">
                        <i class="bi bi-arrow-left-right"></i> Transfer Funds
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.transactions.index') || Route::is('customer.transactions.receipt')) active @endif" href="{{ route('customer.transactions.index') }}">
                        <i class="bi bi-list-columns-reverse"></i> My Transactions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.beneficiaries.index') || Route::is('customer.beneficiaries.create') || Route::is('customer.beneficiaries.edit')) active @endif" href="{{ route('customer.beneficiaries.index') }}">
                        <i class="bi bi-people"></i> Manage Beneficiaries
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.loans.index') || Route::is('customer.loans.apply') || Route::is('customer.loans.show') || Route::is('customer.loans.payments')) active @endif" href="{{ route('customer.loans.index') }}">
                        <i class="bi bi-cash-stack"></i> Loans & Repayments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.cards.index') || Route::is('customer.cards.requestDebit') || Route::is('customer.cards.requestCredit') || Route::is('customer.cards.track')) active @endif" href="{{ route('customer.cards.index') }}">
                        <i class="bi bi-credit-card"></i> Cards & Payments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.notifications.index')) active @endif" href="{{ route('customer.notifications.index') }}">
                        <i class="bi bi-bell"></i> Alerts & Notifications
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.profile.edit')) active @endif" href="{{ route('customer.profile.edit') }}">
                        <i class="bi bi-person-gear"></i> Edit Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::is('customer.password.change')) active @endif" href="{{ route('customer.password.change') }}">
                        <i class="bi bi-shield-lock"></i> Change Password
                    </a>
                </li>
            </ul>
        </div>
        <div class="px-4">
            <hr class="text-secondary">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn w-full btn-outline-danger d-flex align-items-center justify-content-center gap-2 py-2" style="border-radius: 8px;">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="navbar-custom d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-link d-lg-none p-0 text-dark" id="sidebarToggle">
                    <i class="bi bi-list fs-3"></i>
                </button>
                <h4 class="m-0 fw-bold text-slate-800">@yield('page_title', 'Dashboard')</h4>
            </div>
            
            @php
                $unreadNotificationsCount = \App\Models\Notification::where('user_id', Auth::id())->unread()->count();
                $recentNotifications = \App\Models\Notification::where('user_id', Auth::id())->orderBy('id', 'desc')->take(5)->get();
            @endphp

            <div class="d-flex align-items-center gap-2">
                <!-- Notifications Dropdown Bell -->
                <div class="dropdown me-3">
                    <button class="btn btn-link text-dark p-0 position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; box-shadow: none;">
                        <i class="bi bi-bell fs-4"></i>
                        @if($unreadNotificationsCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light" style="padding: 4px 6px; font-size: 9px;">
                                {{ $unreadNotificationsCount }}
                            </span>
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border border-light-subtle rounded-4 p-3" aria-labelledby="notificationDropdown" style="width: 320px; font-size: 13px; margin-top: 10px;">
                        <li class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                            <span class="fw-bold text-dark">Recent Alerts</span>
                            @if($unreadNotificationsCount > 0)
                                <form action="{{ route('customer.notifications.markAllRead') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-primary text-xs p-0 text-decoration-none" style="font-size: 11px;">Mark all read</button>
                                </form>
                            @endif
                        </li>
                        @forelse($recentNotifications as $notif)
                            <li class="mb-2 pb-2 border-bottom rounded p-1 {{ !$notif->is_read ? 'bg-light fw-semibold' : '' }}">
                                <div class="d-flex justify-content-between align-items-start">
                                    <span class="text-xs text-dark text-truncate" style="max-width: 180px;">{{ $notif->title }}</span>
                                    <span class="text-2xs text-muted" style="font-size: 9px;">{{ $notif->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-muted text-xs text-truncate mt-1" style="max-width: 280px; font-size: 11px;">
                                    {{ $notif->message }}
                                </div>
                            </li>
                        @empty
                            <li class="text-center py-3 text-muted text-xs">No recent notifications.</li>
                        @endforelse
                        <li class="text-center pt-2">
                            <a href="{{ route('customer.notifications.index') }}" class="text-primary fw-bold text-xs text-decoration-none">View All Alerts</a>
                        </li>
                    </ul>
                </div>

                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 fw-semibold d-none d-sm-inline-block">Customer Account</span>
                <div class="d-flex align-items-center gap-2 ms-2">
                    <div class="bg-secondary rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: 600;">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                    <span class="fw-semibold d-none d-md-inline">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 p-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 p-3 mb-4" role="alert">
                <ul class="m-0 pl-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- View Body Slot -->
        @yield('content')
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
