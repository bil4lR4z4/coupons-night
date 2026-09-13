@php 
use App\Models\Setting;
$setting = Setting::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <meta name="description" content="@yield('meta_description', 'Default description here')">
    <meta name="keywords" content="@yield('meta_keywords', 'default, keywords')">
        <!-- Google Search Console Verification -->
    <meta name="google-site-verification" content="VAuHmZizmM8qqpIT20WDVjEzBi_avi8jyzJ4Z28Qeps" />
    <link rel="icon" type="image/png" href="{{ asset($setting->favicone ?? '') }}">
    
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/store.css') }}" rel="stylesheet">
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/swiper.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @php
        $headerBgStyle = setting('header_bg_type', 'gradient') === 'gradient'
            ? 'linear-gradient('
                . setting('header_gradient_direction', '90deg') . ', '
                . setting('header_gradient_color_1', '#8B2500') . ' 0%, '
                . setting('header_gradient_color_2', '#E8735A') . ' 100%)'
            : setting('header_solid_color', '#C0392B');

        $buttonBgStyle = setting('button_bg_type', 'gradient') === 'gradient'
            ? 'linear-gradient('
                . setting('button_gradient_direction', '90deg') . ', '
                . setting('button_gradient_color_1', '#A93226') . ' 0%, '
                . setting('button_gradient_color_2', '#E74C3C') . ' 100%)'
            : setting('button_solid_color', '#C0392B');

        $footerBgStyle = setting('footer_bg_type', 'gradient') === 'gradient'
            ? 'linear-gradient('
                . setting('footer_gradient_direction', '90deg') . ', '
                . setting('footer_gradient_color_1', '#111111') . ' 0%, '
                . setting('footer_gradient_color_2', '#333333') . ' 100%)'
            : setting('footer_solid_color', '#212529');
    @endphp

    <style>
        :root {
            --header-bg-style: {{ $headerBgStyle }};
            --header-text-color: {{ setting('header_text_color', '#FFFFFF') }};

            --button-bg-style: {{ $buttonBgStyle }};
            --button-text-color: {{ setting('button_text_color', '#FFFFFF') }};

            --footer-bg-style: {{ $footerBgStyle }};
            --footer-text-color: {{ setting('footer_text_color', '#FFFFFF') }};

            --link-color: {{ setting('link_color', '#C0392B') }};
            --link-hover-color: {{ setting('link_hover_color', '#8E2B20') }};
            --text-hover-color: {{ setting('text_hover_color', '#C0392B') }};
            --banner-bg-style: {{ setting('banner_bg_type', 'gradient') === 'gradient'
                 ? 'linear-gradient('
                      . setting('banner_gradient_direction', '90deg') . ', '
                      . setting('banner_gradient_color_1', '#8B2500') . ' 0%, '
                      . setting('banner_gradient_color_2', '#E8735A') . ' 100%)'
                      : setting('banner_solid_color', '#C0392B') }};
        }

        body {
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
        }

        p,
        span,
        li,
        input,
        textarea,
        select,
        label,
        small {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .fw-bold,
        .fw-semibold,
        .navbar,
        .nav-link,
        .btn {
            font-family: 'Plus Jakarta' !important;
        }

        .site-header {
            background: var(--header-bg-style);
            color: var(--header-text-color);
        }
        .site-banner {
          background: var(--banner-bg-style);
          color: var(--header-text-color);
        }
        .site-header a,
        .site-header .nav-link {
            color: var(--header-text-color);
        }

        .site-header a:hover,
        .site-header .nav-link:hover {
            color: var(--header-text-color);
            opacity: .85;
        }
.btn.custom-btn {
    font-family: 'Plus Jakarta Sans' !important;
    background: var(--button-bg-style);
    color: var(--button-text-color);
    border: none;
    position: relative;
    z-index: 1;
    font-weight: 600;
    overflow: hidden;
    text-transform: capitalize;
    /* display: inline-flex; */
    align-items: center;
    /* gap: 8px; */
}

.btn.custom-btn::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 60%;
    height: 100%;
    background: rgba(255, 255, 255, 0.25);
    transform: skewX(-25deg);
    transition: all 0.6s ease;
    z-index: 0;
}

