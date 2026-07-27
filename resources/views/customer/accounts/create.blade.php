@extends('customer.layout')

@section('title', 'Open New Account')
@section('page_title', 'Open Bank Account')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-4">Request New Account Opening</h5>

            <form action="{{ route('customer.accounts.store') }}" method="POST">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="cnic" class="form-label fw-semibold">CNIC / National ID</label>
                        <input type="text" class="form-control @error('cnic') is-invalid @enderror" id="cnic" name="cnic" value="{{ old('cnic') }}" required placeholder="e.g. 42101-1234567-1">
                        @error('cnic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="dob" class="form-label fw-semibold">Date of Birth</label>
                        <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob') }}" required>
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">Residential Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required placeholder="Full street address, city, country...">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="occupation" class="form-label fw-semibold">Occupation</label>
                        <input type="text" class="form-control @error('occupation') is-invalid @enderror" id="occupation" name="occupation" value="{{ old('occupation') }}" required placeholder="e.g. Accountant">
                        @error('occupation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="monthly_income" class="form-label fw-semibold">Monthly Income</label>
                        <input type="number" step="0.01" class="form-control @error('monthly_income') is-invalid @enderror" id="monthly_income" name="monthly_income" value="{{ old('monthly_income') }}" required placeholder="e.g. 75000">
                        @error('monthly_income')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="account_type" class="form-label fw-semibold">Account Type</label>
                        <select class="form-select @error('account_type') is-invalid @enderror" id="account_type" name="account_type" required>
                            <option value="" disabled selected>-- Select Type --</option>
                            <option value="savings" @if(old('account_type') === 'savings') selected @endif>Savings Account (2.5% Interest, 500 Min Balance)</option>
                            <option value="current" @if(old('account_type') === 'current') selected @endif>Current Account (No Interest, No Min Balance)</option>
                        </select>
                        @error('account_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="initial_deposit" class="form-label fw-semibold">Initial Deposit</label>
                        <input type="number" step="0.01" class="form-control @error('initial_deposit') is-invalid @enderror" id="initial_deposit" name="initial_deposit" value="{{ old('initial_deposit', '0') }}" required placeholder="e.g. 1000">
                        @error('initial_deposit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="ifsc_code" class="form-label fw-semibold">Branch Code / IFSC (Optional)</label>
                    <input type="text" class="form-control @error('ifsc_code') is-invalid @enderror" id="ifsc_code" name="ifsc_code" value="{{ old('ifsc_code') }}" placeholder="e.g. BMS0001">
                    @error('ifsc_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customer.accounts.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-custom-primary px-4 py-2">Submit Opening Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
