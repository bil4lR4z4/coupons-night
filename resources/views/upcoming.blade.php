@extends('layouts.app')

@section('title', 'Upcoming Sales Events & Online Shopping Deals')
@section('meta_description', 'Stay updated with upcoming shopping events, seasonal sales, and online discount offers
from top brands and stores.')
@section('content')
<style>
/* ── Timer ── */
.timer-box {
    min-width: 52px;
}

.timer-box .num {
    font-size: 22px;
    font-weight: 800;
    color: #0f0c1a;
    line-height: 1;
}

.timer-box .lbl {
    font-size: 10px;
    font-weight: 500;
    margin-top: 2px;
}

.timer-sep {
    font-size: 22px;
    font-weight: 800;
    color: var(--primary);
    margin-bottom: 12px;
}

/* ── Event Cards ── */
.event-card {
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    min-height: 195px;
    display: flex;
    align-items: flex-end;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.event-content {
    position: relative;
    z-index: 2;
    padding: 18px;
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.event-title {
    font-weight: 900;
    font-size: 26px;
    color: #fff;
    line-height: 1;
}

.event-title .gold {
    color: var(--accent);
}

.event-sub {
    color: rgba(255, 255, 255, .7);
    font-size: 12px;
    margin: 5px 0 12px;
}

.event-date {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 255, 255, .1);
    border-radius: 6px;
    padding: 5px 12px;
    color: rgba(255, 255, 255, .85);
    font-size: 11px;
    margin-bottom: 14px;
}

/* ── Store circles in event card ── */
.s-row {
    display: flex;
    align-items: center;
    gap: 4px;
    flex-wrap: wrap;
    margin-top: 10px;
}

.s-row .lbl {
    font-size: 10px;
    color: rgba(255, 255, 255, .5);
    margin-right: 4px;
}

.s-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 9px;
    font-weight: 800;
    flex-shrink: 0;
}

.more-pill {
    background: rgba(255, 255, 255, .18);
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 999px;
}

/* ── Sidebar store row ── */
.st-row {
    border-bottom: 1px solid #f3f4f6;
    transition: background .18s;
}

.st-row:last-child {
    border-bottom: none;
}

.st-row:hover {
    background: #faf9ff;
    border-radius: 8px;
}

.st-icon {
    width: 46px;
    height: 46px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
    border: 1px solid var(--border);
    background: #fff;
    padding: 3px;
}

.st-icon img {
    width: 100%;
    height: 100%;
}

.st-name {
    flex: 1;
    font-size: 13px;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.st-count {
    white-space: nowrap;
    font-size: 11px;
}

/* ── Deal cards ── */
.deal-card {
    border: 1.5px solid var(--border);
    border-radius: 14px;
    background: #fff;
    transition: box-shadow .2s, transform .2s;
}

.deal-card:hover {
    box-shadow: 0 8px 28px rgba(124, 58, 237, .12);
    transform: translateY(-2px);
}

.d-logo {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: #f8f9fa;
}

.d-logo img {
    width: 80%;
    height: 80%;
    object-fit: contain;
}

.d-store {
    font-size: 12px;
    font-weight: 700;
    color: #374151;
}

.d-title {
    font-size: 15px;
    font-weight: 900;
    color: #111827;
    line-height: 1.2;
}

.d-sub {
    font-size: 11px;
    color: var(--muted);
}

.code-box {
    background: #f3f4f6;
    border: 1.5px dashed #d1d5db;
    border-radius: 7px;
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 5px 9px;
    flex: 1;
    min-width: 0;
}

.code-val {
    font-size: 12px;
    font-weight: 800;
    color: #111827;
    letter-spacing: 1px;
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.code-lbl {
    font-size: 10px;
    font-weight: 700;
    color: var(--muted);
    white-space: nowrap;
}

.copy-btn {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--primary);
    font-size: 12px;
    padding: 0;
    flex-shrink: 0;
}

.exp {
    font-size: 10px;
    color: var(--muted);
    text-align: center;
}

.exp span {
    color: #ef4444;
    font-weight: 600;
}

/* ── Deals horizontal scroll ── */
.deals-scroll {
    overflow-x: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    scroll-behavior: smooth;
}

.deals-scroll::-webkit-scrollbar {
    display: none;
}

.deals-wrapper {
    min-width: max-content;
}

/* ── Fixed deal card width for scroll ── */
.deal-col {
    width: 200px;
    flex-shrink: 0;
}

/* ── Features row ── */
.features-row {
    background: #f8f7ff;
    border-radius: 12px;
    overflow: hidden;
}

.feat {
    flex: 1;
    border-right: 1px solid var(--border);
    min-width: 0;
}

.feat:last-child {
    border-right: none;
}

.feat-icon {
    width: 32px;
    height: 32px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.feat-title {
    font-size: 11px;
    font-weight: 700;
    color: #1f2937;
}

.feat-desc {
    font-size: 10px;
    color: var(--muted);
    line-height: 1.4;
}

/* ── Popular Stores & Categories grid ── */
.store-item,
.cat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 8px 4px;
    border-radius: 12px;
    cursor: pointer;
    flex: 1;
    min-width: 60px;
    max-width: 80px;
    transition: background .18s, transform .18s;
}

.store-item:hover,
.cat-item:hover {
    background: #f3f0ff;
    transform: translateY(-2px);
}

.s-logo-box {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    border: 1.5px solid var(--border);
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-bottom: 6px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
    transition: box-shadow .18s;
}

.store-item:hover .s-logo-box {
    box-shadow: 0 4px 16px rgba(124, 58, 237, .15);
    border-color: #c4b5fd;
}

.s-logo-box img {
    width: 78%;
    height: 78%;
    object-fit: contain;
}

.s-label,
.cat-label {
    font-size: 10px;
    font-weight: 600;
    color: #374151;
    text-align: center;
    word-break: break-word;
    line-height: 1.3;
}

.cat-icon {
    width: 50px;
    height: 50px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 6px;
    background: #f3f4f6;
    transition: transform .18s;
}

.cat-item:hover .cat-icon {
    transform: scale(1.08);
}

/* ── Affiliate card ── */
.aff-card {
    background: linear-gradient(135deg, #7c3aed, #a855f7);
    border-radius: 14px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.aff-card::before {
    content: '';
    position: absolute;
    top: -20px;
    right: -20px;
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: rgba(255, 255, 255, .08);
}

.coins {
    position: absolute;
    right: 14px;
    bottom: 12px;
    font-size: 38px;
}

/* ── Arrow scroll buttons ── */
.arr-btn {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    border: 1.5px solid var(--border);
    background: #fff;
    color: var(--primary);
    font-size: 13px;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .07);
    flex-shrink: 0;
    transition: all .2s;
}

.arr-btn:hover {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}

/* ════════════════════════════════
   MOBILE RESPONSIVE FIXES
   ════════════════════════════════ */

/* -- sm: 576px and below -- */
@media (max-width: 575.98px) {

    /* Timer: smaller boxes, no overflow */
    .timer-box {
        min-width: 42px;
        padding: 6px 4px !important;
    }

    .timer-box .num {
        font-size: 16px;
    }

    .timer-sep {
        font-size: 16px;
        margin-bottom: 8px;
    }

    /* Event card text */
    .event-title {
        font-size: 20px;
    }

    .event-content {
        padding: 14px;
    }

    /* Event card bottom row: stack vertically */
    .event-card .d-flex.align-items-center.justify-content-between {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 10px !important;
    }

    /* Heading */
    h2.fw-black {
        font-size: 19px !important;
    }

    /* Features: 2x2 grid on mobile */
    .features-row {
        display: grid !important;
        grid-template-columns: 1fr 1fr;
    }

    .feat {
        border-right: none !important;
        border-bottom: 1px solid var(--border);
        flex-direction: column;
    }

    .feat:nth-child(1),
    .feat:nth-child(2) {
        border-bottom: 1px solid var(--border);
    }

    .feat:nth-child(3),
    .feat:nth-child(4) {
        border-bottom: none;
    }

    .feat:nth-child(odd) {
        border-right: 1px solid var(--border) !important;
    }

    /* Deal card fixed width slightly smaller */
    .deal-col {
        width: 175px;
    }

    /* Store/cat items: allow 4-5 per row on small screens */
    .store-item,
    .cat-item {
        min-width: 56px;
        max-width: 72px;
    }

    /* Sidebar popular stores: hide chevron on tiny screens */
    .st-row .fa-chevron-right {
        display: none;
    }

    /* Section padding */
    .bg-white.rounded-4.p-4 {
        padding: 16px !important;
    }
}

/* -- md: 576px – 767px -- */
@media (min-width: 576px) and (max-width: 767.98px) {

    .timer-box {
        min-width: 46px;
    }

    .timer-box .num {
        font-size: 18px;
    }

    .event-title {
        font-size: 22px;
    }

    .features-row {
        display: grid !important;
        grid-template-columns: 1fr 1fr;
    }

    .feat {
        border-right: none !important;
        border-bottom: 1px solid var(--border);
        flex-direction: column;
    }

    .feat:nth-child(odd) {
        border-right: 1px solid var(--border) !important;
    }

    .feat:nth-child(3),
    .feat:nth-child(4) {
        border-bottom: none;
    }
}

/* -- Tablet: 768px – 991px -- */
@media (min-width: 768px) and (max-width: 991.98px) {

    .event-title {
        font-size: 24px;
    }

    .features-row {
        display: grid !important;
        grid-template-columns: 1fr 1fr;
    }

    .feat {
        border-right: none !important;
        border-bottom: 1px solid var(--border);
    }

    .feat:nth-child(odd) {
        border-right: 1px solid var(--border) !important;
    }

    .feat:nth-child(3),
    .feat:nth-child(4) {
        border-bottom: none;
    }

    .deal-col {
        width: 190px;
    }
}

/* -- Original desktop: 992px+ -- */
@media (min-width: 992px) {
    .features-row {
        display: flex !important;
    }

    .feat {
        border-right: 1px solid var(--border);
        border-bottom: none !important;
    }

    .feat:last-child {
        border-right: none;
    }
}

/* ── Utility ── */
/* NOTE: overflow-x: hidden hatayi — woh navbar dropdown ko clip karti thi */
.row {
    --bs-gutter-x: 1rem;
}

/* Page ka main wrapper — overflow sirf body level pe control karein */
body {
    overflow-x: hidden;
}

/* Event card stacking context navbar ke neeche rahe */
.event-card {
    isolation: auto;
    z-index: 0;
}

.event-content {
    position: relative;
    z-index: 0;
}

.deals-scroll{
    overflow-x: auto;
    scrollbar-width: none;
    scroll-behavior: smooth;
    cursor: grab;
}

.deals-scroll::-webkit-scrollbar{
    display: none;
}

.deals-wrapper{
    width: max-content;
}

</style>


<div class="container pt-4 mb-bottom px-20">
    <div class="row g-4 mb-bottom">
        <div class="col-lg-8">

            {{-- Header: title + timer --}}
            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-3">

                <div>
                    <span class="badge mb-2">
                        <i class="fa fa-bell me-1"></i> Next Event Starting Soon
                    </span>
                    <h2 class="fw-black mb-1"
                        style="font-family:'Montserrat',sans-serif;font-size:24px;font-weight:900;">
                        <span style="color:var(--primary)">Upcoming</span> Events
                    </h2>
                    <p class="text-muted mb-0" style="font-size:13px;">
                        Big savings events are coming! Don't miss out on exclusive deals and coupons.
                    </p>
                </div>

                <div class="d-flex align-items-center gap-2 pt-1 flex-shrink-0">
                    <div class="timer-box bg-white rounded-3 p-2 text-center shadow-sm">
                        <div class="num" id="days">00</div>
                        <div class="lbl text-muted">Days</div>
                    </div>
                    <div class="timer-sep">:</div>
                    <div class="timer-box bg-white rounded-3 p-2 text-center shadow-sm">
                        <div class="num" id="hours">00</div>
                        <div class="lbl text-muted">Hours</div>
                    </div>
                    <div class="timer-sep">:</div>
                    <div class="timer-box bg-white rounded-3 p-2 text-center shadow-sm">
                        <div class="num" id="mins">00</div>
                        <div class="lbl text-muted">Mins</div>
                    </div>
                    <div class="timer-sep">:</div>
                    <div class="timer-box bg-white rounded-3 p-2 text-center shadow-sm">
                        <div class="num" id="secs">00</div>
                        <div class="lbl text-muted">Secs</div>
                    </div>
                </div>

            </div>

            <input type="hidden" id="eventDate" value="{{ $nextEvent->start_date ?? '' }}">

            {{-- Event cards --}}
            @foreach ($events as $event)
            <div class="event-card mb-3"
                style="background-image:url('{{ asset('public/uploads/events/'.$event->image) }}');">
                <div class="event-content">

                    <span class="badge mb-2">{{ $event->badge_text }}</span>

                    <h2 class="event-title">{{ $event->title }}</h2>
                    <div class="event-sub">{{ $event->subtitle }}</div>

                    <div class="event-date">
                        <i class="fa fa-calendar-alt" style="color:var(--accent)"></i>
                        {{ $event->start_date }} – {{ $event->end_date }}
                    </div>

                    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap w-100 mt-2">

                        <a href="{{ $event->button_link }}" class="btn custom-btn flex-shrink-0">
                            {{ $event->button_text }}
                            <i class="fa fa-arrow-right ms-1"></i>
                        </a>

                        <div class="s-row flex-shrink-0">
                            <span class="lbl">Top Stores</span>
                            @foreach ($stores as $store)
                            <div class="s-circle">
                                <a href="{{route('store.show', $store->slug)}}">
                                    <img src="{{ $store->logo ? asset('public/uploads/stores/'.$store->logo) : '' }}"
                                        style="width:100%;height:100%;object-fit:contain;" alt="{{ $store->name }}">
                                </a>
                            </div>
                            @endforeach
                            <span class="more-pill"> <a class="text-decoration-none text-white"
                                    href="{{ route('stores.page') }}">+{{ $storeCount }}</a></span>
                        </div>

                    </div>

                </div>
            </div>
            @endforeach

        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            <div class="bg-white rounded-4 p-3 shadow-sm mb-3">

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold" style="font-size:15px;">Popular Stores</span>
                    <a href="{{ url('/sitemap') }}" class="link">View All</a>
                </div>

                @foreach ($popularStores as $store)
                <a href="{{ route('store.show', $store->slug) }}" class="text-decoration-none text-dark">
                    <div class="st-row d-flex align-items-center gap-2 py-2 px-1">
                        <div class="st-icon">
                            <img class="rounded-circle"
                                src="{{ $store->logo ? asset('public/uploads/stores/'.$store->logo) : '' }}"
                                alt="{{ $store->name }}">
                        </div>
                        <span class="st-name">{{ $store->name }}</span>
                        <span class="st-count text-muted">{{ $store->coupons_count }} Coupons</span>
                        <i class="fa fa-chevron-right text-muted" style="font-size:11px;"></i>
                    </div>
                </a>
                @endforeach

            </div>

            <div class="community-card site-banner p-4 rounded-4">
                <h6 class="fw-bold mb-1">
                    <i class="fa fa-users me-2"></i>Follow Our Community
                </h6>
                <p class="mb-3" style="font-size:12px;opacity:.85;">
                    Follow us for latest deals, coupons & shopping updates!
                </p>
                <div class="d-flex gap-2 flex-wrap">
                    @if(!empty($setting->fb_link))
                    <a href="{{ $setting->fb_link }}" class="btn btn-sm custom-btn"
                        style="background:#1877F2;color:#fff;border:none;">
                        <i class="fa-brands fa-facebook-f me-1"></i> Facebook
                    </a>
                    @endif
                    @if(!empty($setting->insta_link))
                    <a href="{{ $setting->insta_link }}" class="btn btn-sm custom-btn"
                        style="background:#E4405F;color:#fff;border:none;">
                        <i class="fa-brands fa-instagram me-1"></i> Instagram
                    </a>
                    @endif
                    @if(!empty($setting->pinterest_link))
                    <a href="{{ $setting->pinterest_link }}" class="btn btn-sm custom-btn"
                        style="background:#BD081C;color:#fff;border:none;">
                        <i class="fa-brands fa-pinterest-p me-1"></i> Pinterest
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Featured Deals --}}
    <div class="bg-white rounded-4 p-4 shadow-sm mb-bottom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0 fw-black" style="font-size:18px;">Featured Deals & Coupons</h2>
            <a href="{{ url('/coupons') }}" class="link btn custom-btn">
                View All <i class="fa fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="deals-scroll">
            <div class="d-flex deals-wrapper">
                @foreach($featuredCoupons as $coupon)
                <div class="deal-col">
                    <div class="deal-card h-100 d-flex flex-column p-3">

                        <div class="d-logo mb-2">
                            <img src="{{ $coupon->store && $coupon->store->logo
                                ? asset('public/uploads/stores/'.$coupon->store->logo)
                                : '' }}" alt="{{ $coupon->store->name ?? '' }}">
                        </div>

                        <div class="d-store mb-1">{{ $coupon->store->name ?? 'Store' }}</div>
                        <div class="d-title mb-1">{{ $coupon->name }}</div>
                        <div class="d-sub mb-2">{{ \Illuminate\Support\Str::limit(strip_tags($coupon->detail), 35) }}
                        </div>

                        @if($coupon->is_no_code == 0)
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="code-lbl">CODE</span>
                            <div class="code-box">
                                <span class="code-val">{{ $coupon->coupon_code }}</span>
                                <button class="copy-btn" onclick="copyCode('{{ $coupon->coupon_code }}',this)">
                                    <i class="fa fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        @endif

                        <div class="mt-auto">
                            <button class="btn w-100 custom-btn rounded-pill get-code-btn mb-2"
                                data-image="{{ asset('uploads/stores/'.($coupon->store->logo ?? '')) }}"
                                data-code="{{ $coupon->is_no_code == 1 ? ($coupon->store->store_url ?? '') : ($coupon->coupon_code ?? '') }}"
                                data-name="{{ $coupon->name ?? '' }}"
                                data-type="{{ $coupon->is_no_code == 1 ? 'deal' : 'code' }}">
                                {{ $coupon->is_no_code == 1 ? 'Get Deal' : 'Get Coupon' }}
                                <i class="fa fa-arrow-right ms-1"></i>
                            </button>
                            <div class="exp">
                                Exp:
                                <span>
                                    {{ !empty($coupon->end_date)
                                         ? \Carbon\Carbon::parse($coupon->end_date)->format('d M Y')
                                         : now()->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Features row --}}
        <div class="row g-0 mt-3">
            <div class="col-12">
                <div class="features-row d-flex">

                    <div class="feat d-flex align-items-start gap-2 p-3">
                        <div class="feat-icon" style="background:#d1fae5;">🆓</div>
                        <div>
                            <div class="feat-title">100% Free</div>
                            <div class="feat-desc">All coupons and deals are 100% free to use.</div>
                        </div>
                    </div>

                    <div class="feat d-flex align-items-start gap-2 p-3">
                        <div class="feat-icon" style="background:#ede9fe;">✅</div>
                        <div>
                            <div class="feat-title">Verified Coupons</div>
                            <div class="feat-desc">We verify & test all coupons before listing.</div>
                        </div>
                    </div>

                    <div class="feat d-flex align-items-start gap-2 p-3">
                        <div class="feat-icon" style="background:#fef3c7;">⭐</div>
                        <div>
                            <div class="feat-title">Top Deals</div>
                            <div class="feat-desc">We handpick the best deals from top stores.</div>
                        </div>
                    </div>

                    <div class="feat d-flex align-items-start gap-2 p-3">
                        <div class="feat-icon" style="background:#dbeafe;">🔒</div>
                        <div>
                            <div class="feat-title">Secure Shopping</div>
                            <div class="feat-desc">Shop with confidence using verified offers.</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- Popular Stores & Categories --}}
    <div class="bg-white rounded-4 p-4 shadow-sm">
        <div class="row g-4 align-items-stretch">

            <div class="col-12 col-md-6 border-end-md">
                <div class="h-100 d-flex flex-column pe-md-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold" style="font-size:16px;">Today's Popular Stores</span>
                        <a href="{{ url('/stores') }}" class="btn custom-btn link text-decoration-none">
                            View All <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>

                    <div class="d-flex align-items-start gap-1 flex-wrap">
                        @foreach($popularStores as $store)
                        <a href="{{ route('store.show', $store->slug) }}" class="text-decoration-none text-dark">
                            <div class="store-item">
                                <div class="s-logo-box">
                                    <img src="{{ $store->logo ? asset('public/uploads/stores/'.$store->logo) : '' }}"
                                        alt="{{ $store->name }}">
                                </div>
                                <span class="s-label">{{ $store->name }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>

                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="h-100 d-flex flex-column ps-md-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold" style="font-size:16px;">Trending Categories</span>
                        <a href="{{ url('/category') }}" class="link btn custom-btn text-decoration-none">
                            View All <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>

                    <div class="d-flex align-items-start gap-1 flex-wrap">
                        @foreach($popularCategories as $category)
                        <a href="{{ url('/coupon-categories/'.$category->slug) }}"
                            class="text-decoration-none text-dark">
                            <div class="cat-item">
                                <div class="cat-icon">
                                    @if($category->image)
                                    <img src="{{ asset('public/uploads/categories/'.$category->image) }}"
                                        style="width:24px;height:24px;object-fit:contain;" alt="{{ $category->name }}">
                                    @else
                                    <i class="fa fa-folder"></i>
                                    @endif
                                </div>
                                <span class="cat-label">{{ $category->name }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>


<script>
const eventDate = document.getElementById('eventDate').value;
if (eventDate) {
    const countDownDate = new Date(eventDate).getTime();
    const timer = setInterval(function() {
        const distance = countDownDate - new Date().getTime();
        if (distance < 0) {
            clearInterval(timer);
            ['days', 'hours', 'mins', 'secs'].forEach(id => document.getElementById(id).innerHTML = '00');
            return;
        }
        const pad = n => String(n).padStart(2, '0');
        document.getElementById('days').innerHTML = pad(Math.floor(distance / 86400000));
        document.getElementById('hours').innerHTML = pad(Math.floor((distance % 86400000) / 3600000));
        document.getElementById('mins').innerHTML = pad(Math.floor((distance % 3600000) / 60000));
        document.getElementById('secs').innerHTML = pad(Math.floor((distance % 60000) / 1000));
    }, 1000);
}

function copyCode(code, btn) {
    navigator.clipboard.writeText(code).then(() => {
        const i = btn.querySelector('i');
        i.className = 'fa fa-check';
        btn.style.color = '#10b981';
        setTimeout(() => {
            i.className = 'fa fa-copy';
            btn.style.color = '';
        }, 1500);
    });
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const slider = document.querySelector(".deals-scroll");

    setInterval(() => {

        slider.scrollLeft += 1;

        if (
            slider.scrollLeft + slider.clientWidth >= slider.scrollWidth
        ) {
            slider.scrollLeft = 0;
        }

    },);

});
</script>
@endsection