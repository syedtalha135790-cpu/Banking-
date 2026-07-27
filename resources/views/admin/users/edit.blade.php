@extends('admin.layout')

@section('title', 'Edit User')
@section('page_title', 'Modify User Details')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-4">Modify Details for {{ $user->name }}</h5>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Full Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required placeholder="e.g. John Doe">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="e.g. john@example.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label fw-semibold">Phone Number (Optional)</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="e.g. +1234567890">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="password" class="form-label fw-semibold">New Password (Leave blank to keep current)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimum 8 characters">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new secure password">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label fw-semibold">System Access Role</label>
                    @if($user->id === Auth::id())
                        <input type="hidden" name="role" value="admin">
                        <select class="form-select" disabled>
                            <option selected>Admin (You cannot demote yourself)</option>
                        </select>
                        <small class="text-muted">Self role modifications are locked.</small>
                    @else
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="customer" @if(old('role', $user->role) === 'customer') selected @endif>Customer (Standard Client Dashboard)</option>
                            <option value="admin" @if(old('role', $user->role) === 'admin') selected @endif>Admin (Control Panel & CRUD)</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    @endif
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">Cancel</a>
                    <button type="submit" class="btn btn-custom-primary px-4 py-2">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
