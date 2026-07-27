@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('page_title', 'Core Banking Control Console')

@section('content')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Summary Cards Grid -->
<div class="row g-3 mb-4">
    <!-- Row 1: Global Finance & Users -->
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card p-3 border-0 bg-primary text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Total Pool Balance</span>
            <h3 class="fw-bold my-1">{{ number_format($totalBankBalance, 2) }}</h3>
            <small class="text-3xs opacity-75">All active deposits sum</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card p-3 border-0 bg-dark text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Total Customers</span>
            <h3 class="fw-bold my-1">{{ $totalCustomers }}</h3>
            <small class="text-3xs opacity-75">Admins: {{ $totalAdmins }} | Total: {{ $totalUsers }}</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card p-3 border-0 bg-success text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Total Accounts</span>
            <h3 class="fw-bold my-1">{{ $totalAccounts }}</h3>
            <small class="text-3xs opacity-75">Active: {{ $activeAccounts }} | Inactive: {{ $inactiveAccounts }}</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card p-3 border-0 bg-info text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Transactions Count</span>
            <h3 class="fw-bold my-1">{{ $totalTransactions }}</h3>
            <small class="text-3xs opacity-75">Today: {{ $todayTransactions }} | Month: {{ $monthlyTransactions }}</small>
        </div>
    </div>

    <!-- Row 2: Financial Streams & Loans -->
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card p-3 border-0 bg-success-subtle text-success border border-success-subtle shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Total Deposits</span>
            <h4 class="fw-bold my-1">{{ number_format($totalDeposits, 2) }}</h4>
            <small class="text-3xs opacity-75">Inbound Cash flow</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card p-3 border-0 bg-danger-subtle text-danger border border-danger-subtle shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Total Withdrawals</span>
            <h4 class="fw-bold my-1">{{ number_format($totalWithdrawals, 2) }}</h4>
            <small class="text-3xs opacity-75">Outbound Cash flow</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card p-3 border-0 bg-warning-subtle text-warning border border-warning-subtle shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Loan Requests</span>
            <h4 class="fw-bold my-1">{{ $totalLoans }}</h4>
            <small class="text-3xs opacity-75">Pending: {{ $loansPending }} | Disbursed: {{ $loansDisbursed }}</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card p-3 border-0 bg-primary-subtle text-primary border border-primary-subtle shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Card Accounts</span>
            <h4 class="fw-bold my-1">{{ $totalDebitCards + $totalCreditCards }}</h4>
            <small class="text-3xs opacity-75">Debit: {{ $totalDebitCards }} | Credit: {{ $totalCreditCards }} | Req: {{ $pendingCardRequests }}</small>
        </div>
    </div>
</div>

<!-- Interactive Chart.js Grid -->
<div class="row g-4 mb-4">
    <!-- Chart 1: Daily Transactions -->
    <div class="col-12 col-lg-6">
        <div class="card card-custom p-3 shadow-sm border-0 h-100">
            <h6 class="fw-bold text-dark mb-3">Daily Transaction Count (Last 7 Days)</h6>
            <div style="height: 250px; position: relative;">
                <canvas id="chartDaily"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 2: Deposits vs Withdrawals -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card card-custom p-3 shadow-sm border-0 h-100">
            <h6 class="fw-bold text-dark mb-3">Cash Volumes</h6>
            <div style="height: 250px; position: relative; display: flex; align-items: center; justify-content: center;">
                <canvas id="chartFinances"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 3: Account Types breakdown -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card card-custom p-3 shadow-sm border-0 h-100">
            <h6 class="fw-bold text-dark mb-3">Account Categories</h6>
            <div style="height: 250px; position: relative; display: flex; align-items: center; justify-content: center;">
                <canvas id="chartAccounts"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 4: Customer growth over time -->
    <div class="col-12 col-lg-6">
        <div class="card card-custom p-3 shadow-sm border-0 h-100">
            <h6 class="fw-bold text-dark mb-3">Customer Growth Line</h6>
            <div style="height: 250px; position: relative;">
                <canvas id="chartGrowth"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 5: Loan Decisions breakdown -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card card-custom p-3 shadow-sm border-0 h-100">
            <h6 class="fw-bold text-dark mb-3">Loan Operations</h6>
            <div style="height: 250px; position: relative; display: flex; align-items: center; justify-content: center;">
                <canvas id="chartLoans"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 6: Card Networks requests -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card card-custom p-3 shadow-sm border-0 h-100">
            <h6 class="fw-bold text-dark mb-3">Card Applications</h6>
            <div style="height: 250px; position: relative; display: flex; align-items: center; justify-content: center;">
                <canvas id="chartCards"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities Timelines & User Ledger -->
