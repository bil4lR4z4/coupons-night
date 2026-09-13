@extends('layouts.app')

@section('title', 'Contact CouponNight Support')
@section('meta_description', 'Contact CouponNight for support, partnership inquiries, coupon submissions, or help with deals and discount codes.')
@section('content')

<style>
    /* .contact-hero {
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
    } */

    .contact-card {
        margin-top: -45px;
        border-radius: 1.25rem;
    }

/* .contact-input {
    background-color: #13337481;
    border: 1px solid #2d3748;
    color: #f5f5f5;
} */
/* .contact-input::placeholder{

} */
.contact-input:focus {
    border-color: #25105a;
    box-shadow: 0 0 0 .25rem rgba(37, 16, 90, 0.18);
    background-color: #fff;
}
    /* .contact-btn {
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
        border: 0;
    } */

    .contact-btn:hover {
        opacity: .95;
        color: #fff;
    }

    textarea.contact-input {
        min-height: 140px;
        resize: vertical;
    }
    .logo-box{
    width:60px;
    height:60px;
    overflow:hidden;
}

.logo-img{
    width:100%;
    height:100%;
    object-fit:contain;
}

@media (max-width:768px){

    .logo-box{
        width:100px;
        height:100px; /* agar height bhi 100px chahiye */
    }

}
</style>

<div class=" site-banner contact-hero text-white text-center py-5 ">
    <div class="container py-4">
        <p class="text-uppercase small mb-2 fw-medium">Need Some Help</p>
        <h1 class="fw-bold mb-3">Contact Us</h1>
        <p class="mb-0 mx-auto" style="max-width: 420px;">
            Don't hesitate and give a message to the Coupon Night team.
        </p>
    </div>
</div>

<div class="container mb-bottom px-20">
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-10">
            <div class="card border-0 shadow contact-card">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">First Name:</label>
                                <input type="text" class="form-control contact-input rounded-3" placeholder="Enter first name" name="first_name" value="{{ old('first_name') }}">
                                @error('first_name')
                                    <span class="text-danger small fw-medium">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Last Name:</label>
                                <input type="text" class="form-control contact-input rounded-3" placeholder="Enter last name" name="last_name" value="{{ old('last_name') }}">
                                @error('last_name')
                                    <span class="text-danger small fw-medium">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email:</label>
                                <input type="email" class="form-control contact-input rounded-3" placeholder="Enter email address" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger small fw-medium">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Subject:</label>
                                <input type="text" class="form-control contact-input rounded-3" placeholder="Enter subject" name="subject" value="{{ old('subject') }}">
                                @error('subject')
                                    <span class="text-danger small fw-medium">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Message:</label>
                                <textarea class="form-control contact-input rounded-3" placeholder="Write your message here..." name="message">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-danger small fw-medium">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 text-center pt-2">
                                <button type="submit" class="btn custom-btn contact-btn text-white fw-semibold px-5 py-2 rounded-pill">
                                    Submit <i class="fa-solid fa-arrow-right ms-2 "></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

     
    </div>
</div>
<div class="container px-20">
        <div class="mb-bottom">
        <div class="card border-0 shadow-sm rounded-4 ">
            <div class="card-body p-lg-5 p-4">

                <div class="d-flex align-items-center gap-3 mb-4">
<div class="logo-box bg-white d-flex align-items-center justify-content-center">

    <img src="{{ asset($setting->favicone) }}"
         alt="Logo"
         class="logo-img">

</div>

                    <div>
                        <span class="badge px-3 py-2 rounded-pill mb-2">
                            Important Notice
                        </span>

                        <h2 class="fw-bold mb-0">
                            Why are you contacting us?
                        </h2>
                    </div>
                </div>

                <p class="text-secondary fs-6 mb-3">
                    We request that you maintain brevity in your query and be concise so that we may help you
                    more quickly.
                </p>

                <p class="text-secondary fs-6 mb-3">
                    In case you have questions pertaining to any particular store, offer, or
                    promotion, please do mention the name of the store along with the link of the webpage or
                    coupon code involved.
                </p>

                <p class="text-secondary fs-6 mb-4">
                    In case you would like to report any problems such as a discontinued
                    coupon code or a dead link on any page of ours, please do mention the specific page link
                    and let us know what trouble you are facing. We will then verify the matter and resolve it
                    immediately.
                </p>

                <div class="row g-3">

                    <div class="col-lg-4 col-md-6">
                        <div class="border rounded-3 p-3 h-100 bg-light">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span class="fw-semibold">
                                    Mention Store Name
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="border rounded-3 p-3 h-100 bg-light">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span class="fw-semibold">
                                    Add Coupon/Page Link
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="border rounded-3 p-3 h-100 bg-light">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span class="fw-semibold">
                                    Explain Your Problem Briefly
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
   

@endsection