.btn.custom-btn:hover::before {
    left: 120%;
}

/* Arrow Animation */
.btn.custom-btn i {
    transition: transform 0.3s ease;
    position: relative;
    z-index: 2;
}

.btn.custom-btn:hover i {
    transform: translateX(5px);
}
.latest-product-card{
    border-radius: 28px;
    background: #fff;
    box-shadow: 0 10px 35px rgba(0,0,0,0.08);
    transition: .3s ease;
}

.latest-product-card:hover{
    transform: translateY(-4px);
}

.latest-product-image{
    position: relative;
    background: #f8f8fb;
    text-align: center;
}

.latest-product-image img{
    width: 100%;
    max-height: 340px;
    object-fit: contain;
    transition: .35s ease;
}

.latest-product-card:hover .latest-product-image img{
    transform: scale(1.04);
}

/* Discount Badge */
.latest-discount-badge{
    background: var(--header-bg-style);
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    padding: 8px 16px;
    border-radius: 50px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}


.latest-product-title{
    font-size: 30px;
    line-height: 1.2;
    color: #111827;
}


/* .latest-product-desc{
    color: #6b7280;
    font-size: 15px;
    line-height: 1.6;
 min-height: 45px; 
} */


/* .latest-price{
    font-size: 32px;
    font-weight: 800;
    color: #111827;
} */

/* .latest-old-price{
    font-size: 18px;
    color: #9ca3af;
    text-decoration: line-through;
} */

/* Button */
/* .latest-shop-btn{
    font-size: 16px;
    font-weight: 700;
} */

/* Responsive */
/* @media(max-width:991px){

    .latest-product-image{
        padding: 30px 20px 10px;
    }

    .latest-product-image img{
        max-height: 240px;
    }

    .latest-product-title{
        font-size: 24px;
    }

    .latest-price{
        font-size: 26px;
    }

    .latest-old-price{
        font-size: 16px;
    }
} */
        .badge {
            background: var(--button-bg-style);
            color: var(--button-text-color);
            border: none;
        }
        .badge:hover {
              
              color: var(--button-text-color);
              opacity: .95;
        }
        
        .btn-theme {
            background: var(--button-bg-style);
            color: var(--button-text-color);
            border: none;
        }

        .btn-theme:hover {
            color: var(--button-text-color);
            opacity: .95;
        }

        footer {
            background: var(--footer-bg-style);
            color: var(--footer-text-color);
        }

        footer a.nav-link {
            color: var(--footer-text-color) !important;
        }

        footer a.nav-link:hover {
            color: var(--footer-text-color);
            opacity: .85;
        }

        .icon {
            text-decoration: none;
            width: 27.5px;
            height: 27.5px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            background: var(--link-color);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            font-size: 12px;
        }

        .icon:hover {
            background: var(--link-hover-color);
            color: var(--text-hover-color);
        }

        .link {
            color: var(--link-color);
        }

        a.link:hover {
            color: var(--link-hover-color);
        }

        header nav .nav-link {
            color: #4B5563 !important;
            font-weight: 600 !important;
        }

        header nav .active {
            color: var(--link-color) !important;
        }

        .discount-badge {
            position: absolute;
            top: 0;
            border-radius: 50rem;
            font-size: 12px;
            padding: 4px 8px;
            margin: 16px;
            color: var(--button-text-color);
            background: {{ setting('button_gradient_color_1', '#F97316') }};
        }


/* Chrome, Edge, Safari */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #161b22;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #25105a 0%, #1e3d6e 100%);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #25105a 0%, #1e3d6e 100%);
}

/* Firefox */
html {
    scrollbar-color: #ffaa03 #241057;
    scrollbar-width: thin;
}
    .mb-bottom{
        margin-bottom: 90px;
        
    }
    .pagination .page-link {
    color: #25105a;
    border-color: #dee2e6;
    box-shadow: none !important;
}

