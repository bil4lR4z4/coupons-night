@extends('layouts.app')

@section('title', 'Help Center & FAQs – CouponNight')
@section('meta_description', 'Find answers about coupon codes, promo offers, discounts, shopping deals, and how CouponNight works.')

@section('content')

<style>

.underline-accent{
    width:35px;
    height:3px;
    border-radius:2px;
}

/* Search Box */
.help-search-box{
    max-width:700px;
    margin:auto;
}

.help-search-box input{
    height:55px;
    border-radius:12px;
    padding-left:20px;
    border:1px solid #ddd;
    box-shadow:none !important;
}

.help-search-box button{
    height:55px;
    border-radius:12px;
    padding:0 25px;
}

.help-card{
    transition:0.3s;
}

.help-card:hover{
    transform:translateY(-3px);
}

</style>

<div class="site-header text-white text-center py-5 mb-bottom">

    <div class="container">

        <p class="mb-1 small">
            Help Center
        </p>

        <h1 class="fw-bold">
            How Can We Help You Save?
        </h1>

        {{-- Search --}}
        <div class="help-search-box mt-4">

            <input type="text"
                   id="helpSearch"
                   class="form-control"
                   placeholder="Search help topics...">

        </div>

    </div>

</div>

<div class="container mb-bottom px-20">

    <div class="row justify-content-center">

        <div class="col-xl-12 col-lg-12">

            @if(isset($helpFaqs) && $helpFaqs->count() > 0)

                <div id="helpFaqWrapper">

                    @foreach($helpFaqs as $faq)

                        <div class="card shadow-sm border-0 mb-4 rounded-3 help-card faq-item">

                            <div class="card-body p-4">

                                <h5 class="fw-bold faq-title">
                                    {{ $faq->title }}
                                </h5>

                                <div class="underline-accent site-header mb-3"></div>

                                <div class="text-muted mb-0 small faq-description">

                                    {!! $faq->description !!}

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                {{-- No Result --}}
                <div id="noResult"
                     class="alert alert-warning text-center d-none">

                    No matching help topic found

                </div>

            @else

                <div class="alert alert-info text-center">

                    No Help Content Found

                </div>

            @endif

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

document.getElementById('helpSearch').addEventListener('keyup', function () {

    let keyword = this.value.toLowerCase();

    let items = document.querySelectorAll('.faq-item');

    let found = false;

    items.forEach(function(item) {

        let title = item.querySelector('.faq-title').innerText.toLowerCase();

        let description = item.querySelector('.faq-description').innerText.toLowerCase();

        if (
            title.includes(keyword) ||
            description.includes(keyword)
        ) {

            item.style.display = 'block';

            found = true;

        } else {

            item.style.display = 'none';

        }

    });

    document.getElementById('noResult').classList.toggle('d-none', found);

});

</script>

@endpush