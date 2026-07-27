@extends('customer.layout')

@section('title', 'Transaction History')
@section('page_title', 'Transaction Ledger')

@section('content')
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h5 class="fw-bold m-0">Ledger for Account: <span class="text-primary">{{ $account->account_number }}</span></h5>
            <small class="text-muted">Available Balance: <strong class="text-success">{{ number_format($account->balance, 2) }}</strong></small>
        </div>
        <a href="{{ route('customer.account.details', $account->id) }}" class="btn btn-outline-secondary btn-sm" style="border-radius: 8px;">
            <i class="bi bi-arrow-left"></i> Back to Details
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Transaction ID</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $txn)
                    <tr>
                        <td>#{{ $txn->id }}</td>
                        <td>
                            @if($txn->type === 'deposit')
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Deposit</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Withdrawal</span>
                            @endif
                        </td>
                        <td class="fw-bold @if($txn->type === 'deposit') text-success @else text-danger @endif">
                            {{ $txn->type === 'deposit' ? '+' : '-' }}{{ number_format($txn->amount, 2) }}
                        </td>
                        <td>{{ $txn->description }}</td>
                        <td class="text-muted text-xs">{{ $txn->created_at->format('F d, Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No transactions recorded for this account.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $transactions->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
