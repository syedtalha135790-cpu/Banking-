<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Loan ID</th>
                <th>Borrower Name</th>
                <th>Loan Category</th>
                <th>Principal Amount</th>
                <th>Monthly EMI</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Submission Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
                <tr>
                    <td class="fw-bold">#{{ $loan->id }}</td>
                    <td>
                        <div class="fw-bold text-dark">{{ $loan->user->name ?? 'N/A' }}</div>
                        <small class="text-muted">Account: {{ $loan->account_id }}</small>
                    </td>
                    <td><span class="badge bg-light text-dark border px-2 py-1 rounded-pill">{{ ucfirst($loan->loan_type) }} Loan</span></td>
                    <td class="fw-bold">{{ number_format($loan->amount, 2) }}</td>
                    <td>{{ $loan->monthly_emi ? number_format($loan->monthly_emi, 2) : '-' }}</td>
                    <td>{{ $loan->duration }} Months</td>
                    <td>
                        <span class="badge {{ $loan->status === 'disbursed' || $loan->status === 'approved' ? 'bg-success' : ($loan->status === 'rejected' ? 'bg-danger' : 'bg-warning') }} px-2.5 py-1 rounded-pill fw-semibold">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                    <td class="text-muted text-xs">{{ $loan->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">No loans matched search criteria.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3 search-pagination" data-target="loans">
    {{ $loans->links('pagination::bootstrap-5') }}
</div>
