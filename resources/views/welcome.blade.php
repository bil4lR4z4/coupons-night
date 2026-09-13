@extends('layouts.app')

@section('title', 'CouponNight – Verified Coupons, Promo Codes & Online Deals')
@section('meta_description', 'Discover verified coupon codes, promo offers, and online shopping deals from popular
stores. Save more with updated discounts, exclusive offers, and daily deals at CouponNight.
')
@section('content')
<style>
.mb-bottom {
    margin-bottom: 90px;
}

.store-slider {
    overflow: hidden;
    width: 100%;
}

.store-track {
    display: flex;
    gap: 90px;
    width: max-content;
}

.store-item {
    flex-shrink: 0;
}

.product-title,
.coupon-title {
    min-height: 48px;
    line-height: 24px;

    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.upcoming-overlay {
    background: rgba(36, 16, 88, .28);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 16px;
}

/* Title */
.upcoming-title {
    color: #fff;
    font-size: 1.8rem;
    font-weight: 700;
    line-height: 1.1;
    margin-bottom: 8px;
}

/* Starts In */
.starts-in {
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 12px;
}

/* Timer */
.countdown-wrapper {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 15px;
}

.countdown-box {
    background: #fff;
    border-radius: 12px;
    width: 58px;
    padding: 8px 4px;
    text-align: center;
}

.countdown-value {
    font-size: 1.3rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
}

.countdown-box small {
    display: block;
    margin-top: 3px;
    font-size: .75rem;
    color: #000;
}

/* Button */
.upcoming-btn {
    padding: 10px 20px;
    font-size: .9rem;
    max-width: 100%;
}

/* Large screens */
@media (min-width: 1200px) {

    .countdown-wrapper {
        flex-wrap: nowrap;
    }

}

/* Laptop */
@media (max-width: 1199px) {

    .upcoming-title {
        font-size: 1.6rem;
    }

    .countdown-box {
        width: 55px;
    }

    .countdown-value {
        font-size: 1.2rem;
    }

}

/* Tablet */
@media (max-width: 991px) {

    .upcoming-title {
        font-size: 1.5rem;
    }

    .starts-in {
        font-size: .95rem;
        margin-bottom: 10px;
    }

    .countdown-box {
        width: 52px;
        padding: 7px 3px;
    }

    .countdown-value {
        font-size: 1.1rem;
    }

    .countdown-box small {
        font-size: .7rem;
    }

    .upcoming-btn {
        padding: 9px 18px;
        font-size: .85rem;
    }

}

/* Mobile */
@media (max-width: 576px) {

    .upcoming-overlay {
        padding: 12px;
    }

    .upcoming-title {
        font-size: 1.4rem;
        margin-bottom: 6px;
    }

    .starts-in {
        font-size: .9rem;
        margin-bottom: 8px;
    }

    .countdown-wrapper {
        gap: 6px;
        margin-bottom: 10px;
    }

    .countdown-box {
        width: 48px;
        padding: 6px 2px;
    }

    .countdown-value {
        font-size: 1rem;
    }

    .countdown-box small {
        font-size: .65rem;
    }

    .upcoming-btn {
        width: auto;
        max-width: 180px;
        padding: 8px 14px;
        font-size: .8rem;
    }
}

@media (max-width: 991px) {
    .mb-bottom {
        margin-bottom: 60px;
    }

    .card-img {
        height: 180px !important;
    }
}
</style>

@if($settings->count() > 0 && $settings->offer_checkbox == 'active')
<div class="modal fade" id="offerModel" tabindex="-1" aria-labelledby="offerModel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! $settings->offer_description ?? '' !!}

                @if($settings->offer_button != null)
                <div class="text-center">
                    <a href="{{ $settings->offer_button ?? '' }}" class="btn custom-btn rounded-pill mt-3">Shop Now<i
                            class="fa-solid fa-arrow-right ms-2 "></i></a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
<div class="container mt-3 px-20">
    <div class="row row-gap-4 mb-bottom">
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded-4">

                    @foreach($carousels as $key => $carousel)

                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                        <div class="position-relative">

                            <div class="ratio ratio-16x9">
                                <img src="{{ asset('uploads/slider-images/' . $carousel->image ?? '') }}"
                                    class="d-block w-100 object-fit-cover" loading="lazy" alt="...">
                            </div>

                            <!-- Overlay -->
                            @if($carousel->page_url != null || $carousel->title != null)
                            <div class="position-absolute top-0 start-0 w-100 h-100"
                                style="background: rgba(0,0,0,0.45); z-index:1;">
                            </div>
                            @endif
                            <div class="carousel-caption d-none d-md-block text-start top-25" style="z-index:2;">

                                <h1 class="fw-bold">
                                    {{ $carousel->title ?? '' }}
                                </h1>

                                @if($carousel->page_url != null)
                                <a href="{{ $carousel->page_url ?? '' }}" class="btn custom-btn rounded-pill mt-3">

                                    {{ $carousel->button_text ?? 'Shop Now' }}<i
                                        class="fa-solid fa-arrow-right ms-2 "></i>
                                </a>
                                @endif

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                <button class="carousel-control-prev mt-5 me-2 end-0 start-auto btn-theme rounded-circle" type="button"
                    data-bs-target="#carouselExampleCaptions" data-bs-slide="prev"
                    style="left:unset; display: flex; align-self: center; height: 38px; width: 38px;">

                    <i class="fa-solid fa-arrow-left"></i>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next mb-5 me-2 btn-theme rounded-circle" type="button"
                    data-bs-target="#carouselExampleCaptions" data-bs-slide="next"
                    style="display: flex; align-self: center; height: 38px; width: 38px;">

                    <i class="fa-solid fa-arrow-right"></i>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-12">

            <div class="card rounded-4 overflow-hidden h-100 position-relative">

                <img src="{{ asset('images/site/upcoming_events.png') }}" alt="" class="card-img h-100"
                    style="object-fit:cover">

                <div class="card-img-overlay upcoming-overlay">

                    <!-- Title -->
                    <h2 class="upcoming-title">
                        {{ $upcomingEvent->title ?? 'Upcoming Events' }}
                    </h2>

                    <!-- Starts In -->
                    <div class="starts-in">
                        Starts In
                    </div>

                    <!-- Countdown -->
                    <div class="countdown-wrapper">

                        <div class="countdown-box">
                            <div id="days" class="countdown-value">00</div>
                            <small>Days</small>
                        </div>

                        <div class="countdown-box">
                            <div id="hours" class="countdown-value">00</div>
                            <small>Hours</small>
                        </div>

                        <div class="countdown-box">
                            <div id="minutes" class="countdown-value">00</div>
                            <small>Min</small>
                        </div>

                        <div class="countdown-box">
                            <div id="seconds" class="countdown-value">00</div>
                            <small>Sec</small>
                        </div>

                    </div>

                    <!-- Button -->
                    <a href="{{ route('upcoming') }}" class="btn custom-btn rounded-pill upcoming-btn">
                        Upcoming Events
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>

                </div>

            </div>

        </div>
    </div>
    @if($deals->count() > 0)
    <div
        class="d-flex flex-lg-row flex-md-row flex-sm-row flex-column justify-content-between align-items-end  mb-lg-4 mb-md-3 mb-sm-3 mb-3">
        <div class="">
            <h1 class="fs-30">Top Trending Deals</h1>
            <p class="mb-0">Verified savings from the world's leading retailers</p>
        </div>
        <div class="">
            <!-- <a href="" class="text-decoration-none text-primary fw-semibold">View All <i
                    class="fa-solid fa-arrow-right"></i></a> -->
        </div>
    </div>
    <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-2 g-lg-4 g-md-4 g-sm-4 g-3 mb-bottom">
        @foreach($deals as $deal)
        <div class="">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body d-flex flex-column gap-3 p-4">
                    <div class="rounded-3 border border-5 ratio ratio-1x1" style="width:60px; height:60px">
                        <img src="{{ asset('uploads/stores/' . (optional($deal->store)->logo ?? 'default.png')) }}"
                            alt="" class="w-100 object-fit-cover">
                    </div>
                    <div class="">
                        <span class="verify-badge"><img src="{{ asset('images/icons/check-verify-second.svg') }}"
                                alt=""></span>
                        <h5 class="fw-semibold mt-2 mb-1">Up to {{$deal->coupon_image_line_1 ?? ''}}
                            {{$deal->coupon_image_line_2 ?? ''}}
                        </h5>
                        <p class="mb-0 smaller">{{$deal->name ?? ''}}</p>
                    </div>
                    <button class="btn px-2 custom-btn rounded-pill get-code-btn"
                        data-image="{{ asset('uploads/stores/' . ($deal->store->logo ?? '')) }}" data-code=""
                        data-name="{{ $deal->name ?? '' }}" data-type="deal"
                        data-link="{{ $deal->store->store_url ?? '' }}">
                        Get Deal<i class="fa-solid fa-arrow-right ms-2 "></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($popularStores->count() > 0)
    <h1 class="fs-30 mb-5 text-center fw-bold">
        Popular Stores
    </h1>

    <div class="store-slider mb-bottom">
        <div class="store-track">
            @foreach($popularStores as $popularStore)
            <div class="store-item">
                <a href="{{ route('store.show', $popularStore->slug ?? '') }}">
                    <img src="{{ asset('uploads/stores/' . $popularStore->logo) }}"
                        class="rounded-circle bg-white object-fit-cover" width="98" height="96">
                </a>
            </div>
            @endforeach

            {{-- Infinite loop ke liye dubara repeat --}}
            @foreach($popularStores as $popularStore)
            <div class="store-item">
                <a href="{{ route('store.show', $popularStore->slug ?? '') }}">
                    <img src="{{ asset('uploads/stores/' . $popularStore->logo) }}"
                        class="rounded-circle bg-white object-fit-cover" width="98" height="96">
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($coupons->count() > 0)
    <div class="mb-bottom">
        <h1 class="fs-30 mb-lg-4 mb-md-3 mb-sm-3 mb-3">
            Today's Trending Coupons
        </h1>

        <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-2 g-lg-4 g-md-4 g-sm-3 g-3">
            @foreach($coupons as $coupon)
            <div>
                <div class="card border-0 shadow-sm rounded-4">
                    <div
                        class="card-body d-flex flex-lg-row flex-md-column flex-sm-column flex-column gap-3 justify-content-between align-items-lg-center align-items-md-start align-items-sm-start align-items-start p-lg-4 p-md-4 p-3">
                        <div
                            class="d-flex flex-lg-row flex-md-row flex-sm-row flex-column gap-3 align-items-lg-center align-items-md-center align-items-sm-center align-items-start">
                            <a href="{{ $coupon->store->store_url ?? '#' }}" class="text-decoration-none text-dark">
                                <div class="ratio ratio-1x1" style="width:54px; height:54px">
                                    <img src="{{ asset('uploads/stores/' . ($coupon->store->logo ?? '')) }}"
                                        alt="{{ $coupon->store->name ?? '' }}" class="rounded object-fit-cover">
                                </div>
                            </a>

                            <div>

                                <h6 class="mb-1">
                                    {{ $coupon->name ?? '' }}
                                </h6>

                                <a href="{{ $coupon->store->store_url ?? '#' }}" class="text-decoration-none text-dark">
                                    <p class="smaller m-0">
                                        {{ $coupon->store->name ?? '' }}
                                        <img src="{{ asset('images/icons/check-verify-second.svg') }}" alt="Verified">
                                    </p>
                                </a>
                            </div>
                        </div>

                        <div>
                            <button class="btn px-3 custom-btn rounded-pill get-code-btn"
                                data-image="{{ asset('uploads/stores/' . ($coupon->store->logo ?? '')) }}"
                                data-code="{{ $coupon->coupon_code ?? '' }}" data-name="{{ $coupon->name ?? '' }}"
                                data-type="code" data-link="{{ $coupon->store->store_url ?? '' }}">
                                Get Code
                                <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="card rounded-top-0 rounded-bottom-4 rounded-end-4 border-0 shadow-sm mb-bottom">
        <div class="card-body p-lg-5 p-4">
            <div class="row row-gap-4">
                <div class="col-lg-7">
                    <div class="">
                        <video class="rounded-3 w-100" controls playsinline preload="metadata"
                            poster="{{ asset('images/video-thumb.jpg') }}">

                            <source src="{{ asset($settings->how_to_use_image) }}" type="video/mp4">

                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <div class="col-lg-5 d-flex align-items-center">
                    <div class="">
                        <h1 class="fw-bold mb-4">How to Use Coupons & Promo Codes</h1>
                        <p class="fs-18 mb-4">{{ $settings->how_to_use ?? '' }}</p>
                        <a href="{{ route('help') }}" class="btn custom-btn rounded-pill">Browse Guides<i
                                class="fa-solid fa-arrow-right ms-2 "></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-bottom">
        <div class="card-body p-lg-5 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Featured Stores</h3>
                <a href="{{ route('stores.page') }}" class="btn custom-btn rounded-pill">View All<i
                        class="fa-solid fa-arrow-right ms-2 "></i></a>
            </div>
            <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-2 g-2 mt-3">

                @foreach ($stores as $store)
                <div class="">
                    <a href="{{ route('store.show', $store->slug) }}"
                        class="text-decoration-none small text-secondary fw-medium">{{ $store->name }}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @if($categories->count() > 0)
    <div class="d-flex justify-content-between align-items-end mt-5 mb-4">
        <h1 class="fs-30 m-0">
            Popular Categories
        </h1>
        <a href="{{ route('categories.page') }}" class="btn custom-btn rounded-pill">View All Categories<i
                class="fa-solid fa-arrow-right ms-2 "></i></a>
    </div>
    <div class="row row-cols-lg-6 row-cols-md-4 row-cols-sm-3 row-cols-2 g-4 mb-bottom">

        @foreach ($categories as $category)
        <div class="">
            <div class="card h-100 border-0 rounded-4">
                <a href="{{ route('coupon_category.page', $category->slug) }}" class="text-decoration-none link">
                    <div class="card-body d-flex flex-column align-items-center text-center p-4">
                        @if (!empty($category->image) && file_exists(public_path('uploads/categories/' .
                        $category->image)))
                        <div class="ratio ratio-1x1 mb-3 rounded-3 overflow-hidden" style="width:60px; height:60px">
                            <img src="{{ asset('uploads/categories/'. $category->image) }}" alt=""
                                class="w-100 object-fit-cover">
                        </div>
                        @else
                        <div class="ratio ratio-1x1 mb-3 rounded-3 border d-flex align-items-center justify-content-center bg-info-subtle fw-bold"
                            style="width:60px; height:60px; font-size:20px;">
                            {{ strtoupper(substr($category->name, 0, 2)) }}
                        </div>

                        @endif
                        <h6>{{ $category->name ?? '' }}</h6>
                    </div>
                </a>
            </div>
        </div>
        @endforeach

    </div>
    @endif

    <h1 class="fs-30 mb-lg-4 mb-md-3 mb-sm-3 mb-3">Shopping Guides & Articles</h1>
    <div class="row row-cols-lg-2 rowcols-md-2 row-cols-sm-1 row-cols-1 row-gap-4 mb-bottom">
        <x-frontend.artical />
        <div class="col-12 text-center w-100 mt-5">
            <a href="{{ route('blog') }}" class="btn custom-btn rounded-pill">View All Articals<i
                    class="fa-solid fa-arrow-right ms-2 "></i></a>
        </div>
    </div>

    @if($bestCoupons->count() > 0)
    <div class="swiper mySwiper mb-bottom">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <h1 class="fs-30 mb-0">Best Dropshipping Stores</h1>

            <div class="d-flex gap-2 align-items-center">
                <div class="swiper-button-prev position-static custom-swiper custom-swiper-prev"></div>
                <div class="swiper-button-next position-static custom-swiper custom-swiper-next"></div>
            </div>
        </div>

        <div class="swiper-wrapper">

            @foreach ($bestCoupons as $bestCoupon)
            <div class="swiper-slide">

                <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">

                    <a href="{{ $bestCoupon->html_link ?? '' }}" target="_blank">
                        <div class="ratio ratio-4x3">
                            <img src="{{ asset('uploads/best-coupons/' . ($bestCoupon->image ?? '')) }}"
                                class="card-img-top object-fit-cover" alt="">
                        </div>
                    </a>

                    <div class="card-body d-flex flex-column">

                        <div class="flex-grow-1">

                            <p class="coupon-title fs-18 fw-semibold mb-2 text-capitalize">
                                {{ $bestCoupon->title ?? '' }}
                            </p>

                            <p class="small text-danger-emphasis fw-light m-0 pb-2 text-capitalize">
                                {{ $bestCoupon->store->name ?? '' }}
                            </p>

                        </div>

                        <a href="{{ $bestCoupon->html_link ?? '' }}" class="btn custom-btn rounded-pill mt-auto"
                            target="_blank">
                            Shop Now
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>

                    </div>

                </div>

            </div>
            @endforeach

        </div>
    </div>
    @endif



    @if($products->count() > 0)

    <div class="swiper myProductSwiper mb-bottom">

        <div class="d-flex justify-content-between align-items-start mb-4">
            <h1 class="fs-30 mb-0">
                Best Deals from Trending Stores 2026
            </h1>

            <div class="d-flex gap-2 align-items-center">
                <div class="swiper-button-prev position-static custom-swiper product-swiper-prev"></div>
                <div class="swiper-button-next position-static custom-swiper product-swiper-next"></div>
            </div>
        </div>

        <div class="swiper-wrapper">

            @foreach ($products as $product)

            @php
            $oldPrice = (float) preg_replace('/[^0-9.]/', '', $product->old_price);
            $currentPrice = (float) preg_replace('/[^0-9.]/', '', $product->current_price);

            $discount = 0;

            if ($oldPrice > 0 && $currentPrice > 0) {
            $discount = round((($oldPrice - $currentPrice) / $oldPrice) * 100);
            }
            @endphp

            <div class="swiper-slide">

                <div class="card border-0 rounded-3 shadow-sm overflow-hidden position-relative h-100">

                    <a href="{{ $product->url ?? '#' }}" target="_blank">
                        <div class="ratio ratio-4x3">
                            <img src="{{ asset('uploads/products/' . ($product->image ?? 'default.png')) }}"
                                class="card-img-top object-fit-cover" alt="{{ $product->product_name }}">
                        </div>
                    </a>

                    @if($discount > 0)
                    <span class="discount-badge">
                        -{{ $discount }}%
                    </span>
                    @endif

                    <div class="card-body d-flex flex-column">

                        <div class="flex-grow-1">

                            <p class="fs-10 link m-0">
                                {{ $product->store->name ?? 'Store' }}
                            </p>

                            <p class="coupon-title fs-18 fw-semibold mb-2 text-capitalize">
                                {{ $product->product_name }}
                            </p>

                            <div class="d-flex gap-2 align-items-center flex-wrap pb-2">
                                <h5 class="m-0">
                                    {{ $product->current_price }}
                                </h5>

                                @if($oldPrice > 0)
                                <span class="text-decoration-line-through small text-danger-emphasis">
                                    {{ $product->old_price }}
                                </span>
                                @endif
                            </div>

                        </div>

                        <a href="{{ $product->url ?? '#' }}" target="_blank"
                            class="btn custom-btn rounded-pill mt-auto">
                            Get Deal
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

    @endif

    @if($faqs->count() > 0)
    <h1 class="fs-30  mb-4 text-center">Frequently Asked Questions</h1>
    <div class="accordion accordion-flush d-flex flex-column gap-3 mb-bottom" id="accordionFlushExample">
        @foreach($faqs as $faq)
        <div class="accordion-item rounded-3 overflow-hidden" style="border:1px solid #ffaa03">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed shadow-none bg-transparent fw-semibold" type="button"
                    data-bs-toggle="collapse" data-bs-target="#{{ $faq->id }}" aria-expanded="false"
                    aria-controls="flush-collapseOne">
                    {{ $faq->title }}
                </button>
            </h2>
            <div id="{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">{!! $faq->description !!}</div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    <div class="card rounded-top-0 rounded-bottom-4 rounded-end-4 border-0 shadow-sm mb-bottom">
        <div class="card-body p-lg-5 p-md-4 p-sm-3 p-3">
            <div class="row row-gap-4">
                <div class="col-lg-5">
                    <div class="ratio ratio-1x1">
                        <img src="{{ asset($settings->why_chose_us_image ?? '') }}" alt="" class="w-100 rounded-3">
                    </div>
                </div>
                <div class="col-lg-7 d-flex align-items-center ">
                    <div class="">
                        <h1 class="fw-bold mb-4">Why Choose Coupon Night?</h1>
                        <p class="fs-18 mb-4">{{ $settings->why_chose ?? '' }}</p>
                        <a href="{{ route('terms.page') }}" class="btn custom-btn rounded-pill">Learn More <i
                                class="fa-solid fa-arrow-right ms-2 "></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
window.addEventListener('load', function() {

    // Modal
    let modalElement = document.getElementById('offerModel');
    if (modalElement) {
        let myModal = new bootstrap.Modal(modalElement);
        myModal.show();
    }

    // Store Slider
    const track = document.querySelector('.store-track');

    if (track) {

        let position = 0;
        let speed = 1;
        let paused = false;

        function animate() {

            if (!paused) {
                position += speed;

                if (position >= track.scrollWidth / 2) {
                    position = 0;
                }

                track.style.transform = `translateX(-${position}px)`;
            }

            requestAnimationFrame(animate);
        }

        animate();

        track.addEventListener('mouseenter', () => {
            paused = true;
        });

        track.addEventListener('mouseleave', () => {
            paused = false;
        });

    }

});

var productSwiper = new Swiper(".myProductSwiper", {
    slidesPerView: 4,
    spaceBetween: 20,

    navigation: {
        nextEl: ".product-swiper-next",
        prevEl: ".product-swiper-prev",
    },

    autoplay: {
        delay: 3000, // 3 seconds
        disableOnInteraction: false, // Arrow click ke baad bhi autoplay chalta rahega
    },

    loop: true,

    breakpoints: {
        0: {
            slidesPerView: 2,
        },
        576: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        992: {
            slidesPerView: 4,
        }
    }
});
</script>
<script>
const countDownDate = new Date("{{ $upcomingEvent->start_date ?? now() }}").getTime();

setInterval(function() {

    let now = new Date().getTime();
    let distance = countDownDate - now;

    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("days").innerHTML = days;
    document.getElementById("hours").innerHTML = hours;
    document.getElementById("minutes").innerHTML = minutes;
    document.getElementById("seconds").innerHTML = seconds;

}, 1000);
</script>
@endpush