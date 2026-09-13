@extends('layouts.app')

@section('title', 'Privacy Policy – CouponNight')
@section('meta_description', 'Read CouponNight’s privacy policy to understand how we collect, use, and protect your personal information.')

@section('content')

<style>

.underline-accent {
    width: 35px;
    height: 3px;

    border-radius: 2px;
}

.info-box {
    border-left: 4px solid #000000;
    background: #eef4ff;
}
.info-box p{
    text-align: justify;
}
.privacy-content p{
     text-align: justify;
}
</style>

<div class="site-header   text-white text-center py-5 mb-bottom">
    <div class="container">
        <p class="small mb-1">Coupon Night</p>
        <h1 class="fw-bold mb-3">Privacy Policy</h1>
        <p class="mb-0 mx-auto" style="max-width:500px;">
            We respect your privacy. Learn how we collect, use, and protect your personal information when you use Coupon Night.
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

            <div class="p-3 rounded mb-4 info-box">
                <p class="mb-0 small text-dark">
                    🔒 Coupon Night is committed to protecting your privacy. We do not sell, rent, or trade your personal information to any third parties.
                </p>
            </div>

            @if(isset($sections) && $sections->count() > 0)
                @foreach($sections as $section)
                    <div class="card shadow-sm border mb-4 card-custom">
                        <div class="card-body p-4">
                            <h5 class="fw-bold">{{ $section->title }}</h5>
                            <div class="underline-accent site-header   mb-3"></div>

                            <div class="privacy-content">
                                {!! $section->description !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info text-center">
                    No Privacy Policy Content Found
                </div>
            @endif

        </div>
    </div>
</div>

@endsection