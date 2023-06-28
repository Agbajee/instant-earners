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
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/off-canvas.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('sasco/assets/css/rsmenu-main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/rs-spacing.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sasco/assets/css/responsive.css')}}">

</head>
<body class="defult-home">

    {{-- <div class="offwrap"></div>

    <!--Preloader start here-->
    <div id="pre-load">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('sasco/assets/images/logo-icon.png')}}" alt="SaaS Landing Pages HTML Template "></div>
            </div>
        </div>
    </div> --}}
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
                            <a href="{{route('ads')}}">Advert Task</a>
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
            @yield('content')
    </div>

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
        @yield('script')
    </body>
</html>
