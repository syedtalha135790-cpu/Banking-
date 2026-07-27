@extends('admin.layout')

@section('title', 'Beneficiary Approvals')
@section('page_title', 'Beneficiary Verification Console')

@section('content')
<!-- Search & Filters Panel -->
<div class="card card-custom p-4 mb-4 shadow-sm border-0">
    <form action="{{ route('admin.beneficiaries.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-6">
            <label for="search" class="form-label fw-semibold text-xs text-muted">Search beneficiary name / account number / registered customer</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search...">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <label for="status" class="form-label fw-semibold text-xs text-muted">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="pending" @if(request('status') === 'pending') selected @endif>Pending Verification</option>
                <option value="verified" @if(request('status') === 'verified') selected @endif>Verified</option>
                <option value="rejected" @if(request('status') === 'rejected') selected @endif>Rejected</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 py-2"><i class="bi bi-funnel-fill"></i> Filter</button>
            <a href="{{ route('admin.beneficiaries.index') }}" class="btn btn-outline-secondary w-100 py-2">Clear</a>
        </div>
    </form>
</div>

<!-- Ledger Card -->
<div class="card card-custom p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Registered Customer</th>
                    <th>Beneficiary Name</th>
                    <th>Account Number</th>
                    <th>Bank Name</th>
                    <th>Status</th>
                    <th>Verified By</th>
                    <th class="text-center">Verification Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beneficiaries as $b)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $b->user->name }}</div>
                            <small class="text-muted">{{ $b->user->email }}</small>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $b->beneficiary_name }}</div>
                            @if($b->nickname)
                                <small class="text-muted">Alias: {{ $b->nickname }}</small>
                            @endif
                        </td>
                        <td class="fw-bold text-primary">{{ $b->account_number }}</td>
                        <td>{{ $b->bank_name }}</td>
                        <td>
                            @if($b->verification_status === 'verified')
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-pill fw-semibold">Verified</span>
                            @elseif($b->verification_status === 'rejected')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-pill fw-semibold">Rejected</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1.5 rounded-pill fw-semibold">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($b->verifiedBy)
                                <div class="text-xs fw-semibold text-dark">{{ $b->verifiedBy->name }}</div>
                                <small class="text-muted text-3xs">{{ $b->verified_at->format('Y-m-d H:i') }}</small>
                            @else
                                <span class="text-muted text-xs">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.beneficiaries.show', $b->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                    <i class="bi bi-eye"></i> Details
                                </a>

                                @if($b->verification_status !== 'verified')
                                    <form action="{{ route('admin.beneficiaries.verify', $b->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" style="border-radius: 8px;">
                                            <i class="bi bi-check-lg"></i> Verify
                                        </button>
                                    </form>
                                @endif

                                @if($b->verification_status !== 'rejected')
                                    <form action="{{ route('admin.beneficiaries.reject', $b->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                                            <i class="bi bi-slash-circle"></i> Reject
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.beneficiaries.delete', $b->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to soft-delete this beneficiary?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="border-radius: 8px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No beneficiary records found.</td>
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
