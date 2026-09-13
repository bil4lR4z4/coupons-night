@extends('admin.master')

@section('title', 'Add Coupon')

@section('content')
<div class="container-fluid">
        <x-breadcrumb 
    parent-label="Coupons"
    :parent-route="route('admin.coupons.index')"
    current-page-title="Add Coupons"
/>
    <div class="card shadow-sm">
        <!-- <div class="card-header bg-danger text-white text-center">
            <h4 class="mb-0">Add New Coupon</h4>
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

            <form action="{{ route('admin.coupons.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <!-- Coupon Name -->

                    <div class="col-md-4">
                        <label class="form-label">Coupon Name</label>

                        <input type="text" name="name" class="form-control @error('name') border-danger @enderror" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Coupon Image Text -->

                    <div class="col-md-4">
                        <label class="form-label">Coupon Image Text</label>

                        <div class="row g-2">

                            <div class="col-4">
                                <input type="text" name="coupon_image_line_1" class="form-control" placeholder="20%"
                                    value="{{ old('coupon_image_line_1') }}">
                            </div>

                            <div class="col-4">
                                <input type="text" name="coupon_image_line_2" class="form-control" placeholder="Off"
                                    value="{{ old('coupon_image_line_2') }}">
                            </div>

                            <div class="col-4">
                                <input type="text" name="coupon_image_line_3" id="coupon_image_line_3"
                                    class="form-control" placeholder="Code"
                                    value="{{ old('coupon_image_line_3', 'Code') }}">
                            </div>

                        </div>
                    </div>

                    <!-- Exclusive -->

                    <div class="col-md-4">
                        <label class="form-label">Exclusive</label>
                        <label for="is_exclusive" class="form-check-label border w-100 px-2 pt-1 pb-2 rounded-2">
                            <input class="form-check-input" type="checkbox" name="is_exclusive" id="is_exclusive"
                                {{ old('is_exclusive') ? 'checked' : '' }}> Is Exclusive
                        </label>
                    </div>

                    <!-- Coupon Detail -->

                    <div class="col-md-4">
                        <label class="form-label">Coupon Detail</label>

                        <textarea name="detail" class="form-control" rows="3">{{ old('detail') }}</textarea>
                    </div>

                    <!-- Coupon Code -->

                    <div class="col-md-4">

                        <label class="form-label">Coupon Code</label>

                        <div class="d-flex gap-2">

                            <div>
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control"
                                    value="{{ old('coupon_code') }}">
                                @error('coupon_code')
                                    <span class="text-danger">coupon code is required</span>
                                @enderror
                            </div>
                            <div class="form-check d-flex align-items-center">

                                <input class="form-check-input mt-0" type="checkbox" name="is_no_code" id="is_no_code"
                                    {{ old('is_no_code') ? 'checked' : '' }}>

                                <label class="form-check-label ms-1" for="is_no_code">
                                    No
                                </label>

                            </div>

                        </div>

                        <div class="form-check mt-2">

                            <input class="form-check-input" type="checkbox" name="free_shipping" id="free_shipping"
                                {{ old('free_shipping') ? 'checked' : '' }}>

                            <label class="form-check-label" for="free_shipping">
                                Free Shipping Coupon
                            </label>

                        </div>

                    </div>

                    <!-- Date Type -->

                    <div class="col-md-4">

                        <label class="form-label">Date Type</label>

                        <select name="date_type" id="date_type" class="form-select">

                            <option value="text" selected>
                                Text
                            </option>

                            <option value="calendar">
                                Calendar
                            </option>

                        </select>

                    </div>

                    <!-- Date Text -->

                    <div class="col-md-4" id="date_text_wrapper">

                        <label class="form-label">Date Text</label>

                        <input type="text" name="date_text" class="form-control" value="{{ old('date_text', 'Soon') }}">

                    </div>

                    <!-- Start Date -->

                    <div class="col-md-4 calendar-fields">

                        <label class="form-label">Start Date</label>

                        <input type="date" name="start_date" class="form-control">

                    </div>

                    <!-- End Date -->

                    <div class="col-md-4 calendar-fields">

                        <label class="form-label">End Date</label>

                        <input type="date" name="end_date" class="form-control">

                    </div>

                    <!-- Mark As -->

                    <div class="col-md-12">

                        <label class="form-label d-block">Mark as</label>

                        <div class="d-flex flex-wrap gap-4">

                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" name="is_homepage" id="is_homepage">

                                <label class="form-check-label" for="is_homepage">
                                    Home page
                                </label>

                            </div>

                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" name="is_top_category"
                                    id="is_top_category">

                                <label class="form-check-label" for="is_top_category">
                                    Top category
                                </label>

                            </div>

                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" name="is_special_offer"
                                    id="is_special_offer">

                                <label class="form-check-label" for="is_special_offer">
                                    Special Offer
                                </label>

                            </div>

                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" name="is_verified" id="is_verified">

                                <label class="form-check-label" for="is_verified">
                                    Verify
                                </label>

                            </div>

                        </div>

                    </div>

                    <!-- Store -->

                    <div class="col-md-4">

                        <label class="form-label">Store Name</label>

                        <select name="store_id" class="form-select select2 @error('store_id') border-danger @enderror">

                            <option value="">Select Store</option>

                            @foreach($stores as $store)

                            <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>

                                {{ $store->name }}

                            </option>

                            @endforeach

                        </select>
                        @error('store_id')
                        <span class="text-danger">Store is required</span>
                        @enderror
                    </div>

                    <!-- HTML -->

                    <div class="col-md-4">

                        <label class="form-label">Html Code (url)</label>

                        <textarea name="html_code" class="form-control" rows="3">{{ old('html_code') }}</textarea>

                    </div>

                    <!-- Event -->

                    <div class="col-md-4">

                        <label class="form-label">Event</label>

                        <select name="event_id" class="form-select select2">

                            <option value="">Select Event</option>

                            @foreach($events as $event)

                            <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>

                                {{ $event->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Rank -->

                    <div class="col-md-4">

                        <label class="form-label">Rank</label>

                        <input type="number" name="rank" class="form-control" value="{{ old('rank', 0) }}">

                    </div>

                    <!-- Status -->

                    <div class="col-md-4">

                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">

                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>

                        </select>

                    </div>

                </div>

                <div class="mt-4 text-center">

                    <button type="submit" class="btn btn-warning">
                        Add Coupon
                    </button>

                    <button type="reset" class="btn btn-secondary">
                        Reset Form
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')



<script>

$(document).ready(function() {

    // store previous coupon code
    let previousCouponCode = '';

    // =========================
    // DATE TYPE TOGGLE
    // =========================

    function toggleDateFields() {

        let type = $('#date_type').val();

        if (type === 'calendar') {

            $('.calendar-fields').show();
            $('#date_text_wrapper').hide();

        } else {

            $('.calendar-fields').hide();
            $('#date_text_wrapper').show();

        }
    }

    // =========================
    // COUPON TYPE TOGGLE
    // =========================

    function toggleCouponType() {

        if ($('#is_no_code').is(':checked')) {

            // save previous code
            previousCouponCode = $('#coupon_code').val();

            // clear field
            $('#coupon_code').val('');

            // readonly
            $('#coupon_code').prop('readonly', true);

            // image text
            $('#coupon_image_line_3').val('Offer');

        } else {

            // enable field
            $('#coupon_code').prop('readonly', false);

            // restore previous code
            $('#coupon_code').val(previousCouponCode);

            // image text
            $('#coupon_image_line_3').val('Code');
        }
    }

    // =========================
    // DEFAULT LOAD
    // =========================

    toggleDateFields();
    toggleCouponType();

    // =========================
    // DATE TYPE CHANGE
    // =========================

    $('#date_type').on('change', function() {
        toggleDateFields();
    });

    // =========================
    // NO CODE CHANGE
    // =========================

    $('#is_no_code').on('change', function() {
        toggleCouponType();
    });

    // =========================
    // COUPON CODE TYPING
    // =========================

    $('#coupon_code').on('keyup', function() {

        previousCouponCode = $(this).val();

        if (!$('#is_no_code').is(':checked')) {

            $('#coupon_image_line_3').val('Code');
        }
    });

});

</script>




@endpush