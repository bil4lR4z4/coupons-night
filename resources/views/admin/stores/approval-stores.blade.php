{{-- =========================================
APPROVAL STORES BLADE
resources/views/admin/stores/approval-stores.blade.php
========================================= --}}

@extends('admin.master')

@section('title', 'Approval Stores')

@section('content')

<div class="container-fluid">

    <!-- PAGE HEADER -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Admin Approval Stores
            </h2>

            <p class="text-muted mb-0">
                Review & Publish Stores
            </p>

        </div>

    </div>

    <!-- TABLE CARD -->

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table
                    class="table table-hover align-middle"
                    id="approvalTable"
                >

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Store</th>

                            <th>Coupons</th>

                            <th>Products</th>

                            <th>Created By</th>

                            <th>Status</th>

                            <th width="320">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($stores as $store)

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
                                            class="rounded border shadow-sm"
                                            style="object-fit:cover;"
                                        >

                                    @endif

                                    <div>

                                        <h6 class="mb-1 fw-bold">

                                            {{ $store->name }}

                                        </h6>

                                        <small class="text-muted">

                                            {{ $store->website }}

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <!-- COUPONS -->

                            <td>

                                <span class="badge bg-primary px-3 py-2">

                                    {{ $store->coupons->count() }} Coupons

                                </span>

                            </td>

                            <!-- PRODUCTS -->

                            <td>

                                <span class="badge bg-info px-3 py-2">

                                    {{ $store->products->count() }} Products

                                </span>

                            </td>

                            <!-- USER -->

                            <td>

                                {{ optional($store->creator)->username }}

                            </td>

                            <!-- STATUS -->

                            <td>

                                <span class="badge bg-warning text-dark px-3 py-2">

                                    Pending Review

                                </span>

                            </td>

                            <!-- ACTIONS -->

                            <td>

                                <div class="d-flex gap-2 flex-wrap">

                                    <!-- EDIT STORE -->

                                    <a
                                        href="{{ url('admin/stores/edit/'.$store->id) }}"
                                        class="btn btn-sm btn-primary"
                                    >

                                        <i class="fa fa-edit me-1"></i>

                                        Edit Store

                                    </a>

                                    <!-- REVIEW COUPONS -->

                                    <a
                                        href="{{ url('admin/coupons?store_id='.$store->id) }}"
                                        class="btn btn-sm btn-dark"
                                    >

                                        <i class="fa fa-ticket me-1"></i>

                                        Coupons

                                    </a>

                                    <!-- PUBLISH -->

                                    <form
                                        action="{{ route('admin.stores.publish.store',$store->id) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-success"
                                            onclick="return confirm('Publish this store?')"
                                        >

                                            <i class="fa fa-check me-1"></i>

                                            Publish

                                        </button>

                                    </form>

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


<script>

$(document).ready(function () {

    $('#approvalTable').DataTable({

        responsive: true,

        pageLength: 10,

        ordering: true,

        searching: true,

        lengthMenu: [10, 25, 50, 100],

    });

});

</script>

@endpush