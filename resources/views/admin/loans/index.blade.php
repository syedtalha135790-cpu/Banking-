@extends('admin.layout')

@section('title', 'Loan Applications')
@section('page_title', 'Loan Application Console')

@section('content')
<!-- Stats Cards Row -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card p-3 border-0 bg-primary text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Applications</span>
            <h4 class="fw-bold my-1">{{ $totalApplications }}</h4>
            <small class="text-3xs opacity-75">Submitted all-time</small>
        </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card p-3 border-0 bg-warning text-dark shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Pending Reviews</span>
            <h4 class="fw-bold my-1">{{ $pendingLoans }}</h4>
            <small class="text-3xs opacity-75">Needs evaluation</small>
        </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card p-3 border-0 bg-success text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Active Loans</span>
            <h4 class="fw-bold my-1">{{ $activeLoans }}</h4>
            <small class="text-3xs opacity-75">Repayment active</small>
        </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card p-3 border-0 bg-danger text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Rejected</span>
            <h4 class="fw-bold my-1">{{ $rejectedLoans }}</h4>
            <small class="text-3xs opacity-75">Rejected files</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card p-3 border-0 bg-dark text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Disbursed Principal</span>
            <h5 class="fw-bold my-1">{{ number_format($totalLoanAmount, 2) }}</h5>
            <small class="text-3xs opacity-75">Approved funds</small>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
        <div class="card p-3 border-0 bg-info text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Total EMI Collected</span>
            <h5 class="fw-bold my-1">{{ number_format($totalEmiCollected, 2) }}</h5>
            <small class="text-3xs opacity-75">Repayments logged</small>
        </div>
    </div>
</div>

<!-- Search & Filters Panel -->
<div class="card card-custom p-4 mb-4 shadow-sm border-0">
    <form action="{{ route('admin.loans.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-6">
            <label for="search" class="form-label fw-semibold text-xs text-muted">Search customer name / CNIC / purpose</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search...">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <label for="status" class="form-label fw-semibold text-xs text-muted">Verification Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="pending" @if(request('status') === 'pending') selected @endif>Pending</option>
                <option value="under_review" @if(request('status') === 'under_review') selected @endif>Under Review</option>
                <option value="disbursed" @if(request('status') === 'disbursed') selected @endif>Disbursed (Active)</option>
                <option value="completed" @if(request('status') === 'completed') selected @endif>Fully Paid</option>
                <option value="rejected" @if(request('status') === 'rejected') selected @endif>Rejected</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 py-2"><i class="bi bi-funnel-fill"></i> Filter</button>
            <a href="{{ route('admin.loans.index') }}" class="btn btn-outline-secondary w-100 py-2">Clear</a>
        </div>
    </form>
</div>

<!-- Applications Table -->
<div class="card card-custom p-4">
    <h5 class="fw-bold mb-4 text-dark">Loan Application Logs</h5>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Customer Name</th>
                    <th>Account Number</th>
                    <th>Type</th>
                    <th>Requested Principal</th>
                    <th>Income / Status</th>
                    <th>Status</th>
                    <th>Date Applied</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $loan->user->name }}</div>
                            <small class="text-muted">CNIC: {{ $loan->cnic }}</small>
                        </td>
                        <td class="fw-semibold text-primary">{{ $loan->account->account_number }}</td>
                        <td><span class="badge bg-light text-dark border px-2 py-1 rounded-pill">{{ ucfirst($loan->loan_type) }}</span></td>
                        <td class="fw-bold">{{ number_format($loan->amount, 2) }}</td>
                        <td>
                            <div class="text-dark fw-medium">Income: {{ number_format($loan->monthly_income, 2) }}</div>
                            <small class="text-muted">{{ ucfirst($loan->employment_status) }}</small>
                        </td>
                        <td>
                            @if($loan->status === 'disbursed')
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded-pill fw-semibold">Disbursed</span>
                            @elseif($loan->status === 'completed')
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1 rounded-pill fw-semibold">Fully Paid</span>
                            @elseif($loan->status === 'rejected')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1 rounded-pill fw-semibold">Rejected</span>
                            @elseif($loan->status === 'under_review')
                                <span class="badge bg-info-subtle text-info border border-info-subtle px-2.5 py-1 rounded-pill fw-semibold">Under Review</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1 rounded-pill fw-semibold">Pending</span>
                            @endif
                        </td>
                        <td class="text-muted text-xs">{{ $loan->application_date->format('Y-m-d H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.loans.show', $loan->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                <i class="bi bi-folder-check"></i> Evaluate
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">No loan applications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $loans->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
