@extends('admin.layout')

@section('title', 'Beneficiary Details')
@section('page_title', 'Beneficiary Overview')

@section('content')
<div class="row">
    <div class="col-12 col-md-8 mx-auto">
        <!-- Back trigger -->
        <a href="{{ route('admin.beneficiaries.index') }}" class="btn btn-outline-secondary mb-3" style="border-radius: 8px;">
            <i class="bi bi-arrow-left"></i> Back to approvals
        </a>

        <div class="card card-custom p-4 shadow-sm border-0">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 border-bottom pb-3">
                <div>
                    <h5 class="fw-bold m-0 text-slate-800">Beneficiary Link Details</h5>
                    <small class="text-muted">Registered by customer: <strong>{{ $beneficiary->user->name }}</strong></small>
                </div>
                <div>
                    @if($beneficiary->verification_status === 'verified')
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-semibold">Verified</span>
                    @elseif($beneficiary->verification_status === 'rejected')
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold">Rejected</span>
                    @else
                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill fw-semibold">Pending Verification</span>
                    @endif
                </div>
            </div>

            <div class="row g-3 text-sm mb-4">
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Beneficiary Account Name</span>
                    <span class="fw-bold text-slate-800 fs-5">{{ $beneficiary->beneficiary_name }}</span>
                    @if($beneficiary->nickname)
                        <span class="text-muted text-xs d-block">Alias: <strong>{{ $beneficiary->nickname }}</strong></span>
                    @endif
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Beneficiary Account Number</span>
                    <span class="fw-bold text-primary fs-5">{{ $beneficiary->account_number }}</span>
                </div>
                
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Bank Name / Branch Name</span>
                    <span class="fw-semibold text-slate-800">{{ $beneficiary->bank_name }} - {{ $beneficiary->branch_name }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Branch / SWIFT Code</span>
                    <span class="fw-semibold text-slate-800">Code: {{ $beneficiary->branch_code }} @if($beneficiary->swift_code) | SWIFT: {{ $beneficiary->swift_code }} @endif</span>
                </div>

                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Contact Email</span>
                    <span class="fw-semibold text-slate-800">{{ $beneficiary->email ?? 'Not provided' }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Contact Phone</span>
                    <span class="fw-semibold text-slate-800">{{ $beneficiary->phone ?? 'Not provided' }}</span>
                </div>

                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Relationship to Customer</span>
                    <span class="badge bg-light text-dark border px-2.5 py-1.5 rounded-pill mt-1">{{ ucfirst($beneficiary->relationship) }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Request Registered Time</span>
                    <span class="fw-semibold text-slate-800">{{ $beneficiary->created_at->format('F d, Y h:i A') }}</span>
                </div>
            </div>

            @if($beneficiary->verification_status === 'verified')
                <div class="alert alert-success border-0 rounded-4 p-3 mb-4 text-xs">
                    <i class="bi bi-shield-check fs-5 me-1"></i> Verified on <strong>{{ $beneficiary->verified_at->format('Y-m-d H:i') }}</strong> by administrator <strong>{{ $beneficiary->verifiedBy->name }}</strong>.
                </div>
            @endif

            <div class="border-top pt-3 d-flex gap-2 justify-content-end">
                @if($beneficiary->verification_status !== 'verified')
                    <form action="{{ route('admin.beneficiaries.verify', $beneficiary->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success px-4 py-2">
                            <i class="bi bi-check-lg me-1"></i> Verify / Approve
                        </button>
                    </form>
                @endif

                @if($beneficiary->verification_status !== 'rejected')
                    <form action="{{ route('admin.beneficiaries.reject', $beneficiary->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger px-4 py-2">
                            <i class="bi bi-slash-circle me-1"></i> Reject request
                        </button>
                    </form>
                @endif

                <form action="{{ route('admin.beneficiaries.delete', $beneficiary->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to soft-delete this beneficiary?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 py-2">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
