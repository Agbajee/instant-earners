<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="{{$gt->description}}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>{{$gt->title}}</title>
        <!-- Stylesheets -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="{{asset ('newHome/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset ('newHome/css/fontawesome-all.css')}}" rel="stylesheet">
        <link href="{{asset ('newHome/css/owl.css')}}" rel="stylesheet">
        <link href="{{asset ('newHome/css/flaticon.css')}}" rel="stylesheet">
        <link href="{{asset ('newHome/css/linoor-icons-2.css')}}" rel="stylesheet">
        <link href="{{asset ('newHome/css/animate.css')}}" rel="stylesheet">
        <link href="{{asset ('newHome/css/jarallax.css')}}" rel="stylesheet">
        <link href="{{asset ('newHome/css/jquery-ui.css')}}" rel="stylesheet">
        <link href="{{asset ('newHome/css/jquery.fancybox.min.css')}}" rel="stylesheet">
        <link href="{{asset ('newHome/css/hover.css')}}" rel="stylesheet">
        <link href="{{asset ('newHome/css/custom-animate.css')}}" rel="stylesheet">
        <link href="{{asset ('newHome/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('newHome/css/rtl.css')}}" rel="stylesheet">
        <link href="{{asset('newHome/css/responsive.css')}}" rel="stylesheet">

        <link rel="shortcut icon" href="{{asset('images/general/'.$gt->favicon)}}">
        <style>
            .banner-full-height{
                min-height: 100vh!important;
            }
            @media (min-width: 768px) {
                .inner_linoor{
                    margin-top: -220px!important;
                }
            }
        </style>

    </head>
    <body>
        <div class="page-wrapper">
            <!-- <div class="preloader">
                <div class="icon"></div>
            </div> -->

            <header class="main-header header-style-one">

                <!-- Header Upper -->
                <div class="header-upper">
                    <div class="inner-container clearfix">
                        <!--Logo-->
                        <div class="logo-box">
                            <div class="logo">
                                <a href="/" >
                                    <img id="thm-logo" src="{{asset('images/general/'.$gt->logo)}}" alt="Miratel">
                                </a>
                            </div>
                        </div>
                        <div class="nav-outer clearfix">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler"><span class="icon flaticon-menu-2"></span><span class="txt">Menu</span>
                            </div>

                            <!-- Main Menu -->
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li>
                                            <a href="{{url('/')}}">Home</a>
                                        </li>
                                        <li>
                                            <a href="{{route('aboutUs')}}">About Us</a>
                                        </li>
                                        <li class="dropdown"><a href="#">Pages</a>
                                            <ul>
                                                <li><a href="{{route('checkCoupon')}}">Check Code </a></li>
                                                <li><a href="{{route('activationCode')}}">Message a Vendor</a></li>
                                                <li> <hr /> </li>
                                                <li><a href="{{ route('howItWorks') }}">How It Works</a></li>
                                                <li><a href="{{route('siteStatistics')}}">Top Earners</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{route('marketplace')}}">Shop</a></li>
                                        <li><a href="{{route('news')}}">Blog</a></li>
                                        <li><a href="{{route('contact')}}">Contact</a></li>
                                        @auth
                                        <li><a href="{{route('signin')}}">Join</a></li>
                                        @else
                                        <li><a href="{{route('account')}}">Dashboard</a></li>
                                        @endauth
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <div class="other-links clearfix">
                            <div class="cart-btn">
                                <a href="{{route('account')}}" class="theme-btn cart-toggler">
                                    <span class="flaticon-user"></span>
                                </a>
                            </div>
                            <!--Search Btn-->
                            <div class="search-btn">
                                <button type="button" class="theme-btn search-toggler"><span class="flaticon-loupe"></span></button>
                            </div>
                            <div class="link-box">
                                <div class="call-us">
                                    @auth
                                    <a class="link" href="{{route('account')}}">Dashboard</a>
                                    @else
                                    <a class="link" href="{{route('account')}}">Log in</a>
                                    @endauth
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--End Header Upper-->

            </header>

            <!--Mobile Menu-->
            <div class="side-menu__block">


                <div class="side-menu__block-overlay custom-cursor__overlay">
                    <div class="cursor"></div>
                    <div class="cursor-follower"></div>
                </div>
                <!-- /.side-menu__block-overlay -->
                <div class="side-menu__block-inner ">
                    <div class="side-menu__top justify-content-end">

                        <a href="#" class="side-menu__toggler side-menu__close-btn"><img src="{{asset ('newHome/images/icons/close-1-1.png')}}" alt=""></a>
                    </div>
                    <!-- /.side-menu__top -->


                    <nav class="mobile-nav__container">
                        <!-- content is loading via js -->
                    </nav>
                    <div class="side-menu__sep"></div>
                    <!-- /.side-menu__sep -->
                    <div class="side-menu__content">
                        <p>Miratel is a premium Template for Digital Agencies, Start Ups, Small Business and a wide range of other
                            agencies.</p>
                        <div class="side-menu__social">
                            <a href="https://www.instagram.com/officialmirateltech/" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://twitter.com/MiratelTech" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://t.me/mirateltechnology" target="_blank"><i class="fab fa-telegram"></i></a>
                            <a href="https://www.youtube.com/@officialmirateltech" target="_blank"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    <!-- /.side-menu__content -->
                </div>
                <!-- /.side-menu__block-inner -->
            </div>
            <!-- /.side-menu__block -->

            <!--Search Popup-->
            <div class="search-popup">
                <div class="search-popup__overlay custom-cursor__overlay">
                    <div class="cursor"></div>
                    <div class="cursor-follower"></div>
                </div>
                <!-- /.search-popup__overlay -->
                <div class="search-popup__inner">
                    <form action="{{route('productSearch')}}" class="search-popup__form">
                        <input type="text" name="search" placeholder="Type here to Search Store....">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <!-- /.search-popup__inner -->
            </div>
            <!-- /.search-popup -->


            <!-- Banner Section -->

            <section class="banner-section banner-two container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="banner-content ">
                            <div class="sub-title">MIRATEL TECHNOLOGY</div>
                            <h1>Experience the <br>future  of technology</h1>
                            <div class="link-box">
                                <a class="theme-btn btn-style-one" href="{{route('signup')}}">
                                    <i class="btn-curve"></i>
                                    <span class="btn-title">Get Started</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="play">
                            <div class="circle-1"></div>
                            <div class="circle-2"></div>
                            <div class="circle-3"></div>
                            <img src="{{ asset('newHome/images/resource/miratel-icon.png')}}" alt="miratel-icon">
                        </div>
                    </div>
                </div>
            </section>


            {{-- <section class="banner-section banner-two">

                <div class="banner-carousel owl-theme owl-carousel banner-full-height">
                    <!-- Slide Item -->
                    <div class="slide-item banner-full-height">
                        <div class="image-layer" style="background-image: url({{asset('newHome/images/main-slider/2.jpg')}};"></div>
                        <div class="shape-1"></div>
                        <div class="auto-container banner-full-height">
                            <div class="content-box banner-full-height">
                                <div class="content">
                                    <div class="inner inner_linoor">
                                        <div class="sub-title">MIRATEL TECHNOLOGY</div>
                                        <h1>Smart Web <br>Design Agency</h1>
                                        <div class="link-box">
                                            <a class="theme-btn btn-style-one" href="about.html">
                                                <i class="btn-curve"></i>
                                                <span class="btn-title">Discover More</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
            <!--End Banner Section -->

            <!--Services Section-->
            <section class="services-section-two">
                <div class="auto-container">
                    <div class="sec-title">
                        <!--Title Block-->
                        <div class="row clearfix">
                            <div class="column col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                <h2>THE UNIQUE<br> INNOVATIONS<span class="dot">.</span></h2>
                            </div>
                            <div class="column col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                <div class="lower-text">
                                    Miratel technology is an online multipurpose system concerned with bringing connection 
                                    between entrepreneurs and consumers. MIRATEL is the solution to the past, present and future 
                                    challenges in commercialization and entrepreneurship.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="services">
                        <div class="row clearfix">
                            <!--Service Block-->
                            <div class="service-block-two col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                                    <div class="bottom-curve"></div>
                                    <div class="icon-box"><span class="flaticon-shopping-bag-2"></span></div>
                                    <h5><a href="javascript:void(0);">e - Commerce</a></h5>
                                    <div class="text">Upload your goods to thousands of people.</div>
                                </div>
                            </div>

                            <!--Service Block-->
                            <div class="service-block-two col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                                    <div class="bottom-curve"></div>
                                    <div class="icon-box"><span class="flaticon-trophy"></span></div>
                                    <h5><a href="javascript:void(0);">MIRA <br>SPORT BET</a></h5>
                                    <div class="text">Win Thousands of Naira by staking for free.</div> 
                                </div>
                            </div>

                            <!--Service Block-->
                            <div class="service-block-two col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                                    <div class="bottom-curve"></div>
                                    <div class="icon-box"><span class="flaticon-monitor"></span></div>
                                    <h5><a href="javascript:void(0);">SKILLS <br>ACQUISITION</a></h5>
                                    <div class="text">Availability of Updated modern skills for Mira users.</div>
                                </div>
                            </div>

                            <!--Service Block-->
                            <div class="service-block-two col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box wow fadeInUp" data-wow-delay="900ms" data-wow-duration="1500ms">
                                    <div class="bottom-curve"></div>
                                    <div class="icon-box"><span class="flaticon-hand-shake"></span></div>
                                    <h5 class="text-black">AFFILIATE <br>COMMISSION</h5>
                                    <div class="text">Highest affiliate commission on products sales up to 82%.</div>
                                </div>
                            </div>

                        </div>

                        <div class="row clearfix">
                            <!--Service Block-->
                            <div class="service-block-two col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                                    <div class="bottom-curve"></div>
                                    <div class="icon-box"><span class="flaticon-clipboard"></span></div>
                                    <h5><a href="javascript:void(0);">MIRA <br/> MONTHLY CONTEST</a></h5>
                                    <div class="text">Beauty contests and Talent hunts for Mira users.</div>
                                </div>
                            </div>

                            <!--Service Block-->
                            <div class="service-block-two col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                                    <div class="bottom-curve"></div>
                                    <div class="icon-box"><span class="flaticon-shopping-cart"></span></div>
                                    <h5><a href="javascript:void(0);">NFT <br>MARKETPLACE</a></h5>
                                    <div class="text">Accessibility to Mira NFTs marketplace.</div> 
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <!--Featured Section-->
            <section class="featured-section">
                <div class="auto-container">
                    <div class="row clearfix">
                        <!--Left Column-->
                        <div class="left-col col-lg-6 col-md-12 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <div class="image-box"><img src="{{asset ('newHome/images/resource/phone-mockup-1.jpg')}}" alt=""></div>
                            </div>
                        </div>
                        <!--Right Column-->
                        <div class="right-col col-lg-6 col-md-12 col-sm-12">
                            <div class="inner">
                                <div class="sec-title">
                                    <h2>MAKE WEBSITES WITHOUT TOUCHING the CODing<span class="dot">.</span></h2>
                                    <div class="lower-text">We are committed to providing our customers with exceptional service while
                                        offering our employees the best training. There are many variations of passages of lorem ipsum is
                                        simply free text available in the market, but
                                        the majority have suffered time.</div>
                                </div>
                                <div class="features">
                                    <div class="row clearfix">
                                        <div class="feature col-md-6 col-sm-12">
                                            <div class="inner-box">
                                                <h6>Free Consultation</h6>
                                                <div class="text">Lorem ipsum is not dolor sit amet, consectetur notted.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="feature col-md-6 col-sm-12">
                                            <div class="inner-box">
                                                <h6>Best team members</h6>
                                                <div class="text">Lorem ipsum is not dolor sit amet, consectetur notted.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--Why Us Section-->
            <section class="why-us-section">
                <div class="auto-container">
                    <div class="row clearfix">
                        <!--Left Column-->
                        <div class="left-col col-lg-6 col-md-12 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <div class="round-box">
                                    <div class="image-box">
                                        <img src="{{asset ('newHome/images/resource/win.jpg')}}" alt="">
                                    </div>
                                    <div class="vid-link">
                                        <a href="https://youtu.be/kFppfr_e26Q" class="lightbox-image">
                                            <div class="icon"><span class="flaticon-play-button-1"></span><i class="ripple"></i></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Right Column-->
                        <div class="right-col col-lg-6 col-md-12 col-sm-12">
                            <div class="inner">
                                <div class="sec-title">
                                    <h2>See Why you should choose Miratel<span class="dot">.</span></h2>
                                </div>
                                <div class="features">
                                    <div class="feature">
                                        <div class="inner-box">
                                            <h6 style="color: #000;">Approved</h6>
                                            <div class="text">
                                                Government Approved  and certified.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feature">
                                        <div class="inner-box">
                                            <h6 style="color: #000;">Support</h6>
                                            <div class="text">
                                                24/7 Active Customer care & support.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feature">
                                        <div class="inner-box">
                                            <h6 style="color: #000;">Automated</h6>
                                            <div class="text">
                                                Automated and easy withdrawal mode.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feature">
                                        <div class="inner-box">
                                            <h6 style="color: #000;">Prizes</h6>
                                            <div class="text">
                                                Massive compensation and prizes for members.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--Testimonials Section-->
            <section class="testimonials-section">
                <div class="auto-container">
                    <div class="sec-title">
                        <h2>User feedbacks<span class="dot">.</span></h2>
                    </div>
                    <div class="carousel-box">
                        <div class="testimonials-carousel owl-theme owl-carousel">
                            <div class="testi-block">
                                <div class="inner">
                                    <div class="icon"><span>“</span></div>
                                    <div class="info">
                                        <div class="image"><a href="team.html"><img src="{{asset ('newHome/images/resource/author-1.jpg')}}" alt=""></a></div>
                                        <div class="name">Shirley Smith</div>
                                        <div class="designation">Director</div>
                                    </div>
                                    <div class="text">There are many variations of passages of lorem ipsum available but the majority have
                                        suffered alteration in some form, by injected humour, or randomised words which don't look even
                                        slightly believable.</div>
                                </div>
                            </div>
                            <div class="testi-block">
                                <div class="inner">
                                    <div class="icon"><span>“</span></div>
                                    <div class="info">
                                        <div class="image"><a href="team.html"><img src="{{asset ('newHome/images/resource/author-2.jpg')}}" alt=""></a></div>
                                        <div class="name">Mike hardson</div>
                                        <div class="designation">Director</div>
                                    </div>
                                    <div class="text">There are many variations of passages of lorem ipsum available but the majority have
                                        suffered alteration in some form, by injected humour, or randomised words which don't look even
                                        slightly believable.</div>
                                </div>
                            </div>
                            <div class="testi-block">
                                <div class="inner">
                                    <div class="icon"><span>“</span></div>
                                    <div class="info">
                                        <div class="image"><a href="team.html"><img src="{{asset ('newHome/images/resource/author-3.jpg')}}" alt=""></a></div>
                                        <div class="name">Sarah albert</div>
                                        <div class="designation">Director</div>
                                    </div>
                                    <div class="text">There are many variations of passages of lorem ipsum available but the majority have
                                        suffered alteration in some form, by injected humour, or randomised words which don't look even
                                        slightly believable.</div>
                                </div>
                            </div>
                            <div class="testi-block">
                                <div class="inner">
                                    <div class="icon"><span>“</span></div>
                                    <div class="info">
                                        <div class="image"><a href="team.html"><img src="{{asset ('newHome/images/resource/author-1.jpg')}}" alt=""></a></div>
                                        <div class="name">Shirley Smith</div>
                                        <div class="designation">Director</div>
                                    </div>
                                    <div class="text">There are many variations of passages of lorem ipsum available but the majority have
                                        suffered alteration in some form, by injected humour, or randomised words which don't look even
                                        slightly believable.</div>
                                </div>
                            </div>
                            <div class="testi-block">
                                <div class="inner">
                                    <div class="icon"><span>“</span></div>
                                    <div class="info">
                                        <div class="image"><a href="team.html"><img src="{{asset ('newHome/images/resource/author-2.jpg')}}" alt=""></a></div>
                                        <div class="name">Mike hardson</div>
                                        <div class="designation">Director</div>
                                    </div>
                                    <div class="text">There are many variations of passages of lorem ipsum available but the majority have
                                        suffered alteration in some form, by injected humour, or randomised words which don't look even
                                        slightly believable.</div>
                                </div>
                            </div>
                            <div class="testi-block">
                                <div class="inner">
                                    <div class="icon"><span>“</span></div>
                                    <div class="info">
                                        <div class="image"><a href="team.html"><img src="{{asset ('newHome/images/resource/author-3.jpg')}}" alt=""></a></div>
                                        <div class="name">Sarah albert</div>
                                        <div class="designation">Director</div>
                                    </div>
                                    <div class="text">There are many variations of passages of lorem ipsum available but the majority have
                                        suffered alteration in some form, by injected humour, or randomised words which don't look even
                                        slightly believable.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="features-section jarallax" data-jarallax data-speed="0.3" data-imgPosition="50% -100%">
                <!-- <div class="image-layer" style="background-image: url(images/background/image-3.jpg);"></div> -->
                <img src="{{asset ('newHome/images/background/image-3.jpg')}}" class="jarallax-img" alt="">
                <div class="auto-container">
                    <div class="content-box">
                        <h2>Grow With Community & Experience Endless Possibilities<span>.</span></h2>
                        <div class="features clearfix">
                            <div class="feature-block">
                                <div class="inner">
                                    <div class="icon-box"><span class="flaticon-design-tools"></span></div>
                                    <h6>latest <br>technology</h6>
                                </div>
                            </div>
                            <div class="feature-block">
                                <div class="inner">
                                    <div class="icon-box"><span class="flaticon-idea"></span></div>
                                    <h6>amazing <br>free support</h6>
                                </div>
                            </div>
                            <div class="feature-block">
                                <div class="inner">
                                    <div class="icon-box"><span class="flaticon-clock"></span></div>
                                    <h6>quick <br>services</h6>
                                </div>
                            </div>
                        </div>
                        <div class="link-box">
                            <a class="theme-btn btn-style-one" href="about.html">
                                <i class="btn-curve"></i>
                                <span class="btn-title">Discover More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Funfacts Section -->

            <!-- Fluid Section -->
            <section class="fluid-section">
                <div class="outer-container">
                    <div class="row clearfix">
                        <div class="column col-lg-6 col-md-12 col-sm-12 d-none">
                            <div class="inner">
                                <div class="image-layer" style="background-image: url(images/background/image-4.jpg);">
                                </div>
                                <div class="content-box">
                                    <h3>BUILD a BETTER WEBSITE ALOT QUICKER WITH linoor</h3>
                                    <div class="link-box">
                                        <a class="theme-btn btn-style-one" href="about.html">
                                            <i class="btn-curve"></i>
                                            <span class="btn-title">Discover More</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner">
                                <div class="image-layer" style="background-image: url(images/background/image-5.jpg);">
                                </div>
                                <div class="content-box">
                                    <h3>We provide our customers with exceptional service</h3>
                                    <div class="link-box">
                                        <a class="theme-btn btn-style-two" href="contact.html">
                                            <i class="btn-curve"></i>
                                            <span class="btn-title">Discover More</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main Footer -->
            <footer style="background:rgb(255, 255, 255);" class="main-footer normal-padding">
                <div class="auto-container">
                    <!--Widgets Section-->
                    <div class="widgets-section">
                        <div class="row clearfix">

                            <!--Column-->
                            <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="footer-widget logo-widget">
                                    <div class="widget-content">
                                        <div class="logo">
                                            <a href="/"><img id="fLogo" src="{{asset('images/general/'.$gt->logo)}}" alt="" /></a>
                                        </div>
                                        <div class="text">Welcome to our web design agency. Lorem ipsum simply free text dolor sited amet cons
                                            cing elit.</div>
                                        <ul class="social-links clearfix">
                                            <li><a href="https://t.me/mirateltechnology" target="_blank"><span class="fab fa-telegram"></span></a></li>
                                            <li><a href="https://twitter.com/MiratelTech" target="_blank"><span class="fab fa-twitter"></span></a></li>
                                            <li><a href="https://www.instagram.com/officialmirateltech/" target="_blank"><span class="fab fa-instagram"></span></a></li>
                                            <li><a href="https://www.youtube.com/@officialmirateltech" target="_blank"><span class="fab fa-youtube"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--Column-->
                            <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="footer-widget links-widget">
                                    <div class="widget-content">
                                        <h6>Explore</h6>
                                        <div class="row clearfix">
                                            <div class=" col-sm-12">
                                                <ul>
                                                    <li><a href="#">About</a></li>
                                                    <li><a href="{{route('howItWorks')}}">How It Works</a></li>
                                                    <li><a href="{{route('news')}}">Sponsored Posts</a></li>
                                                    <li><a href="{{route('terms')}}">Terms & Conditions</a></li>
                                                    <li><a href="{{route('privacy')}}">Privacy Policy</a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <div class="auto-container">
                        <div class="inner clearfix">
                            <div class="copyright">&copy; Copyright 2022 by Miratel.com</div>
                        </div>
                    </div>
                </div>

            </footer>
        </div>
    <!-- Back to Top Start -->
    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>
    <!-- Back to Top End -->
    <script src="{{asset('newHome/js/jquery.js')}}"></script>
	<script src="{{asset('newHome/js/popper.min.js')}}"></script>
	<script src="{{asset('newHome/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('newHome/js/TweenMax.js')}}"></script>
	<script src="{{asset('newHome/js/jquery-ui.js')}}"></script>
	<script src="{{asset('newHome/js/jquery.fancybox.js')}}"></script>
	<script src="{{asset('newHome/js/owl.js')}}"></script>
	<script src="{{asset('newHome/js/mixitup.js')}}"></script>
	<script src="{{asset('newHome/js/appear.js')}}"></script>
	<script src="{{asset('newHome/js/wow.js')}}"></script>
	<script src="{{asset('newHome/js/jQuery.style.switcher.min.js')}}"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.2/js.cookie.min.js">
	</script>
	<script src="{{asset('newHome/js/jquery.easing.min.js')}}"></script>
	<script src="{{asset('newHome/js/jarallax.min.js')}}"></script>
	<script src="{{asset('newHome/js/custom-script.js')}}"></script>
    @include('partials.notify')

	<script src="{{asset('newHome/js/lang.js')}}"></script>
	<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<script src="{{asset('newHome/js/color-switcher.js')}}"></script>

    </body>
</html>
