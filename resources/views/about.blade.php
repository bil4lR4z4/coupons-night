@extends('layouts.app')

@section('title', 'About CouponNight – Verified Coupons & Online Deals')
@section('meta_description', 'Learn about CouponNight, your destination for verified coupon codes, promo offers, online discounts, and smarter shopping savings.')

@section('content')

@php
use App\Models\Admin\Store;

$popularStores = Store::where('is_popular', 1)
    ->where('status', 'enable')
    ->whereHas('coupons', function ($q) {
        $q->where('status', 'enable');
    })
    ->whereExists(function ($query) {
        $query->selectRaw(1)
            ->from('categories')
            ->where('categories.status', 'enable')
            ->whereRaw('FIND_IN_SET(categories.id, stores.category_id)');
    })
    ->get();
@endphp

<style>
/* ============================================================
   GLOBAL
============================================================ */
body {
    overflow-x: hidden;
    background: #fff;
}

.raimg {
    border-radius: 0px 40px 0px 40px !important;
}

/* ============================================================
   SECTIONS
============================================================ */
.section-padding {
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.section-light {
    background: #f8f8fc;
}

/* ============================================================
   TYPOGRAPHY
============================================================ */
.section-heading {
    font-size: clamp(32px, 4vw, 52px);
    font-weight: 700;
    line-height: 1.1;
    color: #111827;
    letter-spacing: -1.5px;
    margin-bottom: 18px;
}

.section-subheading {
    font-size: clamp(24px, 3vw, 36px);
    font-weight: 700;
    line-height: 1.2;
    color: #111827;
    letter-spacing: -0.8px;
    margin-bottom: 18px;
}

.section-text {
    font-size: 16px;
    line-height: 1.85;
    color: #6b7280;
    margin-bottom: 14px;
}

.about-list {
    padding-left: 20px;
    margin-top: 16px;
    margin-bottom: 16px;
}

.about-list li {
    color: #6b7280;
    margin-bottom: 10px;
    font-size: 16px;
    line-height: 1.75;
}

/* ============================================================
   BADGE
============================================================ */
.badge {
    padding: 7px 18px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.4px;
    text-transform: uppercase;
}

/* ============================================================
   HERO
============================================================ */
.hero-section {
    min-height: 92vh;
    display: flex;
    align-items: center;
}

.hero-image {
    position: relative;
    animation: floatImage 6s ease-in-out infinite;
}

.hero-image img {
    width: 100%;
    max-width: 580px;
    display: block;
    margin: auto;
}

/* ============================================================
   IMAGE WRAPPER / FLOATING
============================================================ */
.image-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
}

.floating-image {
    width: 100%;
    max-width: 520px;
    animation: floatImage 5s ease-in-out infinite;
}

.floating-image img {
    width: 100%;
    height: auto;
    object-fit: contain;
    border-radius: 24px;
    transition: transform 0.4s ease;
}

.floating-image:hover img {
    transform: translateY(-8px) scale(1.01);
}

/* ============================================================
   STAT CARDS
============================================================ */
.stat-card {
    display: flex;
    align-items: center;
    flex-direction: column;
    background: #fff;
    border-radius: 20px;
    padding: 32px 18px;
    text-align: center;
    height: 100%;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid #f0f0f8;
}

.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(109, 93, 252, 0.1);
}

.stat-card img {
    height: 46px;
    margin-bottom: 4px;
}

.stat-card h3 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 8px;
    color: #111827;
    letter-spacing: -1px;
}

