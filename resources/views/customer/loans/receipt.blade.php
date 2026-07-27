@extends('customer.layout')

@section('title', 'EMI Payment Receipt')
@section('page_title', 'EMI Repayment Receipt')

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
        <a href="{{ route('customer.loans.show', $payment->loan_id) }}" class="btn btn-outline-secondary mb-3 no-print" style="border-radius: 8px;">
            <i class="bi bi-arrow-left"></i> Back to Schedule
        </a>

        <!-- Receipt Card -->
        <div class="card card-custom p-4 shadow-sm border-0" id="printableArea">
            <div class="text-center mb-4">
                <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex mb-2">
                    <i class="bi bi-bank fs-2"></i>
                </div>
                <h4 class="fw-bold m-0 text-dark">BMS BANK</h4>
                <small class="text-muted">EMI Installment Payment Receipt</small>
            </div>

            <div class="border-top border-bottom py-3 my-3">
                <div class="row g-2 text-sm">
                    <div class="col-6 text-muted">Receipt Ref Code:</div>
                    <div class="col-6 text-end fw-bold text-dark">{{ $payment->reference_number }}</div>
                    
                    <div class="col-6 text-muted">Installment No:</div>
                    <div class="col-6 text-end fw-bold text-dark">Installment #{{ $payment->installment_number }} of {{ $payment->loan->duration }}</div>
                    
                    <div class="col-6 text-muted">Payment Status:</div>
                    <div class="col-6 text-end">
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-0.5 fw-semibold">
                            Success
                        </span>
                    </div>

                    <div class="col-6 text-muted">Timestamp:</div>
                    <div class="col-6 text-end fw-medium text-dark">{{ $payment->payment_date->format('F d, Y h:i A') }}</div>
                </div>
            </div>

            <div class="my-4 text-center">
                <span class="text-muted text-xs uppercase d-block mb-1">REPAYMENT AMOUNT</span>
                <h1 class="fw-bold text-success">
                    -{{ number_format($payment->amount, 2) }}
                </h1>
            </div>

            <h6 class="fw-bold mb-3 text-dark border-bottom pb-2">Repayment & Loan Ledger Details</h6>
            <div class="space-y-2 text-sm mb-4">
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Loan Type:</span>
                    <span class="fw-semibold text-dark">{{ ucfirst($payment->loan->loan_type) }} Loan</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Loan ID Number:</span>
                    <span class="fw-semibold text-dark">#{{ $payment->loan->id }}</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Linked Account:</span>
                    <span class="fw-semibold text-dark">{{ $payment->loan->account->account_number }}</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Remaining Loan Balance:</span>
                    <span class="fw-bold text-danger">{{ number_format($payment->loan->outstanding_balance, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between py-1.5 border-bottom border-light">
                    <span class="text-muted">Due Date:</span>
                    <span class="fw-semibold text-dark">{{ $payment->due_date->format('F d, Y') }}</span>
                </div>
            </div>

            <div class="alert alert-secondary border-0 rounded-4 text-center text-muted" style="font-size: 11px;">
                Thank you for banking with BMS. This is a computer-generated repayment receipt and does not require a physical signature.
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
