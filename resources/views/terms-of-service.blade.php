@extends('layouts.app')

@section('title', 'Terms of Service – CouponNight')
@section('meta_description', 'Read the Terms of Service for using CouponNight, including coupon usage policies, website terms, and platform guidelines.')

@section('content')

<style>


.underline-accent {
    width: 35px;
    height: 3px;
    border-radius: 2px;
}

.terms-content p{
    text-align: justify;
}
</style>

<div class="site-header text-white text-center py-5 mb-bottom">
    <div class="container">
        <p class="mb-1 small">Coupon Night</p>
        <h1 class="fw-bold">Terms of Service</h1>
    </div>
</div>

<div class="container mb-bottom px-20">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12">

            @if(isset($sections) && $sections->count() > 0)
                @foreach($sections as $section)
                    <div class="card shadow-sm border mb-4 rounded-3">
                        <div class="card-body p-4">
                            <h5 class="fw-bold">{{ $section->title }}</h5>
                            <div class="underline-accent site-header  mb-3"></div>

                            <div class="terms-content" >
                                {!! $section->description !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info text-center">
                    No Terms Content Found
                </div>
            @endif

        </div>
    </div>
</div>

@endsection