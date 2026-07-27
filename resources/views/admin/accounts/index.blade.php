@extends('admin.layout')

@section('title', 'Manage Accounts')
@section('page_title', 'Bank Accounts Directory')

@section('content')
<!-- Accounts Summary Stats -->
<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom p-3 border-start border-primary border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1 text-xs">Total Accounts</h6>
                    <h4 class="fw-bold m-0">{{ $totalAccounts }}</h4>
                </div>
                <div class="bg-primary-subtle text-primary p-2 rounded-3">
                    <i class="bi bi-wallet2 fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom p-3 border-start border-info border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1 text-xs">Savings / Current</h6>
                    <h4 class="fw-bold m-0">{{ $totalSavings }} / {{ $totalCurrent }}</h4>
                </div>
                <div class="bg-info-subtle text-info p-2 rounded-3">
                    <i class="bi bi-bank fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom p-3 border-start border-success border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1 text-xs">Active Accounts</h6>
                    <h4 class="fw-bold m-0">{{ $activeAccounts }}</h4>
                </div>
                <div class="bg-success-subtle text-success p-2 rounded-3">
                    <i class="bi bi-patch-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card card-custom p-3 border-start border-danger border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1 text-xs">Inactive Accounts</h6>
                    <h4 class="fw-bold m-0">{{ $inactiveAccounts }}</h4>
                </div>
                <div class="bg-danger-subtle text-danger p-2 rounded-3">
                    <i class="bi bi-exclamation-triangle fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filters Panel -->
<div class="card card-custom p-4 mb-4 shadow-sm border-0">
    <form action="{{ route('admin.accounts.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-5">
            <label for="search" class="form-label fw-semibold text-xs text-muted">Search accounts</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search by name, email, account no, CNIC...">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <label for="type" class="form-label fw-semibold text-xs text-muted">Account Type</label>
            <select name="type" id="type" class="form-select">
                <option value="">All Types</option>
                <option value="savings" @if(request('type') === 'savings') selected @endif>Savings Account</option>
                <option value="current" @if(request('type') === 'current') selected @endif>Current Account</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-2">
            <label for="status" class="form-label fw-semibold text-xs text-muted">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="active" @if(request('status') === 'active') selected @endif>Active</option>
                <option value="inactive" @if(request('status') === 'inactive') selected @endif>Inactive</option>
            </select>
        </div>
        <div class="col-12 col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 py-2"><i class="bi bi-funnel-fill"></i> Filter</button>
            <a href="{{ route('admin.accounts.index') }}" class="btn btn-outline-secondary w-100 py-2">Clear</a>
        </div>
    </form>
</div>

<!-- Accounts Directory Table -->
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h5 class="fw-bold m-0">Active Accounts Directory</h5>
        <a href="{{ route('admin.accounts.create') }}" class="btn btn-custom-primary">
            <i class="bi bi-plus-lg me-1"></i> Open New Account
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Account Number</th>
                    <th>Customer Name</th>
                    <th>CNIC</th>
                    <th>Type</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts as $acc)
                    <tr>
                        <td class="fw-bold text-primary">{{ $acc->account_number }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $acc->user->name }}</div>
                            <small class="text-muted">{{ $acc->user->email }}</small>
                        </td>
                        <td>{{ $acc->cnic }}</td>
                        <td>
                            @if($acc->account_type === 'savings')
                                <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill">Savings</span>
                            @else
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">Current</span>
                            @endif
                        </td>
                        <td class="fw-bold text-dark">{{ number_format($acc->balance, 2) }}</td>
                        <td>
                            @if($acc->isActive())
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-pill fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> Active</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-pill fw-semibold"><i class="bi bi-x-circle-fill me-1"></i> Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.accounts.details', $acc->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="{{ route('admin.accounts.edit', $acc->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.accounts.delete', $acc->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to soft-delete this account?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No accounts match the criteria.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $accounts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
