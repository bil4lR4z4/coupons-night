@extends('admin.master')

@section('title', 'All Users')

@section('content')
<div class="container-fluid">
    <x-breadcrumb parent-label="Products" parent-route="{{ route('admin.product.index') }}"
        current-page-title="{{ isset($edit) ? 'Update' : 'Add'}} Product" />
    <div class="card shadow-sm">

        <div class="card-body">
            <x-form method="post"
                action="{{ isset($edit) ? route('admin.product.update', $edit->id) : route('admin.product.store') }}">
                <div class="row row-cols-2">
                    <x-input type="text" name="product_name" value="{{ $edit->product_name ?? ''}}"
                        placeholder="Product Name" label="Product Name" />

                    <x-input type="text" name="product_title" value="{{ $edit->product_title ?? ''}}"
                        placeholder="Product Title" label="Product Title" />


                    <x-input type="text" name="old_price" id="old_price" value="{{ $edit->old_price ?? ''}}" placeholder="Old Price"
                        label="Old Price" />

                    <x-input type="text" name="current_price" id="current_price" value="{{ $edit->current_price ?? ''}}"
                        placeholder="Current Price" label="Current Price" />

                        <div class="col-12">
    <small id="priceError" class="text-danger"></small>
</div>

<!-- <div class="mb-3">

    <label class="form-label">
        Select Currency
    </label>

    <select class="form-select select2"
            name="currency_code"
            id="currencySelect">

        <option value="">
            Select Currency
        </option>

        @foreach($currencies as $currency)

            <option
                value="{{ $currency->currency_code }}"
                data-symbol="{{ $currency->currency_symbol }}"

                {{ old('currency_code', $edit->currency_code ?? '') == $currency->currency_code ? 'selected' : '' }}>

                {{ $currency->currency_name }}
                ({{ $currency->currency_code }})
                -
                {{ $currency->currency_symbol }}

            </option>

        @endforeach

    </select>

</div> -->

<input type="hidden"
       name="currency_symbol"
       id="currencySymbol"
       value="{{ old('currency_symbol', $edit->currency_symbol ?? '') }}">
                    <div class="mb-3 col-12">
                        <label for="detail" class="form-label">Product Details</label>
                        <textarea class="form-control" name="detail" id="detail"
                            rows="3">{{ old('detail', $edit->detail ?? '')}}</textarea>
                    </div>

                    <x-input type="text" name="url" value="{{ $edit->url ?? ''}}" placeholder="https://example.com"
                        label="Product URL" />

                    <div class="mb-3">
                        <label for="store_id" class="form-label">Select Store</label>
                        <select class="form-select select2" name="store_id">
                            <option value="">Select Store</option>
                            @foreach ($stores as $store)
                            <option value="{{ $store->id }}"
                                {{ old('store_id', $edit->store_id ?? '') == $store->id ? 'selected' : ''}}>
                                {{ $store->name }}</option>
                            @endforeach
                        </select>
                        @error('store_id')
                        <span class="text-danger">select store</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="event_id" class="form-label">Select Event</label>
                        <select class="form-select select2" name="event_id">
                            <option value="">Select Event</option>
                            @foreach ($events as $event)
                            <option value="{{ $event->id }}"
                                {{ old('event_id', $edit->event_id ?? '') == $event->id ? 'selected' : ''}}>
                                {{ $event->name }}</option>
                            @endforeach
                        </select>
                        @error('event_id')
                        <span class="text-danger">select event</span>
                        @enderror
                    </div>

                    <!-- <div class="mb-3">
                        <label for="category_id" class="form-label">Select Category</label>
                        <select class="form-select select2" name="category_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $edit->category_id ?? '') == $category->id ? 'selected' : ''}}>
                                {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">select category</span>
                        @enderror
                    </div> -->

                    <x-input type="file" name="image" label="Product Image (400 x 300)" wrapperClass="col-6" />
                    @if(!empty($edit->image))
                    <div>
                        <div class="ratio ratio-4x3" style="width:200px">
                            <img src="{{asset('uploads/products/' . $edit->image)}}" alt=""
                                class="img-thumbnail object-fit-cover">
                        </div>
                    </div>
                    @endif
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-success">{{ isset($edit) ? 'Update' : 'Save'}}
                            Product</button>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection

@push('scripts')



<script>
$(document).ready(function () {

    $('#currencySelect').change(function () {
        let symbol = $(this).find(':selected').data('symbol');
        $('#currencySymbol').val(symbol);
    });

    $('#currencySelect').trigger('change');

    function validatePrices() {

        let oldPriceText = $('#old_price').val();
        let currentPriceText = $('#current_price').val();

        // Text se numeric value extract karo
        let oldPrice = parseFloat(oldPriceText.replace(/[^0-9.]/g, ''));
        let currentPrice = parseFloat(currentPriceText.replace(/[^0-9.]/g, ''));

        $('#priceError').text('');

        if (!isNaN(oldPrice) && !isNaN(currentPrice)) {

            if (currentPrice > oldPrice) {

                $('#priceError').text(
                    'Current Price should be less than Old Price.'
                );

            }

        }

    }

    $('#old_price, #current_price').on('input', function () {
        validatePrices();
    });

});
</script>

@endpush
