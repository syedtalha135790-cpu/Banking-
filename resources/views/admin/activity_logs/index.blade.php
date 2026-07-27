@extends('admin.layout')

@section('title', 'Activity Logs')
@section('page_title', 'System Security Audit Trail')

@section('content')
<style>
    /* Print Layout Styling overrides */
    @media print {
        body * {
            visibility: hidden;
        }
        .printable-logs-area, .printable-logs-area * {
            visibility: visible;
        }
        .printable-logs-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .non-printable {
            display: none !important;
        }
    }
    .hover-row {
        cursor: pointer;
    }
</style>

<!-- Stat metrics cards -->
<div class="row g-3 mb-4 non-printable">
    <div class="col-12 col-md-4">
        <div class="card p-3 border-0 bg-primary text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Total Audits Tracked</span>
            <h3 class="fw-bold my-1">{{ number_format($totalLogs) }}</h3>
            <small class="text-3xs opacity-75">All recorded transactions & actions</small>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card p-3 border-0 bg-success text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Logins Today</span>
            <h3 class="fw-bold my-1">{{ $loginsToday }}</h3>
            <small class="text-3xs opacity-75">Successful & failed verification attempts</small>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card p-3 border-0 bg-dark text-white shadow-sm h-100" style="border-radius: 12px;">
            <span class="text-xs uppercase fw-bold opacity-75">Administrative Actions</span>
            <h3 class="fw-bold my-1">{{ $adminActions }}</h3>
            <small class="text-3xs opacity-75">Account adjustments & approvals logged</small>
        </div>
    </div>
</div>

<!-- Filters Drawer Panel -->
<div class="card card-custom p-4 mb-4 shadow-sm border-0 non-printable">
    <h5 class="fw-bold mb-3 text-dark">Logs Query Filter</h5>
    
    <form action="{{ route('admin.activity_logs.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-3">
            <label for="search" class="form-label text-xs fw-semibold text-muted">Keyword Search</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control" placeholder="Search Description/IP...">
        </div>

        <div class="col-12 col-md-2">
            <label for="module" class="form-label text-xs fw-semibold text-muted">Module</label>
            <select name="module" id="module" class="form-select">
                <option value="">All Modules</option>
                <option value="auth" @if(request('module') === 'auth') selected @endif>Auth</option>
                <option value="transaction" @if(request('module') === 'transaction') selected @endif>Transaction</option>
                <option value="profile" @if(request('module') === 'profile') selected @endif>Profile</option>
                <option value="loan" @if(request('module') === 'loan') selected @endif>Loan</option>
                <option value="card" @if(request('module') === 'card') selected @endif>Card</option>
                <option value="admin" @if(request('module') === 'admin') selected @endif>Admin</option>
            </select>
        </div>

        <div class="col-12 col-md-2">
            <label for="status" class="form-label text-xs fw-semibold text-muted">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="success" @if(request('status') === 'success') selected @endif>Successful</option>
                <option value="failed" @if(request('status') === 'failed') selected @endif>Failed</option>
            </select>
        </div>

        <div class="col-12 col-md-2">
            <label for="date" class="form-label text-xs fw-semibold text-muted">Audit Date</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}" class="form-control">
        </div>

        <div class="col-12 col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 py-2">
                <i class="bi bi-funnel-fill"></i> Filter
            </button>
            <a href="{{ route('admin.activity_logs.export', request()->query()) }}" class="btn btn-success w-100 py-2">
                <i class="bi bi-file-earmark-excel"></i> Export CSV
            </a>
            <button type="button" onclick="window.print();" class="btn btn-outline-secondary w-100 py-2">
                <i class="bi bi-printer"></i> Print
            </button>
        </div>
    </form>
</div>

