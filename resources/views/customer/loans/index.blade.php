@extends('customer.layout')

@section('title', 'Loans & Repayments')
@section('page_title', 'My Loans & Repayments')

@section('content')
<!-- Stats Cards Row -->
<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card p-3 border-0 bg-primary text-white shadow-sm h-100" style="border-radius: 16px;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-xs uppercase fw-bold opacity-75">Active Loans</span>
                <i class="bi bi-wallet2 fs-4"></i>
            </div>
            <h3 class="fw-bold m-0">{{ $activeLoans->count() }}</h3>
            <small class="opacity-75">Currently active plans</small>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card p-3 border-0 bg-info text-white shadow-sm h-100" style="border-radius: 16px;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-xs uppercase fw-bold opacity-75">Pending Reviews</span>
                <i class="bi bi-clock-history fs-4"></i>
            </div>
            <h3 class="fw-bold m-0">{{ $pendingApplications->count() }}</h3>
            <small class="opacity-75">Awaiting authorization</small>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card p-3 border-0 bg-danger text-white shadow-sm h-100" style="border-radius: 16px;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-xs uppercase fw-bold opacity-75">Monthly EMI Due</span>
                <i class="bi bi-calendar-event fs-4"></i>
            </div>
            <h3 class="fw-bold m-0">{{ number_format($emiDueSum, 2) }}</h3>
            <small class="opacity-75">Due this month</small>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card p-3 border-0 bg-dark text-white shadow-sm h-100" style="border-radius: 16px;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-xs uppercase fw-bold opacity-75">Remaining Balance</span>
                <i class="bi bi-piggy-bank fs-4"></i>
            </div>
            <h3 class="fw-bold m-0">{{ number_format($remainingBalance, 2) }}</h3>
            <small class="opacity-75">Total outstanding liability</small>
        </div>
    </div>
</div>

@if($nextPayment)
    <div class="alert alert-warning border-0 rounded-4 p-3 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2 shadow-sm">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-triangle-fill text-warning fs-4"></i>
            <div>
                <strong>EMI Repayment Due:</strong> Installment #{{ $nextPayment->installment_number }} of {{ number_format($nextPayment->amount, 2) }} is due on <strong>{{ $nextPayment->due_date->format('F d, Y') }}</strong>.
            </div>
        </div>
        <a href="{{ route('customer.loans.show', $nextPayment->loan_id) }}" class="btn btn-warning px-4 py-2 fw-semibold text-dark">Pay Installment</a>
    </div>
@endif

<div class="row g-4">
    <!-- Application List -->
    <div class="col-12 col-lg-8">
        <div class="card card-custom p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <h5 class="fw-bold text-dark m-0">My Loans Directory</h5>
                <a href="{{ route('customer.loans.apply') }}" class="btn btn-custom-primary">
                    <i class="bi bi-plus-lg me-1"></i> Apply for Loan
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Loan ID</th>
                            <th>Type</th>
                            <th>Principal Amount</th>
                            <th>EMI (Monthly)</th>
                            <th>Status</th>
                            <th>Remaining Bal.</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loans as $loan)
                            <tr>
                                <td class="fw-bold text-dark">#{{ $loan->id }}</td>
                                <td><span class="badge bg-light text-dark border px-2 py-1 rounded-pill">{{ ucfirst($loan->loan_type) }} Loan</span></td>
                                <td class="fw-semibold">{{ number_format($loan->amount, 2) }}</td>
                                <td>{{ $loan->status === 'disbursed' ? number_format($loan->monthly_emi, 2) : 'Awaiting rate' }}</td>
                                <td>
                                    @if($loan->status === 'disbursed')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill fw-semibold">Disbursed</span>
                                    @elseif($loan->status === 'completed')
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1 rounded-pill fw-semibold">Fully Paid</span>
                                    @elseif($loan->status === 'rejected')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill fw-semibold">Rejected</span>
                                    @elseif($loan->status === 'under_review')
                                        <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-pill fw-semibold">Under Review</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 rounded-pill fw-semibold">Pending</span>
                                    @endif
                                </td>
                                <td class="fw-bold text-slate-800">{{ number_format($loan->outstanding_balance, 2) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('customer.loans.show', $loan->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                        <i class="bi bi-eye"></i> View Schedule
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">You have not submitted any loan applications.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Repayment Logs -->
    <div class="col-12 col-lg-4">
        <div class="card card-custom p-4 h-100">
            <h5 class="fw-bold mb-4 text-dark">Repayment History</h5>

            <div class="space-y-3">
                @forelse($repaymentHistory as $log)
                    <div class="p-3 bg-light rounded-4 border border-light d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold text-dark d-block">Installment #{{ $log->installment_number }}</span>
                            <small class="text-muted d-block">{{ ucfirst($log->loan->loan_type) }} Loan ID #{{ $log->loan->id }}</small>
                            <small class="text-muted text-2xs">{{ $log->payment_date->format('Y-m-d H:i') }}</small>
                        </div>
                        <div class="text-end">
                            <span class="fw-bold text-success d-block">-{{ number_format($log->amount, 2) }}</span>
                            <a href="{{ route('customer.loans.receipt', $log->id) }}" class="text-xs text-primary text-decoration-none">
                                <i class="bi bi-receipt"></i> Receipt
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">No repayment transaction logs found.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
