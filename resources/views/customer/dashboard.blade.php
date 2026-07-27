@extends('customer.layout')

@section('title', 'Client Dashboard')
@section('page_title', 'My Portfolio')

@section('content')
<div class="row g-4">
    <!-- Welcome Card -->
    <div class="col-12">
        <div class="card card-custom p-4 bg-primary text-white" style="border: none;">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold m-0">Welcome Back, {{ $user->name }}!</h2>
                    <p class="m-0 mt-1 opacity-75">Access your secured savings pockets, manage card settings, and view transaction details.</p>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-4">
                    <i class="bi bi-patch-check-fill fs-2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Details -->
    <div class="col-12 col-md-6">
        <div class="card card-custom p-4 h-100">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Profile Credentials</h5>
            <div class="space-y-3">
                <div class="d-flex justify-content-between py-2 border-bottom border-light">
                    <span class="text-muted fw-medium">Full Name:</span>
                    <span class="fw-semibold text-dark">{{ $user->name }}</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom border-light">
                    <span class="text-muted fw-medium">Email Address:</span>
                    <span class="fw-semibold text-dark">{{ $user->email }}</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom border-light">
                    <span class="text-muted fw-medium">Phone Number:</span>
                    <span class="fw-semibold text-dark">{{ $user->phone_number ?? 'Not provided' }}</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom border-light">
                    <span class="text-muted fw-medium">Account Class:</span>
                    <span class="badge bg-success-subtle text-success fw-semibold border border-success-subtle rounded-pill px-2.5 py-1">Standard Customer</span>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('customer.profile.edit') }}" class="btn btn-custom-primary flex-grow-1">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profile
                </a>
                <a href="{{ route('customer.password.change') }}" class="btn btn-outline-secondary flex-grow-1" style="border-radius: 10px;">
                    <i class="bi bi-shield-lock me-1"></i> Security
                </a>
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="col-12 col-md-6">
        <div class="card card-custom p-4 h-100 d-flex flex-column justify-content-between">
            <div>
                <h5 class="fw-bold mb-3 border-bottom pb-2">Security Notice</h5>
                <p class="text-muted text-sm leading-relaxed">
                    Always verify that you are accessing BMS over a secure connection. We will never request your passwords, login credentials, or one-time security codes (OTP) via phone call, SMS, or email. Keep your credentials safe and report any anomalies immediately to compliance.
                </p>
            </div>
            <div class="bg-light p-3 rounded-4 d-flex align-items-start gap-2">
                <i class="bi bi-shield-exclamation text-warning fs-4"></i>
                <div class="text-xs text-muted">
                    Last Logged login activity logged from active web session. Verify session tokens inside browser settings.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
