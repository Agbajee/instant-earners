<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/fonts/css/all.css')}}" rel="stylesheet">
    @yield('styles')
     
	<script data-ad-client="ca-pub-4988060882059570" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body>
<div class="site-container">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="main_navi clearfix container">
                <div class="act_logo pull-left"> <a href="{{route('home')}}"><img src="{{asset('assets/img/logo.png')}}"> </a>
                    <form method="get" action="{{route('search')}}">
                        <div class="search_top_bar">
                            <input type="search" placeholder="Search anything..."name="term">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="nav_links pull-right">
                    <li> <a href="{{url('/')}}"><i class="fa fa-home"></i>Home</a> </li>
                    <li> <a href="#"><i class="fa fa-info-circle"></i>How to earn</a> </li>
                    <li> <a href="{{route('signup')}}" class="reg"><i class="fa fa-magic"></i>Sign up </a> </li>
                    <li> <a href="{{route('signin')}}"><i class="fa fa-sign-in"></i>Login</a> </li>
                </div>
            </div>
            <div class="mb_menu">
                <div class="site-container-inner-first text-center">
                    <h3> <b> ALOWWEE.COM</b></h3>
                    <div class="forum_stats"> <b>Stats:</b> 1,977,799 members, 4,145,754 <b>topics</b>. <b>Date: Wednesday</b>, 21 March 2018 at 09:14 AM </div>
                    <!--<p>Welcome, <b>Guest</b>: <a href="#">Join Alowwee.com</a> / <a href="#">LOGIN!</a> / <a href="#">Trending</a> / <a href="#">Recent</a> / <a href="#">New</a></p>-->
                    <div class="the_quick_link_nav clearfix"> <a href="#">Home</a> <a href="#">Sign up</a> <a href="#">Sign In</a> <a href="#">Categories</a> <a href="#">New Topic</a> <a href="#">How To Earn</a> </div>
                    <div class="clearfix col-md-12">
                        <div class="site-search-column">
                            <input type="text" placeholder="Search anything here ..." name="" class="input-search">
                            <button class="search_mb"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ssp"></div>
    @yield('content')
</div>
<div class="bottom-scroll-height"></div>
<div class="col-md-12">
    <div class="the_footer_outter">
        <div class="container">
            <div class="footer-style borded_f">
                <div class="col-md-1 hidden-xs hidden-sm">
                    <div class="footer_item_inner_2">
                        <h1>
                            A
                            <br>
                            L
                            <br>
                            L
                            <br>
                            O
                            <br>
                            <span>W</span>
                            <br>
                            <span>W</span>
                            <br>
                            E
                            <br>
                            E
                        </h1> </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-4">
                    <div class="footer_item_inner">
                        <h2>Allowee</h2>
                        <div class="list_inner">
                            <li><a href="#">Questions </a></li>
                            <li><a href="#">Jobs </a></li>
                            <li><a href="#">Developer Jobs Directory</a></li>
                            <li><a href="#">Salary Calculator</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Mobile</a></li>
                            <li><a href="#">Disable Responsiveness</a></li>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-4">
                    <div class="footer_item_inner">
                        <h2>Products</h2> </div>
                    <div class="list_inner">
                        <li><a href="#">Teams </a></li>
                        <li><a href="#">Talent </a></li>
                        <li><a href="#">Advertising </a></li>
                        <li><a href="#">Enterprise </a></li>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-4">
                    <div class="footer_item_inner">
                        <h2>Company</h2> </div>
                    <div class="list_inner">
                        <li><a href="#">About </a></li>
                        <li><a href="#">Press </a></li>
                        <li><a href="#">Work Here </a></li>
                        <li><a href="#">Legal </a></li>
                        <li><a href="#">Privacy Policy </a></li>
                        <li><a href="#">Contact Us </a></li>
                    </div>
                </div>
                <div class="col-md-3 hidden-xs hidden-sm">
                    <div class="last_s">
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">LinkedIn</a></li>
                    </div>
                    <div class="cop_right_note"> site design / logo © 2019 Stack Exchange Inc; user contributions licensed under cc by-sa 3.0 with attribution required. rev 2019.4.12.33321 </div>
                </div>
                <div class="col-md-1"> </div>
            </div>
        </div>
    </div>
</div>


@yield('scripts')
</body>

</html>