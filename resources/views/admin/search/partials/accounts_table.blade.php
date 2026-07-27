<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Account Holder</th>
                <th>Account Number</th>
                <th>Account Type</th>
                <th>CNIC / National ID</th>
                <th>Balance</th>
                <th>Status</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($accounts as $acc)
                <tr>
                    <td>
                        <div class="fw-bold text-dark">{{ $acc->user->name ?? 'N/A' }}</div>
                        <small class="text-muted">{{ $acc->user->email ?? '' }}</small>
                    </td>
                    <td class="fw-bold text-primary">{{ $acc->account_number }}</td>
                    <td><span class="badge bg-light text-dark border px-2 py-1 rounded-pill">{{ ucfirst($acc->account_type) }}</span></td>
                    <td class="text-xs">{{ $acc->cnic }}</td>
                    <td class="fw-bold">{{ number_format($acc->balance, 2) }}</td>
                    <td>
                        @if($acc->status === 'active')
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill fw-semibold">Active</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill fw-semibold">{{ ucfirst($acc->status) }}</span>
                        @endif
                    </td>
                    <td class="text-muted text-xs">{{ $acc->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No accounts matched search criteria.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3 search-pagination" data-target="accounts">
    {{ $accounts->links('pagination::bootstrap-5') }}
</div>
