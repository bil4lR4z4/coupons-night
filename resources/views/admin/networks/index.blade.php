@extends('admin.master')

@section('title', 'View Networks')

@section('content')
<div class="container-fluid">
    <x-breadcrumb current-page-title="Networks" />
    <div class="card shadow-sm">

        <div class="card-body">
            <div class="table-responsive">
                <table id="networksTable" class="table table-bordered table-striped align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Network Name</th>
                            <th>Slug</th>
                            <th>Network Color</th>
                            <th>Network Status</th>
                            <th>Date</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($networks as $key => $network)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $network->name }}</td>
                            <td>{{ $network->slug }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span
                                        style="display:inline-block;width:40px;height:24px;background:{{ $network->color }};border-radius:6px;border:1px solid #ccc;"></span>
                                    <span>{{ $network->color }}</span>
                                </div>
                            </td>
                            <td>
                                @if($network->status == 'enable')
                                <span class="badge bg-success">Enable</span>
                                @else
                                <span class="badge bg-danger">Disable</span>
                                @endif
                            </td>
                            <td>{{ $network->created_at->format('M j, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.networks.details', $network->id) }}"
                                    class="btn btn-sm btn-info">
                                    View Detail
                                </a>

                                <a href="{{ route('admin.networks.edit', $network->id) }}"
                                    class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <a href="{{ route('admin.networks.delete', $network->id) }}"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Delete this network?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No networks found.</td>
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
$(document).ready(function() {
    $('#networksTable').DataTable({
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        ordering: true,
        searching: true,
        responsive: true,
        autoWidth: false,
        language: {
            search: "Search Networks:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ networks",
            paginate: {
                previous: "Prev",
                next: "Next"
            }
        }
    });
});
</script>
@endpush