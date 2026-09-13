@extends('admin.master')



@section('title', 'All Users')



@section('content')

<div class="container-fluid">
    <x-breadcrumb current-page-title="All Activities" />

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">

                <table id="productTable" class="table table-bordered table-striped align-middle w-100">

                    <thead class="table-dark">

                        <tr>
                            <th>Action</th>
                            <th>Detail</th>
                            <th>Time</th>
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
        ajax: "{{ route('admin.user.activity.details', $id) }}",
        columns: [
            { data: 'action', orderable: false, searchable: false },
            { data: 'detail', orderable: false, searchable: false },
            { data: 'date', orderable: false, searchable: false },
        ]
    });

});
</script>

@endpush