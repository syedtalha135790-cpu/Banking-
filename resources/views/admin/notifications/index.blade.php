@extends('admin.layout')

@section('title', 'System Notification Logs')
@section('page_title', 'Notification Audit Logs')

@section('content')
<!-- Search & Filters Panel -->
<div class="card card-custom p-4 mb-4 shadow-sm border-0">
    <form action="{{ route('admin.notifications.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-5">
            <label for="search" class="form-label text-xs fw-semibold text-muted">Search title, message, ref, name or email</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search logs...">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
            <label for="type" class="form-label text-xs fw-semibold text-muted">Filter Type</label>
            <select name="type" id="type" class="form-select">
                <option value="">All Categories</option>
                <option value="transaction" @if(request('type') === 'transaction') selected @endif>Transactions</option>
                <option value="loan" @if(request('type') === 'loan') selected @endif>Loans</option>
                <option value="card" @if(request('type') === 'card') selected @endif>Cards</option>
                <option value="account" @if(request('type') === 'account') selected @endif>Account Status</option>
                <option value="welcome" @if(request('type') === 'welcome') selected @endif>System Welcome</option>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-2 col-lg-2">
            <label for="status" class="form-label text-xs fw-semibold text-muted">Read Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="unread" @if(request('status') === 'unread') selected @endif>Unread</option>
                <option value="read" @if(request('status') === 'read') selected @endif>Read</option>
            </select>
        </div>
        <div class="col-12 col-md-2 col-lg-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 py-2"><i class="bi bi-funnel-fill"></i> Filter</button>
            <a href="{{ route('admin.notifications.index') }}" class="btn btn-outline-secondary w-100 py-2">Clear</a>
        </div>
    </form>
</div>

<!-- Logs directory Card -->
<div class="card card-custom p-4 shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Recipient Details</th>
                    <th>Alert Title</th>
                    <th>Message Snippet</th>
                    <th>Type</th>
                    <th>Reference</th>
                    <th>Read Status</th>
                    <th>Channel</th>
                    <th>Sent Timestamp</th>
                    <th class="text-center">Resend</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $notif)
                    <tr>
                        <td>
                            @if($notif->user)
                                <div class="fw-bold text-dark">{{ $notif->user->name }}</div>
                                <small class="text-muted">{{ $notif->user->email }}</small>
                            @else
                                <span class="text-muted text-xs">Unknown Recipient</span>
                            @endif
                        </td>
                        <td class="fw-semibold text-slate-800">{{ $notif->title }}</td>
                        <td class="text-muted text-xs text-wrap" style="max-width: 250px;">{{ $notif->message }}</td>
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
                        <td class="text-xs fw-semibold text-primary">{{ $notif->reference_number ?? 'N/A' }}</td>
                        <td>
                            @if($notif->is_read)
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">Read</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 rounded-pill">Unread</span>
                            @endif
                        </td>
                        <td class="text-muted text-xs text-uppercase">{{ $notif->sent_via }}</td>
                        <td class="text-muted text-xs">{{ $notif->created_at->format('Y-m-d H:i:s') }}</td>
                        <td class="text-center">
                            @if($notif->user && $notif->user->email)
                                <form action="{{ route('admin.notifications.resend', $notif->id) }}" method="POST" onsubmit="return confirm('Re-queue this notification email to recipient?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;" title="Resend Notification">
                                        <i class="bi bi-arrow-clockwise"></i> Resend
                                    </button>
                                </form>
                            @else
                                <span class="text-muted text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">No transmission logs found.</td>
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
