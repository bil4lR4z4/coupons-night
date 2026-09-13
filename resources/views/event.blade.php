@extends('layouts.app')

@section('title', $events->title )
@section('meta_description', $events->meta_description)
@section('content')

<div class="text-white py-5 site-banner mb-bottom px-20">
    <div class="container ">
        <div class="row g-4 flex-column flex-lg-row align-items-start">

            <div class="col-auto mb-2 mb-lg-0 ">
                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center overflow-hidden"
                     style="width:130px;height:130px;">
                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-center fw-bold"
                         style="">
                      <img src="{{ asset('uploads/events/' . $events->icon) }}" alt="">
                    </div>
                </div>
            </div>

            <div class="col">
                <h1 class="fw-bold display-6 mb-3">
                    {{ $events->name }}
                </h1>

                <p class="small lh-lg mb-0 text-white-50" style="text-align:justify;">
                   {{ $events->full_description }}
                </p>
            </div>

        </div>
    </div>
</div>
<div class="container px-20 mb-bottom">
    <h1 class="fs-30  mb-4">Today's Trending Coupons</h1>
    <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1 g-4 mb-4">

        @foreach ($eventsCoupons as $coupon)
            <div class="">
                <div class="card border-0 rounded-3">
                    <div class="card-body d-flex flex-column gap-3 p-4">
                        <img src="{{ asset('uploads/stores/' . $coupon->store->logo ?? '') }}" alt="" class="border rounded-3 border-5"
                            style="width:48px; height:48px">
                        <div class="">
                            <span class="verify-badge"><img
                                        src="{{ asset('images/icons/check-verify-second.svg') }}" alt=""></span>
                            <h5 class="fw-semibold mt-2 mb-1">{{ $coupon->coupon_image_line_1 ?? ''  }}{{ $coupon->coupon_image_line_2 ?? ''  }}{{ $coupon->coupon_image_line_3 ?? ''  }}</h5>
                            <p class="mb-0 smaller">{{$coupon->name ?? ''}}</p>
                        </div>
                            <div>
                            <button class="btn px-3 custom-btn dealbutton rounded-pill get-code-btn"
                                  class="btn px-3 custom-btn rounded-pill get-code-btn"
   data-name="{{ $coupon->name ?? '' }}"
   data-image="{{ asset('uploads/stores/' . ($coupon->store->logo ?? '')) }}"
   data-code="{{ $coupon->coupon_code ?? '' }}"
   data-type="{{ $coupon->is_no_code ? 'deal' : 'code' }}"
   data-link="{{ $store->store_url ?? '' }}">
    {{ $coupon->is_no_code ? 'Get Deal' : 'Get Code' }}
    <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                        <!-- <a href="#" 
                        data-name="{{ $coupon->name ?? '' }}"
                            data-image="{{ asset('uploads/stores/' . $coupon->store->logo ?? '') }}"
                            data-link="{{ $coupon->store->store_url ?? '' }}" data-type="deal" data-code=""
                        class="btn px-4 custom-btn rounded-pill get-code-btn">Get Deal <i class="fa-solid fa-arrow-right ms-2 "></i></a> -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
    {{ $eventsCoupons->links('pagination::bootstrap-5') }}
</div>
</div>

@endsection