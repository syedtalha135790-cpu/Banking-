<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Role</th>
                <th>Registered Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $u)
                <tr>
                    <td class="fw-bold">#{{ $u->id }}</td>
                    <td class="fw-bold text-dark">{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->phone_number ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $u->role === 'admin' ? 'bg-danger-subtle text-danger' : 'bg-primary-subtle text-primary' }} px-2 py-1 rounded-pill">
                            {{ ucfirst($u->role) }}
                        </span>
                    </td>
                    <td class="text-muted text-xs">{{ $u->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No users matched search criteria.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3 search-pagination" data-target="users">
    {{ $users->links('pagination::bootstrap-5') }}
</div>
