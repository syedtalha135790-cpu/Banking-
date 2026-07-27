@extends('customer.layout')

@section('title', 'My EMI Payments')
@section('page_title', 'My Loan Installments')

@section('content')
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h5 class="fw-bold m-0 text-dark">Loan Installment Ledger</h5>
            <p class="text-muted text-xs m-0">Review paid and upcoming installments across your active loans.</p>
        </div>
        <a href="{{ route('customer.loans.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Loans
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Loan ID</th>
                    <th>Installment</th>
                    <th>Due Date</th>
                    <th>Amount Due</th>
                    <th>Status</th>
                    <th>Payment Date</th>
                    <th>Reference Code</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $p)
                    <tr>
                        <td class="fw-bold text-dark">#{{ $p->loan_id }}</td>
                        <td>Installment #{{ $p->installment_number }} of {{ $p->loan->duration }}</td>
                        <td>{{ $p->due_date->format('F d, Y') }}</td>
                        <td class="fw-bold text-primary">{{ number_format($p->amount, 2) }}</td>
                        <td>
                            @if($p->payment_status === 'paid')
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded-pill fw-semibold">Paid</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1 rounded-pill fw-semibold">Pending</span>
                            @endif
                        </td>
                        <td>{{ $p->payment_date ? $p->payment_date->format('Y-m-d H:i') : '-' }}</td>
                        <td class="fw-semibold text-slate-800">{{ $p->reference_number ?? '-' }}</td>
                        <td class="text-center">
                            @if($p->payment_status === 'paid')
                                <a href="{{ route('customer.loans.receipt', $p->id) }}" class="btn btn-sm btn-outline-success" style="border-radius: 8px;">
                                    <i class="bi bi-receipt"></i> Receipt
                                </a>
                            @else
                                <a href="{{ route('customer.loans.show', $p->loan_id) }}" class="btn btn-sm btn-primary" style="border-radius: 8px;">
                                    Pay Installment
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">No loan installment payment records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $payments->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
