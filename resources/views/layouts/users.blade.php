@php

if(Auth::user()->mode ){
    $class = "dark-skin";
}else{
    $class = "light-skin";
}

$notification = \App\Models\siteNotifcation::firstOrFail();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $gt->title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ $gt->keywords }}" />
    <meta name="description" content="{{ $gt->description }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="{{ asset('images/general/' . $gt->favicon) }}">
    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('newUser/css/vendors_css.css') }}">
    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('newUser/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('newUser/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('newUser/css/skin_color.css') }}">
</head>

<body class="hold-transition {!! $class !!} sidebar-mini theme-primary fixed sidebar-collapse">

    <div class="wrapper">
        <div id="loader"></div>

        <header class="main-header">
            <div class="d-flex align-items-center logo-box justify-content-start d-none d-sm-block">
                <!-- Logo -->
                <a href="{{route('account')}}" class="logo">
                    <!-- logo-->
                    <div class="logo-mini w-30">
                        <span class="light-logo"><img src="{{ asset('newUser/images/logo-white.png')}}" alt="logo"></span>
                        <span class="dark-logo"><img src="{{ asset('newUser/images/logo-black.png')}}" alt="logo"></span>
                    </div>
                    <div class="logo-lg">
                        <span class="light-logo"><img src="{{ asset('newUser/images/logo-white.png')}}" alt="logo"></span>
                        <span class="dark-logo"><img src="{{ asset('newUser/images/logo-black.png')}}" alt="logo"></span>
                    </div>
                </a>
            </div>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <div class="app-menu">
                    <ul class="header-megamenu nav">
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" role="button" id="backButton" class="waves-effect waves-light text-white" title="left">
                                <i data-feather="chevron-left"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="navbar-custom-menu r-side">
                    <ul class="nav navbar-nav">
                        <li class="btn-group nav-item d-lg-inline-flex d-none">
                            <a href="#" data-provide="fullscreen"
                                class="waves-effect waves-light nav-link full-screen btn-warning-light"
                                title="Full Screen">
                                <i data-feather="maximize"></i>
                            </a>
                        </li>

                        <!-- User Account-->
                        <li class="dropdown user user-menu">
                            <a href="{{route('notifications')}}" class="waves-effect waves-light text-white"
                                data-bs-toggle="dropdown" title="User">
                                <i data-feather="bell"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <!-- sidebar-->
            <section class="sidebar position-relative">
                <div class="multinav">
                    <div class="multinav-scroll" style="height: 100%;">
                        <!-- sidebar menu-->
                        <ul class="sidebar-menu" data-widget="tree">
                            <li>
                                <a href="{{route('account')}}">
                                    <i data-feather="monitor"></i>
                                    <span >Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('editAccount')}}">
                                    <i data-feather="user"></i>
                                    <span>User Profile</span>
                                </a>
                            </li>
                            

                            <li>
                                <a href="{{route('upgradePlan')}}">
                                    <i data-feather="chevrons-up"></i>
                                    <span>Upgrade Plan</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('requestPayout')}}">
                                    <i data-feather="dollar-sign"></i>
                                    <span>Payment</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('earningHistory')}}">
                                    <i data-feather="activity"></i>
                                    <span>Earning History</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('subscribe')}}">
                                    <i data-feather="gift"></i>
                                    <span>Courses/Skills</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('myLoans')}}">
                                    <i data-feather="gift"></i>
                                    <span>Loans</span>
                                </a>
                            </li>
>
                        </ul>

                        <div class="sidebar-widgets">
                            <div class="mx-25 mb-30 pb-20 side-bx bg-primary-light rounded20">
                                <div class="text-center">
                                    <img src="{{ asset('newUser/images/logo-black.png')}}" class=" p-25"alt="">
                                </div>
                            </div>
                            <div class="copyright text-center m-25">
                                <p>© 2023 All Rights Reserved </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </aside>
        @yield('content')
        @include('partials.bottomnav')
       
        {{-- <footer class="main-footer">
            &copy; 2022 <a href="/">Miratel</a>. All Rights Reserved.
        </footer> --}}
    </div>


    <script src="{{ asset('newUser/js/vendors.min.js') }}"></script>
    <script src="{{ asset('newUser/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('newUser/assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_components/jquery-knob/js/jquery.knob.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('newUser/assets/vendor_plugins/iCheck/icheck.min.js') }}"></script>

    <!-- WebkitX Admin App -->
    <script src="{{ asset ('newUser/js/template.js')}}"></script>
    <script src="{{ asset ('newUser/js/pages/dashboard.js')}}"></script>
    @yield('js')
    @include('partials.notify')
</body>

</html>
