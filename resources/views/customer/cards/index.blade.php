@extends('customer.layout')

@section('title', 'Cards & Payments')
@section('page_title', 'My Payment Cards')

@section('content')
<style>
    /* Premium Bank Card Styles */
    .bank-card {
        width: 100%;
        max-width: 380px;
        height: 220px;
        border-radius: 18px;
        padding: 24px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
        margin-bottom: 24px;
    }
    .bank-card:hover {
        transform: translateY(-5px) rotate(1deg);
    }
    .bank-card::before {
        content: '';
        position: absolute;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -50px;
        right: -50px;
    }
    .card-debit {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    }
    .card-credit {
        background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
    }
    .card-blocked {
        background: linear-gradient(135deg, #434343 0%, #000000 100%);
    }
    .card-logo {
        height: 32px;
        width: auto;
    }
    .card-chip {
        width: 42px;
        height: 32px;
        background: #f1c40f;
        border-radius: 6px;
        margin-bottom: 20px;
        box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
    }
</style>

<div class="row g-4 mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h5 class="fw-bold m-0 text-dark">Active Cards Directory</h5>
            <p class="text-muted text-xs m-0">Manage card limits, replacement requests, or freeze stolen profiles.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('customer.cards.requestDebit') }}" class="btn btn-primary px-3 py-2">
                <i class="bi bi-plus-lg me-1"></i> Request Debit Card
            </a>
            <a href="{{ route('customer.cards.requestCredit') }}" class="btn btn-outline-primary px-3 py-2">
                <i class="bi bi-wallet2 me-1"></i> Apply for Credit Card
            </a>
        </div>
    </div>

    <!-- Active Cards Grid -->
    @forelse($cards as $c)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="bank-card {{ $c->status === 'blocked' ? 'card-blocked' : ($c->card_type === 'debit' ? 'card-debit' : 'card-credit') }}">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="text-xs uppercase fw-bold opacity-75">{{ ucfirst($c->card_type) }} Card</span>
                        <h6 class="m-0 fw-semibold">{{ $c->card_network === 'visa' ? 'Visa Platinum' : 'MasterCard Gold' }}</h6>
                    </div>
                    <span class="badge {{ $c->status === 'active' ? 'bg-success' : 'bg-danger' }} px-2.5 py-1 rounded-pill">
                        {{ ucfirst($c->status) }}
                    </span>
                </div>

                <div class="card-chip"></div>

                <div class="mb-3">
                    <h5 class="fw-bold tracking-widest text-white m-0">{{ $c->masked_number }}</h5>
                </div>

                <div class="d-flex justify-content-between align-items-end text-xs">
                    <div>
                        <span class="opacity-75 d-block text-2xs uppercase">Cardholder</span>
                        <span class="fw-medium">{{ $c->user->name }}</span>
                    </div>
                    <div class="text-end">
                        <span class="opacity-75 d-block text-2xs uppercase">Expiry</span>
                        <span class="fw-medium">{{ $c->expiry_date->format('m/y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Card Controls -->
            <div class="card card-custom p-3 border border-light-subtle d-flex gap-2 justify-content-center flex-row flex-wrap mb-4">
                @if($c->status === 'active')
                    <form action="{{ route('customer.cards.block', $c->id) }}" method="POST" onsubmit="return confirm('Freeze this card immediately? You will need to request replacement if lost.');" class="w-100">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100 py-2">
                            <i class="bi bi-shield-slash me-1"></i> Freeze / Report Lost
                        </button>
                    </form>
                @else
                    <button class="btn btn-sm btn-danger disabled w-100 py-2">
                        <i class="bi bi-lock-fill me-1"></i> Card Frozen
                    </button>
                @endif
                <form action="{{ route('customer.cards.replace', $c->id) }}" method="POST" onsubmit="return confirm('Deactivate card and order replacement? Shipping fee may apply.');" class="w-100">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-secondary w-100 py-2">
                        <i class="bi bi-arrow-repeat me-1"></i> Request Replacement
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-light border rounded-4 text-center py-5 text-muted">
                <i class="bi bi-credit-card-2-front fs-1 mb-2 d-block text-muted"></i>
                You have not registered or been issued any payment cards. Use the triggers above to request a card!
            </div>
        </div>
    @endforelse
</div>

<!-- Requests Tracking Ledger -->
<div class="card card-custom p-4 mt-2">
    <h5 class="fw-bold mb-4 text-dark">Card Applications & Shipment Logs</h5>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Request ID</th>
                    <th>Card Type</th>
                    <th>Network</th>
                    <th>Delivery Address</th>
                    <th>Request Date</th>
                    <th>Shipping Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $r)
                    <tr>
                        <td class="fw-bold">#{{ $r->id }}</td>
                        <td><span class="badge bg-light text-dark border px-2 py-1 rounded-pill">{{ ucfirst($r->card_type) }} Card</span></td>
                        <td class="text-uppercase fw-semibold">{{ $r->card_network }}</td>
                        <td class="text-muted text-xs">{{ $r->delivery_address }}</td>
                        <td class="text-muted text-xs">{{ $r->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            @if($r->request_status === 'approved' || $r->request_status === 'delivered')
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill fw-semibold">{{ ucfirst($r->request_status) }}</span>
                            @elseif($r->request_status === 'rejected')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill fw-semibold">Rejected</span>
                            @elseif($r->request_status === 'shipped')
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1 rounded-pill fw-semibold"><i class="bi bi-truck me-1"></i> Shipped</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 rounded-pill fw-semibold">{{ ucfirst(str_replace('_', ' ', $r->request_status)) }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('customer.cards.track', $r->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                <i class="bi bi-geo-alt"></i> Track Delivery
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No pending card application tracks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
