<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- meta tag -->
    <meta charset="utf-8">
    <title>{{$gt->title}}</title>
    <meta name="description" content="{{$gt->description}}">
    <!-- responsive tag -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('images/general/'.$gt->favicon)}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/remixicon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/fonts/flaticon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/off-canvas.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('sasco/assets/css/rsmenu-main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/rs-spacing.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/responsive.css')}}">

</head>
<body class="defult-home">

    <div class="offwrap"></div>

    <!--Preloader start here-->
    <div id="pre-load">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('sasco/assets/images/logo-icon.png')}}" alt="SaaS Landing Pages HTML Template "></div>
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
                                        <img class="normal-logo" src="{{ asset('sasco/assets/images/logo.png')}}" alt="logo">
                                        <img class="sticky-logo" src="{{ asset('sasco/assets/images/logo-green.png')}}" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-cell">
                                <div class="rs-menu-area">
                                    <div class="main-menu">
                                        <nav class="rs-menu hidden-md">
                                            <ul class="nav-menu">
                                                <li class="menu-item current-menu-item">
                                                    <a href="{{url('/')}}">Home</a>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="{{route('aboutUs')}}">About</a>
                                                </li>
                                                <li class="menu-item-has-children">
                                                    <a href="#">Pages</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="{{route('activationCode')}}">Get Coupon Code</a></li>
                                                        <li><a href="{{route('checkCoupon')}}">Check Codes</a></li>
                                                        <li><a href="{{ route('howItWorks') }}">How It Works</a></li>
                                                        <li><a href="{{route('siteStatistics')}}">Top Earners</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="{{route('news')}}">Sponsored Task</a>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="{{route('contact')}}">Contact</a>
                                                </li>
                                                <li class="menu-item-has-children">
                                                    <a href="#">Terms</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="{{route('terms')}}">Terms and Conditions</a></li>
                                                        <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
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
                                            <a href="{{route('account')}}"><span class="btn-text"><i
                                                class="ri-user-3-line"></i> Dashboard</span>
                                            </a>
                                        </li>
                                        @else
                                        <li class="btn-quote">
                                            <a href="{{route('account')}}"><span class="btn-text">
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
                            <a href="{{url('/')}}l">Home</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('aboutUs')}}">About</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Pages</a>
                            <ul class="sub-menu">
                                <li><a href="{{route('activationCode')}}">Get Coupon Code</a></li>
                                <li><a href="{{route('checkCoupon')}}">Check Codes</a></li>
                                <li><a href="{{ route('howItWorks') }}">How It Works</a></li>
                                <li><a href="{{route('siteStatistics')}}">Top Earners</a></li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('news')}}">Sponsored Task</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('contact')}}">Contact</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Terms</a>
                            <ul class="sub-menu">
                                <li><a href="{{route('terms')}}">Terms and Conditions</a></li>
                                <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
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
                                <a href="{{route('account')}}">
                                    <span class="btn-text">
                                        <i class="ri-user-3-line"></i>
                                        Dashboard
                                    </span>
                                </a>
                            </li>
                            @else
                            <li class="btn-quote">
                                <a href="{{route('account')}}">
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
                            <img class="wow fadeInUp" src="{{ asset('sasco/assets/images/banner/style2/hand-phone.png')}}" alt="Images">
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
                                <img class="mains-logos rs-grid-img " src="{{ asset('sasco/assets/images/partner/style1/1.png')}}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img " src="{{ asset('sasco/assets/images/partner/style1/2.png')}}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img " src="{{ asset('sasco/assets/images/partner/style1/3.png')}}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img " src="{{ asset('sasco/assets/images/partner/style1/4.png')}}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img " src="{{ asset('sasco/assets/images/partner/style1/5.png')}}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img " src="{{ asset('sasco/assets/images/partner/style1/1.png')}}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img " src="{{ asset('sasco/assets/images/partner/style1/2.png')}}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img " src="{{ asset('sasco/assets/images/partner/style1/3.png')}}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img " src="{{ asset('sasco/assets/images/partner/style1/4.png')}}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                    <div class="partner-item">
                        <div class="logo-img">
                            <a href="https://rstheme.com">
                                <img class="mains-logos rs-grid-img " src="{{ asset('sasco/assets/images/partner/style1/5.png')}}" title=""
                                    alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Partner End -->

        <!-- Services Section Start -->
        <div class="rs-services services-style1 pt-140 pb-140 md-pt-80 md-pb-80">
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
        </div>
        <!-- Services Section End -->

        <!--  Feature Start -->
        <div class="rs-feature feature-style1 gray-bg3 pt-130 pb-130 md-pt-65 md-pb-80">
            <div class="container">
                <div class="row y-middle">
                    <div class="col-lg-6">
                        <div class="score-metar">
                            <div class="secore-main">
                                <img src="{{ asset('sasco/assets/images/feature/style1/score-metar.png')}}" alt="">
                                <div class="secore-small one">
                                    <img class="horizontal3" src="{{ asset('sasco/assets/images/feature/style1/score-metar2.png')}}" alt="">
                                </div>
                                <div class="secore-small two">
                                    <img class="horizontal3" src="{{ asset('sasco/assets/images/feature/style1/score-metar3.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="sec-title">
                            <h2 class="title pb-25">
                                Manage your money with Sasly
                            </h2>
                            <p class="desc pb-25">
                                Auctor urna nunc id cursus metus aliquam eleifend mi. Sit amet risus nullam eget. Ut
                                lectus arcu bibendum at. Id interdum velit laoreet id donec ultrices tincidunt arcu.
                                Mauris ultrices eros in cursus.
                            </p>
                            <p class="desc">
                                Amet nisl purus in mollis nunc sed id. In hac habitasse platea dictumst quisque sagittis
                                purus. Blandit cursus risus at ultrices mi tempus.
                            </p>
                            <div class="btn-part mt-40">
                                <a class="readon know" href="contact-1.html">
                                    <span class="btn-text">Know More</span>
                                    <i class="ri-arrow-right-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Feature End -->

        <!-- Why Choose Section Start -->
        <div id="rs-choose" class="rs-choose choose-style1 pt-140 pb-140 md-pt-80 md-pb-80">
            <div class="container">
                <div class="row y-middle">
                    <div class="col-lg-6 pr-100 md-pr-15 md-mb-50">
                        <div class="sec-title">
                            <h2 class="title pb-25">
                                Why you choose Sasly app?
                            </h2>
                            <p class="desc pb-25">
                                Ornare lectus sit amet est placerat in egestas erat for imperdiet. Adipiscing at in
                                tellus integer feugiat.
                            </p>
                            <p class="desc pb-25">
                                Ac orci phasellus egestas tellus rutrum. Elit duis tristique sollicitudin nibh sit amet.
                                Interdum velit euismod in pellentesque massa. Id velit ut tortor pretium.
                            </p>
                            <ul class="check-lists check-style4">
                                <li class="list-item">
                                    <span class="icon-list-icon">
                                        <i class="fa fa-check-circle"></i>
                                    </span>
                                    <span class="list-text">Zero transfer fee</span>
                                </li>
                                <li class="list-item">
                                    <span class="icon-list-icon">
                                        <i class="fa fa-check-circle"></i>
                                    </span>
                                    <span class="list-text">Great service. Great rates.</span>
                                </li>
                                <li class="list-item">
                                    <span class="icon-list-icon">
                                        <i class="fa fa-check-circle"></i>
                                    </span>
                                    <span class="list-text">Quick and easy</span>
                                </li>
                            </ul>
                            <div class="btn-part mt-40">
                                <a class="readon know" href="contact-1.html">
                                    <span class="btn-text">Know More</span>
                                    <i class="ri-arrow-right-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="gradiant-circle">
                            <img src="{{ asset('sasco/assets/images/choose/style2/gradiant-circle.png')}}" alt="Images">
                            <div class="device-img one">
                                <img class="wow veritcal2" src="{{ asset('sasco/assets/images/choose/style2/device2.png')}}" alt="Images">
                            </div>
                            <div class="device-img two">
                                <img class="wow veritcal3" src="{{ asset('sasco/assets/images/choose/style2/device1.png')}}" alt="Images">
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
                                    <img src="{{ asset('sasco/assets/images/process/style1/isomatric1.png')}}" alt="">
                                </div>
                                <div class="services-content">
                                    <div class="services-title">
                                        <h4 class="title">1. Download Wallet</h4>
                                    </div>
                                    <p class="desc-text">
                                        Auctor urna nunc id cursus metus aliquam eleifend. Sit amet nullam eget.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 md-mb-30">
                        <div class="addon-services-item">
                            <div class="services-part">
                                <div class="services-icon">
                                    <img src="{{ asset('sasco/assets/images/process/style1/isomatric2.png')}}" alt="">
                                </div>
                                <div class="services-content">
                                    <div class="services-title">
                                        <h4 class="title">2. Creative account</h4>
                                    </div>
                                    <p class="desc-text">
                                        Auctor urna nunc id cursus metus aliquam eleifend. Sit amet nullam eget.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="addon-services-item">
                            <div class="services-part">
                                <div class="services-icon">
                                    <img src="{{ asset('sasco/assets/images/process/style1/isomatric1.png')}}" alt="">
                                </div>
                                <div class="services-content">
                                    <div class="services-title">
                                        <h4 class="title">3. Use your daily life</h4>
                                    </div>
                                    <p class="desc-text">
                                        Auctor urna nunc id cursus metus aliquam eleifend. Sit amet nullam eget.
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
                            <span><img src="{{ asset('sasco/assets/images/testimonial/style1/quote3.png')}}" alt="Testimonial"></span>
                            <p>Sasly impressed me on multiple levels. No matter where you go, sasly is the coolest, most
                                happening thing around!</p>
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
                                <img src="{{ asset('sasco/assets/images/testimonial/style1/testi1.jpg')}}" alt="">
                            </div>
                            <div class="testi-information">
                                <div class="testi-name">Dj Bravo</div>
                                <span class="testi-title">Personal Counseling</span>
                            </div>
                        </div>
                    </div>
                    <div class="testi-item">
                        <div class="item-content">
                            <span><img src="{{ asset('sasco/assets/images/testimonial/style1/quote3.png')}}" alt="Testimonial"></span>
                            <p>Sasly impressed me on multiple levels. No matter where you go, sasly is the coolest, most
                                happening thing around!</p>
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
                                <img src="{{ asset('sasco/assets/images/testimonial/style1/testi2.jpg')}}" alt="">
                            </div>
                            <div class="testi-information">
                                <div class="testi-name">Leslie Alexander</div>
                                <span class="testi-title">Anxiety Disorder</span>
                            </div>
                        </div>
                    </div>
                    <div class="testi-item">
                        <div class="item-content">
                            <span><img src="{{ asset('sasco/assets/images/testimonial/style1/quote3.png')}}" alt="Testimonial"></span>
                            <p>Sasly impressed me on multiple levels. No matter where you go, sasly is the coolest, most
                                happening thing around!</p>
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
                                <img src="{{ asset('sasco/assets/images/testimonial/style1/testi3.jpg')}}" alt="">
                            </div>
                            <div class="testi-information">
                                <div class="testi-name">Moorie Hussy</div>
                                <span class="testi-title">Product Designer</span>
                            </div>
                        </div>
                    </div>
                    <div class="testi-item">
                        <div class="item-content">
                            <span><img src="{{ asset('sasco/assets/images/testimonial/style1/quote3.png')}}" alt="Testimonial"></span>
                            <p>Sasly impressed me on multiple levels. No matter where you go, sasly is the coolest, most
                                happening thing around!</p>
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
                                <img src="{{ asset('sasco/assets/images/testimonial/style1/testi4.jpg')}}" alt="">
                            </div>
                            <div class="testi-information">
                                <div class="testi-name">Brie Larson</div>
                                <span class="testi-title">Web Designer</span>
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
                                    <img src="{{ asset('sasco/assets/images/cta/style2/device-half.png')}}" alt="Images">
                                    <div class="ripple-img one">
                                        <img class="scale" src="{{ asset('sasco/assets/images/cta/style2/ripple-frame.png')}}" alt="Images">
                                    </div>
                                    <div class="ripple-img two">
                                        <img class="scale" src="{{ asset('sasco/assets/images/cta/style2/ripple-frame.png')}}" alt="Images">
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
    <footer id="rs-footer" class="rs-footer footer-main-home footer-modify2 temp-footer">
        <div class="container">
            <div class="footer-top">
                <div class="row">
                    <div class="col-lg-4 md-mb-20">
                        <div class="footer-logo">
                            <a href="index.html"><img src="{{ asset('sasco/assets/images/logo.png')}}" alt=""></a>
                        </div>
                        <p class="widget-desc">Instantnaire is a brand that offers substantial stream of income to its
                            members through affiliate marketing opportunities.</p>
                        <ul class="footer-social md-mb-30">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-8 pl-110 md-pl-15">
                        <div class="row">
                            <div class="col-lg-4 md-mb-10">
                                <h3 class="footer-title">About</h3>
                                <ul class="site-map">
                                    <li><a href="about-1.html">About</a></li>
                                    <li><a href="services-details">Terms and Conditions</a></li>
                                    <li><a href="blog.html">Privacy</a></li>
                                    <li><a href="contact-1.html">Contact</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4 md-mb-10">
                                <h3 class="footer-title">Resources</h3>
                                <ul class="site-map">
                                    <li><a href="#">Sponsored Posts</a></li>
                                    <li><a href="price-plan">Top Earners</a></li>
                                    <li><a href="faqs.html">Get Code</a></li>
                                    <li><a href="#">Check Codes</a></li>
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

     <script src="{{ asset('sasco/assets/js/modernizr-2.8.3.min.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/jquery.min.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/bootstrap.min.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/jquery.nav.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/wow.min.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/skill.bars.jquery.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/imagesloaded.pkgd.min.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/slick.min.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/waypoints.min.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/jquery.magnific-popup.min.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/jquery.counterup.min.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/contact.form.js')}}"></script>
     <script src="{{ asset('sasco/assets/js/main.js')}}"></script>
    @include('partials.notify')
    </body>
</html>
