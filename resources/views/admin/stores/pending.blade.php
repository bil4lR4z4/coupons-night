@extends('admin.master')

@section('title', 'Pending Stores')

@section('content')

<div class="container-fluid">

    <!-- PAGE TITLE -->

    <div class="row mb-4">

        <div class="col-lg-12">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h2 class="fw-bold mb-1">
                        Pending Stores
                    </h2>

                    <p class="text-muted mb-0">
                        Stores waiting for admin approval
                    </p>

                </div>

                <div>

                    <span class="badge bg-warning fs-6 px-3 py-2">
                        Total Pending :
                        {{ $stores->count() }}
                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- STATISTICS -->

    <div class="row mb-4">

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-muted">
                        Pending Stores
                    </h6>

                    <h2 class="fw-bold text-warning">
                        {{ $stores->count() }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Coupons
                    </h6>

                    <h2 class="fw-bold text-primary">
                        {{ $stores->sum(fn($s) => $s->coupons->count()) }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle" id="pendingStoresTable">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Store</th>

                            <th>Logo</th>

                            <th>Coupons</th>

                            <th>Created By</th>

                            <th>Coupon Status</th>

                            <th>Approval</th>

                            <th>Created</th>

                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($stores as $store)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                <div>

                                    <h6 class="mb-0 fw-semibold">
                                        {{ $store->name }}
                                    </h6>

                                    <small class="text-muted">
                                        {{ $store->website }}
                                    </small>

                                </div>

                            </td>

                            <td>

                                @if($store->logo)

                                <img
                                    src="{{ asset('uploads/stores/'.$store->logo) }}"
                                    width="60"
                                    class="rounded shadow-sm"
                                >

                                @else

                                <span class="badge bg-secondary">
                                    No Logo
                                </span>

                                @endif

                            </td>

                            <td>

                                @php
                                    $couponCount = $store->coupons->count();
                                @endphp

                                <span class="badge bg-primary">

                                    {{ $couponCount }} Coupons

                                </span>

                            </td>

                            <td>

                                {{ optional($store->creator)->username ?? 'N/A' }}

                            </td>

                            <td>

                                @if($couponCount >= 5)

                                    <span class="badge bg-success">
                                        Completed
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Incomplete
                                    </span>

                                @endif

                            </td>

                            <td>

                                <span class="badge bg-warning text-dark">

                                    Pending

                                </span>

                            </td>

                            <td>

                                {{ $store->created_at->format('d M Y') }}

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <a href="#"
                                       class="btn btn-sm btn-primary">

                                        Edit

                                    </a>

                                    <a href="#"
                                       class="btn btn-sm btn-success">

                                        Approve

                                    </a>

                                    <a href="#"
                                       class="btn btn-sm btn-danger">

                                        Reject

                                    </a>

                                </div>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<!-- DATATABLE -->

<script>

$(document).ready(function () {

    $('#pendingStoresTable').DataTable({

        responsive: true,

        pageLength: 10,

        ordering: true,

        searching: true,

        lengthMenu: [10, 25, 50, 100],

    });

});

</script>

@endpush