.stat-card p {
    color: #9ca3af;
    font-size: 14px;
    font-weight: 500;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* ============================================================
   LOGO SLIDER
============================================================ */
.logo-wrapper {
    overflow: hidden;
}

.logo-slider {
    display: flex;
    gap: 24px;
    width: max-content;
    animation: logoScroll 22s linear infinite;
}

.logo-item {
    width: 130px;
    height: 130px;
    background: #fff;
    border-radius: 50rem;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    border: 1px solid #f0f0f8;
}

.logo-item img {
    max-width: 100%;
}

/* ============================================================
   CTA BOX
============================================================ */
.cta-box {
    background: #111827;
    border-radius: 32px;
    padding: 80px 40px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.cta-box h2 {
    color: #fff;
    font-size: clamp(30px, 4vw, 52px);
    font-weight: 700;
    letter-spacing: -1.2px;
    margin-bottom: 18px;
}

.cta-box p {
    color: #9ca3af;
    font-size: 17px;
    line-height: 1.75;
    max-width: 600px;
    margin: auto auto 32px;
}

/* ============================================================
   BLUR SHAPES
============================================================ */
.blur-shape {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    z-index: 0;
    pointer-events: none;
}

.shape-one {
    width: 240px;
    height: 240px;
    background: #7c3aed;
    opacity: 0.1;
    top: -60px;
    right: -30px;
}

.shape-two {
    width: 200px;
    height: 200px;
    background: #6d5dfc;
    opacity: 0.09;
    bottom: -40px;
    left: -40px;
}

/* ============================================================
   SCROLL REVEAL
============================================================ */
.reveal {
    opacity: 0;
    transform: translateY(60px);
    transition: opacity 0.9s cubic-bezier(0.2, 0.65, 0.3, 1),
                transform 0.9s cubic-bezier(0.2, 0.65, 0.3, 1);
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}

.reveal-left {
    opacity: 0;
    transform: translateX(-60px);
    transition: opacity 0.9s cubic-bezier(0.2, 0.65, 0.3, 1),
                transform 0.9s cubic-bezier(0.2, 0.65, 0.3, 1);
}

.reveal-left.active {
    opacity: 1;
    transform: translateX(0);
}

.reveal-right {
    opacity: 0;
    transform: translateX(60px);
    transition: opacity 0.9s cubic-bezier(0.2, 0.65, 0.3, 1),
                transform 0.9s cubic-bezier(0.2, 0.65, 0.3, 1);
}

.reveal-right.active {
    opacity: 1;
    transform: translateX(0);
}

/* ============================================================
   ANIMATIONS
============================================================ */
@keyframes floatImage {
    0%   { transform: translateY(0px); }
    50%  { transform: translateY(-12px); }
    100% { transform: translateY(0px); }
}

@keyframes logoScroll {
    from { transform: translateX(0); }
    to   { transform: translateX(-50%); }
}

/* ============================================================
   RESPONSIVE
============================================================ */
@media (max-width: 991px) {

    .section-padding {
        padding: 56px 0;
    }

    .hero-section {
        min-height: auto;
        text-align: center;
        padding-top: 60px;
    }

    .hero-image {
        margin-top: 36px;
    }

    .hero-image img,
    .floating-image {
        max-width: 100%;
    }

    .section-heading  { font-size: 34px; letter-spacing: -1px; }
    .section-subheading { font-size: 26px; }
    .section-text     { font-size: 15.5px; }

    .cta-box {
        padding: 56px 24px;
        border-radius: 24px;
    }

    .cta-box h2 { font-size: 28px; }

    .logo-item { width: 110px; height: 110px; }

    .row { --bs-gutter-y: 2rem; }

    .order-mobile-1 { order: 1; }
    .order-mobile-2 { order: 2; }

    .container {
        padding-left: 20px;
        padding-right: 20px;
    }
}

@media (min-width: 992px) {
    .container {
        padding-left: 0;
        padding-right: 0;
    }
}
</style>


<!-- ============================================================
     HERO
============================================================ -->
<section class="section-padding hero-section">

    <div class="blur-shape shape-one"></div>
    <div class="blur-shape shape-two"></div>

    <div class="container" style="position:relative; z-index:1">
        <div class="row align-items-center">

            <div class="col-lg-6">

                <span class="badge bg-light text-dark mb-4">
                    Save Smarter Everyday
                </span>

                <h1 class="section-heading">
                    Helping You Save Before You Checkout
                </h1>

                <p class="section-text">
                    At CouponNight, we believe saving money online should feel simple, quick, and stress-free.
                </p>

                <p class="section-text">
                    We help shoppers discover real coupon codes, trending deals, and useful offers from popular
                    online stores — without wasting time on expired promotions or confusing discount pages.
                    Whether you are shopping for fashion, electronics, beauty, home essentials, food, travel,
                    or everyday products, CouponNight brings the best savings together in one easy place.
                </p>

                <p class="section-text">
                    Our goal is simple: help you shop smarter and save more every time you buy online.
                </p>

                <a href="/" class="btn custom-btn mt-2">
                    Explore Deals
                </a>

            </div>

            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('images/about/About_hero.png') }}"
                         class="img-fluid raimg"
                         alt="CouponNight – Save Before You Checkout">
                </div>
            </div>

        </div>
    </div>

</section>


<!-- ============================================================
     ABOUT
