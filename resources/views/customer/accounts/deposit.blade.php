@extends('customer.layout')

@section('title', 'Deposit Funds')
@section('page_title', 'Deposit Funds')

@section('content')
<div class="row">
    <div class="col-12 col-md-6 mx-auto">
        <div class="card card-custom p-4 shadow-sm border-0">
            <h5 class="fw-bold mb-4 text-success"><i class="bi bi-cash-coin me-1"></i> Deposit Money</h5>

            <div class="alert alert-secondary border-0 rounded-4 p-3 mb-4 text-xs">
                Account Number: <strong class="text-primary">{{ $account->account_number }}</strong><br>
                Current Balance: <strong class="text-dark">{{ number_format($account->balance, 2) }}</strong>
            </div>

            <form action="{{ route('customer.accounts.deposit', $account->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="amount" class="form-label fw-semibold">Amount to Deposit</label>
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
                    <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="e.g. Deposit via portal">
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customer.account.details', $account->id) }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-success px-4 py-2">Confirm Deposit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
