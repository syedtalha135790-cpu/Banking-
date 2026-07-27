<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Reference No.</th>
                <th>Account Number</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Post Balance</th>
                <th>Description</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $t)
                <tr>
                    <td class="fw-bold text-primary">{{ $t->reference_number }}</td>
                    <td>{{ $t->account->account_number ?? 'N/A' }}</td>
                    <td>
                        <span class="badge {{ in_array($t->transaction_type, ['deposit', 'transfer_in']) ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle' }} px-2 py-1 rounded-pill fw-semibold">
                            {{ ucfirst(str_replace('_', ' ', $t->transaction_type)) }}
                        </span>
                    </td>
                    <td class="fw-bold">{{ number_format($t->amount, 2) }}</td>
                    <td>{{ number_format($t->balance_after_transaction, 2) }}</td>
                    <td class="text-muted text-xs">{{ $t->description }}</td>
                    <td class="text-xs text-muted">{{ $t->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No transactions matched search criteria.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3 search-pagination" data-target="transactions">
    {{ $transactions->links('pagination::bootstrap-5') }}
</div>
