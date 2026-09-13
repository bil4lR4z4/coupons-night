@extends('admin.master')



@section('title', 'All Users')



@section('content')

<div class="container-fluid">

    <x-breadcrumb current-page-title="All Products" />
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">

                <table id="productTable" class="table table-bordered table-striped align-middle w-100">

                    <thead class="table-dark">

                        <tr>

                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

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

    $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.product.index') }}",
        columns: [
            { data: 'image', orderable: false, searchable: false },
            { data: 'product_name' },
            { data: 'price', orderable: false, searchable: false },
            { data: 'date', orderable: false, searchable: false },
            { data: 'username' },
            { data: 'action', orderable: false, searchable: false },
        ]
    });

});
</script>

@endpush