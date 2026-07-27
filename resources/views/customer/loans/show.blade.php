@extends('customer.layout')

@section('title', 'EMI Repayment Schedule')
@section('page_title', 'EMI Repayment Schedule')

@section('content')
<div class="row g-4">
    <!-- Loan Info Sidepanel -->
    <div class="col-12 col-lg-4">
        <div class="card card-custom p-4 shadow-sm border-0 mb-4">
            <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Loan Summary</h5>

            <div class="space-y-3 text-sm">
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Loan Account ID:</span>
                    <span class="fw-bold text-dark">#{{ $loan->id }}</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Category Type:</span>
                    <span class="badge bg-light text-dark border px-2 py-1 rounded-pill">{{ ucfirst($loan->loan_type) }} Loan</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Principal Amount:</span>
                    <span class="fw-bold text-dark">{{ number_format($loan->amount, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Annual Interest Rate:</span>
                    <span class="fw-semibold text-slate-800">{{ $loan->interest_rate }}%</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Repayment Span:</span>
                    <span class="fw-semibold text-dark">{{ $loan->duration }} Months</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Monthly EMI:</span>
                    <span class="fw-bold text-primary">{{ $loan->status === 'disbursed' ? number_format($loan->monthly_emi, 2) : 'TBD' }}</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Total Interest Paid:</span>
                    <span class="fw-semibold text-slate-800">{{ number_format($loan->total_interest, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Total Repayment sum:</span>
                    <span class="fw-semibold text-slate-800">{{ number_format($loan->total_payment, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Outstanding Balance:</span>
                    <span class="fw-bold text-danger">{{ number_format($loan->outstanding_balance, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Application Date:</span>
                    <span class="fw-semibold text-dark">{{ $loan->application_date->format('Y-m-d') }}</span>
                </div>
                @if($loan->approval_date)
                    <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                        <span class="text-muted">Disbursed Date:</span>
                        <span class="fw-semibold text-dark">{{ $loan->approval_date->format('Y-m-d') }}</span>
                    </div>
                @endif
            </div>

            @if($loan->status === 'pending')
                <div class="alert alert-warning border-0 rounded-4 text-center mt-3 p-2 text-xs">
                    <i class="bi bi-clock-history me-1"></i> Awaiting Administrator Audit and Interest Rate Assignment.
                </div>
            @endif
        </div>
        
        <a href="{{ route('customer.loans.index') }}" class="btn btn-outline-secondary w-100 py-2.5" style="border-radius: 12px;">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <!-- EMI Amortization Schedule Table -->
    <div class="col-12 col-lg-8">
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-4 text-dark">EMI Repayment Schedule</h5>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Installment</th>
                            <th>Due Date</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Payment Date / Ref</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loan->loanPayments as $p)
                            <tr>
                                <td class="fw-bold text-dark">#{{ $p->installment_number }}</td>
                                <td>{{ $p->due_date->format('F d, Y') }}</td>
                                <td class="fw-bold text-primary">{{ number_format($p->amount, 2) }}</td>
                                <td>
                                    @if($p->payment_status === 'paid')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded-pill fw-semibold"><i class="bi bi-check2-circle me-1"></i> Paid</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1 rounded-pill fw-semibold"><i class="bi bi-clock me-1"></i> Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->payment_status === 'paid')
                                        <div class="text-dark fw-medium">{{ $p->payment_date->format('Y-m-d H:i') }}</div>
                                        <small class="text-muted text-xs">Ref: <strong>{{ $p->reference_number }}</strong></small>
                                    @else
                                        <span class="text-muted text-xs">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($p->payment_status === 'paid')
                                        <a href="{{ route('customer.loans.receipt', $p->id) }}" class="btn btn-sm btn-outline-success" style="border-radius: 8px;">
                                            <i class="bi bi-receipt"></i> Receipt
                                        </a>
                                    @else
                                        @if($loan->status === 'disbursed')
                                            <!-- Check if this is the next due payment to prevent skipping payments -->
                                            @php
                                                $firstPending = $loan->loanPayments->where('payment_status', 'pending')->first();
                                            @endphp
                                            @if($firstPending && $firstPending->id == $p->id)
                                                <form action="{{ route('customer.loans.pay', $p->id) }}" method="POST" onsubmit="return confirm('Confirm payment of EMI installment #{{ $p->installment_number }} from your linked bank account?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-primary" style="border-radius: 8px;">
                                                        <i class="bi bi-credit-card"></i> Pay Now
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-secondary disabled" style="border-radius: 8px;" title="Please pay previous due installments first.">
                                                    Pay Now
                                                </button>
                                            @endif
                                        @else
                                            <button class="btn btn-sm btn-secondary disabled" style="border-radius: 8px;">Awaiting Disbursal</button>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">EMI schedule will generate automatically upon loan application approval.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
