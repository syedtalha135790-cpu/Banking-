@extends('customer.layout')

@section('title', 'My Accounts')
@section('page_title', 'My Bank Accounts')

@section('content')
<div class="row g-4">
    <!-- Summary Header -->
    <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
        <div>
            <h5 class="fw-bold m-0 text-slate-800">Account Portfolios</h5>
            <p class="text-muted text-xs m-0">View all your registered active/inactive bank accounts.</p>
        </div>
        <a href="{{ route('customer.accounts.create') }}" class="btn btn-custom-primary">
            <i class="bi bi-plus-lg me-1"></i> Open New Account
        </a>
    </div>

    <!-- Accounts Cards Loop -->
    @forelse($accounts as $acc)
        <div class="col-12 col-md-6">
            <div class="card card-custom p-4 shadow-sm border-0 h-100 d-flex flex-col justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-pill fw-semibold text-xs mb-1">
                                {{ ucfirst($acc->account_type) }} Account
                            </span>
                            <h4 class="fw-bold m-0 text-slate-800">{{ $acc->account_number }}</h4>
                        </div>
                        <div>
                            @if($acc->isActive())
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill text-xs fw-semibold">Active</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill text-xs fw-semibold">Inactive</span>
                            @endif
                        </div>
                    </div>

                    <div class="border-top border-bottom py-3 my-3">
                        <span class="text-muted text-xs d-block mb-1">CURRENT BALANCE</span>
                        <h2 class="fw-bold text-success m-0">{{ number_format($acc->balance, 2) }}</h2>
                    </div>

                    <div class="row g-2 text-xs text-muted mb-4">
                        <div class="col-6">CNIC: <strong>{{ $acc->cnic }}</strong></div>
                        <div class="col-6">Interest Rate: <strong>{{ $acc->interest_rate }}%</strong></div>
                        <div class="col-6">IFSC: <strong>{{ $acc->ifsc_code ?? '-' }}</strong></div>
                        <div class="col-6">Opened: <strong>{{ $acc->created_at->format('Y-m-d') }}</strong></div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('customer.account.details', $acc->id) }}" class="btn btn-outline-primary flex-grow-1">
                        <i class="bi bi-eye"></i> Details
                    </a>
                    <a href="{{ route('customer.accounts.deposit.form', $acc->id) }}" class="btn btn-success flex-grow-1 @if(!$acc->isActive()) disabled @endif">
                        <i class="bi bi-plus-circle"></i> Deposit
                    </a>
                    <a href="{{ route('customer.accounts.withdraw.form', $acc->id) }}" class="btn btn-danger flex-grow-1 @if(!$acc->isActive()) disabled @endif">
                        <i class="bi bi-dash-circle"></i> Withdraw
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card card-custom p-5 text-center shadow-sm border-0">
                <i class="bi bi-wallet2 text-muted fs-1 mb-3"></i>
                <h5 class="fw-bold text-slate-800">No active bank accounts found</h5>
                <p class="text-muted mb-4">Get started by opening a Savings or Current bank account in just a few seconds.</p>
                <a href="{{ route('customer.accounts.create') }}" class="btn btn-custom-primary px-4 py-2">
                    <i class="bi bi-plus-lg me-1"></i> Open Your First Account
                </a>
            </div>
        </div>
    @endforelse
</div>
@endsection
