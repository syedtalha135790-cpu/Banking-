@extends('customer.layout')

@section('title', 'Request Debit Card')
@section('page_title', 'Order Debit Card')

@section('content')
<div class="row">
    <div class="col-12 col-md-8 col-lg-6 mx-auto">
        <div class="card card-custom p-4 shadow-sm border-0">
            <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-credit-card-2-back me-1"></i> Order a Debit Card</h5>

            <form action="{{ route('customer.cards.storeDebit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Cardholder Name (Profile Registered)</label>
                    <input type="text" class="form-control bg-light" value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="account_id" class="form-label fw-semibold">Select Target Bank Account</label>
                    <select class="form-select @error('account_id') is-invalid @enderror" id="account_id" name="account_id" required>
                        <option value="" disabled selected>-- Select Active Account --</option>
                        @foreach($accounts as $acc)
                            <option value="{{ $acc->id }}" @if(old('account_id') == $acc->id) selected @endif>
                                {{ $acc->account_number }} ({{ ucfirst($acc->account_type) }} - Bal: {{ number_format($acc->balance, 2) }})
                            </option>
                        @endforeach
                    </select>
                    @error('account_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted d-block mt-1">Rule: Only one active debit card can be registered per account.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold d-block">Preferred Card Network</label>
                    <div class="form-check form-check-inline me-4">
                        <input class="form-check-input" type="radio" name="card_network" id="network_visa" value="visa" checked required>
                        <label class="form-check-label fw-medium" for="network_visa">
                            <i class="bi bi-cc-circle text-primary"></i> Visa Platinum
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="card_network" id="network_mastercard" value="mastercard" required>
                        <label class="form-check-label fw-medium" for="network_mastercard">
                            <i class="bi bi-cc-circle text-warning"></i> MasterCard Gold
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label fw-semibold">Contact Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', Auth::user()->phone) }}" class="form-control @error('phone_number') is-invalid @enderror" required placeholder="e.g. +1234567890">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="delivery_address" class="form-label fw-semibold">Card Delivery Address</label>
                    <textarea name="delivery_address" id="delivery_address" rows="3" class="form-control @error('delivery_address') is-invalid @enderror" required placeholder="Provide full address where the card should be couriered...">{{ old('delivery_address') }}</textarea>
                    @error('delivery_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customer.cards.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">Submit Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
