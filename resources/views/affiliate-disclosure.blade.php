@extends('layouts.app')

@section('title', 'Affiliate Disclosure – CouponNight')
@section('meta_description', 'Learn how CouponNight may earn affiliate commissions from qualifying purchases while helping users find verified deals and discounts.')

@section('content')

    <style>
        .form-card {
            border-radius: 1rem;
        }

        .underline-accent {
            width: 35px;
            height: 3px;
            border-radius: 2px;
        }

        .banner-box {
            border-left: 4px solid #000000;
            background: rgba(139, 92, 246, 0.08);
        }

        .banner-box p {
            text-align: justify;
        }
    </style>

    <div class="site-header  text-white text-center py-5 mb-bottom">
        <div class="container">
            <p class="small mb-1">Coupon Night</p>
            <h1 class="fw-bold mb-3">Affiliate Disclosure</h1>
            <p class="mb-0 mx-auto" style="max-width:500px;">
                Transparency is at the heart of everything we do. Here's how Coupon Night earns and how it affects you.
            </p>
        </div>
    </div>

    <div class="container mb-bottom px-20">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12">

                <p class="text-end text-muted small">
                    Last updated:
                    {{ $sections->count() ? $sections->max('updated_at')->format('F Y') : 'N/A' }}
                </p>

                <div class="p-3 rounded mb-4 banner-box">
                    <p class="mb-0 small text-dark">
                        🔗 Coupon Night participates in affiliate marketing programs. We may earn a small commission when
                        you purchase — at no extra cost.
                    </p>
                </div>

                @if(isset($sections) && $sections->count() > 0)
                    @foreach($sections as $section)
                        <div class="card shadow-sm border mb-4 form-card">
                            <div class="card-body p-4">
                                <h5 class="fw-bold">{{ $section->title }}</h5>
                                <div class="underline-accent site-header  mb-3"></div>

                                <div class="affiliate-content">
                                    {!! $section->description !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info text-center">
                        No Affiliate Disclosure Content Found
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection