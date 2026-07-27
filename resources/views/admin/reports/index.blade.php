@extends('admin.layout')

@section('title', 'System Reports')
@section('page_title', 'System Audit & Reports Engine')

@section('content')
<style>
    /* Print Layout Styling overrides */
    @media print {
        body * {
            visibility: hidden;
        }
        .printable-report-area, .printable-report-area * {
            visibility: visible;
        }
        .printable-report-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .non-printable {
            display: none !important;
        }
    }
</style>

<!-- Filters Card Panel -->
<div class="card card-custom p-4 mb-4 shadow-sm border-0 non-printable">
    <h5 class="fw-bold mb-3 text-dark">Audit Filter Criteria</h5>
    
    <form action="{{ route('admin.reports') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-12 col-md-4">
            <label for="category" class="form-label text-xs fw-semibold text-muted">Log Category</label>
            <select name="category" id="category" class="form-select">
                <option value="transactions" @if($category === 'transactions') selected @endif>Transactions Logs</option>
                <option value="accounts" @if($category === 'accounts') selected @endif>Accounts Ledger</option>
                <option value="loans" @if($category === 'loans') selected @endif>Loans Applications</option>
                <option value="cards" @if($category === 'cards') selected @endif>Card Applications</option>
            </select>
        </div>

        <div class="col-12 col-md-4">
            <label for="range" class="form-label text-xs fw-semibold text-muted">Time Period</label>
            <select name="range" id="range" class="form-select">
                <option value="daily" @if($range === 'daily') selected @endif>Daily Report (Today)</option>
                <option value="weekly" @if($range === 'weekly') selected @endif>Weekly Report (Last 7 Days)</option>
                <option value="monthly" @if($range === 'monthly') selected @endif>Monthly Report (Last 30 Days)</option>
                <option value="yearly" @if($range === 'yearly') selected @endif>Yearly Report (Last 365 Days)</option>
            </select>
        </div>

        <div class="col-12 col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 py-2">
                <i class="bi bi-funnel-fill"></i> Load Report
            </button>
            <button type="button" onclick="window.print();" class="btn btn-outline-secondary w-100 py-2">
                <i class="bi bi-printer"></i> Print Report
            </button>
        </div>
    </form>
</div>

<!-- Printable Report Area -->
<div class="card card-custom p-4 shadow-sm border-0 printable-report-area">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <h4 class="fw-bold text-dark m-0">BMS Bank Audit Statement</h4>
            <small class="text-muted text-xs">Generated on: {{ now()->toDateTimeString() }} | Category: <strong>{{ ucfirst($category) }}</strong> | Period: <strong>{{ ucfirst($range) }}</strong></small>
        </div>
        <div class="text-end">
            <span class="badge bg-dark px-3 py-2 rounded-pill text-xs">Official Document</span>
        </div>
    </div>

    <!-- 1. Category Table: Transactions -->
    @if($category === 'transactions')
        <div class="table-responsive">
            <table class="table table-striped align-middle statement-table" style="font-size: 13px;">
                <thead class="table-dark">
                    <tr>
                        <th>Reference</th>
                        <th>Account Number</th>
                        <th>Transaction Type</th>
                        <th>Amount</th>
                        <th>Balance Post</th>
                        <th>Description</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $t)
                        <tr>
                            <td class="fw-bold text-primary">{{ $t->reference_number }}</td>
                            <td>{{ $t->account->account_number ?? 'N/A' }}</td>
                            <td>
                                <span class="badge {{ in_array($t->transaction_type, ['deposit', 'transfer_in']) ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst(str_replace('_', ' ', $t->transaction_type)) }}
                                </span>
                            </td>
                            <td class="fw-bold">{{ number_format($t->amount, 2) }}</td>
                            <td>{{ number_format($t->balance_after_transaction, 2) }}</td>
                            <td class="text-muted text-xs">{{ $t->description }}</td>
                            <td class="text-xs">{{ $t->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No transactions found inside this range.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    <!-- 2. Category Table: Accounts -->
    @elseif($category === 'accounts')
        <div class="table-responsive">
            <table class="table table-striped align-middle statement-table" style="font-size: 13px;">
                <thead class="table-dark">
                    <tr>
                        <th>Account Holder</th>
                        <th>Account Number</th>
                        <th>Account Type</th>
                        <th>CNIC ID</th>
                        <th>Available Balance</th>
                        <th>Status</th>
                        <th>Date Configured</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $acc)
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
                                <span class="badge {{ $acc->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($acc->status) }}
                                </span>
                            </td>
                            <td class="text-xs">{{ $acc->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No accounts registered inside this range.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    <!-- 3. Category Table: Loans -->
    @elseif($category === 'loans')
        <div class="table-responsive">
            <table class="table table-striped align-middle statement-table" style="font-size: 13px;">
                <thead class="table-dark">
                    <tr>
                        <th>Borrower Name</th>
                        <th>Loan Category</th>
                        <th>Principal Amount</th>
                        <th>Interest Rate</th>
                        <th>Monthly EMI</th>
                        <th>Duration</th>
                        <th>Approval Status</th>
                        <th>Date Filed</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $loan)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $loan->user->name ?? 'N/A' }}</div>
                                <small class="text-muted">ID: {{ $loan->cnic }}</small>
                            </td>
                            <td><span class="badge bg-light text-dark border px-2 py-1 rounded-pill">{{ ucfirst($loan->loan_type) }} Loan</span></td>
                            <td class="fw-bold">{{ number_format($loan->amount, 2) }}</td>
                            <td>{{ $loan->interest_rate ? $loan->interest_rate . '%' : '-' }}</td>
                            <td>{{ $loan->monthly_emi ? number_format($loan->monthly_emi, 2) : '-' }}</td>
                            <td>{{ $loan->duration }} Months</td>
                            <td>
                                <span class="badge {{ $loan->status === 'disbursed' || $loan->status === 'approved' ? 'bg-success' : ($loan->status === 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                            <td class="text-xs">{{ $loan->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No loan applications filed inside this range.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    <!-- 4. Category Table: Cards -->
    @elseif($category === 'cards')
        <div class="table-responsive">
            <table class="table table-striped align-middle statement-table" style="font-size: 13px;">
                <thead class="table-dark">
                    <tr>
                        <th>Cardholder Name</th>
                        <th>Card Type</th>
                        <th>Preferred Network</th>
                        <th>Delivery Address</th>
                        <th>Contact Phone</th>
                        <th>Shipping Status</th>
                        <th>Date Requested</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $card)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $card->user->name ?? 'N/A' }}</div>
                                <small class="text-muted">Account ID: {{ $card->account_id }}</small>
                            </td>
                            <td><span class="badge bg-light text-dark border px-2 py-1 rounded-pill">{{ ucfirst($card->card_type) }} Card</span></td>
                            <td class="text-uppercase fw-semibold">{{ $card->card_network }}</td>
                            <td class="text-muted text-xs">{{ $card->delivery_address }}</td>
                            <td>{{ $card->phone_number }}</td>
                            <td>
                                <span class="badge {{ $card->request_status === 'approved' || $card->request_status === 'delivered' ? 'bg-success' : ($card->request_status === 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ ucfirst(str_replace('_', ' ', $card->request_status)) }}
                                </span>
                            </td>
                            <td class="text-xs">{{ $card->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No card requests compiled inside this range.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
