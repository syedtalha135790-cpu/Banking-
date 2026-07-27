@extends('customer.layout')

@section('title', 'Manage Beneficiaries')
@section('page_title', 'Manage Beneficiaries')

@section('content')
<!-- Search & Filters Panel -->
<div class="card card-custom p-4 mb-4 shadow-sm border-0">
    <form action="{{ route('customer.beneficiaries.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-6">
            <label for="search" class="form-label fw-semibold text-xs text-muted">Search beneficiary name / account number / nickname</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search...">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <label for="status" class="form-label fw-semibold text-xs text-muted">Verification Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="pending" @if(request('status') === 'pending') selected @endif>Pending Verification</option>
                <option value="verified" @if(request('status') === 'verified') selected @endif>Verified</option>
                <option value="rejected" @if(request('status') === 'rejected') selected @endif>Rejected</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 py-2"><i class="bi bi-funnel-fill"></i> Filter</button>
            <a href="{{ route('customer.beneficiaries.index') }}" class="btn btn-outline-secondary w-100 py-2">Clear</a>
        </div>
    </form>
</div>

<!-- Beneficiaries Directory list -->
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h5 class="fw-bold m-0 text-dark">Beneficiary Accounts Directory</h5>
            <p class="text-muted text-xs m-0">You can transfer funds only to Verified beneficiaries.</p>
        </div>
        <a href="{{ route('customer.beneficiaries.create') }}" class="btn btn-custom-primary">
            <i class="bi bi-plus-lg me-1"></i> Register Beneficiary
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Beneficiary Name</th>
                    <th>Account Number</th>
                    <th>Bank / Branch</th>
                    <th>Relationship</th>
                    <th>Verification Status</th>
                    <th>Registered Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beneficiaries as $b)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $b->beneficiary_name }}</div>
                            @if($b->nickname)
                                <small class="text-muted">Alias: <strong>{{ $b->nickname }}</strong></small>
                            @endif
                        </td>
                        <td class="fw-bold text-primary">{{ $b->account_number }}</td>
                        <td>
                            <div class="text-dark fw-semibold">{{ $b->bank_name }}</div>
                            <small class="text-muted">{{ $b->branch_name }} ({{ $b->branch_code }})</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2.5 py-1.5 rounded-pill">{{ ucfirst($b->relationship) }}</span>
                        </td>
                        <td>
                            @if($b->verification_status === 'verified')
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-pill fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> Verified</span>
                            @elseif($b->verification_status === 'rejected')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-pill fw-semibold"><i class="bi bi-x-circle-fill me-1"></i> Rejected</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1.5 rounded-pill fw-semibold"><i class="bi bi-clock-history me-1"></i> Pending Verification</span>
                            @endif
                        </td>
                        <td class="text-muted text-xs">{{ $b->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                @if($b->isVerified())
                                    <a href="{{ route('customer.transfer') }}?receiver={{ $b->account_number }}" class="btn btn-sm btn-success" style="border-radius: 8px;">
                                        <i class="bi bi-arrow-left-right me-1"></i> Transfer
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-success disabled" style="border-radius: 8px;" title="Only verified beneficiaries can receive transfers.">
                                        <i class="bi bi-arrow-left-right me-1"></i> Transfer
                                    </button>
                                @endif
                                <a href="{{ route('customer.beneficiaries.edit', $b->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('customer.beneficiaries.delete', $b->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this beneficiary?');">
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
                        <td colspan="7" class="text-center py-4 text-muted">No beneficiaries match the criteria.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $beneficiaries->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
