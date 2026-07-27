@extends('customer.layout')

@section('title', 'Apply for Loan')
@section('page_title', 'Loan Application Request')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="card card-custom p-4 shadow-sm border-0">
            <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-file-earmark-text me-1"></i> Apply for a Loan</h5>

            <form action="{{ route('customer.loans.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="account_id" class="form-label fw-semibold">Disbursement/Repayment Account</label>
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
                        <label for="loan_type" class="form-label fw-semibold">Loan Category</label>
                        <select class="form-select @error('loan_type') is-invalid @enderror" id="loan_type" name="loan_type" required>
                            <option value="" disabled selected>-- Select Loan Type --</option>
                            <option value="personal" @if(old('loan_type') === 'personal') selected @endif>Personal Loan</option>
                            <option value="home" @if(old('loan_type') === 'home') selected @endif>Home Loan</option>
                            <option value="car" @if(old('loan_type') === 'car') selected @endif>Car Loan</option>
                            <option value="education" @if(old('loan_type') === 'education') selected @endif>Education Loan</option>
                            <option value="business" @if(old('loan_type') === 'business') selected @endif>Business Loan</option>
                        </select>
                        @error('loan_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="amount" class="form-label fw-semibold">Requested Loan Principal</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold"></span>
                            <input type="number" name="amount" id="amount" value="{{ old('amount') }}" class="form-control @error('amount') is-invalid @enderror" required placeholder="0.00" min="1000">
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="duration" class="form-label fw-semibold">Loan Duration (Months)</label>
                        <input type="number" name="duration" id="duration" value="{{ old('duration') }}" class="form-control @error('duration') is-invalid @enderror" required placeholder="e.g. 12, 24, 36" min="3" max="120">
                        <small class="text-muted">Repayment plan span: 3 to 120 months.</small>
                        @error('duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="cnic" class="form-label fw-semibold">National ID / CNIC</label>
                        <input type="text" name="cnic" id="cnic" value="{{ old('cnic') }}" class="form-control @error('cnic') is-invalid @enderror" required placeholder="e.g. 42101-1234567-8">
                        @error('cnic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="monthly_income" class="form-label fw-semibold">Verified Monthly Income</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold"></span>
                            <input type="number" step="0.01" name="monthly_income" id="monthly_income" value="{{ old('monthly_income') }}" class="form-control @error('monthly_income') is-invalid @enderror" required placeholder="0.00">
                            @error('monthly_income')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="employment_status" class="form-label fw-semibold">Employment Status</label>
                        <select class="form-select @error('employment_status') is-invalid @enderror" id="employment_status" name="employment_status" required onchange="toggleEmployerField()">
                            <option value="" disabled selected>-- Select Status --</option>
                            <option value="employed" @if(old('employment_status') === 'employed') selected @endif>Salaried / Employed</option>
                            <option value="self-employed" @if(old('employment_status') === 'self-employed') selected @endif>Self-Employed / Business Owner</option>
                            <option value="unemployed" @if(old('employment_status') === 'unemployed') selected @endif>Unemployed</option>
                        </select>
                        @error('employment_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6" id="employer_name_container">
                        <label for="employer_name" class="form-label fw-semibold">Employer Name / Company</label>
                        <input type="text" name="employer_name" id="employer_name" value="{{ old('employer_name') }}" class="form-control @error('employer_name') is-invalid @enderror" placeholder="e.g. Acme Corp">
                        @error('employer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="supporting_documents" class="form-label fw-semibold">Supporting Financial Documents (Payslips/Bank Statements)</label>
                    <input type="file" class="form-control @error('supporting_documents') is-invalid @enderror" id="supporting_documents" name="supporting_documents" required>
                    <small class="text-muted">Allowed files: PDF, JPG, PNG. Max file size: 5MB.</small>
                    @error('supporting_documents')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="purpose_of_loan" class="form-label fw-semibold">Detailed Purpose of Loan</label>
                    <textarea name="purpose_of_loan" id="purpose_of_loan" rows="3" class="form-control @error('purpose_of_loan') is-invalid @enderror" required placeholder="Describe what you plan to use these funds for...">{{ old('purpose_of_loan') }}</textarea>
                    @error('purpose_of_loan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('customer.loans.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleEmployerField() {
        var status = document.getElementById('employment_status').value;
        var employerContainer = document.getElementById('employer_name_container');
        var employerInput = document.getElementById('employer_name');
        
        if (status === 'employed') {
            employerContainer.style.display = 'block';
            employerInput.setAttribute('required', 'required');
        } else {
            employerContainer.style.display = 'none';
            employerInput.removeAttribute('required');
            employerInput.value = '';
        }
    }
    
    // Run on boot
    window.onload = function() {
        toggleEmployerField();
    };
</script>
@endsection
