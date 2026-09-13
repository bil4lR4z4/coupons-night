@extends('layouts.app')

@section('title', 'Blog')

@section('content')

    <div class="container">
        <div class="row px-5 px-lg-0">
            <div class="col-12 my-5 ">

                <!-- Top breadcrumb/title line -->
                <div class=" d-flex flex-wrap align-items-center gap-3 mb-4 plusJakartaSans ">

                    <a href="#" class="text-decoration-none text-dark fw-bold " style="font-size:18px;">Home</a>

                    <div class="vr d-none d-sm-block"></div>

                    <span class=" article-top-title col-lg-4 col-8 " style="font-size:20px; color: #B71422; font-weight: 700; ">
                        What Is Amazon TACoS And Why It Matters 3
                    </span>
                </div>

                <div class="row  gx-4 gx-lg-5">
                    <!-- Left Content -->
                    <div class="col-lg-6 pt-4">
                        <h1 class="display-2  lh-1 mb-4 plusJakartaSans" style="font-size:56px; font-weight: 700;">
                            What Is Amazon
                            TACoS And Why It
                            Matters 3
                        </h1>

                        <p class=" mb-4 inter" style="font-size:18px; font-weight: 500; color:#595C5D;">
                            Explore the real meaning of Amazon TACoS, its difference from ACoS,
                            and learn how to leverage it for smarter ad decisions and scalable
                            ecommerce growth.
                        </p>

                        <div class="d-flex flex-column gap-2 inter"
                            style="font-size:18px; font-weight: 500; color:#595C5D;">
                            <span>March 18, 2026</span>
                            <span>Amplivus</span>
                            <span>Educational</span>
                            <span>October 16, 2025 | 5 min read</span>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="col-lg-6 pe-0 text-center">
                        <div class=" p-0">
                            <img src="{{ asset('images/store/featured_blog.png') }}" alt="Amazon TACoS" class="img-fluid "
                                style="height:350px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 py-4 tacos-page">

                <div class="row g-4">

                    <!-- TOC -->
                    <div class="col-lg-4 ">
                        <div class="toc-box position-sticky ">
                            <div class="p-5 p-lg-3 top-0 toc shadow ">
                                <h5 class="fw-bold mb-3 plusJakartaSans " style="font-size:20px;">Table Of Contents</h5>
                                <hr class="mt-0 mb-3">

                                <ul class="list-unstyled mb-4">
                                    <li><a href="#home">Home</a></li>
                                    <li><a href="#what-is-tacos">What Is Amazon TACoS And ...</a></li>
                                    <li><a href="#share-1">Share This Article</a></li>
                                    <li><a href="#share-2">Share This Article</a></li>
                                    <li><a href="#introduction">Introduction</a></li>
                                    <li><a href="#what-is-tacos-amazon">What Is TACoS In Amazon PPC</a></li>
                                    <li><a href="#why-different">Why TACoS Is Different From ...</a></li>
                                    <li><a href="#calculate">How To Calculate TACoS</a></li>
                                    <li><a href="#important">Why TACoS Is Important For ...</a></li>
                                    <li><a href="#profitability">Profitability And Efficiency</a></li>
                                    <li><a href="#organic-growth">Organic Growth</a></li>
                                    <li><a href="#spot-red-flags">Spot Red Flags Early</a></li>
                                    <li><a href="#good-tacos">What Is A Good TACoS For A ...</a></li>
                                    <li><a href="#factors">Factors That Influence TACoS</a></li>
                                    <li><a href="#strategies">Strategies To Improve Your ...</a></li>
                                    <li><a href="#refine-targeting">Refine Targeting</a></li>
                                    <li><a href="#optimize-listings">Optimize Product Listings</a></li>
                                    <li><a href="#monitor-campaigns">Monitor And Adjust Campai...</a></li>
                                    <li><a href="#monitor-trends">Monitoring TACoS Trends</a></li>
                                    <li><a href="#elevate">Elevate Your Amazon Strategy</a></li>
                                    <li><a href="#key-takeaways">Key Takeaways At A Glance</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-3 mt-4  plusJakartaSans" style="font-size;24px; font-weight:700; color:black;">Popular Categories</h4>

                                <div class="d-flex flex-wrap gap-2 inter">
                                    <span class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border bg-white">AI
                                        Tools</span>
                                    <span class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Art
                                        &amp;
                                        Craft</span>
                                    <span
                                        class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Automotive</span>
                                    <span class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Baby
                                        &amp;
                                        Toddler
                                        toys</span>
                                    <span
                                        class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Daily
                                        Deals</span>
                                    <span
                                        class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Business
                                        &amp;
                                        Finance</span>
                                    <span
                                        class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Clothing
                                        &amp;
                                        Fashion</span>
                                    <span class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">AI
                                        Tools</span>
                                    <span class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Art
                                        &amp;
                                        Craft</span>
                                    <span
                                        class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Automotive</span>
                                    <span class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Baby
                                        &amp;
                                        Toddler
                                        toys</span>
                                    <span
                                        class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Daily
                                        Deals</span>
                                    <span
                                        class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Business
                                        &amp;
                                        Finance</span>
                                    <span
                                        class="badge rounded-pill text-bg-light px-3 py-2 fw-normal border  bg-white">Clothing
                                        &amp;
                                        Fashion</span>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-bold mt-4 mb-3 plusJakartaSans">Share This Article</h5>
                                <div class="d-flex gap-3 social-icons">
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- CONTENT -->
                    <div class="col-lg-8 ps-lg-5">
                        <div class="content-box">

                            <section id="home">
                                <h2 class="fw-bold mb-3 plusJakartaSans">Introduction</h2>
                                <p>
                                    Did you know that 35% of sellers say they struggle to measure the effectiveness of their
                                    Amazon PPC campaigns?
                                    Your advertising strategy might be costing you more than it should, but there’s a fix.
                                </p>
                                <p>
                                    Say hello to TACoS (Total Advertising Cost of Sale), one of the most critical metrics
                                    for Amazon sellers aiming to find the perfect balance between ad spend and
                                    profitability.
                                </p>
                                <p>
                                    If you’ve been navigating the world of Amazon PPC advertising, understanding TACoS could
                                    be your game-changing advantage.
                                </p>
                                <p>
                                    From optimizing your ad budgets to boosting your organic sales, this guide will break
                                    down TACoS, show you how it compares to ACoS, and share actionable strategies to improve
                                    this essential metric.
                                </p>
                            </section>

                            <section id="what-is-tacos" class="mt-4">
                                <h2 class="fw-bold mb-3 plusJakartaSans">What is TACoS in Amazon PPC</h2>
                                <p>
                                    TACoS stands for Total Advertising Cost of Sale, a metric that evaluates your
                                    advertising spend in relation to your total revenue, encompassing both ad-attributed
                                    sales and organic sales.
                                </p>
                                <p>
                                    Unlike ACoS (Advertising Cost of Sale), which focuses solely on ad-driven revenue, TACoS
                                    provides a holistic view of your advertising strategy’s effectiveness in driving both
                                    paid and organic growth.
                                </p>
                                <p><strong>TACoS Formula:</strong></p>
                                <p>TACoS = (Advertising Spend / Total Revenue) × 100</p>
                                <p>
                                    This metric reflects how well your ads contribute to overall business growth. A lower
                                    TACoS indicates that your advertising spend is effectively stimulating organic sales and
                                    profitability, while a higher TACoS suggests an over-reliance on paid advertising.
                                </p>
                            </section>

                            <section id="why-different" class="mt-4">
                                <h2 class="fw-bold mb-3 plusJakartaSans">Why TACoS is Different From ACoS</h2>
                                <p>
                                    ACoS measures ad spend as a percentage of ad-attributed sales.
                                </p>
                                <p>ACoS = (Advertising Spend ÷ Ad Revenue) × 100</p>
                                <p>
                                    TACoS includes both ad-attributed and organic revenue, offering a more comprehensive
                                    picture:
                                </p>
                                <p>TACoS = (Advertising Spend ÷ Total Revenue) × 100</p>
                                <p>
                                    While ACoS shows you the effectiveness of individual ad campaigns, TACoS evaluates
                                    overall profitability and ad impact on organic growth. For sellers looking to scale
                                    sustainably, TACoS is indispensable.
                                </p>
                            </section>

                            <section id="calculate" class="mt-4">
                                <h2 class="fw-bold mb-3 plusJakartaSans">How to Calculate TACoS</h2>
                                <p>
                                    Calculating your TACoS is simpler than you’d think. All you need to know is your monthly
                                    ad spend and total revenue (ad-attributed + organic sales).
                                </p>
                                <p><strong>Example:</strong></p>
                                <ul>
                                    <li>Monthly ad spend = $2,000</li>
                                    <li>Total revenue = $20,000</li>
                                    <li>TACoS = (2,000 ÷ 20,000) × 100 = 10%</li>
                                </ul>
                                <p>
                                    This means for every $1 spent on ads, $10 was earned in total revenue.
                                </p>
                            </section>

                            <section id="important" class="mt-4">
                                <h2 class="fw-bold mb-3 plusJakartaSans">Why TACoS is Important for Amazon Sellers</h2>
                                <p>
                                    Understanding TACoS gives you deeper insights into your Amazon business’s profitability
                                    and advertising strategy. Here’s why it matters:
                                </p>
                            </section>

                            <section id="profitability" class="mt-4">
                                <h3 class="fw-bold mb-3 plusJakartaSans">Profitability And Efficiency</h3>
                                <p>
                                    TACoS helps track your ad spend’s impact on overall profitability, so you know whether
                                    your budget is being well-spent.
                                </p>
                            </section>

                            <section id="organic-growth" class="mt-4">
                                <h3 class="fw-bold mb-3 plusJakartaSans">Organic Growth</h3>
                                <p>
                                    Ads don’t just drive immediate sales; they also improve organic rankings by boosting
                                    your Best Sellers Rank. A rising rank equals increased discoverability.
                                </p>
                            </section>

                            <section id="spot-red-flags" class="mt-4">
                                <h3 class="fw-bold mb-3 plusJakartaSans">Spot Red Flags Early</h3>
                                <p>
                                    A sudden spike in TACoS could signal inefficient ad targeting or declining product
                                    performance, helping you pivot quickly.
                                </p>
                            </section>

                            <section id="good-tacos" class="mt-4">
                                <h2 class="fw-bold mb-3 plusJakartaSans">What is a Good TACoS for Amazon Businesses?</h2>
                                <p>
                                    The “ideal” TACoS largely depends on your product’s lifecycle, margins, and industry.
                                    However, 5–10% is generally considered optimal.
                                </p>
                                <ul>
                                    <li><strong>Established Products:</strong> Aim for 5–8%</li>
                                    <li><strong>New Product Launches:</strong> TACoS as high as 20–25%</li>
                                    <li><strong>Low-Margin Products:</strong> Expect 10–15%</li>
                                </ul>
                                <p>
                                    Maintaining or reducing TACoS over time is a positive indicator that your organic sales
                                    are growing.
                                </p>
                            </section>

                            <section id="factors" class="mt-4">
                                <h2 class="fw-bold mb-3 plusJakartaSans">Factors That Influence TACoS</h2>
                                <p>
                                    Understanding what drives TACoS is key to sustaining profitability. Here are some common
                                    factors that influence it:
                                </p>
                                <ul>
                                    <li><strong>Product Margins:</strong> Higher profit margins give more room for ad
                                        investments.</li>
                                    <li><strong>Competition:</strong> More competition equals higher ad bids.</li>
                                    <li><strong>Ad Targeting:</strong> Broad or incorrect targeting can inflate ad costs.
                                    </li>
                                    <li><strong>Product Lifecycle:</strong> Launch vs. maturity changes ad spend needs.</li>
                                </ul>
                            </section>

                            <section id="strategies" class="mt-4">
                                <h2 class="fw-bold mb-3 plusJakartaSans">Strategies to Improve Your TACoS</h2>
                                <p>
                                    Lowering your TACoS while enhancing sales efficiency is all about refining your
                                    approach.
                                </p>
                            </section>

                            <section id="refine-targeting" class="mt-4">
                                <h3 class="fw-bold mb-3 plusJakartaSans">Refine Targeting</h3>
                                <ul>
                                    <li>Use precise keywords for tighter targeting.</li>
                                    <li>Leverage negative keywords to remove wasted spend.</li>
                                </ul>
                            </section>

                            <section id="optimize-listings" class="mt-4">
                                <h3 class="fw-bold mb-3 plusJakartaSans">Optimize Product Listings</h3>
                                <ul>
                                    <li>Improve product titles, descriptions, and A+ content.</li>
                                    <li>Focus on reviews to increase buyer trust.</li>
                                </ul>
                            </section>

                            <section id="monitor-campaigns" class="mt-4">
                                <h3 class="fw-bold mb-3 plusJakartaSans">Monitor And Adjust Campaigns</h3>
                                <ul>
                                    <li>Regularly assess TACoS trends.</li>
                                    <li>Use Amazon tools or third-party platforms for performance analysis.</li>
                                </ul>
                            </section>

                            <section id="monitor-trends" class="mt-4">
                                <h3 class="fw-bold mb-3 plusJakartaSans">Monitoring TACoS Trends</h3>
                                <p>
                                    To truly harness TACoS, look beyond the number and analyze trends.
                                </p>
                                <ul>
                                    <li><strong>Decreasing TACoS:</strong> Indicates growing organic sales and overall
                                        efficiency.</li>
                                    <li><strong>Increasing TACoS:</strong> Might signal dependence on ads without organic
                                        growth.</li>
                                </ul>
                                <p>
                                    Combine TACoS data with ACoS metrics to gain a full understanding of your ad campaigns’
                                    performance and long-term growth.
                                </p>
                            </section>

                            <section id="elevate" class="mt-4">
                                <h2 class="fw-bold mb-3 plusJakartaSans">Elevate Your Amazon Strategy</h2>
                                <p>
                                    TACoS empowers sellers to see the bigger picture, balance ad spend with profitability,
                                    and grow their organic presence over time.
                                </p>
                                <p>
                                    Take your Amazon PPC strategy to the next level today by optimizing for TACoS. Whether
                                    you’re launching a new product or scaling your brand, focusing on this metric will pave
                                    the way for stronger profitability and long-term success.
                                </p>
                            </section>

                            <section id="key-takeaways" class="mt-5">
                                <div class="takeaway-box">
                                    <h3 class="fw-bold mb-3 plusJakartaSans">Key Takeaways at a Glance</h3>
                                    <ul class="mb-0">
                                        <li>TACoS = Ad Spend ÷ Total Sales</li>
                                        <li>Lower TACoS indicates strong organic + ad synergy</li>
                                        <li>Track TACoS alongside ACoS for deeper visibility</li>
                                        <li>Optimize campaigns and listings to improve TACoS</li>
                                        <li>Monitor trends for early signals of success or slippage</li>
                                    </ul>
                                </div>
                            </section>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 poppins mt-3 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0 " style="font-size: 29px;">Realted Products</h2>

                    <div class="d-flex gap-2">
                        <button class="btn rounded-circle text-white d-flex align-items-center justify-content-center p-0"
                            type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="prev"
                            style="width:40px; height:40px; background: linear-gradient(90deg, #8b5cf6, #ec4899);">
                            <i class="fa-solid fa-angle-left"></i>
                        </button>

                        <button class="btn rounded-circle text-white d-flex align-items-center justify-content-center p-0"
                            type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="next"
                            style="width:40px; height:40px; background: linear-gradient(90deg, #8b5cf6, #ec4899);">
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>
                </div>

                <div id="featuredProductsCarousel" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-inner">

                        <!-- Slide 1 -->
                        <div class="carousel-item active">
                            <div class="row g-4">
                                <div class="col-lg-3 col-12">
                                    <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                                        <div class="position-relative">
                                            <img src="{{ asset('images/store/feature1.png') }}"
                                                class="card-img-top img-fluid w-100" alt="Product">
                                            <span
                                                class="badge rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1 text-white"
                                                style="background: linear-gradient(90deg, #8b5cf6, #ec4899);">-25%</span>
                                        </div>

                                        <div class="card-body d-flex flex-column p-3">
                                            <small class="text-danger fw-bold text-uppercase mb-2"
                                                style="font-size: 10px;">Electronics</small>
                                            <h5 class="fw-bold mb-3" style="font-size: 16px;">Pro Audio Wireless
                                            </h5>
                                            <div class="mb-4">
                                                <span class="fw-bold fs-4 me-2" style="font-size: 19px;">$149.00</span>
                                                <span class="text-secondary text-decoration-line-through">$199.00</span>
                                            </div>
                                            <button
                                                class="btn feature-btn text-white fw-semibold rounded-pill mt-auto py-2">
                                                Get Deal
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-12">
                                    <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                                        <div class="position-relative">
                                            <img src="{{ asset('images/store/feature2.png') }}"
                                                class="card-img-top img-fluid w-100" alt="Product">
                                            <span
                                                class="badge rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1 text-white"
                                                style="background: linear-gradient(90deg, #8b5cf6, #ec4899);">-30%</span>
                                        </div>

                                        <div class="card-body d-flex flex-column p-3">
                                            <small class="text-danger fw-bold text-uppercase mb-2"
                                                style="font-size: 10px;">Accessories</small>
                                            <h5 class="fw-bold mb-3" style="font-size: 16px;">Minimalist Chrono
                                                Watch</h5>
                                            <div class="mb-4">
                                                <span class="fw-bold fs-4 me-2" style="font-size: 19px;">$84.00</span>
                                                <span class="text-secondary text-decoration-line-through"
                                                    style="font-size: 13px;">$120.00</span>
                                            </div>
                                            <button
                                                class="btn feature-btn text-white fw-semibold rounded-pill mt-auto py-2">
                                                Get Deal
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-12">
                                    <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                                        <div class="position-relative">
                                            <img src="{{ asset('images/store/feature3.png') }}"
                                                class="card-img-top img-fluid w-100" alt="Product">
                                            <span
                                                class="badge rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1 text-white"
                                                style="background: linear-gradient(90deg, #8b5cf6, #ec4899);">-50%</span>
                                        </div>

                                        <div class="card-body d-flex flex-column p-3">
                                            <small class="text-danger fw-bold text-uppercase mb-2"
                                                style="font-size: 10px;">Fashion</small>
                                            <h5 class="fw-bold mb-3" style="font-size: 16px;">Turbo Speed Running
                                                Shoes</h5>
                                            <div class="mb-4">
                                                <span class="fw-bold fs-4 me-2" style="font-size: 19px;">$59.50</span>
                                                <span class="text-secondary text-decoration-line-through"
                                                    style="font-size: 13px;">$119.00</span>
                                            </div>
                                            <button
                                                class="btn feature-btn text-white fw-semibold rounded-pill mt-auto py-2">
                                                Get Deal
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-12
                                                            <div class=" card border-0 rounded-4 shadow-sm h-100
                                    overflow-hidden">
                                    <div class="position-relative">
                                        <img src="{{ asset('images/store/feature4.png') }}"
                                            class="card-img-top img-fluid w-100" alt="Product">
                                        <span
                                            class="badge rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1 text-white"
                                            style="background: linear-gradient(90deg, #8b5cf6, #ec4899);">-15%</span>
                                    </div>

                                    <div class="card-body d-flex flex-column p-3">
                                        <small class="text-danger fw-bold text-uppercase mb-2"
                                            style="font-size: 10px;">Beauty</small>
                                        <h5 class="fw-bold mb-3" style="font-size: 16px;">Designer UV Protection
                                        </h5>
                                        <div class="mb-4">
                                            <span class="fw-bold fs-4 me-2" style="font-size: 19px;">$127.50</span>
                                            <span class="text-secondary text-decoration-line-through"
                                                style="font-size: 13px;">$150.00</span>
                                        </div>
                                        <button class="btn feature-btn text-white fw-semibold rounded-pill mt-auto py-2">
                                            Get Deal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="row g-4">
                            <div class="col-lg-3 col-12">
                                <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                                    <div class="position-relative">
                                        <img src="{{ asset('images/store/feature1.png') }}"
                                            class="card-img-top img-fluid w-100" alt="Product">
                                        <span
                                            class="badge rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1 text-white"
                                            style="background: linear-gradient(90deg, #8b5cf6, #ec4899);">-20%</span>
                                    </div>

                                    <div class="card-body d-flex flex-column p-3">
                                        <small class="text-danger fw-bold text-uppercase mb-2"
                                            style="font-size: 10px;">Electronics</small>
                                        <h5 class="fw-bold mb-3" style="font-size: 16px;">Studio Headset Max
                                        </h5>
                                        <div class="mb-4">
                                            <span class="fw-bold fs-4 me-2" style="font-size: 19px;">$99.00</span>
                                            <span class="text-secondary text-decoration-line-through"
                                                style="font-size: 13px;">$139.00</span>
                                        </div>
                                        <button class="btn feature-btn text-white fw-semibold rounded-pill mt-auto py-2">
                                            Get Deal
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-12">
                                <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                                    <div class="position-relative">
                                        <img src="{{ asset('images/store/feature2.png') }}"
                                            class="card-img-top img-fluid w-100" alt="Product">
                                        <span
                                            class="badge rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1 text-white"
                                            style="background: linear-gradient(90deg, #8b5cf6, #ec4899);">-35%</span>
                                    </div>

                                    <div class="card-body d-flex flex-column p-3">
                                        <small class="text-danger fw-bold text-uppercase mb-2"
                                            style="font-size: 10px;">Accessories</small>
                                        <h5 class="fw-bold mb-3" style="font-size: 16px;">Luxury Smart Bottle
                                        </h5>
                                        <div class="mb-4">
                                            <span class="fw-bold fs-4 me-2" style="font-size: 19px;">$72.00</span>
                                            <span class="text-secondary text-decoration-line-through"
                                                style="font-size: 13px;">$110.00</span>
                                        </div>
                                        <button class="btn feature-btn text-white fw-semibold rounded-pill mt-auto py-2">
                                            Get Deal
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-12">
                                <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                                    <div class="position-relative">
                                        <img src="{{ asset('images/store/feature3.png') }}"
                                            class="card-img-top img-fluid w-100" alt="Product">
                                        <span
                                            class="badge rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1 text-white"
                                            style="background: linear-gradient(90deg, #8b5cf6, #ec4899);">-18%</span>
                                    </div>

                                    <div class="card-body d-flex flex-column p-3">
                                        <small class="text-danger fw-bold text-uppercase mb-2"
                                            style="font-size: 10px;">Fashion</small>
                                        <h5 class="fw-bold mb-3" style="font-size: 16px;">Urban Street Jacket
                                        </h5>
                                        <div class="mb-4">
                                            <span class="fw-bold fs-4 me-2" style="font-size: 19px;">$89.00</span>
                                            <span class="text-secondary text-decoration-line-through"
                                                style="font-size: 13px;">$109.00</span>
                                        </div>
                                        <button class="btn feature-btn text-white fw-semibold rounded-pill mt-auto py-2">
                                            Get Deal
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-12">
                                <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden">
                                    <div class="position-relative">
                                        <img src="{{ asset('images/store/feature4.png') }}"
                                            class="card-img-top img-fluid w-100" alt="Product">
                                        <span
                                            class="badge rounded-pill position-absolute top-0 start-0 m-2 px-2 py-1 text-white"
                                            style="background: linear-gradient(90deg, #8b5cf6, #ec4899);">-12%</span>
                                    </div>

                                    <div class="card-body d-flex flex-column p-3">
                                        <small class="text-danger fw-bold text-uppercase mb-2"
                                            style="font-size: 10px;">Beauty</small>
                                        <h5 class="fw-bold mb-3" style="font-size: 16px;">Daily Skin Cleanser
                                        </h5>
                                        <div class="mb-4">
                                            <span class="fw-bold fs-4 me-2" style="font-size: 19px;">$45.00</span>
                                            <span class="text-secondary text-decoration-line-through"
                                                style="font-size: 13px;">$59.00</span>
                                        </div>
                                        <button class="btn feature-btn text-white fw-semibold rounded-pill mt-auto py-2">
                                            Get Deal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        body {
            overflow-x: hidden;
        }

        @font-face {
            font-family: 'Inter';
            src: url("{{ asset('webfonts/inter.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        .inter {
            font-family: 'Inter', sans-serif;
        }

        @font-face {
            font-family: 'PlusJakartaSans';
            src: url("{{ asset('webfonts/PlusJakartaSans.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        .plusJakartaSans {
            font-family: 'PlusJakartaSans', sans-serif;
        }

        @font-face {
            font-family: 'Poppins';
            src: url("{{ asset('webfonts/Poppins-Bold.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        .poppins {
            font-family: 'Poppins', sans-serif;
        }

        .btn.custom-btn {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(106.58deg, #831BD7 0%, #B31B2F 100%);
            border: unset;
            color: white !important;
            font-weight: 600;
            position: relative;
            overflow: hidden;
            z-index: 1;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 22px;
            font-weight: 600;
        }

        .btn.custom-btn::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0%;
            background: #121826;
            z-index: -1;
            transition: height 0.4s ease;
        }

        .btn.custom-btn:hover::before {
            height: 100%;
        }

        .offer-number {
            background: linear-gradient(108.06deg, #831BD7 0%, #B31B2F 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .badge {
            font-size: 14px;
        }

        .tacos-page {
            background: transparent;
            color: #595C5D;
            border-radius: 8px;
        }

        .toc {

            border-radius: 8px;
        }

        .tacos-page .toc-box {
            top: 20px;

        }

        .toc:hover {
            border: 1px solid #B71422;
        }

        .tacos-page .toc-box,
        .tacos-page .takeaway-box {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 14px;

        }

        .tacos-page h2,
        .tacos-page h3,
        .tacos-page h5 {
            color: black;
            font-size: 24px;
            font-weight: 700;
        }

        .tacos-page p,
        .tacos-page li {
            font-size: 16px;
            font-family: Inter;
            line-height: 1.8;
            color: #595C5D;
            text-align: justify;
        }

        .tacos-page .toc-box a {
            display: block;
            color: #595C5D;
            text-decoration: underline;
            font-size: 16px;
            margin-bottom: 8px;
            transition: 0.2s;
            font-family: Inter;
        }

        .tacos-page .toc-box a:hover,
        .tacos-page .toc-box a.active {
            color: #B71422;
        }

        .tacos-page hr {
            border-color: #B71422;
            opacity: 1;
        }

        .tacos-page .social-icons a {
            color: #595C5D;
            font-size: 25px;
            text-decoration: none;
        }

        .tacos-page .social-icons a:hover {
            /* color: #fff; */
        }

        @media (max-width: 991.98px) {
            .tacos-page .toc-box {
                position: relative !important;
                top: 0 !important;
            }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sections = document.querySelectorAll(".content-box section[id]");
            const navLinks = document.querySelectorAll(".toc-box a");

            function activateLink() {
                let current = "";
                sections.forEach(section => {
                    const sectionTop = section.offsetTop - 120;
                    if (window.scrollY >= sectionTop) {
                        current = section.getAttribute("id");
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === "#" + current) {
                        link.classList.add("active");
                    }
                });
            }

            activateLink();
            window.addEventListener("scroll", activateLink);
        });
    </script>
@endsection