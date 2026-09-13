@extends('layouts.app')

@section('title', 'Exclusive Coupon Codes & Member Discounts')
@section('meta_description', 'Unlock exclusive coupon codes, limited-time discounts, and special online shopping offers available only on CouponNight.')

@section('content')

<style>


.discount-card,
.newsletter-box {
    border-radius: 1rem;
}

.filter-btn.active,
.filter-btn:hover {
    background:linear-gradient(90deg, #ff7a1a 0%, #ffb000 100%);
    color: #fff !important;
    border-color: transparent;
}

.store-logo {
    width: 60px;
    height: 60px;
    font-weight: 700;
    font-size: 14px;
}


.code-box {
    background: rgba(139, 92, 246, 0.08);
    border: 1px dashed #8b5cf6;
}
.card-body p{
    text-align: justify;
}
.copy-btn,
.deal-btn,
.subscribe-btn {
    /* background: linear-gradient(90deg, #8b5cf6, #ec4899); */
    border: none;
    color: #fff;
}

.copy-btn:hover,
.deal-btn:hover,
.subscribe-btn:hover {
    opacity: .95;
    color: #fff;
}

.exclusive-badge {
    background: rgba(139, 92, 246, 0.1);
    color: black;
}
.exclusive-badge:hover {
    background: black;
    color: white;
}

.newsletter-input:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 .25rem rgba(139, 92, 246, 0.15);
}
@media (max-width: 576px) {

    .discount-card {
        border-radius: 12px;
    }

    .card-header {
        padding: 10px !important;
    }

    .card-body {
        padding: 12px !important;
    }

    .store-logo {
        width: 45px;
        height: 45px;
    }

    .card-body h3 {
        font-size: 18px;
    }
}
</style>

<!-- Hero -->
<div class="site-header text-white text-center py-5">
    <div class="container py-3">
        <p class="small mb-2">Coupon Night</p>
        <h1 class="fw-bold mb-3">🎁 Exclusive Discounts</h1>
        <p class="mb-0 mx-auto" style="max-width: 520px;">
            Hand-picked deals you won't find anywhere else. Save big with our exclusive coupon codes, verified and
            updated daily.
        </p>
    </div>
</div>

<!-- Stats -->
<div class="bg-white border-bottom py-3 mb-bottom">
    <div class="container">
        <div class="row text-center justify-content-center g-3">
            <div class="col-6 col-md">
                <h4 class="fw-bold mb-0 counter" data-count="{{ $activeDeals }}">0</h4>
                <small class="text-muted">Active Deals</small>
            </div>

            <div class="col-6 col-md">
                <h4 class="fw-bold mb-0 counter" data-count="{{ $topStores }}">0</h4>
                <small class="text-muted">Top Stores</small>
            </div>
            <div class="col-6 col-md">
                <h4 class="fw-bold mb-0 counter" data-count="{{ $verifiedCodes }}">0</h4>
                <small class="text-muted">Verified Codes</small>
            </div>
            <div class="col-6 col-md">
                <h4 class="fw-bold mb-0" >$2.4M</h4>
                <small class="text-muted">Saved by Users</small>
            </div>
            <div class="col-12 col-md">
                <h4 class="fw-bold mb-0" >Daily</h4>
                <small class="text-muted">Updated</small>
            </div>
        </div>
    </div>
</div>

