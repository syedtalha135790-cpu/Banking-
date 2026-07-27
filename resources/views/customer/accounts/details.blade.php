@extends('customer.layout')

@section('title', 'Account Overview')
@section('page_title', 'Account Overview')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="card card-custom p-4 shadow-sm border-0 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 border-bottom pb-3">
                <div>
                    <h5 class="fw-bold m-0 text-slate-800">Account No: <span class="text-primary">{{ $account->account_number }}</span></h5>
                    <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-pill text-xs fw-semibold mt-1">
                        {{ ucfirst($account->account_type) }} Account
                    </span>
                </div>
                <div>
                    @if($account->isActive())
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> Active</span>
                    @else
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold"><i class="bi bi-x-circle-fill me-1"></i> Inactive</span>
                    @endif
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Account Holder</span>
                    <span class="fw-bold text-slate-800 fs-5">{{ Auth::user()->name }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Available Balance</span>
                    <span class="fw-bold text-success fs-5">{{ number_format($account->balance, 2) }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">CNIC / ID Number</span>
                    <span class="fw-semibold text-slate-800">{{ $account->cnic }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Date of Birth</span>
                    <span class="text-slate-800 fw-semibold">{{ $account->dob->format('F d, Y') }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Email Address</span>
                    <span class="text-slate-800 fw-semibold">{{ Auth::user()->email }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Phone Number</span>
                    <span class="text-slate-800 fw-semibold">{{ Auth::user()->phone_number ?? '-' }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Occupation / Income</span>
                    <span class="text-slate-800 fw-semibold">{{ $account->occupation }} (Monthly: {{ number_format($account->monthly_income, 2) }})</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Interest / Min Balance</span>
                    <span class="text-slate-800 fw-semibold">{{ $account->interest_rate }}% Interest | Min: {{ number_format($account->minimum_balance, 2) }}</span>
                </div>
                <div class="col-12">
                    <span class="text-muted text-xs uppercase d-block">Residential Address</span>
                    <span class="text-slate-800 fw-semibold">{{ $account->address }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">IFSC Code</span>
                    <span class="text-slate-800 fw-semibold">{{ $account->ifsc_code ?? '-' }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Opened On</span>
                    <span class="text-muted text-xs">{{ $account->created_at->format('F d, Y H:i') }}</span>
                </div>
            </div>

            <!-- Operations / Actions Row -->
            <div class="border-top pt-3 d-flex flex-wrap gap-2 justify-content-end">
                <a href="{{ route('customer.accounts.edit', $account->id) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profile
                </a>
                <a href="{{ route('customer.account.transactions', $account->id) }}" class="btn btn-outline-info">
                    <i class="bi bi-list-columns me-1"></i> View Transactions
                </a>
                <a href="{{ route('customer.accounts.deposit.form', $account->id) }}" class="btn btn-success @if(!$account->isActive()) disabled @endif">
                    <i class="bi bi-plus-circle me-1"></i> Deposit Money
                </a>
                <a href="{{ route('customer.accounts.withdraw.form', $account->id) }}" class="btn btn-danger @if(!$account->isActive()) disabled @endif">
                    <i class="bi bi-dash-circle me-1"></i> Withdraw Money
                </a>
            </div>
            @if(!$account->isActive())
                <div class="alert alert-danger border-0 rounded-4 mt-3 py-2 text-center text-xs">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Transactions are currently disabled by management because this account is Inactive.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
