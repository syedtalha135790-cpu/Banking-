@extends('customer.layout')

@section('title', 'My Transactions')
@section('page_title', 'My Financial Activities')

@section('content')
<!-- Search & Filters Panel -->
<div class="card card-custom p-4 mb-4 shadow-sm border-0">
    <form action="{{ route('customer.transactions.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-3">
            <label for="search" class="form-label fw-semibold text-xs text-muted">Search reference / note</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search...">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <label for="account_id" class="form-label fw-semibold text-xs text-muted">Filter by Account</label>
            <select name="account_id" id="account_id" class="form-select">
                <option value="">All Accounts</option>
                @foreach($accounts as $acc)
                    <option value="{{ $acc->id }}" @if(request('account_id') == $acc->id) selected @endif>
                        {{ $acc->account_number }} ({{ ucfirst($acc->account_type) }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-2">
            <label for="type" class="form-label fw-semibold text-xs text-muted">Type</label>
            <select name="type" id="type" class="form-select">
                <option value="">All Types</option>
                <option value="deposit" @if(request('type') === 'deposit') selected @endif>Deposit</option>
                <option value="withdrawal" @if(request('type') === 'withdrawal') selected @endif>Withdrawal</option>
                <option value="transfer_in" @if(request('type') === 'transfer_in') selected @endif>Transfer In</option>
                <option value="transfer_out" @if(request('type') === 'transfer_out') selected @endif>Transfer Out</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-2">
            <label for="start_date" class="form-label fw-semibold text-xs text-muted">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>
        <div class="col-12 col-sm-6 col-md-2">
            <label for="end_date" class="form-label fw-semibold text-xs text-muted">End Date</label>
            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>
        <div class="col-12 d-flex gap-2 justify-content-end mt-3">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-funnel-fill"></i> Filter</button>
            <a href="{{ route('customer.transactions.index') }}" class="btn btn-outline-secondary px-4">Clear</a>
        </div>
    </form>
</div>

<!-- History Card -->
<div class="card card-custom p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Ref Code</th>
                    <th>My Account</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Balance After</th>
                    <th>Description</th>
                    <th>Date Time</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $txn)
                    <tr>
                        <td class="fw-bold text-slate-800">{{ $txn->reference_number }}</td>
                        <td class="fw-semibold text-primary">{{ $txn->account->account_number }}</td>
                        <td>
                            @if($txn->transaction_type === 'deposit')
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill text-2xs">Deposit</span>
                            @elseif($txn->transaction_type === 'withdrawal')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill text-2xs">Withdrawal</span>
                            @elseif($txn->transaction_type === 'transfer_in')
                                <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill text-2xs">Transfer In</span>
                            @else
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill text-2xs">Transfer Out</span>
                            @endif
                        </td>
                        <td class="fw-bold @if($txn->transaction_type === 'deposit' || $txn->transaction_type === 'transfer_in') text-success @else text-danger @endif">
                            {{ ($txn->transaction_type === 'deposit' || $txn->transaction_type === 'transfer_in') ? '+' : '-' }}{{ number_format($txn->amount, 2) }}
                        </td>
                        <td class="fw-semibold text-dark">{{ number_format($txn->balance_after_transaction, 2) }}</td>
                        <td>{{ $txn->description }}</td>
                        <td class="text-muted text-xs">{{ $txn->created_at->format('Y-m-d H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('customer.transactions.receipt', $txn->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                <i class="bi bi-receipt"></i> Receipt
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">No transactions matched your search criteria.</td>
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