<!-- Body -->
<div class="container mb-bottom px-20">
    <!-- Filter Tabs -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="{{ route('exclusive.page') }}" class="rounded-pill px-3 btn {{ !$slug ? 'custom-btn' : 'btn-outline-secondary' }} filter-btn">
            All Deals
        </a>

        @foreach($categories as $cat)
        <a href="{{ route('exclusive.page', $cat->slug) }}"
            class="btn {{ $slug == $cat->slug ? 'custom-btn' : 'btn-outline-secondary' }} rounded-pill px-3 filter-btn">
            {{ $cat->name }}
        </a>
        @endforeach
    </div>

    <!-- Section Heading -->
    <div class="d-flex align-items-center gap-2 mb-4">
        <h2 class="h5 fw-bold mb-0">🔥 Today's Top Picks</h2>
        <span class="badge exclusive-badge">Exclusive</span>
        <div class="flex-grow-1 border-top"></div>
    </div>

    <div class="row g-4">
        @forelse($coupons as $coupon)
        @php
        $promoValue = trim(
        ($coupon->coupon_image_line_1 ?? '') . ' ' .
        ($coupon->coupon_image_line_2 ?? '') . ' ' .
        ($coupon->coupon_image_line_3 ?? '')
        );

        if ($promoValue == '') {
        $promoValue = $coupon->is_no_code ? 'Deal' : 'Code';
        }

        $storeName = $coupon->store->name ?? 'Store';
        $categoryName = $coupon->category->name ?? 'Category';
        @endphp

        <div class=" col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 discount-card">
                <div class="card-header bg-white border-bottom d-flex flex-lg-row flex-md-row flex-sm-row flex-column align-items-lg-center align-items-md-center align-items-sm-start gap-3 py-3">

                    <div
                        class="store-logo rounded text-white d-flex align-items-center justify-content-center overflow-hidden main-gradient ratio ratio-1x1">
                        @if(!empty($coupon->store?->logo))
                        <img src="{{ asset('uploads/stores/' . $coupon->store->logo) }}" alt="{{ $storeName }}"
                            class="w-100 h-100 object-fit-cover" style="background:#fff;">
                        @else
                        {{ strtoupper(substr($storeName, 0, 1)) }}
                        @endif
                    </div>

                    <div>
                        <div class="fw-semibold">{{ $storeName }}</div>
                        <small class="text-muted">{{ $categoryName }}</small>
                    </div>

                    <span class="badge exclusive-badge ms-auto">Exclusive</span>
                </div>

                <div class="card-body d-flex flex-column">
                    <h3 class="h4 fw-bold mb-2">{{ $promoValue }}</h3>

                    <p class="text-muted small flex-grow-1">
                        {{ $coupon->detail ?? $coupon->name }}
                    </p>

                    @if($coupon->is_no_code == 0 && !empty($coupon->coupon_code))

                    <div class="d-flex mb-3">
                        <div class="code-box flex-grow-1 rounded-start px-3 py-2 fw-semibold text-truncate">
                            {{ $coupon->coupon_code }}
                        </div>

                        <a href="#" class="btn custom-btn copy-btn rounded-0 rounded-end px-3 get-code-btn"
                            data-name="{{ $coupon->name ?? '' }}"
                            data-image="{{ asset('uploads/stores/' . $coupon->store->logo ?? '') }}"
                            data-code="{{ $coupon->coupon_code ?? '' }}" 
                            data-type="code"
                            data-link="{{ $coupon->store->store_url ?? '' }}">

                            Copy
</a>
                    </div>

                    @else

                    <a href="#"
                        class="btn deal-btn custom-btn w-100 rounded mb-3 get-code-btn"
                        data-name="{{ $coupon->name ?? '' }}"
                        data-image="{{ asset('uploads/stores/' . $coupon->store->logo ?? '') }}"
                        data-code="" 
                        data-type="deal"
                        data-link="{{ $coupon->store->store_url ?? '' }}">

                        Get This Deal →
                    </a>

                    @endif

                    <div class="d-flex justify-content-between small text-muted">
                        <span>
                            @if($coupon->end_date)
                            Expires: {{ \Carbon\Carbon::parse($coupon->end_date)->format('M d, Y') }}
                            @else
                            Limited Time
                            @endif
                        </span>

                        @if($coupon->is_verified == 1)
                            <img src="{{asset('images/icons/check-verify-second.svg')}}" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="bg-white rounded-4 p-4 shadow-sm text-center">
                <p class="mb-0 text-muted">No exclusive coupons found.</p>
            </div>
        </div>
        @endforelse
    </div>


      <div class="mt-4">
    {{ $coupons->links('pagination::bootstrap-5') }}
</div>
</div>

<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(item => item.classList.remove('active'));
        this.classList.add('active');
    });
});

// document.querySelectorAll('.copy-btn').forEach(btn => {
//     btn.addEventListener('click', function() {
//         let code = this.previousElementSibling.innerText;
//         navigator.clipboard.writeText(code);
//         let oldText = this.innerText;
//         this.innerText = 'Copied!';
//         setTimeout(() => {
//             this.innerText = oldText;
//         }, 1500);
//     });
// });

    document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll(".counter");
        counters.forEach(counter => {
            let target = +counter.getAttribute("data-count");
            let count = 0;
            let speed = target / 100;
            let updateCount = () => {
                count += speed;
                if (count < target) {
                    counter.innerText = Math.ceil(count) + "+";
                    requestAnimationFrame(updateCount);
                } else {
                    counter.innerText = target + "+";
                }
            };
            updateCount();
        });
    });
</script>
@endsection