<!-- Audit Trail Table -->
<div class="card card-custom p-4 shadow-sm border-0 printable-logs-area">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <h4 class="fw-bold text-dark m-0">System Activity Statement</h4>
            <small class="text-muted text-xs">Security Logs Audit Trail | Generated on: {{ now()->toDateTimeString() }}</small>
        </div>
        <div class="text-end non-printable">
            <span class="badge bg-danger px-3 py-2 rounded-pill text-xs">Immutable Ledger</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle" style="font-size: 13px;">
            <thead class="table-dark">
                <tr>
                    <th>Log ID</th>
                    <th>Operator</th>
                    <th>Module</th>
                    <th>Action</th>
                    <th>Description Summary</th>
                    <th>Client OS/Browser</th>
                    <th>Status</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr class="hover-row" onclick="viewLogDetails({{ $log->id }})">
                        <td class="fw-bold">#{{ $log->id }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $log->user->name ?? 'System Guest' }}</div>
                            <small class="text-muted text-3xs">{{ $log->ip_address }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-0.5 rounded-pill text-2xs uppercase">
                                {{ $log->module }}
                            </span>
                        </td>
                        <td class="text-uppercase fw-semibold text-xs text-slate-800">{{ str_replace('_', ' ', $log->action) }}</td>
                        <td class="text-muted text-xs">{{ $log->description }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-1.5 text-2xs text-slate-600">
                                <span><i class="bi bi-laptop"></i> {{ $log->operating_system }}</span>
                                <span class="text-muted">|</span>
                                <span><i class="bi bi-browser-chrome"></i> {{ $log->browser }}</span>
                            </div>
                        </td>
                        <td>
                            @if($log->status === 'success')
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0.5 rounded-pill text-2xs">Success</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-0.5 rounded-pill text-2xs">Failed</span>
                            @endif
                        </td>
                        <td class="text-xs text-muted">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">No security audits recorded for this query.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 non-printable">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Audit Log Detail Modal -->
<div class="modal fade" id="logDetailModal" tabindex="-1" aria-labelledby="logDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 14px; border: none;">
            <div class="modal-header bg-dark text-white" style="border-top-left-radius: 14px; border-top-right-radius: 14px;">
                <h5 class="modal-title fw-bold" id="logDetailModalLabel">Security Audit Detail</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-3">
                    <span id="detailStatusBadge" class="badge px-3 py-1.5 rounded-pill text-xs fw-bold"></span>
                </div>
                <table class="table table-bordered align-middle text-xs">
                    <tbody>
                        <tr>
                            <th class="bg-light text-muted fw-bold w-35">Log Reference ID</th>
                            <td id="detailId" class="fw-bold"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-muted fw-bold">Operator</th>
                            <td id="detailOperator" class="fw-bold text-dark"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-muted fw-bold">Action / Event</th>
                            <td id="detailAction" class="text-uppercase fw-semibold text-primary"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-muted fw-bold">Module</th>
                            <td id="detailModule" class="text-uppercase"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-muted fw-bold">IP Address</th>
                            <td id="detailIp"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-muted fw-bold">Operating System</th>
                            <td id="detailOS"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-muted fw-bold">Browser</th>
                            <td id="detailBrowser"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-muted fw-bold">Device Category</th>
                            <td id="detailDevice"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-muted fw-bold">Timestamp</th>
                            <td id="detailTime" class="text-muted"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3">
                    <label class="form-label text-xs fw-semibold text-muted mb-1">Description payload</label>
                    <div id="detailDescription" class="p-3 bg-light text-slate-800 rounded border text-xs" style="white-space: pre-wrap;"></div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary w-100 py-2" data-bs-dismiss="modal" style="border-radius: 8px;">Dismiss</button>
            </div>
        </div>
    </div>
</div>

<!-- AJAX detail loading script -->
<script>
    function viewLogDetails(id) {
        // Trigger loading state or fetch data directly via fetch API
        fetch(`/admin/activity-logs/${id}`)
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success') {
                    const data = res.data;
                    document.getElementById('detailId').innerText = `#${data.id}`;
                    document.getElementById('detailOperator').innerText = data.user;
                    document.getElementById('detailAction').innerText = data.action;
                    document.getElementById('detailModule').innerText = data.module;
                    document.getElementById('detailIp').innerText = data.ip_address;
                    document.getElementById('detailOS').innerText = data.operating_system;
                    document.getElementById('detailBrowser').innerText = data.browser;
                    document.getElementById('detailDevice').innerText = data.device;
                    document.getElementById('detailTime').innerText = data.created_at;
                    document.getElementById('detailDescription').innerText = data.description;

                    const statusBadge = document.getElementById('detailStatusBadge');
                    statusBadge.innerText = data.status;
                    if (data.status === 'SUCCESS') {
                        statusBadge.className = 'badge bg-success-subtle text-success border border-success-subtle px-3 py-1.5 rounded-pill text-xs fw-bold';
                    } else {
                        statusBadge.className = 'badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 rounded-pill text-xs fw-bold';
                    }

                    // Show Modal
                    const myModal = new bootstrap.Modal(document.getElementById('logDetailModal'));
                    myModal.show();
                }
            })
            .catch(err => {
                alert('Error loading log data.');
            });
    }
</script>
@endsection
