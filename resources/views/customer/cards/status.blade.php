@extends('customer.layout')

@section('title', 'Track Card Delivery')
@section('page_title', 'Track Card Courier')

@section('content')
<style>
    /* CSS Step Timeline */
    .timeline-steps {
        display: flex;
        flex-direction: column;
        position: relative;
        padding-left: 30px;
    }
    .timeline-steps::before {
        content: '';
        position: absolute;
        left: 9px;
        top: 5px;
        bottom: 5px;
        width: 2px;
        background: #dee2e6;
    }
    .timeline-step-item {
        position: relative;
        margin-bottom: 24px;
    }
    .timeline-step-bullet {
        position: absolute;
        left: -30px;
        top: 2px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #dee2e6;
        border: 4px solid white;
        box-shadow: 0 0 0 2px #dee2e6;
    }
    .timeline-step-item.completed .timeline-step-bullet {
        background: #2ecc71;
        box-shadow: 0 0 0 2px #2ecc71;
    }
    .timeline-step-item.active .timeline-step-bullet {
        background: #3498db;
        box-shadow: 0 0 0 2px #3498db;
    }
</style>

<div class="row">
    <div class="col-12 col-md-8 mx-auto">
        <!-- Back trigger -->
        <a href="{{ route('customer.cards.index') }}" class="btn btn-outline-secondary mb-3" style="border-radius: 8px;">
            <i class="bi bi-arrow-left"></i> Back to Cards
        </a>

        <div class="card card-custom p-4 shadow-sm border-0">
            <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Tracking Shipment status</h5>

            <div class="row g-3 text-sm mb-4">
                <div class="col-6">
                    <span class="text-muted text-xs uppercase d-block">Requested Card Type</span>
                    <span class="fw-bold text-slate-800">{{ ucfirst($request->card_type) }} Card ({{ strtoupper($request->card_network) }})</span>
                </div>
                <div class="col-6">
                    <span class="text-muted text-xs uppercase d-block">Request Date</span>
                    <span class="fw-semibold text-slate-800">{{ $request->created_at->format('F d, Y h:i A') }}</span>
                </div>
                <div class="col-12">
                    <span class="text-muted text-xs uppercase d-block">Delivery Address</span>
                    <span class="fw-semibold text-slate-800">{{ $request->delivery_address }}</span>
                </div>
            </div>

            <!-- Shipment Timeline checklist -->
            <div class="timeline-steps mt-4">
                @php
                    $stages = ['pending', 'under_review', 'approved', 'printed', 'shipped', 'delivered'];
                    $currentStageIndex = array_search($request->request_status, $stages);
                    if ($request->request_status === 'rejected') {
                        $currentStageIndex = -1;
                    }
                @endphp

                @if($request->request_status === 'rejected')
                    <div class="alert alert-danger border-0 rounded-4 p-3 mb-4 d-flex align-items-center gap-2">
                        <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                        <div>
                            <strong>Application Rejected:</strong> This card application has been evaluated and rejected by the credit committee.
                        </div>
                    </div>
                @else
                    <div class="timeline-step-item {{ $currentStageIndex >= 0 ? ($currentStageIndex == 0 ? 'active' : 'completed') : '' }}">
                        <div class="timeline-step-bullet"></div>
                        <h6 class="fw-bold m-0 text-dark">Application Pending</h6>
                        <small class="text-muted">Awaiting initial administrative sorting.</small>
                    </div>

                    <div class="timeline-step-item {{ $currentStageIndex >= 1 ? ($currentStageIndex == 1 ? 'active' : 'completed') : '' }}">
                        <div class="timeline-step-bullet"></div>
                        <h6 class="fw-bold m-0 text-dark">Under Review</h6>
                        <small class="text-muted">Background verification and income checks in progress.</small>
                    </div>

                    <div class="timeline-step-item {{ $currentStageIndex >= 2 ? ($currentStageIndex == 2 ? 'active' : 'completed') : '' }}">
                        <div class="timeline-step-bullet"></div>
                        <h6 class="fw-bold m-0 text-dark">Approved</h6>
                        <small class="text-muted">Credit limits defined, account configuration authorized.</small>
                    </div>

                    <div class="timeline-step-item {{ $currentStageIndex >= 3 ? ($currentStageIndex == 3 ? 'active' : 'completed') : '' }}">
                        <div class="timeline-step-bullet"></div>
                        <h6 class="fw-bold m-0 text-dark">Card Printed</h6>
                        <small class="text-muted">16-digit card number and magnetic stripe configured.</small>
                    </div>

                    <div class="timeline-step-item {{ $currentStageIndex >= 4 ? ($currentStageIndex == 4 ? 'active' : 'completed') : '' }}">
                        <div class="timeline-step-bullet"></div>
                        <h6 class="fw-bold m-0 text-dark">Shipped</h6>
                        <small class="text-muted">Courier assigned and package is in transit.</small>
                    </div>

                    <div class="timeline-step-item {{ $currentStageIndex >= 5 ? ($currentStageIndex == 5 ? 'active' : 'completed') : '' }}">
                        <div class="timeline-step-bullet"></div>
                        <h6 class="fw-bold m-0 text-dark">Delivered</h6>
                        <small class="text-muted">Handed over to cardholder. Tap card on ATM to activate PIN.</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
