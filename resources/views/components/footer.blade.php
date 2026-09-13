<footer class="footer-section">

    <div class="container pt-5 pb-4">

        <div class="footer-grid">

            <!-- Logo -->
            <div class="footer-column footer-about">
      <a href="{{ route('home') }}">
                <img src="{{ asset($setting->footer_logo ?? '') }}"
                    alt="logo"
                    class="footer-logo">
</a>
                <p class="footer-description">
                    {{ $setting->site_description }}
                </p>

            </div>

            <!-- Explore -->
            <div class="footer-column">

                <h6 class="footer-title">Explore</h6>

                <ul class="footer-links">

                    <li>
                        <a href="{{route('home')}}">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('categories.page') }}">
                            Categories
                        </a>
                    </li>

                    <li>
                        <a href="{{route('stores.page')}}">
                            Stores
                        </a>
                    </li>

                    <li>
                        <a href="{{route('all-events')}}">
                            Events
                        </a>
                    </li>
                    <li>
                        <a href="{{route('coupons')}}">
                            Coupons
                        </a>
                    </li>


                </ul>

            </div>

            <!-- Popular -->
            <div class="footer-column">

                <h6 class="footer-title">Popular Pages</h6>

                <ul class="footer-links">

                    <li>
                        <a href="{{route('front.product')}}">
                            Product Deals
                        </a>
                    </li>

                    <li>
                        <a href="{{route('stores.page')}}">
                            All Stores
                        </a>
                    </li>
                                        <li>
                        <a href="{{route('upcoming')}}">
                            Upcoming Events
                        </a>
                    </li>

                    <li>
                        <a href="{{route('blog')}}">
                            Blog
                        </a>
                    </li>

                    <li>
                        <a href="{{route('exclusive.page')}}">
                            Exclusive Discounts
                        </a>
                    </li>

                </ul>

            </div>

            <!-- Support -->
            <div class="footer-column">

                <h6 class="footer-title">Support</h6>

                <ul class="footer-links">

                    <li>
                        <a href="{{route('help')}}">
                            Help Center
                        </a>
                    </li>

                    <li>
                        <a href="{{route('faq.page')}}">
                            FAQs
                        </a>
                    </li>

                    <li>
                        <a href="{{route('contact')}}">
                            Contact Us
                        </a>
                    </li>

                    <li>
                        <a href="{{route('submit.coupon')}}">
                            Submit Offer
                        </a>
                    </li>

                    <li>
                        <a href="{{route('affiliate.page')}}">
                            Affiliate Disclosure
                        </a>
                    </li>

                </ul>

            </div>

            <!-- Company -->
            <div class="footer-column">

                <h6 class="footer-title">Company</h6>

                <ul class="footer-links">

                    <li>
                        <a href="{{url('about')}}">
                            About Us
                        </a>
                    </li>

                    <li>
                        <a href="{{route('privacy.page')}}">
                            Privacy Policy
                        </a>
                    </li>

                    <li>
                        <a href="{{route('terms.page')}}">
                            Terms of Service
                        </a>
                    </li>

                    <li>
                        <a href="{{route('disclaimer.page')}}">
                            Disclaimer
                        </a>
                    </li>

                </ul>

            </div>

            <!-- Connect -->
            <div class="footer-column">

                <h6 class="footer-title">Connect</h6>

                <div class="footer-social">

                    @if(!empty($setting->insta_link))
                    <a href="{{ $setting->insta_link }}"
                        target="_blank"
                        class="social-icon btn custom-btn">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    @endif

                    @if(!empty($setting->fb_link))
                    <a href="{{ $setting->fb_link }}"
                        target="_blank"
                        class="social-icon btn custom-btn">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    @endif

                    @if(!empty($setting->youtube_link))
                    <a href="{{ $setting->youtube_link }}"
                        target="_blank"
                        class="social-icon btn custom-btn">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    @endif

                    @if(!empty($setting->pinterest_link))
                    <a href="{{ $setting->pinterest_link }}"
                        target="_blank"
                        class="social-icon btn custom-btn">
                        <i class="fa-brands fa-pinterest-p"></i>
                    </a>
                    @endif

                    @if(!empty($setting->x_link))
                    <a href="{{ $setting->x_link }}"
                        target="_blank"
                        class="social-icon btn custom-btn">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    @endif

                </div>

            </div>

        </div>

        <hr class="footer-divider">

        <p class="footer-copyright">
            © 2026 Coupon Night. All rights reserved.
        </p>

    </div>

</footer>

<style>
.footer-section .btn.custom-btn i,
.footer-section .btn.custom-btn:hover i {
    transform: none !important;
    transition: none !important;
}
.footer-section{
    background: linear-gradient(90deg, #071321 0%, #22085f 100%);
}

.footer-grid{
    display:grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr;
    gap:50px;
    align-items:start;
}

.footer-logo{
    width:190px;
    margin-bottom:22px;
}

.footer-description{
    color:#fff;
    opacity:.75;
    font-size:15px;
    line-height:1.9;
    max-width:300px;
    margin:0;
}

.footer-title{
    color:#fff;
    font-size:18px;
    font-weight:700;
    margin-bottom:12px;
}

.footer-links{
    list-style:none;
    margin:0;
    padding:0;
    display:flex;
    flex-direction:column;
    gap:6px;
}

.footer-links li a{
    color:#fff;
    text-decoration:none;
    font-size:12px;
    transition:.3s ease;
}

.footer-links li a:hover{
    color:#ffb703;
    padding-left:4px;
}

.footer-social{
    display:flex;
    align-items:center;
    gap:10px;
    flex-wrap:wrap;
}

.social-icon{
    width:32px;
    height:32px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    text-decoration:none;
    font-size:15px;
}

.footer-divider{
    border-color:rgba(255, 255, 255, 0.97);
    margin:45px 0 20px;
}

.footer-copyright{
    text-align:center;
    color:#fff;
    opacity:.75;
    font-size:14px;
    margin:0;
}

@media(max-width:1200px){

    .footer-grid{
        grid-template-columns: repeat(3,1fr);
        gap:40px;
    }

}

@media(max-width:768px){

    .footer-grid{
        grid-template-columns: repeat(2,1fr);
    }

}

@media(max-width:576px){

    .footer-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .footer-title{
        font-size:20px;
    }

}

</style>