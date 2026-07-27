@extends('customer.layout')

@section('title', 'Withdraw Cash')
@section('page_title', 'Withdraw Cash')

@section('content')
<div class="row">
    <div class="col-12 col-md-8 col-lg-6 mx-auto">
        <div class="card card-custom p-4 shadow-sm border-0">
            <h5 class="fw-bold mb-4 text-danger"><i class="bi bi-dash-circle-fill me-1"></i> Withdraw Money</h5>

            <form action="{{ route('customer.withdraw.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="account_number" class="form-label fw-semibold">Select Account</label>
                    <select class="form-select @error('account_number') is-invalid @enderror" id="account_number" name="account_number" required>
                        <option value="" disabled selected>-- Select Active Account --</option>
                        @foreach($accounts as $acc)
                            <option value="{{ $acc->account_number }}" @if(old('account_number') === $acc->account_number) selected @endif>
                                {{ $acc->account_number }} ({{ ucfirst($acc->account_type) }} - Bal: {{ number_format($acc->balance, 2) }})
                            </option>
                        @endforeach
                    </select>
                    @error('account_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label fw-semibold">Amount to Withdraw</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light fw-bold"></span>
                        <input type="number" step="0.01" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" required placeholder="0.00" min="0.01">
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="text-muted mt-1 d-block">Savings accounts must keep at least 500.00 minimum balance. Max withdrawal: 15K (Savings) / 100K (Current).</small>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">Description / Note (Optional)</label>
                    <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="e.g. Simulated ATM withdrawal">
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customer.dashboard') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-danger px-4 py-2 fw-semibold">Confirm Withdrawal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
