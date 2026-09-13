@extends('admin.master')

@section('title', 'View Categories')

@section('content')
<div class="container-fluid">
    <x-breadcrumb current-page-title="All Categories" />

    <div class="card shadow-sm">

        <div class="card-body">
            <div class="table-responsive">
                <table id="categoriesTable" class="table table-bordered table-striped align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Parent</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Home</th>
                            <th>Image</th>
                            <th width="170">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $category->name }}

                                @if($category->is_sensitive)
                                <span class="badge bg-danger">Erotic</span>
                                @endif
                            </td>
                            <td>{{ $category->title ?? '-' }}</td>
                            <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                            <td>
                                @if($category->parent_id)
                                <span class="badge bg-info">Subcategory</span>
                                @else
                                <span class="badge bg-primary">Main Category</span>
                                @endif
                            </td>
                            <td>
                                @if($category->status == 'enable')
                                <span class="badge bg-success">Enable</span>
                                @else
                                <span class="badge bg-danger">Disable</span>
                                @endif
                            </td>
                            <td>
                                @if($category->mark_home)
                                <span class="badge bg-primary">Yes</span>
                                @else
                                <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                @if($category->image)
                                <img src="{{ asset('public/uploads/categories/' . $category->image) }}" width="55"
                                    height="55" class="rounded border" style="object-fit: cover;">
                                @else
                                <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('admin.categories.delete', $category->id) }}"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No categories found.</td>
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
    $('#categoriesTable').DataTable({
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        ordering: true,
        searching: true,
        responsive: true,
        autoWidth: false,
        language: {
            search: "Search Categories:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ categories",
            paginate: {
                previous: "Prev",
                next: "Next"
            }
        }
    });
});
</script>
@endpush