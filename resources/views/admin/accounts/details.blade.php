@extends('admin.layout')

@section('title', 'Account Details')
@section('page_title', 'Bank Account Overview')

@section('content')
<div class="row g-4">
    <!-- Account Information Overview Card -->
    <div class="col-12 col-lg-8">
        <div class="card card-custom p-4 shadow-sm border-0 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 border-bottom pb-3">
                <div>
                    <h5 class="fw-bold m-0 text-slate-800">Account No: <span class="text-primary">{{ $account->account_number }}</span></h5>
                    <small class="text-muted">Registered to {{ $account->user->name }}</small>
                </div>
                <div>
                    @if($account->isActive())
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> Active</span>
                    @else
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold"><i class="bi bi-x-circle-fill me-1"></i> Inactive</span>
                    @endif
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Account Holder</span>
                    <span class="fw-bold text-slate-800 fs-5">{{ $account->user->name }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Current Balance</span>
                    <span class="fw-bold text-success fs-5">{{ number_format($account->balance, 2) }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">CNIC / ID Number</span>
                    <span class="fw-semibold text-slate-800">{{ $account->cnic }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Account Type</span>
                    <span class="badge bg-info-subtle text-info border border-info-subtle px-2.5 py-1 rounded-pill fw-semibold mt-1">
                        {{ ucfirst($account->account_type) }} Account
                    </span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Email Address</span>
                    <span class="text-slate-800 fw-semibold">{{ $account->user->email }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Phone Number</span>
                    <span class="text-slate-800 fw-semibold">{{ $account->user->phone_number ?? '-' }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Date of Birth</span>
                    <span class="text-slate-800 fw-semibold">{{ $account->dob->format('F d, Y') }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Monthly Income / Occupation</span>
                    <span class="text-slate-800 fw-semibold">{{ $account->occupation }} (Income: {{ number_format($account->monthly_income, 2) }})</span>
                </div>
                <div class="col-12">
                    <span class="text-muted text-xs uppercase d-block">Residential Address</span>
                    <span class="text-slate-800 fw-semibold">{{ $account->address }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Branch IFSC Code</span>
                    <span class="text-slate-800 fw-semibold">{{ $account->ifsc_code ?? 'Not provided' }}</span>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted text-xs uppercase d-block">Created / Last Updated</span>
                    <span class="text-xs text-muted">Opened: {{ $account->created_at->format('Y-m-d H:i') }} | Modified: {{ $account->updated_at->format('Y-m-d H:i') }}</span>
                </div>
            </div>

            <!-- Operations / Actions Row -->
            <div class="mt-4 border-top pt-3 d-flex flex-wrap gap-2 justify-content-end">
                <a href="{{ route('admin.accounts.edit', $account->id) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-pencil-square me-1"></i> Edit Account
                </a>

                <!-- Activate/Deactivate Toggle -->
                <form action="{{ route('admin.accounts.status', $account->id) }}" method="POST">
                    @csrf
                    @if($account->isActive())
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-x-circle me-1"></i> Deactivate Account
                        </button>
                    @else
                        <button type="submit" class="btn btn-outline-success">
                            <i class="bi bi-check-circle me-1"></i> Activate Account
                        </button>
                    @endif
                </form>

                <!-- Delete Account (Soft Delete) -->
                <form action="{{ route('admin.accounts.delete', $account->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to soft-delete this account?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Delete Account
                    </button>
                </form>
            </div>
        </div>

        <!-- Ledger / Transactions Table -->
        <div class="card card-custom p-4 shadow-sm border-0">
            <h5 class="fw-bold mb-4">Transaction Ledger</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($account->transactions as $txn)
                            <tr>
                                <td>{{ $txn->id }}</td>
                                <td>
                                    @if($txn->type === 'deposit')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Deposit</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Withdrawal</span>
                                    @endif
                                </td>
                                <td class="fw-semibold @if($txn->type === 'deposit') text-success @else text-danger @endif">
                                    {{ $txn->type === 'deposit' ? '+' : '-' }}{{ number_format($txn->amount, 2) }}
                                </td>
                                <td>{{ $txn->description }}</td>
                                <td class="text-muted text-xs">{{ $txn->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No transactions logged for this bank account.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Ledger / Deposit & Withdrawal Form Panels -->
    <div class="col-12 col-lg-4">
        <!-- Deposit Panel -->
        <div class="card card-custom p-4 shadow-sm border-0 mb-4">
            <h5 class="fw-bold mb-3 text-success"><i class="bi bi-cash-coin me-1"></i> Quick Deposit</h5>
            <form action="{{ route('admin.accounts.deposit', $account->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="deposit_amount" class="form-label fw-semibold text-muted text-xs">Amount</label>
                    <input type="number" step="0.01" name="amount" id="deposit_amount" required class="form-control" placeholder="0.00" min="0.01">
                </div>
                <div class="mb-3">
                    <label for="deposit_description" class="form-label fw-semibold text-muted text-xs">Description (Optional)</label>
                    <input type="text" name="description" id="deposit_description" class="form-control" placeholder="e.g. Over-the-counter deposit">
                </div>
                <button type="submit" class="btn btn-success w-100 py-2 fw-semibold" @if(!$account->isActive()) disabled @endif>
                    Deposit Funds
                </button>
                @if(!$account->isActive())
                    <small class="text-danger mt-1 d-block text-xs text-center">Disabled: Account is currently Inactive.</small>
                @endif
            </form>
        </div>

        <!-- Withdrawal Panel -->
        <div class="card card-custom p-4 shadow-sm border-0">
            <h5 class="fw-bold mb-3 text-danger"><i class="bi bi-dash-circle-fill me-1"></i> Quick Withdrawal</h5>
            <form action="{{ route('admin.accounts.withdraw', $account->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="withdraw_amount" class="form-label fw-semibold text-muted text-xs">Amount</label>
                    <input type="number" step="0.01" name="amount" id="withdraw_amount" required class="form-control" placeholder="0.00" min="0.01">
                </div>
                <div class="mb-3">
                    <label for="withdraw_description" class="form-label fw-semibold text-muted text-xs">Description (Optional)</label>
                    <input type="text" name="description" id="withdraw_description" class="form-control" placeholder="e.g. Counter withdrawal">
                </div>
                <button type="submit" class="btn btn-danger w-100 py-2 fw-semibold" @if(!$account->isActive()) disabled @endif>
                    Withdraw Funds
                </button>
                @if(!$account->isActive())
                    <small class="text-danger mt-1 d-block text-xs text-center">Disabled: Account is currently Inactive.</small>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
