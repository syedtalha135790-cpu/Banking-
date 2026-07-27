@extends('customer.layout')

@section('title', 'Withdraw Funds')
@section('page_title', 'Withdraw Funds')

@section('content')
<div class="row">
    <div class="col-12 col-md-6 mx-auto">
        <div class="card card-custom p-4 shadow-sm border-0">
            <h5 class="fw-bold mb-4 text-danger"><i class="bi bi-dash-circle-fill me-1"></i> Withdraw Money</h5>

            <div class="alert alert-secondary border-0 rounded-4 p-3 mb-4 text-xs">
                Account Number: <strong class="text-primary">{{ $account->account_number }}</strong><br>
                Current Balance: <strong class="text-dark">{{ number_format($account->balance, 2) }}</strong><br>
                Account Type: <strong class="text-dark">{{ ucfirst($account->account_type) }}</strong><br>
                @if($account->account_type === 'savings')
                    Minimum Balance Limit: <strong class="text-danger">{{ number_format($account->minimum_balance, 2) }}</strong><br>
                    Max Withdrawal Limit: <strong class="text-danger">15,000 per transaction</strong>
                @else
                    Max Withdrawal Limit: <strong class="text-danger">100,000 per transaction</strong>
                @endif
            </div>

            <form action="{{ route('customer.accounts.withdraw', $account->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="amount" class="form-label fw-semibold">Amount to Withdraw</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light fw-bold"></span>
                        <input type="number" step="0.01" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" required placeholder="0.00" min="0.01">
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">Description / Note</label>
                    <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="e.g. ATM withdrawal simulated">
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customer.account.details', $account->id) }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-danger px-4 py-2">Confirm Withdrawal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
