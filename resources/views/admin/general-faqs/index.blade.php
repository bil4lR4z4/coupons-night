@extends('admin.master')

@section('title', 'View General FAQs')

@section('content')
<div class="container-fluid">
    <x-breadcrumb current-page-title="All FAQs" />

    <div class="card shadow-sm">

        <div class="card-body">
            <div class="table-responsive">
                <table id="generalFaqsTable" class="table table-bordered table-striped align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Sort</th>
                            <th>Status</th>
                            <th>By</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($generalFaqs as $key => $faq)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $faq->question }}</td>
                                <td>{{ $faq->sort_order }}</td>
                                <td>
                                    <form action="{{ route('admin.general-faqs.status', $faq->id) }}" method="POST">
                                        @csrf
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="enable" {{ $faq->status == 'enable' ? 'selected' : '' }}>Enable</option>
                                            <option value="disable" {{ $faq->status == 'disable' ? 'selected' : '' }}>Disable</option>
                                        </select>
                                    </form>
                                </td>
                                <td>{{ $faq->creator->username ?? $faq->creator->name ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.general-faqs.edit', $faq->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('admin.general-faqs.delete', $faq->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this FAQ?')">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No general FAQs found.</td>
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
    $('#generalFaqsTable').DataTable({
        pageLength: 25,
        lengthMenu: [10, 25, 50, 100],
        ordering: true,
        searching: true,
        responsive: true,
        autoWidth: false
    });
});
</script>
@endpush