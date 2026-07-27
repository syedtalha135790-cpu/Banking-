@extends('customer.layout')

@section('title', 'Alerts & Notifications')
@section('page_title', 'Alerts & Notifications')

@section('content')
<div class="card card-custom p-4 mb-4 shadow-sm border-0">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h5 class="fw-bold m-0 text-dark">Notification Center</h5>
            <p class="text-muted text-xs m-0">Audit security events, credit disbursals, and payment warnings.</p>
        </div>
        <div class="d-flex gap-2">
            <form action="{{ route('customer.notifications.markAllRead') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-primary py-2 px-3 text-sm fw-semibold" style="border-radius: 8px;">
                    <i class="bi bi-check-all me-1"></i> Mark All as Read
                </button>
            </form>
        </div>
    </div>

    <!-- Search & Filters -->
    <form action="{{ route('customer.notifications.index') }}" method="GET" class="row g-2 align-items-end mt-2">
        <div class="col-12 col-md-6 col-lg-5">
            <label for="search" class="form-label text-xs fw-semibold text-muted">Search message or reference</label>
            <div class="input-group">
                <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Type keyword...">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <label for="type" class="form-label text-xs fw-semibold text-muted">Filter Category</label>
            <select name="type" id="type" class="form-select">
                <option value="">All Notifications</option>
                <option value="transaction" @if(request('type') === 'transaction') selected @endif>Transactions</option>
                <option value="loan" @if(request('type') === 'loan') selected @endif>Loans</option>
                <option value="card" @if(request('type') === 'card') selected @endif>Cards</option>
                <option value="account" @if(request('type') === 'account') selected @endif>Account Status</option>
                <option value="welcome" @if(request('type') === 'welcome') selected @endif>System Welcome</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-lg-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 py-2"><i class="bi bi-funnel"></i> Apply</button>
            <a href="{{ route('customer.notifications.index') }}" class="btn btn-outline-secondary w-100 py-2">Clear</a>
        </div>
    </form>
</div>

<!-- Notifications Log Table -->
<div class="card card-custom p-4 shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">Status</th>
                    <th>Message Details</th>
                    <th>Alert Type</th>
                    <th>Reference</th>
                    <th>Date & Time</th>
                    <th class="text-center" style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $notif)
                    <tr class="{{ !$notif->is_read ? 'table-light fw-bold text-dark' : '' }}">
                        <td class="text-center">
                            @if(!$notif->is_read)
                                <span class="badge bg-primary rounded-circle p-1.5" title="Unread"><span class="visually-hidden">New</span></span>
                            @else
                                <span class="badge bg-light text-muted p-1.5" title="Read"><i class="bi bi-check2"></i></span>
                            @endif
                        </td>
                        <td>
                            <div class="fs-6">{{ $notif->title }}</div>
                            <small class="text-muted d-block mt-0.5 fw-normal">{{ $notif->message }}</small>
                        </td>
                        <td>
                            @if($notif->notification_type === 'transaction')
                                <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-pill">Transaction</span>
                            @elseif($notif->notification_type === 'loan')
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 rounded-pill">Loan Alert</span>
                            @elseif($notif->notification_type === 'card')
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1 rounded-pill">Card Alert</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1 rounded-pill">{{ ucfirst($notif->notification_type) }}</span>
                            @endif
                        </td>
                        <td class="text-xs fw-semibold">{{ $notif->reference_number ?? 'N/A' }}</td>
                        <td class="text-muted text-xs">{{ $notif->created_at->format('Y-m-d H:i:s') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                @if(!$notif->is_read)
                                    <form action="{{ route('customer.notifications.read', $notif->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Mark as read" style="border-radius: 8px;">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('customer.notifications.delete', $notif->id) }}" method="POST" onsubmit="return confirm('Delete notification?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete alert" style="border-radius: 8px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-bell-slash fs-1 d-block mb-2 text-muted"></i>
                            No notifications match your current filters.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $notifications->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