<div class="row g-4">
    <!-- User Ledger Directory -->
    <div class="col-12 col-xl-7">
        <div class="card card-custom p-4 shadow-sm border-0 h-100">
            <h5 class="fw-bold text-dark mb-3">System Access Directory</h5>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>User Name</th>
                            <th>Email Address</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th class="text-center">Control Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $u->name }}</div>
                                    <small class="text-muted">Registered: {{ $u->created_at->format('Y-m-d') }}</small>
                                </td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->phone_number ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $u->role === 'admin' ? 'bg-danger-subtle text-danger' : 'bg-primary-subtle text-primary' }} px-2 py-1 rounded-pill">
                                        {{ ucfirst($u->role) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        @if($u->id !== Auth::id())
                                            <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" onsubmit="return confirm('Delete this user account?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- Recent Activities Timeline -->
    <div class="col-12 col-xl-5">
        <div class="card card-custom p-4 shadow-sm border-0 h-100">
            <h5 class="fw-bold text-dark mb-3">System Events Log</h5>
            
            <ul class="nav nav-tabs mb-3" id="timelineTabs" role="tablist" style="font-size: 11px;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="act-trans-tab" data-bs-toggle="tab" data-bs-target="#act-trans" type="button" role="tab">Transactions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="act-loans-tab" data-bs-toggle="tab" data-bs-target="#act-loans" type="button" role="tab">Loans</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="act-cards-tab" data-bs-toggle="tab" data-bs-target="#act-cards" type="button" role="tab">Cards</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="act-users-tab" data-bs-toggle="tab" data-bs-target="#act-users" type="button" role="tab">Registrations</button>
                </li>
            </ul>

            <div class="tab-content" id="timelineTabsContent" style="font-size: 13px;">
                <!-- Transactions Tab -->
                <div class="tab-pane fade show active" id="act-trans" role="tabpanel">
                    <ul class="list-group list-group-flush">
                        @forelse($recentDeposits->merge($recentWithdrawals)->sortByDesc('created_at')->take(5) as $t)
                            <li class="list-group-item px-0 py-2 border-bottom-dashed">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-semibold text-slate-800">{{ ucfirst($t->transaction_type) }} alert</span>
                                    <span class="text-xs text-muted">{{ $t->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-muted text-xs">Amount: <strong>{{ number_format($t->amount, 2) }}</strong> | Ref: {{ $t->reference_number }}</div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-3">No recent transactions.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Loans Tab -->
                <div class="tab-pane fade" id="act-loans" role="tabpanel">
                    <ul class="list-group list-group-flush">
                        @forelse($recentLoans as $l)
                            <li class="list-group-item px-0 py-2 border-bottom-dashed">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-semibold text-slate-800">{{ ucfirst($l->loan_type) }} Application</span>
                                    <span class="text-xs text-muted">{{ $l->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-muted text-xs">Amount: <strong>{{ number_format($l->amount, 2) }}</strong> | Status: <span class="badge bg-light text-dark border">{{ $l->status }}</span></div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-3">No recent loan requests.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Cards Tab -->
                <div class="tab-pane fade" id="act-cards" role="tabpanel">
                    <ul class="list-group list-group-flush">
                        @forelse($recentCards as $c)
                            <li class="list-group-item px-0 py-2 border-bottom-dashed">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-semibold text-slate-800">{{ ucfirst($c->card_type) }} Card Request</span>
                                    <span class="text-xs text-muted">{{ $c->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-muted text-xs">Network: <strong class="text-uppercase">{{ $c->card_network }}</strong> | Status: <span class="badge bg-light text-dark border">{{ $c->request_status }}</span></div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-3">No recent card requests.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Registrations Tab -->
                <div class="tab-pane fade" id="act-users" role="tabpanel">
                    <ul class="list-group list-group-flush">
                        @forelse($recentUsers as $u)
                            <li class="list-group-item px-0 py-2 border-bottom-dashed">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-semibold text-slate-800">{{ $u->name }}</span>
                                    <span class="text-xs text-muted">{{ $u->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-muted text-xs">Role: {{ ucfirst($u->role) }} | Email: {{ $u->email }}</div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-3">No recent user registrations.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart Datasets Scripts -->
<script>
    // 1. Daily Transactions Chart
    const ctxDaily = document.getElementById('chartDaily').getContext('2d');
    new Chart(ctxDaily, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartDailyLabels) !!},
            datasets: [{
                label: 'Transactions Count',
                data: {!! json_encode($chartDailyValues) !!},
                backgroundColor: '#2563eb',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // 2. Deposits vs Withdrawals sum totals
    const ctxFinances = document.getElementById('chartFinances').getContext('2d');
    new Chart(ctxFinances, {
        type: 'doughnut',
        data: {
            labels: ['Deposits', 'Withdrawals'],
            datasets: [{
                data: [{{ $depositsSum }}, {{ $withdrawalsSum }}],
                backgroundColor: ['#2ecc71', '#e74c3c'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // 3. Account types
    const ctxAccounts = document.getElementById('chartAccounts').getContext('2d');
    new Chart(ctxAccounts, {
        type: 'pie',
        data: {
            labels: ['Savings', 'Current'],
            datasets: [{
                data: [{{ $savingsCount }}, {{ $currentCount }}],
                backgroundColor: ['#3498db', '#f1c40f'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // 4. Customer growth line
    const ctxGrowth = document.getElementById('chartGrowth').getContext('2d');
    new Chart(ctxGrowth, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartGrowthLabels) !!},
            datasets: [{
                label: 'Customer Registrations',
                data: {!! json_encode($chartGrowthValues) !!},
                borderColor: '#1e3c72',
                borderWidth: 3,
                tension: 0.3,
                fill: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // 5. Loan operations
    const ctxLoans = document.getElementById('chartLoans').getContext('2d');
    new Chart(ctxLoans, {
        type: 'polarArea',
        data: {
            labels: ['Pending', 'Disbursed', 'Rejected'],
            datasets: [{
                data: [{{ $loansPending }}, {{ $loansDisbursed }}, {{ $loansRejected }}],
                backgroundColor: ['#f39c12', '#27ae60', '#c0392b'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // 6. Card network requests
    const ctxCards = document.getElementById('chartCards').getContext('2d');
    new Chart(ctxCards, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                data: [{{ $cardsPending }}, {{ $cardsApproved }}, {{ $cardsRejected }}],
                backgroundColor: ['#e67e22', '#2ecc71', '#95a5a6'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endsection
