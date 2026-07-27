@extends('admin.layout')

@section('title', 'Card Management')
@section('page_title', 'Card Operations Console')

@section('content')
<!-- Stats Cards Row -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card p-3 border-0 bg-primary text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Card Requests</span>
            <h4 class="fw-bold my-1">{{ $totalRequests }}</h4>
            <small class="text-3xs opacity-75">Submitted all-time</small>
        </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card p-3 border-0 bg-warning text-dark shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Pending Reviews</span>
            <h4 class="fw-bold my-1">{{ $pendingRequests }}</h4>
            <small class="text-3xs opacity-75">Applications pending</small>
        </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card p-3 border-0 bg-success text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Active Cards</span>
            <h4 class="fw-bold my-1">{{ $activeCards }}</h4>
            <small class="text-3xs opacity-75">Active globally</small>
        </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card p-3 border-0 bg-danger text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Blocked Cards</span>
            <h4 class="fw-bold my-1">{{ $blockedCards }}</h4>
            <small class="text-3xs opacity-75">Frozen accounts</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card p-3 border-0 bg-dark text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Debit Cards</span>
            <h4 class="fw-bold my-1">{{ $debitCards }}</h4>
            <small class="text-3xs opacity-75">Issued debit lines</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card p-3 border-0 bg-info text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Credit Cards</span>
            <h4 class="fw-bold my-1">{{ $creditCards }}</h4>
            <small class="text-3xs opacity-75">Issued credit lines</small>
        </div>
    </div>
</div>

<!-- Search & Filters Panel -->
<div class="card card-custom p-4 mb-4 shadow-sm border-0">
    <form action="{{ route('admin.cards.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-6">
            <label for="search" class="form-label fw-semibold text-xs text-muted">Search customer name / card number / phone</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search...">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <label for="type" class="form-label fw-semibold text-xs text-muted">Card Category</label>
            <select name="type" id="type" class="form-select">
                <option value="">All Types</option>
                <option value="debit" @if(request('type') === 'debit') selected @endif>Debit Card</option>
                <option value="credit" @if(request('type') === 'credit') selected @endif>Credit Card</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 py-2"><i class="bi bi-funnel-fill"></i> Filter</button>
            <a href="{{ route('admin.cards.index') }}" class="btn btn-outline-secondary w-100 py-2">Clear</a>
        </div>
    </form>
</div>

<!-- Tabs Card -->
<div class="card card-custom p-4">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs mb-4" id="cardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold" id="requests-tab" data-bs-toggle="tab" data-bs-target="#requests-pane" type="button" role="tab">
                Card Requests ({{ $requests->total() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold" id="issued-tab" data-bs-toggle="tab" data-bs-target="#issued-pane" type="button" role="tab">
                Issued Cards Ledger ({{ $cards->total() }})
            </button>
        </li>
    </ul>

    <!-- Tab contents -->
    <div class="tab-content" id="cardTabsContent">
        <!-- Requests tab pane -->
        <div class="tab-pane fade show active" id="requests-pane" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Customer Name</th>
                            <th>Account No.</th>
                            <th>Card Type</th>
                            <th>Network</th>
                            <th>Income / Declared</th>
                            <th>Status</th>
                            <th>Date Applied</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $r)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $r->user->name }}</div>
                                    <small class="text-muted">Contact: {{ $r->phone_number }}</small>
                                </td>
                                <td class="fw-semibold text-primary">{{ $r->account->account_number }}</td>
                                <td><span class="badge bg-light text-dark border px-2 py-1 rounded-pill">{{ ucfirst($r->card_type) }} Card</span></td>
                                <td class="text-uppercase fw-semibold">{{ $r->card_network }}</td>
                                <td>
                                    @if($r->card_type === 'credit')
                                        <div class="text-xs fw-semibold">Income: {{ number_format($r->monthly_income, 2) }}</div>
                                        <small class="text-muted">Limit req: {{ number_format($r->credit_limit_requested, 2) }}</small>
                                    @else
                                        <span class="text-muted text-xs">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($r->request_status === 'approved' || $r->request_status === 'delivered')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill fw-semibold">{{ ucfirst($r->request_status) }}</span>
                                    @elseif($r->request_status === 'rejected')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill fw-semibold">Rejected</span>
                                    @elseif($r->request_status === 'shipped')
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1 rounded-pill fw-semibold">Shipped</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 rounded-pill fw-semibold">{{ ucfirst(str_replace('_', ' ', $r->request_status)) }}</span>
                                    @endif
                                </td>
                                <td class="text-muted text-xs">{{ $r->created_at->format('Y-m-d H:i') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.cards.show', $r->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                        <i class="bi bi-folder-check"></i> Evaluate
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No pending card requests.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $requests->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Issued Cards pane -->
        <div class="tab-pane fade" id="issued-pane" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Cardholder Name</th>
                            <th>Card Number</th>
                            <th>Card Type</th>
                            <th>Network</th>
                            <th>Credit Limit</th>
                            <th>Expiry</th>
                            <th>Status</th>
                            <th class="text-center">Control Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cards as $c)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $c->user->name }}</div>
                                    <small class="text-muted">Account: {{ $c->account->account_number }}</small>
                                </td>
                                <td class="fw-bold text-primary tracking-widest">{{ $c->masked_number }}</td>
                                <td><span class="badge bg-light text-dark border px-2 py-1 rounded-pill">{{ ucfirst($c->card_type) }} Card</span></td>
                                <td class="text-uppercase fw-semibold">{{ $c->card_network }}</td>
                                <td>
                                    @if($c->card_type === 'credit')
                                        <span class="fw-bold">{{ number_format($c->credit_limit, 2) }}</span>
                                    @else
                                        <span class="text-muted text-xs">-</span>
                                    @endif
                                </td>
                                <td class="text-muted text-xs">{{ $c->expiry_date->format('m/y') }}</td>
                                <td>
                                    @if($c->status === 'active')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-pill fw-semibold">Active</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-pill fw-semibold">Blocked</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.cards.toggleStatus', $c->id) }}" method="POST">
                                        @csrf
                                        @if($c->status === 'active')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                                                <i class="bi bi-lock-fill me-1"></i> Freeze Card
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-success" style="border-radius: 8px;">
                                                <i class="bi bi-unlock-fill me-1"></i> Activate / Unfreeze
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No issued cards registered in ledger.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $cards->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
