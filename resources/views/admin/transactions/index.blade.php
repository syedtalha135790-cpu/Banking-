@extends('admin.layout')

@section('title', 'Transactions Audit')
@section('page_title', 'Transactions Audit Ledger')

@section('content')
<!-- Search & Filters Panel -->
<div class="card card-custom p-4 mb-4 shadow-sm border-0">
    <form action="{{ route('admin.transactions.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-4">
            <label for="search" class="form-label fw-semibold text-xs text-muted">Search reference / description / account</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search...">
            </div>
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
        <div class="col-12 col-sm-6 col-md-2">
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="suspicious" id="suspicious" value="1" @if(request('suspicious')) checked @endif>
                <label class="form-check-label fw-semibold text-xs text-danger" for="suspicious">
                    Suspicious (&gt;50K)
                </label>
            </div>
        </div>
        <div class="col-12 d-flex gap-2 justify-content-end mt-3">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-funnel-fill"></i> Filter</button>
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-secondary px-4">Clear</a>
            <a href="{{ route('admin.transactions.export', request()->all()) }}" class="btn btn-success px-4">
                <i class="bi bi-file-earmark-excel"></i> Export CSV
            </a>
        </div>
    </form>
</div>

<!-- Ledger Card -->
<div class="card card-custom p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Ref Code</th>
                    <th>Account No.</th>
                    <th>Holder Name</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Balance After</th>
                    <th>Date Time</th>
                    <th>Audit Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $txn)
                    <tr @if($txn->amount > 50000) class="table-warning-subtle" style="background-color: #fffbeb;" @endif>
                        <td class="fw-bold text-slate-800">{{ $txn->reference_number }}</td>
                        <td class="fw-semibold text-primary">{{ $txn->account->account_number }}</td>
                        <td>{{ $txn->account->user->name }}</td>
                        <td>
                            @if($txn->transaction_type === 'deposit')
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Deposit</span>
                            @elseif($txn->transaction_type === 'withdrawal')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Withdrawal</span>
                            @elseif($txn->transaction_type === 'transfer_in')
                                <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill">Transfer In</span>
                            @else
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">Transfer Out</span>
                            @endif
                        </td>
                        <td class="fw-bold @if($txn->transaction_type === 'deposit' || $txn->transaction_type === 'transfer_in') text-success @else text-danger @endif">
                            {{ ($txn->transaction_type === 'deposit' || $txn->transaction_type === 'transfer_in') ? '+' : '-' }}{{ number_format($txn->amount, 2) }}
                        </td>
                        <td class="fw-semibold text-dark">{{ number_format($txn->balance_after_transaction, 2) }}</td>
                        <td class="text-muted text-xs">{{ $txn->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            @if($txn->amount > 50000)
                                <span class="badge bg-danger text-white rounded-pill text-2xs fw-bold px-2 py-1" style="font-size: 10px;"><i class="bi bi-shield-alert"></i> Suspicious Alert</span>
                            @else
                                <span class="badge bg-light text-muted rounded-pill text-2xs border px-2 py-1" style="font-size: 10px;">Clear</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.transactions.show', $txn->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                <i class="bi bi-receipt"></i> Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">No transactions found matching ledger filters.</td>
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
