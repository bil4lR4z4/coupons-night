@extends('layouts.app')

@section('title', 'Disclaimer – CouponNight')
@section('meta_description', 'Read CouponNight’s disclaimer regarding coupon accuracy, third-party offers, affiliate relationships, and promotional content.')

@section('content')

<style>


.underline-accent {
    width: 35px;
    height: 3px;
    border-radius: 2px;
}

.warning-box {
    border-left: 4px solid #f59e0b;
    background: #fff8e1;
}




</style>

<div class="site-header text-white text-center py-5 mb-bottom">
    <div class="container">
        <p class="small mb-1">Coupon Night</p>
        <h1 class="fw-bold mb-3">Disclaimer</h1>
        <p class="mb-0 mx-auto" style="max-width:500px;">
            Please read this disclaimer carefully before using Coupon Night.
        </p>
    </div>
</div>

<div class="container mb-bottom px-20">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12">

            <p class="text-end text-muted small">
                Last updated:
                {{ isset($sections) && $sections->count() ? $sections->max('updated_at')->format('F Y') : 'N/A' }}
            </p>

            <div class="p-3 rounded mb-4 warning-box">
                <p class="mb-0 small text-dark">
                    ⚠️ Coupons may not always work. We try to verify but cannot guarantee accuracy.
                </p>
            </div>

            @if(isset($sections) && $sections->count() > 0)
                @foreach($sections as $section)
                    <div class="card shadow-sm border-0 mb-4 card-custom rounded-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold">{{ $section->title }}</h5>
                            <div class="underline-accent site-header   mb-3"></div>

                            <div class="disclaimer-content">
                                {!! $section->description !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info text-center">
                    No Disclaimer Content Found
                </div>
            @endif

        </div>
    </div>
</div>

@endsection