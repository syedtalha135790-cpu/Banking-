@extends('admin.layout')

@section('title', 'Live Audit Search')
@section('page_title', 'Live System Audit Cockpit')

@section('content')
<div class="row g-4">
    <!-- Advanced Sidebar Filters -->
    <div class="col-12 col-lg-3">
        <div class="card card-custom p-4 shadow-sm border-0 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark m-0"><i class="bi bi-funnel-fill text-primary"></i> filters</h5>
                <button type="button" id="btnResetFilters" class="btn btn-sm btn-link text-muted text-decoration-none p-0 text-xs">Reset All</button>
            </div>
            <hr class="mt-0 border-light-subtle">

            <form id="filterForm">
                <!-- User Filters -->
                <div class="filter-group select-tab-only mb-3" data-tab="users">
                    <label for="filter_role" class="form-label text-xs fw-semibold text-muted">Filter Role</label>
                    <select name="role" id="filter_role" class="form-select search-trigger">
                        <option value="">All Roles</option>
                        <option value="customer">Customer</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <!-- Account Filters -->
                <div class="filter-group select-tab-only d-none mb-3" data-tab="accounts">
                    <label for="filter_acc_type" class="form-label text-xs fw-semibold text-muted">Account Category</label>
                    <select name="type" id="filter_acc_type" class="form-select search-trigger">
                        <option value="">All Types</option>
                        <option value="savings">Savings Account</option>
                        <option value="current">Current Account</option>
                    </select>
                    
                    <label for="filter_acc_status" class="form-label text-xs fw-semibold text-muted mt-2">Account Status</label>
                    <select name="status" id="filter_acc_status" class="form-select search-trigger">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>

                    <label class="form-label text-xs fw-semibold text-muted mt-3">Balance range limit</label>
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="number" name="balance_min" id="balance_min" class="form-control form-control-sm search-trigger" placeholder="Min">
                        </div>
                        <div class="col-6">
                            <input type="number" name="balance_max" id="balance_max" class="form-control form-control-sm search-trigger" placeholder="Max">
                        </div>
                    </div>
                </div>

                <!-- Transaction Filters -->
                <div class="filter-group select-tab-only d-none mb-3" data-tab="transactions">
                    <label for="filter_tx_type" class="form-label text-xs fw-semibold text-muted">Transaction Type</label>
                    <select name="type" id="filter_tx_type" class="form-select search-trigger">
                        <option value="">All Types</option>
                        <option value="deposit">Deposit</option>
                        <option value="withdrawal">Withdrawal</option>
                        <option value="transfer_out">Transfer Out</option>
                        <option value="transfer_in">Transfer In</option>
                    </select>
                    
                    <label for="filter_tx_status" class="form-label text-xs fw-semibold text-muted mt-2">Status</label>
                    <select name="status" id="filter_tx_status" class="form-select search-trigger">
                        <option value="">All Statuses</option>
                        <option value="completed">Successful</option>
                        <option value="pending">Pending</option>
                        <option value="failed">Failed</option>
                    </select>

                    <label class="form-label text-xs fw-semibold text-muted mt-3">Amount limits</label>
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="number" name="amount_min" id="tx_amount_min" class="form-control form-control-sm search-trigger" placeholder="Min">
                        </div>
                        <div class="col-6">
                            <input type="number" name="amount_max" id="tx_amount_max" class="form-control form-control-sm search-trigger" placeholder="Max">
                        </div>
                    </div>
                </div>

                <!-- Loan Filters -->
                <div class="filter-group select-tab-only d-none mb-3" data-tab="loans">
                    <label for="filter_loan_type" class="form-label text-xs fw-semibold text-muted">Loan Category</label>
                    <select name="type" id="filter_loan_type" class="form-select search-trigger">
                        <option value="">All Loans</option>
                        <option value="personal">Personal Loan</option>
                        <option value="home">Home Loan</option>
                        <option value="car">Car Loan</option>
                        <option value="education">Education Loan</option>
                        <option value="business">Business Loan</option>
                    </select>

                    <label for="filter_loan_status" class="form-label text-xs fw-semibold text-muted mt-2">Loan Status</label>
                    <select name="status" id="filter_loan_status" class="form-select search-trigger">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="under_review">Under Review</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="disbursed">Disbursed</option>
                    </select>
                </div>

                <!-- Card Filters -->
                <div class="filter-group select-tab-only d-none mb-3" data-tab="cards">
                    <label for="filter_card_type" class="form-label text-xs fw-semibold text-muted">Card Category</label>
                    <select name="type" id="filter_card_type" class="form-select search-trigger">
                        <option value="">All Categories</option>
                        <option value="debit">Debit Card</option>
                        <option value="credit">Credit Card</option>
                    </select>

                    <label for="filter_card_status" class="form-label text-xs fw-semibold text-muted mt-2">Card Status</label>
                    <select name="status" id="filter_card_status" class="form-select search-trigger">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="blocked">Blocked</option>
                    </select>
                </div>

                <!-- Date Range pickers for relevant tables -->
                <div class="filter-group date-picker-block d-none mb-3">
                    <label class="form-label text-xs fw-semibold text-muted">Date Range</label>
                    <div class="d-flex flex-column gap-1.5">
                        <input type="date" name="date_start" id="date_start" class="form-control form-control-sm search-trigger">
                        <span class="text-muted text-center text-xs my-0.5">to</span>
                        <input type="date" name="date_end" id="date_end" class="form-control form-control-sm search-trigger">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Live Search Display -->
    <div class="col-12 col-lg-9">
        <div class="card card-custom p-4 shadow-sm border-0 h-100">
            <!-- Search field -->
            <div class="mb-4">
                <div class="input-group input-group-lg shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" id="liveSearchInput" class="form-control border-start-0 py-3" placeholder="Type keyword to filter users instantly...">
                    <button class="btn btn-white border-start-0 text-muted" type="button" id="btnClearSearch" style="border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; border-right: 1px solid #dee2e6;">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>
            </div>

            <!-- Tab Headers -->
            <ul class="nav nav-tabs mb-4" id="searchTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold px-4" data-tab="users" type="button">Users</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4" data-tab="accounts" type="button">Accounts</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4" data-tab="transactions" type="button">Transactions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4" data-tab="loans" type="button">Loans</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4" data-tab="cards" type="button">Cards</button>
                </li>
            </ul>

            <!-- Table dynamic fragment container -->
            <div class="position-relative" style="min-height: 250px;">
                <!-- Loading Spinner -->
                <div id="searchSpinner" class="position-absolute top-50 start-50 translate-middle d-none text-center" style="z-index: 10;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div id="searchTableContainer">
                    <div class="text-center py-5 text-muted">
                        Initial sorting in progress... Awaiting search keys.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AJAX live query dispatcher script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let activeTab = 'users';
        let debounceTimer;

        // Switch Tab and load defaults
        $('#searchTab button').on('click', function() {
            $('#searchTab button').removeClass('active');
            $(this).addClass('active');
            activeTab = $(this).data('tab');

            // Set placeholder context
            $('#liveSearchInput').attr('placeholder', `Type keyword to filter ${activeTab} instantly...`);

            // Hide/Show sidebar filter controls
            $('.select-tab-only').addClass('d-none');
            $(`.select-tab-only[data-tab="${activeTab}"]`).removeClass('d-none');

            // Show date range for transactions & loans
            if (activeTab === 'transactions' || activeTab === 'loans') {
                $('.date-picker-block').removeClass('d-none');
            } else {
                $('.date-picker-block').addClass('d-none');
            }

            // Fire fetch
            fetchResults();
        });

        // Trigger on search text modifications (debounced at 300ms)
        $('#liveSearchInput').on('keyup', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                fetchResults();
            }, 300);
        });

        // Trigger on filter controls change
        $('.search-trigger').on('change input', function() {
            fetchResults();
        });

        // Clear Search
        $('#btnClearSearch').on('click', function() {
            $('#liveSearchInput').val('');
            fetchResults();
        });

        // Reset Filters Button
        $('#btnResetFilters').on('click', function() {
            $('#filterForm')[0].reset();
            $('#liveSearchInput').val('');
            fetchResults();
        });

        // Handle AJAX pagination clicks
        $(document).on('click', '.search-pagination a', function(e) {
            e.preventDefault();
            let pageUrl = $(this).attr('href');
            let page = new URL(pageUrl).searchParams.get('page');
            fetchResults(page);
        });

        // Core AJAX Fetch dispatcher
        function fetchResults(page = 1) {
            $('#searchSpinner').removeClass('d-none');
            $('#searchTableContainer').css('opacity', '0.5');

            let searchVal = $('#liveSearchInput').val();
            let formData = $('#filterForm').serialize();

            $.ajax({
                url: `/admin/search/${activeTab}`,
                method: 'GET',
                data: formData + `&search=${encodeURIComponent(searchVal)}&page=${page}`,
                success: function(html) {
                    $('#searchSpinner').addClass('d-none');
                    $('#searchTableContainer').html(html).css('opacity', '1');
                },
                error: function(xhr) {
                    $('#searchSpinner').addClass('d-none');
                    $('#searchTableContainer').html('<div class="alert alert-danger p-3">Failed to load live data records. Please verify authorization roles.</div>').css('opacity', '1');
                }
            });
        }

        // Initialize table load on page ready
        fetchResults();
    });
</script>
@endsection
