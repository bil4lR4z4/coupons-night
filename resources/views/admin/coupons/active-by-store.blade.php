@extends('admin.master')

@section('title', 'Active Coupons By Store')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white text-center">
            <h4 class="mb-0">View Active Coupons By Store</h4>
        </div>

        <div class="card-body">
            <div class="mb-4" style="max-width: 420px;">
                <input type="text" id="storeSearchInput" class="form-control" placeholder="Search...">
            </div>

            <div id="storeCouponsWrapper">
                @foreach($stores as $store)
                    @if($store->coupons->count())
                        <div class="store-coupon-block mb-5" data-store-name="{{ strtolower($store->name) }}">
                            <h5 class="mb-3">{{ $store->name }}</h5>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Sr</th>
                                            <th>Coupon Name</th>
                                            <th>Like</th>
                                            <th>Dislike</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($store->coupons as $index => $coupon)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $coupon->name }}</td>
                                                <td>
                                                    <form action="{{ route('admin.coupons.votes', $coupon->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                                                        @csrf
                                                        <input type="number" name="likes" class="form-control form-control-sm" value="{{ $coupon->vote->likes ?? 0 }}" min="0">
                                                        <input type="hidden" name="dislikes" value="{{ $coupon->vote->dislikes ?? 0 }}">
                                                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.coupons.votes', $coupon->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                                                        @csrf
                                                        <input type="hidden" name="likes" value="{{ $coupon->vote->likes ?? 0 }}">
                                                        <input type="number" name="dislikes" class="form-control form-control-sm" value="{{ $coupon->vote->dislikes ?? 0 }}" min="0">
                                                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('storeSearchInput').addEventListener('keyup', function () {
    let value = this.value.toLowerCase();
    let blocks = document.querySelectorAll('.store-coupon-block');

    blocks.forEach(function(block) {
        let storeName = block.getAttribute('data-store-name');
        block.style.display = storeName.includes(value) ? '' : 'none';
    });
});
</script>
@endpush