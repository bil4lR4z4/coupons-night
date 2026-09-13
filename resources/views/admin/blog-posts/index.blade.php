@extends('admin.master')

@section('title', 'View Blog Posts')

@section('content')
<div class="container-fluid">
    <x-breadcrumb current-page-title="All Blog Posts" />

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="blogPostsTable" class="table table-bordered table-striped align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Featured</th>
                            <th>Hero</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($posts as $key => $post)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>
                                    @if($post->image)
                                        <img src="{{ asset($post->image) }}" width="70" height="45" style="object-fit:cover;" class="rounded">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>

                                <td>{{ $post->name }}</td>
                                <td>{{ $post->title }}</td>

                                <td>
                                    @forelse($post->categories as $category)
                                        <span class="badge bg-primary me-1 mb-1">{{ $category->name }}</span>
                                    @empty
                                        <span class="text-muted">No category</span>
                                    @endforelse
                                </td>

                                <td>
                                    @if($post->is_featured)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>

                                <td>
                                    @if($post->is_featured_article)
                                        <span class="badge bg-warning text-dark">Yes</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>

                                <td>
                                    @if($post->status == 'enable')
                                        <span class="badge bg-success">Enable</span>
                                    @else
                                        <span class="badge bg-danger">Disable</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.blog-posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('admin.blog-posts.delete', $post->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this post?')">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No blog posts found.</td>
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
    $('#blogPostsTable').DataTable({
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