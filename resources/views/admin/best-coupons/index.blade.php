@extends('admin.master')

@section('title', 'Best Coupon Codes')

@section('content')
<div class="container-fluid">
      <x-breadcrumb current-page-title="All Best Coupon" />
    <div class="card shadow-sm">
        <!-- <div class="card-header bg-danger text-white text-center">
            <h4 class="mb-0">Best Coupon Codes</h4>
        </div> -->

        <div class="card-body">
            <div class="table-responsive">
                <table id="bestCouponsTable" class="table table-bordered table-striped align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>S.No</th>
                            <th>Store</th>
                            <th>Title</th>
                            <th>HTML</th>
                            <th>Image</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bestCoupons as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->store?->name ?? '-' }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->html_link }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('public/uploads/best-coupons/' . $item->image) }}" width="90" height="90" class="rounded border" style="object-fit:cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.best-coupons.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('admin.best-coupons.delete', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this best coupon?')">Delete</a>
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
    $('#bestCouponsTable').DataTable({
        pageLength: 25,
        lengthMenu: [10, 25, 50, 100],
        ordering: true,
        searching: true,
        responsive: true,
        autoWidth: false,
        language: {
            emptyTable: "No best coupons found."
        }
    });
});
</script>
@endpush