============================================================ -->
<section class="section-padding section-light">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 reveal-left order-mobile-2">
                <div class="image-wrapper">
                    <div class="floating-image">
                        <img src="{{ asset('images/about/about1.png') }}"
                             class="img-fluid raimg" alt="About CouponNight">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 reveal-right order-mobile-1">

                <span class="badge bg-primary-subtle mb-4">About Us</span>

                <h2 class="section-subheading">About CouponNight</h2>

                <p class="section-text">
                    CouponNight was founded in 2026 by Joshua and Husnain with one idea in mind: online
                    shopping should be easier, and finding discounts should not feel like a full-time job.
                </p>

                <p class="section-text">
                    Like most shoppers, we were tired of fake coupon codes, expired offers, and websites filled
                    with clutter that made saving money frustrating instead of helpful. So we decided to build a
                    platform that keeps things simple, clean, and genuinely useful.
                </p>

                <p class="section-text">
                    CouponNight was created to help shoppers quickly find working promo codes, seasonal deals,
                    exclusive offers, and shopping inspiration without the hassle.
                </p>

                <p class="section-text">
                    We are building CouponNight for everyday shoppers who want smarter ways to save before
                    they checkout.
                </p>

            </div>

        </div>
    </div>
</section>


<!-- ============================================================
     HOW WE HELP
============================================================ -->
<section class="section-padding">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="badge bg-primary-subtle mb-4">Savings</span>
            <h2 class="section-heading">How We Help You Save</h2>
        </div>

        <div class="row align-items-center mb-5">

            <div class="col-lg-6 reveal-left">
                <p class="section-text">
                    Finding deals should not be complicated. At CouponNight, we organize offers from different
                    stores and categories so you can quickly discover savings without searching across dozens
                    of websites.
                </p>

                <p class="section-text">Our platform focuses on:</p>

                <ul class="about-list">
                    <li>Finding current coupon codes, promo offers, and store discounts</li>
                    <li>Organizing deals by store, category, and shopping trends</li>
                    <li>Highlighting seasonal and trending offers shoppers actually use</li>
                    <li>Sharing shopping tips and guides to help users make smarter buying decisions</li>
                    <li>Making the overall experience clean, fast, and easy to navigate</li>
                </ul>

                <p class="section-text">
                    Instead of spending time testing random coupon codes, shoppers can quickly check
                    CouponNight and move forward with confidence.
                </p>
            </div>

            <div class="col-lg-6 reveal-right">
                <div class="image-wrapper">
                    <div class="floating-image">
                        <img src="{{ asset('images/about/how_to_save_your_money.png') }}"
                             class="img-fluid raimg" alt="How to save money">
                    </div>
                </div>
            </div>

        </div>

        <div class="row align-items-center pt-lg-5">

            <div class="col-lg-6 reveal-left order-mobile-2">
                <div class="image-wrapper">
                    <div class="floating-image">
                        <img src="{{ asset('images/about/about4_secondSection.png') }}"
                             class="img-fluid raimg" alt="Smart Shopping">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 reveal-right order-mobile-1">

                <span class="badge bg-primary-subtle mb-4">Our Mission</span>

                <h2 class="section-subheading">
                    Making Smart Shopping Easy for Everyone
                </h2>

                <p class="section-text">
                    CouponNight exists to help people save money on the products and services they already love.
                </p>

                <p class="section-text">
                    Our mission is to create a trusted platform where shoppers can easily discover useful deals,
                    compare offers, and make better shopping decisions without confusion or frustration.
                </p>

                <p class="section-text">We want CouponNight to become part of the modern shopping routine:</p>

                <ul class="about-list">
                    <li>Check the deal.</li>
                    <li>Apply the coupon.</li>
                    <li>Save before checkout.</li>
                    <li>Simple as that.</li>
                </ul>

            </div>

        </div>

    </div>
</section>


<!-- ============================================================
     STATS
