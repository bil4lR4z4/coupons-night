@extends('layouts.app')

@section('title', 'CouponNight Sitemap – Browse All Coupons & Pages')
@section('meta_description', 'Browse all stores, coupon categories, blogs, events, and deal pages available on CouponNight in one place.')

@section('content')

<div class="site-header text-white text-center py-4 py-md-5 mb-bottom">
    <div class="container">
        <small class="d-block mb-1">Browse Coupons</small>
        <h2 class="fw-bold mb-0">Events</h2>
    </div>
</div>

<div class="container mb-bottom px-20">

    <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1 row-gap-4">
        @foreach($events as $event)
            <div class="">
                <div class="card rounded-4 overflow-hidden">
                    <img src="{{asset('uploads/events/'.$event->full_image ?? '')}}" alt="{{$event->name ?? ''}}" class="card-img-top event-img">
                    <div class="card-img-overlay bg-dark bg-opacity-50 text-light d-flex flex-column justify-content-between">
                        <div class="">
                            <span class="badge mb-2">Event</span>
                            <h2 class="fw-bolder text-light text-truncate">{{$event->name ?? ''}}</h2>
                            <p class="small text-opacity-75"> {{ \Illuminate\Support\Str::words($event->full_description ?? '', 20, '...') }}</p>
                        </div>
                        <div class="">
                            <a href="{{ route('event.page', $event->slug) }}" class="btn custom-btn flex-shrink-0">
                                Go To Event <i class="fa fa-arrow-right ms-1"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

<style>
    .event-img{
        height: clamp(260px, 40vw, 260px);
        width: 100%;
        object-fit: cover;
    }
</style>

</div>

@endsection