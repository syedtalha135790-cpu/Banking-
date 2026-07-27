@extends('customer.layout')

@section('title', 'Transfer Money')
@section('page_title', 'Transfer Funds')

@section('content')
<div class="row">
    <div class="col-12 col-md-8 col-lg-6 mx-auto">
        <div class="card card-custom p-4 shadow-sm border-0">
            <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-arrow-left-right me-1"></i> Transfer Money</h5>

            <form action="{{ route('customer.transfer.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="sender_account_number" class="form-label fw-semibold">From My Account (Sender)</label>
                    <select class="form-select @error('sender_account_number') is-invalid @enderror" id="sender_account_number" name="sender_account_number" required>
                        <option value="" disabled selected>-- Select Source Account --</option>
                        @foreach($accounts as $acc)
                            <option value="{{ $acc->account_number }}" @if(old('sender_account_number') === $acc->account_number) selected @endif>
                                {{ $acc->account_number }} ({{ ucfirst($acc->account_type) }} - Bal: {{ number_format($acc->balance, 2) }})
                            </option>
                        @endforeach
                    </select>
                    @error('sender_account_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="receiver_account_number" class="form-label fw-semibold">To Account Number (Receiver)</label>
                    <input type="text" class="form-control @error('receiver_account_number') is-invalid @enderror" id="receiver_account_number" name="receiver_account_number" value="{{ old('receiver_account_number') }}" required placeholder="e.g. BMS123456789">
                    <small class="text-muted mt-1 d-block">Target account number must exist and be active.</small>
                    @error('receiver_account_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label fw-semibold">Amount to Transfer</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light fw-bold"></span>
                        <input type="number" step="0.01" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" required placeholder="0.00" min="0.01">
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">Description / Reference Note (Optional)</label>
                    <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="e.g. Rent payment, invoice...">
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customer.dashboard') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">Confirm Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