.pagination .page-link:hover {
    color: #fff;
    background: linear-gradient(90deg, #161b22 0%, #25105a 100%);
    border-color: #25105a;
}

.pagination .page-item.active .page-link {
    color: #fff;
    background: linear-gradient(90deg, #161b22 0%, #25105a 100%);
    border-color: #25105a;
}

.pagination .page-link:focus {
    box-shadow: none;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d;
}
    @media (max-width: 991px){
        .mb-bottom{
            margin-bottom: 60px;
        }
        .px-20{
            padding-left: 20px;
            padding-right: 20px;
        }
        h1{
        font-size: 1.6rem !important;
        line-height: 1.2;
    }

    h2{
        font-size: 1.4rem !important;
        line-height: 1.25;
    }

    h3{
        font-size: 1.2rem !important;
        line-height: 1.3;
    }

    h4{
        font-size: 1.05rem !important;
        line-height: 1.35;
    }

    h5{
        font-size: 0.9rem !important;
        line-height: 1.4;
    }

    h6{
        font-size: 0.8rem !important;
        line-height: 1.4;
    }
        .btn.custom-btn{
        font-size: 10px !important;
    }

    .btn.custom-btn i{
        margin: 0 !important;
    }
    }
    .swiper-wrapper{
        height:auto !important
    }


#scrollTopBtn{
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    border: none;
    border-radius: 50%;
    background: var(--button-bg-style);
    color: var(--button-text-color);
    font-size: 24px;
    cursor: pointer;
    display: none;
    z-index: 9999;
}

#scrollTopBtn:hover{
    background:var(--button-bg-style);
}
    </style>

    @stack('styles')
</head>

<body class="bg-light">

    <x-header />

    @yield('content')

    <x-footer />

    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered model-lg"> 
            <div class="modal-content position-relative">
                <div class="modal-header border-0 site-banner"> 
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" data-bs-theme="dark" aria-label="Close"></button> 
                </div> 
                <div class=" "  id="setHTML">

                </div>
            </div> 
        </div> 
    </div>
