<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Card ID</th>
                <th>Cardholder</th>
                <th>Card Number</th>
                <th>Card Type</th>
                <th>Preferred Network</th>
                <th>Credit Limit</th>
                <th>Expiry</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cards as $c)
                <tr>
                    <td class="fw-bold">#{{ $c->id }}</td>
                    <td>
                        <div class="fw-bold text-dark">{{ $c->user->name ?? 'N/A' }}</div>
                        <small class="text-muted">Account: {{ $c->account->account_number ?? 'N/A' }}</small>
                    </td>
                    <td class="fw-bold text-primary tracking-widest">{{ $c->masked_number }}</td>
                    <td><span class="badge bg-light text-dark border px-2 py-1 rounded-pill">{{ ucfirst($c->card_type) }} Card</span></td>
                    <td class="text-uppercase fw-semibold">{{ $c->card_network }}</td>
                    <td>
                        @if($c->card_type === 'credit')
                            <span class="fw-bold">{{ number_format($c->credit_limit, 2) }}</span>
                        @else
                            <span class="text-muted text-xs">-</span>
                        @endif
                    </td>
                    <td class="text-muted text-xs">{{ $c->expiry_date->format('m/y') }}</td>
                    <td>
                        @if($c->status === 'active')
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill fw-semibold">Active</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill fw-semibold">Blocked</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">No cards matched search criteria.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3 search-pagination" data-target="cards">
    {{ $cards->links('pagination::bootstrap-5') }}
</div>
