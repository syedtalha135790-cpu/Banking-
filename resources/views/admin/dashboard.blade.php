@extends('admin.layout')

@section('title', 'Admin Overview')
@section('page_title', 'Admin Command Center')

@section('content')
<div class="row g-4 mb-4">
    <!-- Total Users -->
    <div class="col-12 col-md-4">
        <div class="card card-custom p-4 border-start border-primary border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1">Total Accounts</h6>
                    <h3 class="fw-bold m-0">{{ $totalUsers }}</h3>
                </div>
                <div class="bg-primary-subtle text-primary p-3 rounded-4">
                    <i class="bi bi-people fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Customers -->
    <div class="col-12 col-md-4">
        <div class="card card-custom p-4 border-start border-success border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1">Customers</h6>
                    <h3 class="fw-bold m-0">{{ $totalCustomers }}</h3>
                </div>
                <div class="bg-success-subtle text-success p-3 rounded-4">
                    <i class="bi bi-person-check fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Admins -->
    <div class="col-12 col-md-4">
        <div class="card card-custom p-4 border-start border-warning border-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted fw-bold text-uppercase mb-1">Administrators</h6>
                    <h3 class="fw-bold m-0">{{ $totalAdmins }}</h3>
                </div>
                <div class="bg-warning-subtle text-warning p-3 rounded-4">
                    <i class="bi bi-shield-lock fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Management Table -->
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h5 class="fw-bold m-0">User Directory</h5>
        <a href="{{ route('admin.users.create') }}" class="btn btn-custom-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New User
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Role</th>
                    <th scope="col">Activated</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td class="fw-semibold text-dark">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number ?? '-' }}</td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1.5 rounded-pill fw-semibold">Admin</span>
                            @else
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-pill fw-semibold">Customer</span>
                            @endif
                        </td>
                        <td>
                            @if($user->email_verified_at)
                                <span class="text-success"><i class="bi bi-patch-check-fill me-1"></i> Active</span>
                            @else
                                <span class="text-muted"><i class="bi bi-clock me-1"></i> Pending OTP</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                @if($user->id !== Auth::id())
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-sm btn-outline-secondary disabled" style="border-radius: 8px;">
                                        <i class="bi bi-trash"></i> Self
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No users found in directory.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
