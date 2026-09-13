@extends('admin.master')

@section('title', 'View Events')

@section('content')
<div class="container-fluid">
        <x-breadcrumb current-page-title="All Events" />

    <div class="card shadow-sm">

        <div class="card-body">
            <div class="table-responsive">
                <table id="eventsTable" class="table table-bordered table-striped align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Url</th>
                            <th>Header</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $key => $event)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->slug }}</td>
                                <td>
                                    @if($event->show_in_header)
                                        <span class="badge bg-primary">Yes</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($event->status == 'enable')
                                        <span class="badge bg-success">Enable</span>
                                    @else
                                        <span class="badge bg-danger">Disable</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('admin.events.delete', $event->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this event?')">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No events found.</td>
                            </tr>
                        @endforelse
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
    $('#eventsTable').DataTable({
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        ordering: true,
        searching: true,
        responsive: true,
        autoWidth: false
    });
});
</script>
@endpush