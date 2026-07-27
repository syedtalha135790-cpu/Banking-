@extends('admin.layout')

@section('title', 'Edit Account')
@section('page_title', 'Edit Account Details')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-4">Modify Account Credentials for {{ $account->user->name }}</h5>

            <form action="{{ route('admin.accounts.update', $account->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold text-muted">Account Number</label>
                        <input type="text" class="form-control bg-light" value="{{ $account->account_number }}" readonly>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold text-muted">Account Type</label>
                        <input type="text" class="form-control bg-light" value="{{ ucfirst($account->account_type) }}" readonly>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="cnic" class="form-label fw-semibold">CNIC / National ID</label>
                        <input type="text" class="form-control @error('cnic') is-invalid @enderror" id="cnic" name="cnic" value="{{ old('cnic', $account->cnic) }}" required placeholder="e.g. 42101-1234567-1">
                        @error('cnic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="dob" class="form-label fw-semibold">Date of Birth</label>
                        <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob', $account->dob->format('Y-m-d')) }}" required>
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">Residential Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required placeholder="Full street address, city, country...">{{ old('address', $account->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="occupation" class="form-label fw-semibold">Occupation</label>
                        <input type="text" class="form-control @error('occupation') is-invalid @enderror" id="occupation" name="occupation" value="{{ old('occupation', $account->occupation) }}" required placeholder="e.g. Software Engineer">
                        @error('occupation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="monthly_income" class="form-label fw-semibold">Monthly Income</label>
                        <input type="number" step="0.01" class="form-control @error('monthly_income') is-invalid @enderror" id="monthly_income" name="monthly_income" value="{{ old('monthly_income', $account->monthly_income) }}" required placeholder="e.g. 85000">
                        @error('monthly_income')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="ifsc_code" class="form-label fw-semibold">Branch Code / IFSC (Optional)</label>
                    <input type="text" class="form-control @error('ifsc_code') is-invalid @enderror" id="ifsc_code" name="ifsc_code" value="{{ old('ifsc_code', $account->ifsc_code) }}" placeholder="e.g. BMS0001">
                    @error('ifsc_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.accounts.details', $account->id) }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-custom-primary px-4 py-2">Save Updates</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
