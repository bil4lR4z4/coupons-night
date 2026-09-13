@extends('layouts.app')

@section('title', 'Submit Coupons & Deals – CouponNight')
@section('meta_description', 'Submit coupon codes, promo offers, and online shopping deals to CouponNight and help shoppers save more.')

@section('content')

    <style>
       

        .form-card {
            margin-top: -40px;
            border-radius: 1.25rem;
        }

        .form-control:focus {
            border-color: #161b22;
            box-shadow: 0 0 0 .25rem rgba(139, 92, 246, 0.15);
        }

        .btn-gradient:hover {
            opacity: .95;
        }

        textarea.form-control {
            min-height: 120px;
        }
    </style>

    <div class=" text-white text-center py-5 site-banner">
        <div class="container py-3">
            <p class="small mb-2">Need Some Help</p>
            <h1 class="fw-bold mb-3">Submit a Coupon</h1>
            <p class="mb-0 mx-auto" style="max-width: 500px;">
                You have a working coupon want to share? Submit it here now to earn golds and get on the leaderboards.
            </p>
        </div>
    </div>

    <div class="container mb-bottom px-20">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">

                <div class="card shadow border-0 form-card">
                    <div class="card-body p-4 p-md-5">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('submit.coupon.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Store URL:</label>
                                <input type="url" name="store_url" value="{{ old('store_url') }}"
                                    class="form-control rounded-3" placeholder="https://google.com" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Coupon Code:</label>
                                <input type="text" name="coupon_code" value="{{ old('coupon_code') }}"
                                    class="form-control rounded-3" placeholder="Enter Coupon Code if have">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Description:</label>
                                <textarea name="description"
                                    class="form-control rounded-3">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Expiry Date:</label>
                                <input type="date" name="expiry_date" value="{{ old('expiry_date') }}"
                                    class="form-control rounded-3">
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">First Name:</label>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}"
                                        class="form-control rounded-3" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Last Name:</label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}"
                                        class="form-control rounded-3">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email:</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-3"
                                    required>
                            </div>

                            <div class="text-center pt-2">
                                <button type="submit"
                                    class="btn custom-btn text-white fw-semibold px-5 py-2 rounded-pill">
                                    Submit <i class="fa-solid fa-arrow-right ms-2 "></i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection