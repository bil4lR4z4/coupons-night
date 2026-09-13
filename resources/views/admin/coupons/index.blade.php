@extends('admin.master')

@section('title', 'View Coupons')

@section('content')
<div class="container-fluid">
     <x-breadcrumb current-page-title="All Coupons" />
    <div class="card shadow-sm">
        <!-- <div class="card-header bg-danger text-white text-center">
            <h4 class="mb-0">View Coupons</h4>
        </div> -->

        <div class="card-body">

            <div class="alert alert-info">
                Drag & Drop rows to change coupon order.
            </div>

            <div class="mb-3" style="max-width: 420px;">
                <input type="text" id="couponStoreFilter" class="form-control" placeholder="Type Store Name">
            </div>

            <div class="table-responsive">
                <table id="couponsTable" class="table table-bordered table-striped align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th width="60">Move</th>
                            <th>Sr#</th>
                            <th>Store Name</th>
                            <th>Coupon Name</th>
                            <th>Coupon Code</th>
                            <th>Rank</th>
                            <th>Status</th>
                            <th>By</th>
                            <th>Manage</th>
                        </tr>
                    </thead>

                    <tbody id="sortableCoupons">

                        @forelse($coupons as $key => $coupon)

                        <tr data-id="{{ $coupon->id }}">

                            <td class="text-center" style="cursor: grab;">
                                ☰
                            </td>

                            <td>{{ $key + 1 }}</td>

                            <td>
                                {{ $coupon->store?->name ?? '-' }}
                            </td>

                            <td>
                                {{ $coupon->name }}
                            </td>

                            <td>
                                {{ $coupon->coupon_code }}
                            </td>
                            <td>
                                {{ $coupon->rank }}
                            </td>

                            <td>
                                <form action="{{ route('admin.coupons.status', $coupon->id) }}" method="POST">
                                    @csrf

                                    <select name="status" class="form-select form-select-sm"
                                        onchange="this.form.submit()">

                                        <option value="enable" {{ $coupon->status == 'enable' ? 'selected' : '' }}>
                                            Enable
                                        </option>

                                        <option value="disable" {{ $coupon->status == 'disable' ? 'selected' : '' }}>
                                            Disable
                                        </option>

                                    </select>
                                </form>
                            </td>

                            <td>
                                {{ $coupon->creator->username ?? $coupon->creator->name ?? 'N/A' }}
                            </td>

                            <td>
                                <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <a href="{{ route('admin.coupons.delete', $coupon->id) }}" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Remove this coupon?')">
                                    Remove
                                </a>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="8" class="text-center">
                                No coupons found.
                            </td>
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

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
$(document).ready(function() {

    let table = $('#couponsTable').DataTable({
        pageLength: 25,
        lengthMenu: [10, 25, 50, 100],
        ordering: false,
        searching: true,
        responsive: true,
        autoWidth: false
    });

    $('#couponStoreFilter').on('keyup', function() {
        table.column(2).search(this.value).draw();
    });

    new Sortable(document.getElementById('sortableCoupons'), {

        animation: 150,

        onEnd: function() {

            let ids = [];

            $('#sortableCoupons tr').each(function() {
                ids.push($(this).data('id'));
            });

            $.ajax({
                url: "{{ route('admin.coupons.sort') }}",
                type: "POST",

                data: {
                    ids: ids,
                    _token: "{{ csrf_token() }}"
                },

                success: function(response) {

                    if (response.success) {
                        console.log('Sorting Updated');
                    }

                }
            });
        }
    });
});
</script>

@endpush