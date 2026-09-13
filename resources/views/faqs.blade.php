@extends('layouts.app')

@section('title', 'Help Center & FAQs – CouponNight')
@section('meta_description', 'Find answers about coupon codes, promo offers, discounts, shopping deals, and how CouponNight works.')

@section('content')

<style>


.faq-category {
    font-weight: 700;
    font-size: 13px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #8b5cf6;
    margin-top: 35px;
    margin-bottom: 15px;
}

.underline-line {
    height: 1px;
   
    flex: 1;
    margin-left: 10px;
} 

.contact-box {
   
    border-radius: 1rem;
}
.faq-content p{
    text-align: justify;
}
</style>

<!-- Hero -->
<div class="text-white site-header text-center py-5">
    <div class="container">
        <p class="small mb-1">Coupon Night</p>
        <h1 class="fw-bold mb-3">Frequently Asked Questions</h1>
        <p class="mb-0 mx-auto" style="max-width:500px;">
            Everything you need to know about saving money with Coupon Night.
        </p>
    </div>
</div>

<!-- Content -->
<div class="container mt-5 mb-bottom px-20">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12">
            @if(isset($sections) && $sections->count() > 0)
            <div class="accordion" id="faqAccordion">
                @foreach($sections as $section)
                <div class="accordion-item mb-3 border-0 rounded-3 overflow-hidden shadow-sm ">
                    <h2 class="accordion-header" id="heading{{ $section->id }}">
                        <button class="accordion-button shadow-none bg-white {{ !$loop->first ? 'collapsed' : '' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $section->id }}"
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                            aria-controls="collapse{{ $section->id }}">
                            {{ $section->title }}
                        </button>
                    </h2>

                    <div id="collapse{{ $section->id }}"
                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                        aria-labelledby="heading{{ $section->id }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <div class="faq-content">
                                {!! $section->description !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info text-center">
                No FAQs Found
            </div>
            @endif


            <!-- Contact CTA -->
            <div class="contact-box site-header text-white text-center p-4 mt-5">
                <h5 class="fw-bold">Still Have Questions?</h5>
                <p class="small mb-3">Contact our support team anytime.</p>
                <a href="{{ url('/contact') }}" class="btn custom-btn  fw-semibold rounded-pill px-4">
                    Contact Us
                </a>
            </div>

        </div>
    </div>
</div>

@endsection