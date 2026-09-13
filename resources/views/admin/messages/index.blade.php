@extends('admin.master')



@section('title', 'All Messages')



@section('content')

<div class="container-fluid">

    <x-breadcrumb current-page-title="All Messages" />
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">

                <table id="productTable" class="table table-bordered table-striped align-middle w-100">

                    <thead class="table-dark">

                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
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
        ajax: "{{ route('admin.messages.ajax') }}",
        columns: [
            { data: 'name', orderable: false, searchable: false },
            { data: 'email' },
            { data: 'subject', orderable: false, searchable: false },
            { data: 'message', orderable: false, searchable: false },
            { data: 'date' },
            { data: 'action', orderable: false, searchable: false },
        ]
    });

});
</script>

@endpush