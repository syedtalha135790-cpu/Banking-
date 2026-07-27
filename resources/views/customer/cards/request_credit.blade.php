@extends('customer.layout')

@section('title', 'Apply for Credit Card')
@section('page_title', 'Apply for Credit Card')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="card card-custom p-4 shadow-sm border-0">
            <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-credit-card me-1"></i> Apply for a Credit Card</h5>

            <form action="{{ route('customer.cards.storeCredit') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Cardholder Name (Profile Registered)</label>
                    <input type="text" class="form-control bg-light" value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="account_id" class="form-label fw-semibold">Linked Settlement Account</label>
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
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold d-block">Preferred Card Network</label>
                        <div class="mt-2">
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
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="monthly_income" class="form-label fw-semibold">Monthly Income</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold"></span>
                            <input type="number" step="0.01" name="monthly_income" id="monthly_income" value="{{ old('monthly_income') }}" class="form-control @error('monthly_income') is-invalid @enderror" required placeholder="0.00">
                            @error('monthly_income')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="credit_limit_requested" class="form-label fw-semibold">Credit Limit Requested</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold"></span>
                            <input type="number" step="0.01" name="credit_limit_requested" id="credit_limit_requested" value="{{ old('credit_limit_requested') }}" class="form-control @error('credit_limit_requested') is-invalid @enderror" required placeholder="0.00" min="10000">
                            @error('credit_limit_requested')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="employment_status" class="form-label fw-semibold">Employment Status</label>
                        <select class="form-select @error('employment_status') is-invalid @enderror" id="employment_status" name="employment_status" required>
                            <option value="" disabled selected>-- Select Status --</option>
                            <option value="employed" @if(old('employment_status') === 'employed') selected @endif>Salaried / Employed</option>
                            <option value="self-employed" @if(old('employment_status') === 'self-employed') selected @endif>Self-Employed / Business Owner</option>
                        </select>
                        @error('employment_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="phone_number" class="form-label fw-semibold">Contact Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', Auth::user()->phone) }}" class="form-control @error('phone_number') is-invalid @enderror" required placeholder="e.g. +1234567890">
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="supporting_documents" class="form-label fw-semibold">Income Verification Files (Optional)</label>
                    <input type="file" class="form-control @error('supporting_documents') is-invalid @enderror" id="supporting_documents" name="supporting_documents">
                    <small class="text-muted">Allowed files: PDF, JPG, PNG. Max file size: 5MB.</small>
                    @error('supporting_documents')
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
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
