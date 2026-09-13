@extends('admin.master')

@section('title', 'Store Completion Report')

@section('content')

<div class="container-fluid">

    <!-- PAGE HEADER -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Pending Stores Report
            </h2>

            <p class="text-muted mb-0">
                Store Completion & QA Monitoring
            </p>

        </div>

    </div>

    <!-- TOP CARDS -->

    <div class="row g-4 mb-4">

        <!-- PENDING -->

        <div class="col-lg-4 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-2 fw-semibold">
                                Pending Stores
                            </p>

                            <h2 class="fw-bold text-warning mb-0">

                                {{ $pendingStores }}

                            </h2>

                        </div>

                        <div
                            class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                            style="width:65px;height:65px;"
                        >

                            <i class="fa fa-clock text-warning fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- PUBLISHED -->

        <div class="col-lg-4 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-2 fw-semibold">
                                Published Stores
                            </p>

                            <h2 class="fw-bold text-success mb-0">

                                {{ $completedStores }}

                            </h2>

                        </div>

                        <div
                            class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                            style="width:65px;height:65px;"
                        >

                            <i class="fa fa-check-circle text-success fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- COUPONS -->

        <div class="col-lg-4 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-2 fw-semibold">
                                Total Coupons
                            </p>

                            <h2 class="fw-bold text-primary mb-0">

                                {{ $totalCoupons }}

                            </h2>

                        </div>

                        <div
                            class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                            style="width:65px;height:65px;"
                        >

                            <i class="fa fa-ticket text-primary fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE CARD -->

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table
                    class="table table-hover align-middle"
                    id="completionTable"
                >

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Store</th>

                            <th>Coupons / Deals</th>

                            <th>Products</th>

                            <th>Store Info</th>

                            <th>Final Status</th>

                            <!-- <th>Publish Status</th> -->

                            <th>Created By</th>

                            <th width="120">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($stores as $store)
@php

    $couponDealCount =
        $store->coupons->count();
    $productCount =
        $store->products->count();
    $couponCheck =
        $couponDealCount >= 5;
   $productCheck =
        $productCount >= 1;
   $storeInfoCheck =
        !empty($store->about);
   $readyForPublish =
        $couponCheck;

@endphp


                        <tr>

                            <!-- ID -->

                            <td class="fw-semibold">

                                {{ $loop->iteration }}

                            </td>

                            <!-- STORE -->

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    @if($store->logo)

                                        <img
                                            src="{{ asset('uploads/stores/'.$store->logo) }}"
                                            width="55"
                                            height="55"
                                            class="rounded shadow-sm border"
                                            style="object-fit:cover;"
                                        >

                                    @endif

                                    <div>

                                        <h6 class="mb-1 fw-bold">

                                            {{ $store->name }}
                                            <br>
                                           <a href="{{ $store->store_url }}" class="text-decoration-none" target="_blank">{{ $store->store_url }}</a> 

                                        </h6>

                                        <small class="text-muted">

                                            {{ $store->website }}

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <!-- COUPONS -->

                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <div class="form-check">

                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            {{ $couponCheck ? 'checked' : '' }}
                                            disabled
                                        >

                                    </div>

                                    <span class="fw-semibold">

                                        {{ $couponDealCount }}/5

                                    </span>

                                </div>

                            </td>

                            <!-- PRODUCTS -->

                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <div class="form-check">

                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            {{ $productCheck ? 'checked' : '' }}
                                            disabled
                                        >

                                    </div>

                                    <span class="fw-semibold">

                                        {{ $productCount }}

                                    </span>

                                </div>

                            </td>

                            <!-- STORE INFO -->

                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <div class="form-check">

                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            {{ $storeInfoCheck ? 'checked' : '' }}
                                            disabled
                                        >

                                    </div>

                                    <span class="fw-semibold">

                                        Completed

                                    </span>

                                </div>

                            </td>

                            <!-- FINAL STATUS -->

                            <td>

                                @if($readyForPublish)

                                    <span class="badge bg-success px-3 py-2">

                                        Ready

                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark px-3 py-2">

                                        Pending

                                    </span>

                                @endif

                            </td>

                            <!-- CREATED BY -->

                            <td>

                                <span class="fw-semibold">

                                    {{ optional($store->creator)->username ?? 'N/A' }}

                                </span>

                            </td>

                            <!-- ACTION -->

                            <td>

                                <a href="{{ url('admin/stores/edit/'.$store->id) }}"  class="btn btn-sm btn-primary" >
                                    <i class="fa fa-edit me-1"></i>Edit</a>

                                 <a href="{{ route('admin.stores.delete', $store->id) }}" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this store?')">Delete</a>

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

<script>

$(document).ready(function () {

    $('#completionTable').DataTable({

        responsive: true,

        pageLength: 10,

        ordering: true,

        searching: true,

        lengthMenu: [10, 25, 50, 100],

    });

});

</script>

@endpush