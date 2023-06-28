<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- meta tag -->
    <meta charset="utf-8">
    <title>{{ $gt->title }}</title>
    <meta name="description" content="{{ $gt->description }}">
    <!-- responsive tag -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/general/' . $gt->favicon) }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/remixicon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/fonts/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/off-canvas.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/rsmenu-main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/rs-spacing.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/responsive.css') }}">

</head>

<body class="defult-home">

    <div class="offwrap"></div>

    <!--Preloader start here-->
    <div id="pre-load">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('sasco/assets/images/logo-icon.png') }}"
                        alt="SaaS Landing Pages HTML Template "></div>
            </div>
        </div>
    </div>
    <!--Preloader area end here-->

    <!-- Main content Start -->
    <div class="main-content">

        <!--Full width header Start-->
        <div class="full-width-header">
            <!--Header Start-->
            <header id="rs-header" class="rs-header header-style1 header-modify1 header-transparent temp-header">
                <!-- Menu Start -->
                <div class="menu-area menu-sticky">
                    <div class="container-fluid">
                        <div class="row-table">
                            <div class="col-cell header-logo">
                                <div class="logo-area">
                                    <a href="/">
                                        <img class="normal-logo" src="{{ asset('sasco/assets/images/logo.png') }}"
                                            alt="logo">
                                        <img class="sticky-logo"
                                            src="{{ asset('sasco/assets/images/logo-green.png') }}" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-cell">
                                <div class="rs-menu-area">
                                    <div class="main-menu">
                                        <nav class="rs-menu hidden-md">
                                            <ul class="nav-menu">
                                                <li class="menu-item current-menu-item">
                                                    <a href="{{ url('/') }}">Home</a>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="{{ route('aboutUs') }}">About</a>
                                                </li>
                                                <li class="menu-item-has-children">
                                                    <a href="#">Pages</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="{{ route('activationCode') }}">Get Coupon Code</a>
                                                        </li>
                                                        <li><a href="{{ route('checkCoupon') }}">Check Codes</a></li>
                                                        <li><a href="{{ route('howItWorks') }}">How It Works</a></li>
                                                        <li><a href="{{ route('siteStatistics') }}">Top Earners</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="{{ route('news') }}">Sponsored Task</a>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="{{route('ads')}}">Advert Task</a>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="{{ route('contact') }}">Contact</a>
                                                </li>
                                                <li class="menu-item-has-children">
                                                    <a href="#">Terms</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="{{ route('terms') }}">Terms and Conditions</a>
                                                        </li>
                                                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <!-- //.nav-menu -->
                                        </nav>
                                    </div>
                                    <!-- //.main-menu -->
                                </div>
                            </div>
                            <div class="col-cell">
                                <div class="expand-btn-inner">
                                    <ul>
                                        @auth
                                            <li class="btn-quote">
                                                <a href="{{ route('account') }}"><span class="btn-text"><i
                                                            class="ri-user-3-line"></i> Dashboard</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="btn-quote">
                                                <a href="{{ route('account') }}"><span class="btn-text">
                                                        <i class="ri-login-box-line"></i> Sign In</span>
                                                </a>
                                            </li>
                                        @endauth
                                        <li class="nav-link">
                                            <a id="nav-expander" class="nav-expander bar" href="#">
                                                <div class="bar">
                                                    <span class="dot1"></span>
                                                    <span class="dot2"></span>
                                                    <span class="dot3"></span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menu End -->

                <!-- Canvas Mobile Menu start -->
                <nav class="right_menu_togle mobile-navbar-menu" id="mobile-navbar-menu">
                    <div class="close-btn">
                        <a id="nav-close2" class="nav-close">
                            <div class="line">
                                <span class="line1"></span>
                                <span class="line2"></span>
                            </div>
                        </a>
                    </div>
                    <ul class="nav-menu">
                        <li class="menu-item current-menu-item">
                            <a href="{{ url('/') }}l">Home</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('aboutUs') }}">About</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Pages</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('activationCode') }}">Get Coupon Code</a></li>
                                <li><a href="{{ route('checkCoupon') }}">Check Codes</a></li>
                                <li><a href="{{ route('howItWorks') }}">How It Works</a></li>
                                <li><a href="{{ route('siteStatistics') }}">Top Earners</a></li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('news') }}">Sponsored Task</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Terms</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('terms') }}">Terms and Conditions</a></li>
                                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- //.nav-menu -->
                    <!-- //.nav-menu -->

                    <!-- //.nav-menu -->
                    <div class="canvas-contact">
                        <ul>
                            @auth
                                <li class="btn-quote">
                                    <a href="{{ route('account') }}">
                                        <span class="btn-text">
                                            <i class="ri-user-3-line"></i>
                                            Dashboard
                                        </span>
                                    </a>
                                </li>
                            @else
                                <li class="btn-quote">
                                    <a href="{{ route('account') }}">
                                        <span class="btn-text">
                                            <i class="ri-login-box-line"></i>
                                            Login
                                        </span>
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </nav>
                <!-- Canvas Menu end -->
            </header>
            <!--Header End-->
        </div>
        <!--Full width header End-->

        <!-- Banner Start -->
        <div class="rs-banner banner-style2">
            <div class="container-fluid">
                <div class="row y-middle">
                    <div class="col-lg-7">
                        <div class="content-wrap">
                            <h1 class="title">INSTANTNAIRE fast & steady income.</h1>
                            <div class="description">
                                <p>
                                    Instantnaire is a brand that offers substantial stream of income<br /> to its
                                    members through affiliate marketing opportunities.
                                </p>
                            </div>
                            <ul class="bnr-btn-wrapper">
                                <li>
                                    <a class="rselement-btn" href="contact-1.html">
                                        <i class="ri-apple-fill"></i> Apps Store
                                    </a>
                                </li>
                                <li>
                                    <a class="rselement-btn rselement-active" href="contact-1.html">
                                        <i class="ri-google-play-fill"></i> Play Store
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="bnr-image">
                            <img class="wow fadeInUp"
                                src="{{ asset('sasco/assets/images/banner/style2/hand-phone.png') }}" alt="Images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner End -->

        <!-- Partner Start -->
        <div class="rs-partner partner-style2 gray-bg2 pt-70 pb-65">
            <div class="container">
                <div class="slider partner-slide-1">
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img "
                                    src="{{ asset('sasco/assets/images/partner/style1/1.png') }}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img "
                                    src="{{ asset('sasco/assets/images/partner/style1/2.png') }}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img "
                                    src="{{ asset('sasco/assets/images/partner/style1/3.png') }}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img "
                                    src="{{ asset('sasco/assets/images/partner/style1/4.png') }}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img "
                                    src="{{ asset('sasco/assets/images/partner/style1/5.png') }}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img "
                                    src="{{ asset('sasco/assets/images/partner/style1/1.png') }}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img "
                                    src="{{ asset('sasco/assets/images/partner/style1/2.png') }}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img "
                                    src="{{ asset('sasco/assets/images/partner/style1/3.png') }}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img "
                                    src="{{ asset('sasco/assets/images/partner/style1/4.png') }}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img "
                                    src="{{ asset('sasco/assets/images/partner/style1/5.png') }}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Partner End -->

        <!-- Services Section Start -->
        {{-- <div class="rs-services services-style1 pt-140 pb-140 md-pt-80 md-pb-80">
            <div class="container">
                <div class="sec-title text-center mb-55 md-mb-35">
                    <h2 class="title">
                        We provide tha best<br> service for you
                    </h2>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 xl-mb-30">
                        <div class="services-item">
                            <div class="services-wrap">
                                <div class="services-icon">
                                    <img src="{{ asset('sasco/assets/images/services/style2/ser1.png')}}" alt="Images">
                                </div>
                                <div class="services-content">
                                    <h4 class="title"><a href="services-details.html">Easy Payment</a></h4>
                                    <p class="services-txt">Ac orci phasellus egestas tellus rutrum. Elit duis the intro
                                        tristique sollicitudin.</p>
                                    <div class="services-button">
                                        <a href="services-details.html"><i class="ri-arrow-right-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 xl-mb-30">
                        <div class="services-item">
                            <div class="services-wrap">
                                <div class="services-icon">
                                    <img src="{{ asset('sasco/assets/images/services/style2/ser2.png')}}" alt="Images">
                                </div>
                                <div class="services-content">
                                    <h4 class="title"><a href="services-details.html">Control Your Account</a></h4>
                                    <p class="services-txt">Ac orci phasellus egestas tellus rutrum. Elit duis the intro
                                        tristique sollicitudin.</p>
                                    <div class="services-button">
                                        <a href="services-details.html"><i class="ri-arrow-right-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 sm-mb-30">
                        <div class="services-item">
                            <div class="services-wrap">
                                <div class="services-icon">
                                    <img src="{{ asset('sasco/assets/images/services/style2/ser3.png')}}" alt="Images">
                                </div>
                                <div class="services-content">
                                    <h4 class="title"><a href="services-details.html">Add Any Bank Card</a></h4>
                                    <p class="services-txt">Ac orci phasellus egestas tellus rutrum. Elit duis the intro
                                        tristique sollicitudin.</p>
                                    <div class="services-button">
                                        <a href="services-details.html"><i class="ri-arrow-right-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="services-item">
                            <div class="services-wrap">
                                <div class="services-icon">
                                    <img src="{{ asset('sasco/assets/images/services/style2/ser4.png')}}" alt="Images">
                                </div>
                                <div class="services-content">
                                    <h4 class="title"><a href="services-details.html">Access Any Devices</a></h4>
                                    <p class="services-txt">Ac orci phasellus egestas tellus rutrum. Elit duis the intro
                                        tristique sollicitudin.</p>
                                    <div class="services-button">
                                        <a href="services-details.html"><i class="ri-arrow-right-line"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Services Section End -->

        <!--  Feature Start -->
        <div class="rs-feature feature-style1 gray-bg3 pt-130 pb-130 md-pt-65 md-pb-80">
            <div class="container">
                <div class="row y-middle">
                    <div class="col-lg-6">
                        <div class="score-metar">
                            <div class="secore-main">
                                <img src="{{ asset('sasco/assets/images/feature/style1/score-metar.png') }}"
                                    alt="">
                                <div class="secore-small one">
                                    <img class="horizontal3"
                                        src="{{ asset('sasco/assets/images/feature/style1/score-metar2.png') }}"
                                        alt="">
                                </div>
                                <div class="secore-small two">
                                    <img class="horizontal3"
                                        src="{{ asset('sasco/assets/images/feature/style1/score-metar3.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="sec-title">
                            <h2 class="title pb-25 text-uppercase">
                                How Instantnaire Works
                            </h2>
                            <p class="desc pb-25">
                                <strong>InstantNaire</strong> was innovated by an experienced monetization expert in a
                                bid to equip her members financially with affiliate skills
                                When a member signs up on <strong>InstantNaire</strong> he/she has access to 8 ways of
                                EARNING which can be accessible via a one time registration fee of 3,500 naira
                            </p>
                            <p class="desc">
                            <h4 class="fs-6">EARNING VIA ACTIVITIES </h4>
                            Through Performing Daily Tasks and Earning the following below
                            Unlock daily earnings ₦200
                            Daily Sponsored Share Bonus ₦400
                            </p>
                            <p class="desc">
                            <h4 class="fs-6">EARNING VIA AFFILIATE</h4>
                            Through telling your friends and family about InstantNaire and getting a whooping Commission
                            of ₦2,300 as bonus per person
                            </p>
                            <p class="desc">
                            <h4 class="fs-6">EARNING VIA SALARY</h4>
                            As a member of Instantnaire once you have up to 10 referrals you are entitled to monthly
                            salary which is paid 20th of every month
                            </p>
                            <p class="desc">
                            <h4 class="fs-6">EARNING VIA EXTRA AFFILIATE BONUS
                            </h4>
                            This means you earn when someone you registered on InstantNaire directly with your Referral
                            Link Registers another person which can be their friends or family
                            You get another Whooping sum of ₦200 unlimitedly as long as they keep referring
                            </p>
                            <p class="desc">
                            <h4 class="fs-6">EARNING THROUGH WELCOME BONUS AFTER REGISTRATION
                            </h4>
                            You get 2,000 welcome on your dashboard immediately after registration
                            </p>

                            <p class="desc">
                            <h4 class="fs-6">
                                EARNING VIA OUR GIFT BOX
                            </h4>
                                You can into your account through our giftbox which can pop up on your dashboard at anytime of the day 
                            </p>

                            <p class="desc">
                            <h4 class="fs-6">
                                EARNING VIA FREE BONUS ON AFFILIATE WITHDRAWAL
                            </h4>
                            Upon affiliate withdrawal you may be opportune to get free cash bonus
                            </p>
                            <p class="desc">
                            <h4 class="fs-6">
                                EARNING VIA COMPENSATION PLANS/CONTESTS
                            </h4>
                                This means you get compensated with Lots of Amazing Prizes Ranging from Cash, Laptops(MacBook,Hp) iPhones,Samsungs,Sound Bars,Air condition,Pressing Iron,TV and so on due to your participation/contributions in the massive growth of the platform 
                            </p>
                            <div class="btn-part mt-40">
                                @auth
                                <a class="readon know" href="{{route('account')}}">
                                    <span class="btn-text">My Account</span>
                                    <i class="ri-arrow-right-line"></i>
                                </a>
                                @else
                                <a class="readon know" href="{{route('signup')}}">
                                    <span class="btn-text">Know More</span>
                                    <i class="ri-arrow-right-line"></i>
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Feature End -->

        <!-- Why Choose Section Start -->
        <div id="rs-choose" class="rs-choose choose-style1 pt-140 pb-25 md-pt-20 md-pb-20">
            <div class="container">
                <div class="row y-middle">
                    <div class="col-lg-6 pr-100 md-pr-15 md-mb-20">
                        <div class="sec-title">
                            <h2 class="title pb-25">
                                Do it get paid without referrals?
                            </h2>
                            <p class="desc pb-25">
                                YES, Payment of Task Earnings are 100% on this platform whereby earnings are disbursed in cash every month from Top activity earners to least earners till the revenue gets Exhausted.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="rs-choose" class="rs-choose choose-style1 pt-140 pb-140 md-pt-20 md-pb-80">
            <div class="container">
                <div class="row y-middle">
                    <div class="col-lg-6 pr-100 md-pr-15 md-mb-50">
                        <div class="sec-title">
                            <h2 class="title pb-15">
                                InstantNaire Withdrawal & Payment Processes
                            </h2>
                            <p class="desc pb-25 fw-bolder">
                                Our Withdrawal and Payment mode for Affiliate Earnings are as follows
                            </p>

                            <p class="desc pb-25">
                                -You are Eligible for Withdrawal and Payment with a Minimum of ₦6,000 .Affiliate Withdrawal opens everyday for 2hours 10am - 12pm. We pay within 12 - 24 hours of payment request
                            </p>
                            <p class="desc pb-25">
                                -While non - Affiliate earners are paid every month ( withdrawal for non affiliate earners opens 25th of every month, 8pm -10pm) with the minimum earnings of 20,000 Task Earnings or More, which is coverted to ₦6,000+
                            </p>
                            <p class="desc pb-25 fw-bolder">
                                N.B users on Instantnaire have access to quick loan.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="gradiant-circle">
                            <img src="{{ asset('sasco/assets/images/choose/style2/gradiant-circle.png') }}"
                                alt="Images">
                            <div class="device-img one">
                                <img class="wow veritcal2"
                                    src="{{ asset('sasco/assets/images/choose/style2/device2.png') }}"
                                    alt="Images">
                            </div>
                            <div class="device-img two">
                                <img class="wow veritcal3"
                                    src="{{ asset('sasco/assets/images/choose/style2/device1.png') }}"
                                    alt="Images">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Why Choose Section End -->

        <!-- Cta Start -->
        <div class="rs-process process-style1 pt-145 pb-145 md-pt-80 md-pb-80">
            <div class="container">
                <video class="rs-html5-video" autoplay="" muted="" playsinline="" loop=""
                    src="https://rstheme.com/products/html/sasco/assets/images/wallet-bg.mp4"></video>
                <div class="background-video-wrap">
                    <div class="background-overlay"></div>
                </div>
                <div class="sec-title text-center mb-55">
                    <h2 class="title pb-25 white-color">
                        Get started in 3<br> simple steps
                    </h2>
                    <p class="desc desc4">
                        It only takes a few minutes
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-4 md-mb-30">
                        <div class="addon-services-item">
                            <div class="services-part">
                                <div class="services-icon">
                                    <img src="{{ asset('sasco/assets/images/process/style1/isomatric1.png') }}"
                                        alt="">
                                </div>
                                <div class="services-content">
                                    <div class="services-title">
                                        <h4 class="title">STEP 1.</h4>
                                    </div>
                                    <p class="desc-text">
                                        You purchase a coupon code from any of the verified coupon vendor on the site via the Navigate ➡ COUPON CODE option, after purchasing your code which can only be used once and for just one account Activation/Registration.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 md-mb-30">
                        <div class="addon-services-item">
                            <div class="services-part">
                                <div class="services-icon">
                                    <img src="{{ asset('sasco/assets/images/process/style1/isomatric2.png') }}"
                                        alt="">
                                </div>
                                <div class="services-content">
                                    <div class="services-title">
                                        <h4 class="title">STEP 2.</h4>
                                    </div>
                                    <p class="desc-text">
                                        You use the create an account/referral link you would be provided with by whoever introduced you, fill your details required via the boxes provided and make sure your information are correct so as not to encounter issues later.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="addon-services-item">
                            <div class="services-part">
                                <div class="services-icon">
                                    <img src="{{ asset('sasco/assets/images/process/style1/isomatric1.png') }}"
                                        alt="">
                                </div>
                                <div class="services-content">
                                    <div class="services-title">
                                        <h4 class="title">STEP 3.</h4>
                                    </div>
                                    <p class="desc-text">
                                        Use your code purchased and click on terms and conditions when done, click on SIGN UP and you would get a welcome message from us.WELCOME TO INSTANTNAIRE.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cta End -->

        <!-- Testimonial Section End -->
        <div class="rs-testimonial testimonial-style1 testimonial-modify1 pt-130 pb-170 md-pt-80 md-pb-120">
            <div class="container">
                <div class="sec-title text-center mb-45">
                    <h2 class="title">
                        People who<br> already love us
                    </h2>
                </div>
                <div class="slider testi-slide-1">
                    <div class="testi-item">
                        <div class="item-content">
                            <span><img src="{{ asset('sasco/assets/images/testimonial/style1/quote3.png') }}"
                                    alt="Testimonial"></span>
                            <p>I so much love the look of this app, the dashboard is very clean & easy to navigate</p>
                        </div>
                        <div class="rattings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star star-color"></i>
                        </div>
                        <div class="testi-content">
                            <div class="image-wrap">
                                <img src="https://www.kindpng.com/picc/m/22-223863_no-avatar-png-circle-transparent-png.png"
                                    alt="no-image">
                            </div>
                            <div class="testi-information">
                                <div class="testi-name">Dj Bravo</div>
                            </div>
                        </div>
                    </div>
                    <div class="testi-item">
                        <div class="item-content">
                            <span><img src="{{ asset('sasco/assets/images/testimonial/style1/quote3.png') }}"
                                    alt="Testimonial"></span>
                            <p>Instantnaire entire team is a blessing that can't be undermined, the effort put into the work can't be compared and I can say it loud and clear that I'm a beneficial of this project and always thankful I never missed out.</p>
                        </div>
                        <div class="rattings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="testi-content">
                            <div class="image-wrap">
                                <img src="https://www.kindpng.com/picc/m/22-223863_no-avatar-png-circle-transparent-png.png"
                                alt="no-image">
                            </div>
                            <div class="testi-information">
                                <div class="testi-name">Alex</div>
                            </div>
                        </div>
                    </div>
                    <div class="testi-item">
                        <div class="item-content">
                            <span><img src="{{ asset('sasco/assets/images/testimonial/style1/quote3.png') }}"
                                    alt="Testimonial"></span>
                            <p>I must say I love the app, it's full of mouthwatering features</p>
                        </div>
                        <div class="rattings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="testi-content">
                            <div class="image-wrap">
                                <img src="https://www.kindpng.com/picc/m/22-223863_no-avatar-png-circle-transparent-png.png"
                                alt="no-image">
                            </div>
                            <div class="testi-information">
                                <div class="testi-name">Samuel Onifade</div>
                            </div>
                        </div>
                    </div>
                    <div class="testi-item">
                        <div class="item-content">
                            <span><img src="{{ asset('sasco/assets/images/testimonial/style1/quote3.png') }}"
                                    alt="Testimonial"></span>
                            <p>I earn so much as a member of this app, steady income and monthly salary, long live instant NAIRE</p>
                        </div>
                        <div class="rattings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="testi-content">
                            <div class="image-wrap">
                                <img src="https://www.kindpng.com/picc/m/22-223863_no-avatar-png-circle-transparent-png.png"
                                alt="no-image">
                            </div>
                            <div class="testi-information">
                                <div class="testi-name">Emeka Udl</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial Section End -->

        <!-- Cta Start -->
        <div class="rs-cta cta-style2 cta-modify1">
            <div class="container custom5">
                <div class="cta-wrap">
                    <div class="row">
                        <div class="col-lg-7 pr-20 md-mb-50">
                            <div class="sec-title">
                                <h2 class="title white-color pb-20">
                                    Get reday to start<br> record your moment?
                                </h2>
                                <p class="desc desc3">
                                    Elit pellentesque habitant morbi tristique the senectus et netus.
                                </p>
                                <div class="btn-part mt-33">
                                    <a class="readon try-btn" href="contact-1.html">
                                        <span class="btn-text">Try 14 days Free</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="cta-images">
                                <div class="cta-device">
                                    <img src="{{ asset('sasco/assets/images/cta/style2/device-half.png') }}"
                                        alt="Images">
                                    <div class="ripple-img one">
                                        <img class="scale"
                                            src="{{ asset('sasco/assets/images/cta/style2/ripple-frame.png') }}"
                                            alt="Images">
                                    </div>
                                    <div class="ripple-img two">
                                        <img class="scale"
                                            src="{{ asset('sasco/assets/images/cta/style2/ripple-frame.png') }}"
                                            alt="Images">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cta End -->

    </div>
    <!-- Main content End -->

    <!-- Footer Start -->
    <footer id="rs-footer" class="rs-footer footer-main-home footer-modify2">
        <div class="container">
            <div class="footer-top">
                <div class="row">
                    <div class="col-lg-4 md-mb-20">
                        <div class="footer-logo">
                            <a href="index.html"><img src="{{ asset('sasco/assets/images/logo.png') }}"
                                    alt=""></a>
                        </div>
                        <p class="widget-desc">Instantnaire is a brand that offers substantial stream of income to its
                            members through affiliate marketing opportunities.</p>
                        <ul class="footer-social md-mb-30">
                            <li><a target="_blank" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a target="_blank" href="https://t.me/instantnaire"><i class="fa fa-telegram"></i></a></li>
                            <li><a target="_blank" href="https://instagram.com/instantnaire"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-8 pl-110 md-pl-15">
                        <div class="row">
                            <div class="col-lg-4 md-mb-10">
                                <h3 class="footer-title">About</h3>
                                <ul class="site-map">
                                    <li><a href="{{route('aboutUs')}}">About</a></li>
                                    <li><a href="{{route('terms')}}">Terms and Conditions</a></li>
                                    <li><a href="{{route('privacy')}}">Privacy</a></li>
                                    <li><a href="{{route('terms')}}">Contact</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4 md-mb-10">
                                <h3 class="footer-title">Resources</h3>
                                <ul class="site-map">
                                    <li><a href="{{route('news')}}">Sponsored Posts</a></li>
                                    <li><a href="{{route('siteStatistics')}}">Top Earners</a></li>
                                    <li><a href="{{route('activationCode')}}">Get Code</a></li>
                                    <li><a href="{{route('checkCoupon')}}">Check Codes</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <h3 class="footer-title">Get apps On!</h3>
                                <ul class="textwidget-btn">
                                    <li>
                                        <a class="footer-btn footer-dark" href="#">
                                            <i class="ri-google-play-fill"></i> Play Store
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="bottom-border">
                    <div class="row y-middle">
                        <div class="col-lg-6">
                            <div class="copyright text-lg-start text-center">
                                <p>© 2023 INSTANTnaire.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- start scrollUp  -->
    <div id="scrollUp" class="purple-color">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- End scrollUp  -->

    <!-- Search Modal Start -->
    <div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="search-block clearfix">
                    <form>
                        <div class="form-group">
                            <input class="form-control" placeholder="Search Here..." type="text">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Modal End -->

    <script src="{{ asset('sasco/assets/js/modernizr-2.8.3.min.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/jquery.nav.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/skill.bars.jquery.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/contact.form.js') }}"></script>
    <script src="{{ asset('sasco/assets/js/main.js') }}"></script>
    @include('partials.notify')
</body>

</html>
