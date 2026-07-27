@extends('customer.layout')

@section('title', 'Edit Beneficiary')
@section('page_title', 'Modify Beneficiary Details')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-4">Edit Beneficiary Profile</h5>

            <form action="{{ route('customer.beneficiaries.update', $beneficiary->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="beneficiary_name" class="form-label fw-semibold">Beneficiary Name</label>
                    <input type="text" class="form-control @error('beneficiary_name') is-invalid @enderror" id="beneficiary_name" name="beneficiary_name" value="{{ old('beneficiary_name', $beneficiary->beneficiary_name) }}" required placeholder="e.g. John Doe">
                    @error('beneficiary_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="account_number" class="form-label fw-semibold">Account Number</label>
                        <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" value="{{ old('account_number', $beneficiary->account_number) }}" required placeholder="e.g. BMS123456789">
                        <small class="text-warning">Important: Modifying the account number resets the status to Pending Verification.</small>
                        @error('account_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="nickname" class="form-label fw-semibold">Nickname / Alias (Optional)</label>
                        <input type="text" class="form-control @error('nickname') is-invalid @enderror" id="nickname" name="nickname" value="{{ old('nickname', $beneficiary->nickname) }}" placeholder="e.g. Family, Partner">
                        @error('nickname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="bank_name" class="form-label fw-semibold">Bank Name</label>
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" value="{{ old('bank_name', $beneficiary->bank_name) }}" required placeholder="e.g. BMS Bank">
                        @error('bank_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="branch_name" class="form-label fw-semibold">Branch Name</label>
                        <input type="text" class="form-control @error('branch_name') is-invalid @enderror" id="branch_name" name="branch_name" value="{{ old('branch_name', $beneficiary->branch_name) }}" required placeholder="e.g. Main Branch">
                        @error('branch_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="branch_code" class="form-label fw-semibold">Branch Code</label>
                        <input type="text" class="form-control @error('branch_code') is-invalid @enderror" id="branch_code" name="branch_code" value="{{ old('branch_code', $beneficiary->branch_code) }}" required placeholder="e.g. 0001">
                        @error('branch_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="swift_code" class="form-label fw-semibold">SWIFT / Swift Code (Optional)</label>
                        <input type="text" class="form-control @error('swift_code') is-invalid @enderror" id="swift_code" name="swift_code" value="{{ old('swift_code', $beneficiary->swift_code) }}" placeholder="e.g. BMS0001">
                        @error('swift_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label fw-semibold">Email Address (Optional)</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $beneficiary->email) }}" placeholder="e.g. john@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="phone" class="form-label fw-semibold">Phone Number (Optional)</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $beneficiary->phone) }}" placeholder="e.g. +1234567890">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="relationship" class="form-label fw-semibold">Relationship</label>
                    <select class="form-select @error('relationship') is-invalid @enderror" id="relationship" name="relationship" required>
                        <option value="" disabled>-- Select Relationship --</option>
                        <option value="family" @if(old('relationship', $beneficiary->relationship) === 'family') selected @endif>Family Member</option>
                        <option value="friend" @if(old('relationship', $beneficiary->relationship) === 'friend') selected @endif>Friend</option>
                        <option value="business" @if(old('relationship', $beneficiary->relationship) === 'business') selected @endif>Business Associate</option>
                        <option value="other" @if(old('relationship', $beneficiary->relationship) === 'other') selected @endif>Other</option>
                    </select>
                    @error('relationship')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customer.beneficiaries.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-custom-primary px-4 py-2">Save Details</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
