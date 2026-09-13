@extends('layouts.app')

@section('title', $store->store_title ?? $store->secondary_name ?? 'Store')
@section('meta_description', $store->meta_description )
@section('content')

<style>
.img-fluid2 {
    max-width: 100%;
    height: 100%;
    border-radius: 50%;
}
p {
    text-align: justify;
}
/* Mobile-only duplicate sections */
.mobile-only {
    display: none;
}
.storelogo
   {
        width: 175px;
        height: 175px;
    }
    .visit{
       width: 18px;
       height:18px; 
    }
    .featuredSwiper .swiper-slide{
    height: auto;
}

.featured-card{
    height: 100%;
}

.featured-title{
    min-height: 48px;
    line-height: 24px;

    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.featured-image{
    aspect-ratio: 4/3;
    object-fit: cover;
}
.brand-list{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px 20px;
}

@media (max-width: 991px) {
    .mobile-only {
        display: block !important;
    }
    .desktop-only {
        display: none !important;
    }
    .storelogo{
        width: 125px;
        height: 125px;
    }
      .visit{
       width: 12px;
       height:12px; 
    }
}
</style>

<div class="container px-20 mt-3">

    {{-- ============================================================
         1. OFFICIAL PARTNER / HERO  (same on both)
    ============================================================ --}}
    <div class="row mb-bottom mx-1">
        <div class="col-12 bg-white">
            <div class="row">
                <div class="col-11 mx-auto my-5">
                    <div class="row">
                        <div class="col-lg-2 col-12 text-center mb-lg-4 mb-2">
                            <div class="bg-white  storelogo rounded-circle shadow d-inline-flex align-items-center justify-content-center"
                                style="">
                                <img src="{{ asset('uploads/stores/' . $store->logo) }}" alt="{{ $store->name }}"
                                    class="img-fluid2">
                            </div>
                        </div>
                        <div class="col-lg-10 col-12 ps-lg-5 mt-lg-0 mt-2 text-center text-lg-start">
                            <span class="badge rounded-pill px-3 py-2 mb-1 inter"
                                style="background-color: #5ee28f; color: #005F2F; font-size: 12px; letter-spacing: 0.5px;">
                                OFFICIAL PARTNER
                            </span>
                            <h1 class="fw-bold mb-3 plusJakartaSans"
                                style="font-size: 3rem; line-height: 1.1; color: #2d2d2d;">
                                {{ $store->heading_h1 }}
                            </h1>
                            <p class="text-muted mb-4 inter" style="font-size: 1.2rem; max-width: 700px;">
                                {!! $store->description !!}
                            </p>
                            <a href="{{ $store->store_url }}" target="_blank">
                                <button class="btn custom-btn d-inline-flex align-items-center gap-2 px-md-4 py-md-3 px-3 py-2  "
                                    style="color:white; text-decoration: none; font-size: 18px;">
                                    Visit Store
                                    <img src="{{ asset('images/store/Container.png') }}" class="visit" alt="" style="">
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mobile-only mb-bottom px-1">
        <div class="bg-white border rounded-4 p-4 shadow-sm">
            <h4 class="fw-bold mb-3 plusJakartaSans">About {{ $store->name }}</h4>
            <p>
                {{ $store->about ?? 'Find verified ' . $store->name . ' coupon codes, promo codes, free shipping offers, and exclusive online deals updated daily at CouponNight. Save more with hand-picked discounts, limited-time sales, and trusted offers from ' . $store->name . ' and other top online stores and brands.' }}
            </p>
        </div>
    </div>

    <div class="col-12">
        <div class="row p-0">
            <div class="col-12">
                <div class="row p-0">

                    {{-- ── LEFT SIDEBAR (desktop only visible here) ── --}}
                    <div class="col-lg-4 col-12 pe-lg-4">

                        {{-- About — desktop only here --}}
                        <div class="desktop-only bg-white border rounded-4 p-4 shadow-sm products mb-bottom">
                            <h4 class="fw-bold mb-3 plusJakartaSans">About {{ $store->name }}</h4>
                            <p>
                                {{ $store->about ?? 'Find verified ' . $store->name . ' coupon codes, promo codes, free shipping offers, and exclusive online deals updated daily at CouponNight. Save more with hand-picked discounts, limited-time sales, and trusted offers from ' . $store->name . ' and other top online stores and brands.' }}
                            </p>
                        </div>

                        {{-- Products By Brand — desktop sidebar, mobile hidden (duplicate below) --}}
                        <div class="desktop-only bg-white border rounded-4 p-4 shadow-sm products mb-bottom">
                            <h4 class="fw-bold mb-3 plusJakartaSans">Explore More Brands</h4>
                            <ul class="list-unstyled mb-0 small inter  brand-list">
                                @forelse($brands as $brand)
                                <li class="mb-2">
                                    <a href="{{ route('store.show', $brand->slug) }}"
                                        class="text-decoration-none text-dark">
                                        &gt; {{ $brand->name }}
                                    </a>
                                </li>
                                @empty
                                <li class="text-muted">No stores found.</li>
                                @endforelse
                            </ul>
                        </div>

                        {{-- Popular Categories — desktop sidebar, mobile hidden (duplicate below) --}}
                        <div class="desktop-only mb-bottom">
                            <h4 class="fw-bold pb-3 mt-lg-0 plusJakartaSans">Popular Categories</h4>
                            <div class="d-flex flex-wrap gap-2 inter">
                                @forelse($popularCategories as $cat)
                                <a href="{{ route('coupon_category.page', $cat->slug) }}"
                                    class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border bg-white text-decoration-none">
                                    {{ $cat->name }}
                                </a>
                                @empty
                                <span class="text-muted small">No categories found.</span>
                                @endforelse
                            </div>
                        </div>

                        {{-- Related Stores — desktop sidebar, mobile hidden (duplicate below) --}}
                        <div class="desktop-only mb-bottom">
                            <h4 class="fw-bold mb-3 plusJakartaSans">Related Stores</h4>
                            <div class="row g-3 inter">
                                @forelse($relatedStores as $relatedStore)
                                <div class="col-6">
                                    <a href="{{ route('store.show', $relatedStore->slug) }}"
                                        class="text-decoration-none text-dark">
                                        <div class="bg-white border rounded-4 shadow-sm text-center p-4 h-100">
                                            @if(!empty($relatedStore->logo))
                                            <img src="{{ asset('uploads/stores/' . $relatedStore->logo) }}"
                                                alt="{{ $relatedStore->name }}" class="img-fluid rounded-2">
                                            @else
                                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center"></div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                @empty
                                <div class="col-12">
                                    <p class="text-muted small mb-0">No related stores found.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                    {{-- ── END LEFT SIDEBAR ── --}}


                    {{-- ── RIGHT MAIN CONTENT ── --}}
                    <div class="col-lg-8 col-12 mt-lg-0">
                        <div class="row">

                            {{-- 3. STATS / TOP OFFERS --}}
                            <div class="col-12 mb-bottom">
                                <div class="d-flex align-items-center gap-3 mb-5">
                                    <h2 class="fw-bold mb-0 plusJakartaSans">{{ $store->heading_h2 }}</h2>
                                    <div class="border-top flex-grow-1"></div>
                                </div>
                                <div class="row g-4">
                                    <div class="col-sm-6 col-lg-3 col-6">
                                        <div class="bg-white rounded-4 p-3 text-center shadow-sm">
                                            <h2 class="fw-bold mb-2 offer-number counter" data-target="{{ $totalOffers }}">0</h2>
                                            <div class="text-uppercase text-secondary fw-semibold" style="font-size:12px;">Total Coupon</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 col-6">
                                        <div class="bg-white rounded-4 p-3 text-center shadow-sm">
                                            <h2 class="fw-bold mb-2 offer-number counter" data-target="{{ $couponCodes }}">0</h2>
                                            <div class="text-uppercase text-secondary fw-semibold" style="font-size:12px;">Coupon Codes</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 col-6">
                                        <div class="bg-white rounded-4 p-3 text-center shadow-sm">
                                            <h2 class="fw-bold mb-2 offer-number counter" data-target="{{ $dealCodes }}">0</h2>
                                            <div class="text-uppercase text-secondary fw-semibold" style="font-size:12px;">Coupons Deal</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3 col-6">
                                        <div class="bg-white rounded-4 p-3 text-center shadow-sm">
                                            <h2 class="fw-bold mb-2 offer-number counter" data-target="{{ $freeShipping }}">0</h2>
                                            <div class="text-uppercase text-secondary fw-semibold" style="font-size:12px;">Free Shipping Deals</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 4. ACTIVE PROMO CODES --}}
                            <div class="col-12 mb-bottom">
                                <div class="d-flex align-items-center gap-3 mb-5">
                                    <h3 class="fw-bold mb-0 plusJakartaSans">Active Promo Codes</h3>
                                    <div class="border-top flex-grow-1"></div>
                                </div>

                                @if($coupons->count() > 0)
                                <div class="d-flex flex-column gap-3 inter">
                                    @foreach($coupons as $coupon)
                                    @php
                                        $isFreeShipping = $coupon->free_shipping == 1;
                                        $hasCode = !empty($coupon->coupon_code);
                                        if ($isFreeShipping) {
                                            $promoValue = '<i class="fa-solid fa-truck"></i>';
                                            $promoLabel = 'Free';
                                            $buttonText = 'Get Deal';
                                        } elseif ($hasCode) {
                                            $promoValue = $coupon->coupon_image_line_1 . '' . ($coupon->coupon_image_line_2 ?? '') ?? 'Code';
                                            $promoLabel = 'Discount';
                                            $buttonText = 'Get Code';
                                        }
                                    @endphp
                                    <div class="bg-white rounded-4 p-3 p-md-4 shadow-sm">
                                        <div class="row align-items-center g-3">
                                            <div class="col-md-2 col-12">
                                                <div class="bg-light rounded-4 d-flex flex-column align-items-center justify-content-center h-100 py-4">
                                                    <div class="promo-value fw-bold mb-1">{!! $promoValue !!}</div>
                                                    <small class="text-uppercase fw-semibold" style="color:#ABADAE; font-size: 10px;">{{ $promoLabel }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <h4 class="fw-bold mb-2 plusJakartaSans" style="font-size:18px;">{{ $coupon->name }}</h4>
                                                <p class="text-secondary mb-2" style="font-size:14px;">{{ $coupon->detail }}</p>
                                                @if($coupon->is_verified == 1)
                                                <span class="rounded-pill text-success bg-success-subtle px-2 py-1">
                                                    <span class="verify-badge-green">
                                                        <img src="{{ asset('images/store/Icon.png') }}" style="width:13px; height:13px;" alt="">
                                                        <span>VERIFIED</span>
                                                    </span>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-4 col-12 text-md-end">
                                                <button class="btn custom-btn px-4 py-2 fw-semibold get-code-btn"
                                                    data-name="{{ $coupon->name ?? '' }}"
                                                    data-image="{{ asset('uploads/stores/' . $store->logo ?? '') }}"
                                                    data-code="{{ $coupon->coupon_code ?? '' }}"
                                                    data-type="code"
                                                    data-link="{{ $coupon->store->store_url ?? '' }}">
                                                    {{ $buttonText }}
                                                    <i class="fa-solid fa-arrow-right ms-2 "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="bg-white rounded-4 p-4 shadow-sm text-center">
                                    <p class="mb-0 text-secondary">No active promo codes available.</p>
                                </div>
                                @endif
                            </div>

                            {{-- 5. FEATURED OFFERS --}}
                            <div class="col-12 mb-bottom">
                                <div class="d-flex align-items-center gap-3 mb-5">
                                    <h2 class="fw-bold mb-0 mt-3 plusJakartaSans">Featured Offers</h2>
                                    <div class="border-top flex-grow-1 mt-3"></div>
                                </div>

                                @if($deals->count() > 0)
                                <div class="row g-4 inter">
                                    @foreach($deals as $coupon)
                                    @php
                                        $promoValue = $coupon->coupon_image_line_1.' '.($coupon->coupon_image_line_2 ?? '') ?? 'Deal';
                                    @endphp
                                    <div class="col-lg-6 col-12">
                                        <div class="bg-white rounded-4 p-4 h-100 shadow-sm">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h1 class="fw-bold mb-2 offer-number">{{ $promoValue }}</h1>
                                                <span class="rounded-pill text-success bg-success-subtle px-2 py-1">
                                                    <span class="verify-badge-green">
                                                        <img src="{{ asset('images/store/Icon.png') }}" style="width:13px; height:13px;" alt="">
                                                        <span>VERIFIED</span>
                                                    </span>
                                                </span>
                                            </div>
                                            <h4 class="fw-bold mb-2 plusJakartaSans" style="font-size: 20px;">{{ $coupon->name }}</h4>
                                            <p class="text-secondary mb-4" style="font-size:14px; font-weight: 400;">{{ $coupon->detail }}</p>
                                            <hr>
                                            <div class="d-flex justify-content-between align-items-center my-2">
                                                @if($coupon->end_date)
                                                <small class="text-uppercase fw-semibold" style="color:#757778; font-size: 10px;">
                                                    Expires: {{ \Carbon\Carbon::parse($coupon->end_date)->format('d M Y') }}
                                                </small>
                                                @else
                                                <small class="text-uppercase fw-semibold" style="color:#757778; font-size: 10px;">
                                                    Limited Time Offer
                                                </small>
                                                @endif
                                                <button class="btn custom-btn get-code-btn"
                                                    data-name="{{ $coupon->name ?? '' }}"
                                                    data-type="deal"
                                                    data-image="{{ asset('uploads/stores/' . $store->logo ?? '') }}"
                                                    data-code=""
                                                    data-link="{{ $coupon->store->store_url ?? '' }}"
                                                    style="font-size: 14px;">
                                                    GET DEAL <i class="fa-solid fa-arrow-right ms-2 "></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="bg-white rounded-4 p-4 shadow-sm text-center">
                                    <p class="mb-0 text-secondary">No active promo codes available.</p>
                                </div>
                                @endif
                            </div>

                            {{-- FAQ — desktop only here (mobile duplicate below) --}}
                            @if($store->faqs->where('status', 'enable')->count() > 0)
                            <div class="desktop-only col-12 mb-bottom inter">
                                <h2 class="fw-bold mb-5 plusJakartaSans">{{ $store->name }} Savings FAQ</h2>
                                <div class="accordion custom-faq" id="storeFaqDesktop">
                                    @foreach($store->faqs->where('status', 'enable')->sortBy('sort_order') as $index => $faq)
                                    <div class="accordion-item border-0 rounded-4 overflow-hidden mb-3 {{ $index == 0 ? 'active-faq' : '' }}">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button fw-bold py-3 px-4 {{ $index == 0 ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#faqD{{ $faq->id }}"
                                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                aria-controls="faqD{{ $faq->id }}">
                                                {{ str_replace('{store_name}', $store->name, $faq->question) }}
                                            </button>
                                        </h2>
                                        <div id="faqD{{ $faq->id }}"
                                            class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                            data-bs-parent="#storeFaqDesktop">
                                            <div class="accordion-body px-4 pt-0 pb-2 text-secondary" style="font-size:14px;">
                                                {!! str_replace('{store_name}', $store->name, $faq->answer) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                    {{-- ── END RIGHT MAIN CONTENT ── --}}

                </div>
            </div>
        </div>


        <div class="mobile-only mb-bottom px-1">
            <div class="bg-white border rounded-4 p-4 shadow-sm">
                <h4 class="fw-bold mb-3 plusJakartaSans">Explore More Brands</h4>
                <ul class="list-unstyled mb-0 small inter">
                    @forelse($brands as $brand)
                    <li class="mb-2">
                        <a href="{{ route('store.show', $brand->slug) }}" class="text-decoration-none text-dark">
                            &gt; {{ $brand->name }}
                        </a>
                    </li>
                    @empty
                    <li class="text-muted">No stores found.</li>
                    @endforelse
                </ul>
            </div>
        </div>

  
        <div class="mobile-only mb-bottom px-1">
            <h4 class="fw-bold pb-3 plusJakartaSans">Popular Categories</h4>
            <div class="d-flex flex-wrap gap-2 inter">
                @forelse($popularCategories as $cat)
                <a href="{{ route('coupon_category.page', $cat->slug) }}"
                    class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border bg-white text-decoration-none">
                    {{ $cat->name }}
                </a>
                @empty
                <span class="text-muted small">No categories found.</span>
                @endforelse
            </div>
        </div>

      
        <div class="mobile-only mb-bottom px-1">
            <h4 class="fw-bold mb-3 plusJakartaSans">Related Stores</h4>
            <div class="row g-3 inter">
                @forelse($relatedStores as $relatedStore)
                <div class="col-6">
                    <a href="{{ route('store.show', $relatedStore->slug) }}" class="text-decoration-none text-dark">
                        <div class="bg-white border rounded-4 shadow-sm text-center p-4 h-100">
                            @if(!empty($relatedStore->logo))
                            <img src="{{ asset('uploads/stores/' . $relatedStore->logo) }}"
                                alt="{{ $relatedStore->name }}" class="img-fluid rounded-2">
                            @else
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center"></div>
                            @endif
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-muted small mb-0">No related stores found.</p>
                </div>
                @endforelse
            </div>
        </div>

     
   @if($products->count() > 0)

<div class="col-12 mb-bottom">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0" style="font-size:29px;">
            Featured Products
        </h2>

        <div class="d-flex gap-2">
            <div class="swiper-button-prev position-static custom-swiper featured-prev"></div>
            <div class="swiper-button-next position-static custom-swiper featured-next"></div>
        </div>
    </div>

    <div class="swiper featuredSwiper">

        <div class="swiper-wrapper">

            @foreach($products as $product)

            @php
                $discount = 0;

                if ((float)$product->old_price > 0 && (float)$product->current_price > 0) {
                    $discount = round(
                        (((float)$product->old_price - (float)$product->current_price)
                        / (float)$product->old_price) * 100
                    );
                }
            @endphp

            <div class="swiper-slide">

                <div class="card featured-card border-0 rounded-4 shadow-sm overflow-hidden">

                    <div class="position-relative">

                        <img src="{{ asset('uploads/products/' . $product->image) }}"
                             class="card-img-top featured-image w-100"
                             alt="{{ $product->product_name }}">

                        @if($discount > 0)
                        <span class="badge custom-btn rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1">
                            -{{ $discount }}%
                        </span>
                        @endif

                    </div>

                    <div class="card-body d-flex flex-column">

                        <div class="flex-grow-1">

                            <small class="text-danger fw-bold text-uppercase d-block mb-2"
                                   style="font-size:10px;">
                                {{ optional($product->category)->name ?? 'Product' }}
                            </small>

                            <h5 class="featured-title fw-bold mb-3"
                                style="font-size:16px;">
                                {{ $product->product_title ?? $product->product_name }}
                            </h5>

                            <div class="d-flex align-items-center gap-2 flex-wrap">

                                <span class="fw-bold"
                                      style="font-size:19px;">
                                    {{ $product->current_price }}
                                </span>

                                @if($product->old_price)
                                <span class="text-secondary text-decoration-line-through"
                                      style="font-size:13px;">
                                    {{ $product->old_price }}
                                </span>
                                @endif

                            </div>

                        </div>

                        <a href="{{ $product->url }}"
                           target="_blank"
                           class="btn custom-btn rounded-pill mt-3">
                            Get Deal
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

@endif


        <div class="col-12 mb-bottom">
            <h2 class="fw-bold mb-4" style="font-size: 29px;">Shopping Guides &amp; Articles</h2>
            <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1 row-gap-4">
                <x-frontend.artical />
                <div class="col-12 text-center w-100 pt-4">
                    <a href="{{ route('blog') }}" class="btn custom-btn rounded-pill">View All Articals <i class="fa-solid fa-arrow-right ms-2 "></i></a>
                </div>
            </div>
        </div>

  
        @if($store->faqs->where('status', 'enable')->count() > 0)
        <div class="mobile-only mb-bottom px-1">
            <h2 class="fw-bold mb-5 plusJakartaSans">{{ $store->name }} Savings FAQ</h2>
            <div class="accordion custom-faq" id="storeFaqMobile">
                @foreach($store->faqs->where('status', 'enable')->sortBy('sort_order') as $index => $faq)
                <div class="accordion-item border-0 rounded-4 overflow-hidden mb-3 {{ $index == 0 ? 'active-faq' : '' }}">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold py-3 px-4 {{ $index == 0 ? '' : 'collapsed' }}"
                            type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqM{{ $faq->id }}"
                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                            aria-controls="faqM{{ $faq->id }}">
                            {{ str_replace('{store_name}', $store->name, $faq->question) }}
                        </button>
                    </h2>
                    <div id="faqM{{ $faq->id }}"
                        class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                        data-bs-parent="#storeFaqMobile">
                        <div class="accordion-body px-4 pt-0 pb-2 text-secondary" style="font-size:14px;">
                            {!! str_replace('{store_name}', $store->name, $faq->answer) !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.counter');
    const startCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.innerText = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.innerText = target;
            }
        };
        updateCounter();
    };
    setTimeout(() => {
        counters.forEach((counter, index) => {
            setTimeout(() => { startCounter(counter); }, index * 300);
        });
    }, 700);
    new Swiper(".featuredSwiper", {
    slidesPerView: 4,
    spaceBetween: 24,
    loop: true,

    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true
    },

    navigation: {
        nextEl: ".featured-next",
        prevEl: ".featured-prev",
    },

    breakpoints: {
        0: {
            slidesPerView: 2
        },
        768: {
            slidesPerView: 3
        },
        992: {
            slidesPerView: 4
        }
    }
});
});
</script>