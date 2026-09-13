@extends('admin.master')

@section('title', 'Add Best Coupon')

@section('content')
<div class="container-fluid">
      <x-breadcrumb parent-label="Best Coupon" 
        :parent-route="route('admin.best-coupons.index')"
        current-page-title="Add Best Coupon" />
    <div class="card shadow-sm">
        <!-- <div class="card-header bg-danger text-white text-center">
            <h4 class="mb-0">Add Best Coupon Code</h4>
        </div> -->

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.best-coupons.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Select Store</label>
                        <select name="store_id" class="form-select select2">
                            <option value="">Select Store</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                    {{ $store->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Best Coupon Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Best Coupon HTML Link</label>
                        <input type="text" name="html_link" class="form-control" value="{{ old('html_link') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Image (400 x 300)</label>
                        <input type="file" name="image" class="form-control" id="bestCouponImageInput" accept="image/*">
                        <div class="mt-2">
                            <img id="bestCouponImagePreview" class="img-thumbnail" style="max-width: 140px; display:none;">
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-warning">Add Best Coupon</button>
                    <button type="reset" class="btn btn-secondary">Reset Form</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('bestCouponImageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('bestCouponImagePreview');

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>
@endpush