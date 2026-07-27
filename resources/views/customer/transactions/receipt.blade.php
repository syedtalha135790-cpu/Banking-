@extends('customer.layout')

@section('title', 'Transaction Receipt')
@section('page_title', 'Transaction Receipt Details')

@section('content')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printableArea, #printableArea * {
            visibility: visible;
        }
        #printableArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none !important;
        }
    }
</style>

<div class="row">
    <div class="col-12 col-md-8 col-lg-6 mx-auto">
        <!-- Back trigger -->
        <a href="{{ route('customer.transactions.index') }}" class="btn btn-outline-secondary mb-3 no-print" style="border-radius: 8px;">
            <i class="bi bi-arrow-left"></i> Back to Ledger
        </a>

        <!-- Receipt Card -->
        <div class="card card-custom p-4 shadow-sm border-0" id="printableArea">
            <div class="text-center mb-4">
                <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex mb-2">
                    <i class="bi bi-bank fs-2"></i>
                </div>
                <h4 class="fw-bold m-0 text-dark">BMS BANK</h4>
                <small class="text-muted">Transaction Receipt Log</small>
            </div>

            <div class="border-top border-bottom py-3 my-3">
                <div class="row g-2 text-sm">
                    <div class="col-6 text-muted">Reference Code:</div>
                    <div class="col-6 text-end fw-bold text-dark">{{ $transaction->reference_number }}</div>
                    
                    <div class="col-6 text-muted">Transaction Status:</div>
                    <div class="col-6 text-end">
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-0.5 fw-semibold">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </div>

                    <div class="col-6 text-muted">Timestamp:</div>
                    <div class="col-6 text-end fw-medium text-dark">{{ $transaction->created_at->format('F d, Y h:i A') }}</div>
                </div>
            </div>

            <div class="my-4 text-center">
                <span class="text-muted text-xs uppercase d-block mb-1">TRANSACTION AMOUNT</span>
                <h1 class="fw-bold @if($transaction->transaction_type === 'deposit' || $transaction->transaction_type === 'transfer_in') text-success @else text-danger @endif">
                    {{ ($transaction->transaction_type === 'deposit' || $transaction->transaction_type === 'transfer_in') ? '+' : '-' }}{{ number_format($transaction->amount, 2) }}
                </h1>
            </div>

            <h6 class="fw-bold mb-3 text-dark border-bottom pb-2">Ledger Details</h6>
            <div class="space-y-2 text-sm mb-4">
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Account Number:</span>
                    <span class="fw-semibold text-dark">{{ $transaction->account->account_number }}</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Transaction Type:</span>
                    <span class="fw-semibold text-dark">{{ ucfirst(str_replace('_', ' ', $transaction->transaction_type)) }}</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Closing Balance Snapshot:</span>
                    <span class="fw-bold text-dark">{{ number_format($transaction->balance_after_transaction, 2) }}</span>
                </div>
                
                @if($transaction->senderAccount)
                    <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                        <span class="text-muted">Sender Account:</span>
                        <span class="fw-semibold text-dark">{{ $transaction->senderAccount->account_number }}</span>
                    </div>
                @endif

                @if($transaction->receiverAccount)
                    <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                        <span class="text-muted">Receiver Account:</span>
                        <span class="fw-semibold text-dark">{{ $transaction->receiverAccount->account_number }}</span>
                    </div>
                @endif

                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Description:</span>
                    <span class="fw-semibold text-dark">{{ $transaction->description ?? 'No note provided' }}</span>
                </div>
            </div>

            <div class="alert alert-secondary border-0 rounded-4 text-center text-muted" style="font-size: 11px;">
                Thank you for banking with BMS. This is a computer-generated transaction receipt and does not require a physical signature.
            </div>

            <div class="d-grid gap-2 mt-4 no-print">
                <button onclick="window.print();" class="btn btn-primary py-2.5">
                    <i class="bi bi-printer-fill me-1"></i> Print Receipt
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