============================================================ -->
<section class="section-padding section-light">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="badge bg-primary-subtle mb-4">Statistics</span>
            <h2 class="section-heading">The Savings Add Up</h2>
        </div>

        <div class="row g-4">

            <h2 class="text-center mb-2">Smarter Shopping Starts Here</h2>
            <p class="section-text text-center mb-4">
                A few dollars saved here and there may not seem like much at first, but over time those savings
                can make a real difference — from everyday purchases to holiday shopping and travel.
            </p>

            <div class="col-lg-3 col-md-6 reveal-left">
                <div class="stat-card">
                    <div class="rounded-circle bg-secondary bg-opacity-10 d-flex justify-content-center align-items-center mb-3"
                         style="width:66px; height:66px">
                        <img src="{{ asset('images/about/discount.png') }}" style="width:46px">
                    </div>
                    <h3>2026</h3>
                    <p>Founded</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="stat-card">
                    <div class="rounded-circle bg-secondary bg-opacity-10 d-flex justify-content-center align-items-center mb-3"
                         style="width:66px; height:66px">
                        <img src="{{ asset('images/about/stores.png') }}" style="width:46px">
                    </div>
                    <h3>100+</h3>
                    <p>Stores</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal">
                <div class="stat-card">
                    <div class="rounded-circle bg-secondary bg-opacity-10 d-flex justify-content-center align-items-center mb-3"
                         style="width:66px; height:66px">
                        <img src="{{ asset('images/about/categories.png') }}" style="width:46px">
                    </div>
                    <h3>50+</h3>
                    <p>Categories</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 reveal-right">
                <div class="stat-card">
                    <img src="{{ asset('images/about/daily.png') }}" style="width:70px; height:70px">
                    <h3>Daily</h3>
                    <p>Deal Updates</p>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- ============================================================
     PARTNERS
============================================================ -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 reveal-left order-mobile-2">
                <div class="image-wrapper">
                    <div class="floating-image">
                        <img src="{{ asset('images/about/about5_partners.png') }}"
                             class="img-fluid raimg" alt="Our Partners">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 reveal-right order-mobile-1">

                <span class="badge bg-primary-subtle mb-4">Partnerships</span>

                <h2 class="section-subheading">More About Our Partners</h2>

                <p class="section-text">
                    CouponNight helps connect shoppers with brands, stores, and offers they actually care about.
                </p>

                <p class="section-text">
                    We feature deals from a growing range of online stores across categories like fashion, beauty,
                    electronics, home, lifestyle, food, and more. Our goal is to help users discover better prices
                    while helping brands reach shoppers looking for value.
                </p>

                <p class="section-text">
                    As CouponNight continues to grow, we plan to build strong partnerships with trusted stores
                    and affiliate networks to bring users better deals, exclusive promotions, and more useful
                    shopping opportunities.
                </p>

            </div>

        </div>
    </div>
</section>


<!-- ============================================================
     FEATURED STORES
============================================================ -->
<section class="section-padding section-light">
    <div class="container">

        @if($popularStores->count() > 0)
        <div class="text-center mb-5 reveal">
            <span class="badge bg-primary-subtle mb-4">Popular</span>
            <h2 class="section-heading">Popular Stores</h2>
        </div>

        <div class="swiper storeSwiper">
            <div class="swiper-wrapper">
                @foreach($popularStores as $popularStore)
                <div class="swiper-slide">
                    <a href="{{ route('store.show', $popularStore->slug ?? '') }}">
                        <img src="{{ asset('uploads/stores/' . ($popularStore->logo ?? '')) }}"
                             alt="{{ $popularStore->name ?? '' }}"
                             style="width:96px; height:96px"
                             class="object-fit-cover bg-white rounded-circle">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>


<!-- ============================================================
     CTA
============================================================ -->
<section class="section-padding">
    <div class="container">

        <div class="cta-box reveal">

            <div class="blur-shape shape-one"></div>
            <div class="blur-shape shape-two"></div>

            <span class="badge bg-light text-dark mb-4" style="position:relative;z-index:1">
                Start Saving
            </span>

            <h2 style="position:relative;z-index:1">
                Start Saving Before Every Checkout
            </h2>

            <p style="position:relative;z-index:1">
                Discover verified coupon codes, trending offers,
                and smarter online shopping savings with CouponNight.
            </p>

            <a href="/" class="btn custom-btn bg-white text-dark" style="position:relative;z-index:1">
                Explore Deals
            </a>

        </div>

    </div>
</section>


<!-- ============================================================
     SCROLL REVEAL SCRIPT
============================================================ -->
<script>
function revealOnScroll() {
    document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(function(el) {
        if (el.getBoundingClientRect().top < window.innerHeight - 90) {
            el.classList.add('active');
        }
    });
}

window.addEventListener('scroll', revealOnScroll);
window.addEventListener('DOMContentLoaded', revealOnScroll);
</script>

@endsection