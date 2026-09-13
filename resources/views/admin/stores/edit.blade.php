@extends('admin.master')

@section('title', 'Edit Store')

@section('content')
<div class="container-fluid">
    <x-breadcrumb parent-label="Stores" :parent-route="route('admin.stores.index')" current-page-title="Edit Stores" />
    <div class="card shadow-sm">

        <!-- <div class="card-header bg-danger text-white text-center">
            <h4 class="mb-0">Update Store</h4>
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
            <!-- <div class="alert alert-info py-2">
                Added By: <strong>{{ $store->creator->username ?? 'N/A' }}</strong> |
                Last Updated By: <strong>{{ $store->updater->username ?? 'N/A' }}</strong> |
                Current Login: <strong>{{ auth()->user()->username ?? 'N/A' }}</strong>
            </div> -->
            <form action="{{ route('admin.stores.update', $store->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Store Name</label>
                        <input type="text" name="name" class="form-control @error('name') border-danger @enderror"
                            value="{{ old('name', $store->name) }}" id="name">
                        @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Secondary Name</label>
                        <select name="secondary_name" class="form-select select2">
                            <option value="">Select Type</option>
                            <option value="Coupon Codes"
                                {{ old('secondary_name', $store->secondary_name ?? '') == 'Coupon Codes' ? 'selected' : '' }}>
                                Coupon Codes</option>
                            <option value="Discount Codes"
                                {{ old('secondary_name', $store->secondary_name ?? '') == 'Discount Codes' ? 'selected' : '' }}>
                                Discount Codes</option>
                            <option value="Discount"
                                {{ old('secondary_name', $store->secondary_name ?? '') == 'Discount' ? 'selected' : '' }}>
                                Discount</option>
                            <option value="Coupons"
                                {{ old('secondary_name', $store->secondary_name ?? '') == 'Coupons' ? 'selected' : '' }}>
                                Coupons</option>
                            <option value="Promo Codes"
                                {{ old('secondary_name', $store->secondary_name ?? '') == 'Promo Codes' ? 'selected' : '' }}>
                                Promo Codes</option>
                            <option value="Promotion Codes"
                                {{ old('secondary_name', $store->secondary_name ?? '') == 'Promotion Codes' ? 'selected' : '' }}>
                                Promotion Codes</option>
                            <option value="Promotional Codes"
                                {{ old('secondary_name', $store->secondary_name ?? '') == 'Promotional Codes' ? 'selected' : '' }}>
                                Promotional Codes</option>
                            <option value="Vouchers"
                                {{ old('secondary_name', $store->secondary_name ?? '') == 'Vouchers' ? 'selected' : '' }}>
                                Vouchers</option>
                            <option value="Voucher Codes"
                                {{ old('secondary_name', $store->secondary_name ?? '') == 'Voucher Codes' ? 'selected' : '' }}>
                                Voucher Codes</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Store Title</label>
                        <input type="text" name="store_title"
                            class="form-control @error('store_title') border-danger @enderror"
                            value="{{ old('store_title', $store->store_title) }}">
                        @error('store_title')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Heading H1</label>

                        <select id="heading_h1_template" class="form-select select2">
                            <option value="">Select H1</option>
                            <option value="Coupon Codes Deals & Discounts">Coupon Codes Deals & Discounts</option>
                            <option value="Promo Codes Offers & Discount Deals">Promo Codes Offers & Discount Deals
                            </option>
                            <option value="Hand Tested Coupons & Discount Codes">Hand Tested Coupons & Discount Codes
                            </option>
                        </select>

                        <input type="text" name="heading_h1" id="heading_h1" class="form-control mt-2"
                            value="{{ old('heading_h1', $store->heading_h1 ?? '') }}">

                        @error('heading_h1')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Heading H2</label>

                        <select id="heading_h2_template" class="form-select select2">
                            <option value="">Select H2</option>
                            <option value="Verified Coupons & Discount Codes">Verified Coupons & Discount Codes
                                {{ date('F Y') }}</option>
                            <option value="Latest Coupons & Discount Codes">Latest Coupons & Discount Codes
                                {{ date('F Y') }}</option>
                            <option value="Exclusive Promo Codes & Coupons">Exclusive Promo Codes & Coupons
                                {{ date('F Y') }}</option>
                        </select>

                        <input type="text" name="heading_h2" id="heading_h2" class="form-control mt-2"
                            value="{{ old('heading_h2', $store->heading_h2 ?? '') }}">

                        @error('heading_h2')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Domain</label>
                        <input type="text" name="domain" class="form-control"
                            value="{{ old('domain', $store->domain) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Store Url</label>
                        <input type="text" name="store_url"
                            class="form-control @error('store_url') border-danger @enderror"
                            value="{{ old('store_url', $store->store_url) }}">
                        @error('store_url')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Network</label>
                        <select name="network_id" class="form-select select2">
                            <option value="">Select Network</option>
                            @foreach($networks as $network)
                            <option value="{{ $network->id }}"
                                {{ old('network_id', $store->network_id) == $network->id ? 'selected' : '' }}>
                                {{ $network->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    @php
                    $selectedCategories = old(
                    'category_id',
                    $store->category_id ? explode(',', $store->category_id) : []
                    );
                    @endphp

                    <div class="col-md-3">
                        <label class="form-label">Select Category</label>

                        <select name="category_id[]" class="form-select select2" multiple>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                                {{ $category->parent_id ? '— ' . $category->name : $category->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('category_id')
                        <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="col-md-3">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control" id="logoInput" accept="image/*">
                        <div class="mt-2">
                            @if($store->logo)
                            <img id="logoPreview" src="{{ asset('public/uploads/stores/' . $store->logo) }}"
                                class="img-thumbnail" style="max-width: 100px;">
                            @else
                            <img id="logoPreview" class="img-thumbnail" style="max-width: 100px; display:none;">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Thumbnail Image</label>
                        <input type="file" name="thumbnail_image" class="form-control" id="thumbInput" accept="image/*">
                        <div class="mt-2">
                            @if($store->thumbnail_image)
                            <img id="thumbPreview" src="{{ asset('public/uploads/stores/' . $store->thumbnail_image) }}"
                                class="img-thumbnail" style="max-width: 140px;">
                            @else
                            <img id="thumbPreview" class="img-thumbnail" style="max-width: 140px; display:none;">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">About</label>
                        <textarea name="about" class="form-control" rows="3">{{ old('about',$store->about) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Impression Code</label>
                        <textarea name="impression_code" class="form-control"
                            rows="3">{{ old('impression_code', $store->impression_code) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">HTML Code</label>
                        <textarea name="html_code" class="form-control"
                            rows="3">{{ old('html_code', $store->html_code) }}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label d-block">Mark as</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_popular" id="is_popular"
                                {{ $store->is_popular ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_popular">Popular Store</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured"
                                {{ $store->is_featured ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Feature Store</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_category_featured"
                                id="is_category_featured" {{ $store->is_category_featured ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_category_featured">Category Feature Store</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-warning">Save Store</button>
                    <a href="{{ route('admin.stores.index') }}" class="btn btn-secondary">Back</a>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h5 class="mb-0">Store FAQs</h5>
              
                </div>
                    <small class="text-muted d-block mb-3">
                        <strong>Note:</strong> Use <code>{store_name}</code> in FAQ questions or answers to display the
                        store name dynamically on the frontend.
                        Example: "Does {store_name} offer free shipping?"
                    </small>
                <div id="faqWrapper">
                    @forelse($store->faqs as $faq)
                    <div class="row g-3 faq-row mb-3">
                        <div class="col-md-5">
                            <label class="form-label">Question</label>
                            <input type="text" name="faq_question[]" class="form-control" value="{{ $faq->question }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Answer</label>
                            <textarea name="faq_answer[]" class="form-control editor">{{ $faq->answer }}</textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger removeFaqRow">X</button>
                        </div>
                    </div>
                    @empty
                    <div class="row g-3 faq-row mb-3">
                        <div class="col-md-5">
                            <label class="form-label">Question</label>
                            <input type="text" name="faq_question[]" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Answer</label>
                            <textarea name="faq_answer[]" class="form-control editor"></textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger removeFaqRow">X</button>
                        </div>
                    </div>
                    @endforelse

                </div>
                <button type="button" class="btn btn-sm btn-primary" id="addFaqRow">Add FAQ</button>
                <hr class="my-4">
                <h5>Replace URL System</h5>
                <div class="col-md-4">
                    <label class="form-label">Replace With Store</label>
                    <select name="replace_store_id" class="form-select select2">
                        <option value="">No Replace</option>
                        @foreach($stores as $replaceStore)
                        <option value="{{ $replaceStore->id }}"
                            {{ old('replace_store_id', $store->replace_store_id) == $replaceStore->id ? 'selected' : '' }}>
                            {{ $replaceStore->name }}
                        </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Agar ye select hoga to current store doosray selected store par redirect
                        hoga.</small>
                </div>
                <hr class="my-4">

                <h5 class="mb-3">SEO Settings</h5>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control"
                            value="{{ old('meta_title', $store->meta_title) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control"
                            value="{{ old('meta_keywords', $store->meta_keywords) }}">
                    </div>


                    <div class="col-md-12">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control"
                            rows="3">{{ old('meta_description', $store->meta_description) }}</textarea>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Store Profile Content</h5>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Store Description</label>
                        <textarea name="description"
                            class="form-control editor">{{ old('description', $store->description) }}</textarea>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Advanced Flags</h5>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_trending" id="is_trending"
                                {{ $store->is_trending ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_trending">Trending Store</label>
                        </div>

                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="is_top" id="is_top"
                                {{ $store->is_top ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_top">Top Store</label>
                        </div>
                    </div>
                </div>


                <hr class="my-4">
                <h5 class="mb-3">Additional Information</h5>

                @php
                $selectedPayments = $store->payment_methods ? explode(',', $store->payment_methods) : [];
                @endphp

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Website</label>
                        <input type="text" name="website" class="form-control"
                            value="{{ old('website', $store->website) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email', $store->email) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Phone No</label>
                        <input type="text" name="phone_no" class="form-control"
                            value="{{ old('phone_no', $store->phone_no) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control"
                            value="{{ old('address', $store->address) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Products Name</label>
                        <input type="text" name="products_name" class="form-control"
                            value="{{ old('products_name', $store->products_name) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Facebook URL</label>
                        <input type="text" name="facebook_url" class="form-control"
                            value="{{ old('facebook_url', $store->facebook_url) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">YouTube URL</label>
                        <input type="text" name="youtube_url" class="form-control"
                            value="{{ old('youtube_url', $store->youtube_url) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Google Plus URL</label>
                        <input type="text" name="google_plus_url" class="form-control"
                            value="{{ old('google_plus_url', $store->google_plus_url) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Twitter URL</label>
                        <input type="text" name="twitter_url" class="form-control"
                            value="{{ old('twitter_url', $store->twitter_url) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Pinterest URL</label>
                        <input type="text" name="pinterest_url" class="form-control"
                            value="{{ old('pinterest_url', $store->pinterest_url) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Wikipedia URL</label>
                        <input type="text" name="wikipedia_url" class="form-control"
                            value="{{ old('wikipedia_url', $store->wikipedia_url) }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">iPhone App</label>
                        <input type="text" name="iphone_app" class="form-control"
                            value="{{ old('iphone_app', $store->iphone_app) }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Android App</label>
                        <input type="text" name="android_app" class="form-control"
                            value="{{ old('android_app', $store->android_app) }}">
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="shipping" id="shipping"
                                {{ old('shipping', $store->shipping) ? 'checked' : '' }}>
                            <label class="form-check-label" for="shipping">Shipping Available</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label d-block">Payment Methods</label>

                        <div class="d-flex flex-wrap gap-3">
                            @foreach(['visa','master','american_express','maestro','paypal','jcb','amex','jmc','discover']
                            as $method)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="payment_methods[]"
                                    value="{{ $method }}" id="pm_{{ $method }}"
                                    {{ in_array($method, old('payment_methods', $selectedPayments)) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="pm_{{ $method }}">{{ ucwords(str_replace('_', ' ', $method)) }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Embed Code</label>
                        <textarea name="embed_code" class="form-control"
                            rows="3">{{ old('embed_code', $store->embed_code) }}</textarea>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);

    if (input) {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });
    }
}
previewImage('logoInput', 'logoPreview');
previewImage('thumbInput', 'thumbPreview');

document.getElementById('addFaqRow').addEventListener('click', function() {
    const wrapper = document.getElementById('faqWrapper');
    const uniqueId = Date.now();

    const html = `
        <div class="row g-3 faq-row mb-3">
            <div class="col-md-5">
                <label class="form-label">Question</label>
                <input type="text" name="faq_question[]" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Answer</label>
                <textarea name="faq_answer[]" class="form-control editor-dynamic" id="editor_${uniqueId}" rows="3"></textarea>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger removeFaqRow">X</button>
            </div>
        </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', html);

    if (typeof $ !== 'undefined' && $('#editor_' + uniqueId).length) {
        $('#editor_' + uniqueId).summernote({
            height: 80,
            placeholder: 'Write answer here...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview']]
            ]
        });
    }
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('removeFaqRow')) {
        const row = e.target.closest('.faq-row');
        if (row) row.remove();
    }
});

$(document).ready(function() {
    $('.editor').summernote({
        height: 80,
        placeholder: 'Write answer here...',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview']]
        ]
    });
});
console.log($('#name').val());
</script>
<script>
$(function() {

    $('#heading_h1_template').change(function() {

        let storeName = $('#name').val().trim();
        let template = $(this).val();

        console.log(storeName);
        console.log(template);

        $('#heading_h1').val(storeName + ' ' + template);
    });

    $('#heading_h2_template').change(function() {

        let storeName = $('#name').val().trim();
        let template = $(this).val();

        $('#heading_h2').val(
            storeName + ' ' + template + ' {{ date("F Y") }}'
        );
    });

});
</script>
@endpush