<button id="scrollTopBtn">↑</button>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Swiper !== 'undefined' && document.querySelector('.mySwiper')) {
                new Swiper(".mySwiper", {
                    slidesPerView: 4,
                    spaceBetween: 20,
                    loop: true,

                    autoplay: {
                        delay: 2500,
                        disableOnInteraction: false,
                    },

                    navigation: {
                        nextEl: ".custom-swiper-next",
                        prevEl: ".custom-swiper-prev",
                    },

                    breakpoints: {
                        0: {
                            slidesPerView: 1
                        },
                        576: {
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
            }

            if (document.querySelector('.storeSwiper')) {
                new Swiper(".storeSwiper", {
                    slidesPerView: 7,
                    spaceBetween: 20,
                    loop: true,
                    speed: 4000,

                    autoplay: {
                        delay: 0,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: false,
                    },
                    freeMode: true,
                    allowTouchMove: false,

                    breakpoints: {
                        0: {
                            slidesPerView: 2
                        },
                        576: {
                            slidesPerView: 3
                        },
                        768: {
                            slidesPerView: 5
                        },
                        992: {
                            slidesPerView: 7
                        }
                    }
                });
            }
        });

        document.querySelectorAll('.get-code-btn').forEach(button => {
            button.addEventListener('click', function () {

                let image = this.dataset.image;
                let code = this.dataset.code;
                let name = this.dataset.name;
                let type = this.dataset.type;
                let link = this.dataset.link;

                let html = '';
                let model = false;
                if (type === 'code') {
                    html = `
                        <div class="modal-body d-flex flex-column align-items-center site-banner text-center">

                            <img src="${image}" 
                                alt="" 
                                class="img-thumbnail rounded-circle position-absolute start-50 translate-middle" 
                                style="height:100px; width:100px ; top: -50px">
                            <p class="text-capitalize">Here is your coupon code</p>
                            <div class="input-group w-75 mb-3 px-5">
                                <input 
                                    type="text"
                                    class="form-control text-center coupon-code"
                                    value="${code}"
                                    readonly
                                >

                                <button 
                                    class="btn custom-btn copy-btn"
                                    type="button" data-link="${link}">
                                    Copy
                                </button>
                            </div>
                            <p class="text-light">Copy and Paste Code at Checkout</p>
                        </div> 
                        <div class="modal-footer justify-content-center">
                            <h5 class="fw-bold my-3">${name}</h5>
                        </div> 
                    `;
                    model= true
                } else if (type === 'deal'){
                    html = `
                        <div class="modal-body site-banner text-center">

                            <img src="${image}" 
                                alt="" 
                                class="img-thumbnail rounded-circle position-absolute start-50 translate-middle" 
                                style="height:100px; width:100px; top: -50px">
                            <p class="text-capitalize text-center">Here is your deal</p>
                            <div class="text-center">
                                <a href="${link}"
                                    class="btn custom-btn rounded-pill"
                                    target="_blank"
                                    rel="noopener noreferrer">
                                    Activate Now
                                </a>
                            </div>
                        </div> 
                        <div class="modal-footer justify-content-center">
                            <h5 class="fw-bold my-3">${name}</h5>
                        </div> 
                    `;
                    model= true
                }

                document.getElementById('setHTML').innerHTML = html;

                if(model){
                    let modal = new bootstrap.Modal(
                        document.getElementById('couponModal')
                    );
                    modal.show();
                }
            });
        });

        document.addEventListener('click', function(e) {
            
            if (e.target.classList.contains('copy-btn')) {
                
                let code = document.querySelector('.coupon-code').value;
                let link = e.target.getAttribute('data-link');
                navigator.clipboard.writeText(code)
                    .then(() => {
                        e.target.innerText = "Copied!";
                        if (link && link.trim() !== '') {
                            window.open(link, '_blank');
                        }
                        setTimeout(() => {
                            e.target.innerText = "Copy";
                        }, 2000);
                    });
            }
        });

        $(document).ready(function () {
            $('.mega-menu').on('click', function (e) {
                e.stopPropagation();
            });
            $('.blog-category').click(function(e){
                e.preventDefault();
                e.stopPropagation();

                let categoryId = $(this).attr('data-id');
                $('.blog-category').removeClass('active');
                $(this).addClass('active');
                $('.blog-list').hide();
                $('#blog-' + categoryId).show();
            });
        });

        
    </script>

    <script>
        $(document).ready(function(){

            $(document).on('keyup', '.storeSearch', function(){

                let input = $(this);
                let parent = input.closest('.searchBox');
                let resultsBox = parent.find('.searchResults');

                let search = input.val();

                if(search.length < 1){
                    resultsBox.addClass('d-none').html('');
                    return;
                }

                $.ajax({
                    url: "{{ route('search.store.ajax') }}",
                    type: "GET",
                    data: {
                        search: search
                    },

                    success:function(response){

                        let html = '';

                        if(response.length > 0){

                            response.forEach(function(store){

                                html += `
                                    <a href="/store/${store.slug}" 
                                    class="d-flex align-items-center gap-3 text-decoration-none text-dark p-3 border-bottom border-secondary search-item">

                                        <img src="/uploads/stores/${store.logo}" 
                                            style="width:45px !important; height:45px"
                                            class="rounded-circle object-fit-cover">

                                        <div>
                                            <div class="fw-semibold">
                                                ${store.name}
                                            </div>

                                            <small class="text-secondary">
                                                View Store
                                            </small>
                                        </div>

                                    </a>
                                `;
                            });

                        }else{

                            html = `
                                <div class="p-3 text-dark">
                                    No store found
                                </div>
                            `;
                        }

                        resultsBox
                            .removeClass('d-none')
                            .html(html);
                    }
                });

            });

            $(document).on('click', function(e){

                if(!$(e.target).closest('.searchBox').length){
                    $('.searchResults').addClass('d-none');
                }

            });

        });
    </script>
<script>
const scrollTopBtn = document.getElementById("scrollTopBtn");

window.addEventListener("scroll", () => {
    scrollTopBtn.style.display =
        window.scrollY > 300 ? "block" : "none";
});

scrollTopBtn.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});
</script>
    @stack('scripts')
</body>

</html>