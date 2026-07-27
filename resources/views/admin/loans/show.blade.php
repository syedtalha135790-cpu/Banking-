@extends('admin.layout')

@section('title', 'Evaluate Loan Application')
@section('page_title', 'Evaluate Loan Application')

@section('content')
<div class="row g-4">
    <!-- Back trigger -->
    <div class="col-12">
        <a href="{{ route('admin.loans.index') }}" class="btn btn-outline-secondary" style="border-radius: 8px;">
            <i class="bi bi-arrow-left"></i> Back to Console
        </a>
    </div>

    <!-- Application File Details -->
    <div class="col-12 col-lg-7">
        <div class="card card-custom p-4 shadow-sm border-0 h-100">
            <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Loan Application Dossier</h5>

            <div class="row g-3 text-sm mb-4">
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Customer Registered Name</span>
                    <span class="fw-bold text-slate-800 fs-5">{{ $loan->user->name }}</span>
                    <span class="text-muted text-xs d-block">CNIC: <strong>{{ $loan->cnic }}</strong></span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Target Disbursement Account</span>
                    <span class="fw-bold text-primary fs-5">{{ $loan->account->account_number }}</span>
                    <span class="text-muted text-xs d-block">Type: {{ ucfirst($loan->account->account_type) }} | Bal: <strong>{{ number_format($loan->account->balance, 2) }}</strong></span>
                </div>

                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Requested Principal Amount</span>
                    <span class="fw-bold text-slate-800 fs-5">{{ number_format($loan->amount, 2) }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Repayment Duration</span>
                    <span class="fw-bold text-slate-800 fs-5">{{ $loan->duration }} Months</span>
                </div>

                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Employment / Employer</span>
                    <span class="fw-semibold text-slate-800">{{ ucfirst($loan->employment_status) }} @if($loan->employer_name) (At: {{ $loan->employer_name }}) @endif</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Declared Monthly Income</span>
                    <span class="fw-semibold text-slate-800">{{ number_format($loan->monthly_income, 2) }}</span>
                </div>

                <div class="col-12">
                    <span class="text-muted text-xs uppercase d-block">Detailed Purpose of Loan</span>
                    <p class="fw-medium text-slate-700 bg-light p-3 rounded-4 mt-1 mb-0 border border-light">{{ $loan->purpose_of_loan }}</p>
                </div>

                @if($loan->supporting_documents)
                    <div class="col-12">
                        <span class="text-muted text-xs uppercase d-block mb-1">Supporting Document File</span>
                        <a href="{{ asset('storage/' . $loan->supporting_documents) }}" target="_blank" class="btn btn-outline-primary py-2 px-3 text-sm" style="border-radius: 10px;">
                            <i class="bi bi-file-earmark-pdf-fill"></i> View/Download Financial Documents
                        </a>
                    </div>
                @endif
            </div>

            @if($loan->status === 'disbursed')
                <div class="alert alert-success border-0 rounded-4 p-3 d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check text-success fs-4"></i>
                    <div>
                        <strong>Disbursed:</strong> Loan approved at <strong>{{ $loan->interest_rate }}% interest rate</strong> and funds credited on {{ $loan->approval_date->format('Y-m-d') }}.
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Administrative Controls -->
    <div class="col-12 col-lg-5">
        <div class="card card-custom p-4 shadow-sm border-0 h-100">
            <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Administrative Evaluation</h5>

            @if($loan->status === 'pending' || $loan->status === 'under_review')
                <div class="mb-4">
                    <span class="text-muted text-xs d-block mb-3">Evaluator status controls:</span>
                    
                    @if($loan->status === 'pending')
                        <form action="{{ route('admin.loans.review', $loan->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-info w-100 py-2.5 mb-3 fw-semibold" style="border-radius: 12px;">
                                <i class="bi bi-search"></i> Mark as Under Review
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Approval Form -->
                <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST" class="border-top pt-4">
                    @csrf
                    <div class="mb-3">
                        <label for="interest_rate" class="form-label fw-bold">Assign Annual Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" max="50" name="interest_rate" id="interest_rate" class="form-control" required placeholder="e.g. 5.50">
                            <span class="input-group-text fw-bold">%</span>
                        </div>
                        <small class="text-muted d-block mt-1">Calculates and schedules the monthly EMI and total interest liabilities upon submission.</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success py-2.5 fw-semibold" style="border-radius: 12px;">
                            <i class="bi bi-check-circle-fill"></i> Approve & Disburse Funds
                        </button>
                    </div>
                </form>

                <!-- Rejection Form -->
                <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST" class="mt-3" onsubmit="return confirm('Are you sure you want to reject this loan application?');">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 py-2.5" style="border-radius: 12px;">
                        <i class="bi bi-x-circle-fill"></i> Reject Application
                    </button>
                </form>
            @else
                <!-- Show generated EMI schedule outline for admin audit -->
                <h6 class="fw-bold mb-3 text-dark">Schedule Overview</h6>
                <div class="space-y-2 text-xs">
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span class="text-muted">Monthly EMI:</span>
                        <span class="fw-bold">{{ number_format($loan->monthly_emi, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span class="text-muted">Total Interest:</span>
                        <span class="fw-bold">{{ number_format($loan->total_interest, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span class="text-muted">Total Payment liability:</span>
                        <span class="fw-bold text-dark">{{ number_format($loan->total_payment, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span class="text-muted">Current Outstanding Balance:</span>
                        <span class="fw-bold text-danger">{{ number_format($loan->outstanding_balance, 2) }}</span>
                    </div>
                </div>
                
                <div class="alert alert-light border mt-4 text-center text-muted text-xs rounded-4">
                    Evaluation is complete. No further administrative action is required for this loan file.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
