@php $gt = \App\GeneralSettings::first(); @endphp
<!DOCTYPE html>
<html class="modern fixed has-top-menu has-left-sidebar-half" data-style-switcher-options="{'changeLogo': false}" lang="en">
  <head>
		<!-- Basic -->
		<meta charset="UTF-8">
		<title>Admin Dashboard</title>
		<meta name="keywords" content="{{$gt->keywords}}" />
		<meta name="description" content="{{$gt->description}}">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="shortcut icon" href="{{asset('images/general/'.$gt->favicon)}}">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,300,400,600,700,800,900" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{asset('vendor/animate/animate.compat.css')}}">
		<link rel="stylesheet" href="{{asset('vendor/font-awesome/css/all.min.css')}}" />
		<link rel="stylesheet" href="{{asset('vendor/boxicons/css/boxicons.min.css')}}" />
		<link rel="stylesheet" href="{{asset('vendor/magnific-popup/magnific-popup.css')}}" />
		<link rel="stylesheet" href="{{asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{asset('vendor/multi-select/multi-select.css')}}" />
		<link rel="stylesheet" href="{{asset('vendor/morris/morris.css')}}" />
		<link rel="stylesheet" href="{{asset('vendor/datatables/media/css/dataTables.bootstrap5.css')}}" />
		<link rel="stylesheet" href="{{asset('vendor/dropzone/basic.css')}}">
		<link rel="stylesheet" href="{{asset('vendor/dropzone/dropzone.css')}}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('css/theme.css')}}" />

		<!-- Theme Layout -->
		<link rel="stylesheet" href="{{asset('css/layouts/modern.css')}}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset('css/custom.css')}}">
    	@yield('styles')

		<!-- Head Libs -->
		<script src="{{asset('vendor/modernizr/modernizr.js')}}"></script>

		<script src="{{asset('master/style-switcher/style.switcher.localstorage.js')}}"></script>

	</head>

<body>
  <section class="body">
    <section class="body">
			<!-- start: header -->
			<header class="header header-nav-menu header-nav-links">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="{{('img/logo-modern.png')}}" class="logo-image" width="90" height="24" alt="Porto Admin" /><img src="{{('img/logo-default.png')}}" class="logo-image-mobile" width="90" height="41" alt="Porto Admin" />
					</a>
					<button class="btn header-btn-collapse-nav d-lg-none" data-bs-toggle="collapse" data-bs-target=".header-nav">
						<i class="fas fa-bars"></i>
					</button>

					<!-- start: header nav menu -->
					<div class="header-nav collapse">
						<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 header-nav-main-square">
							<nav>
								<ul class="nav nav-pills" id="mainNav">
									<li class="">
									    <a class="nav-link {{(Request::route()->getName() == 'admin') ? 'active' : ''}}" href="{{route('admin')}}">
									        Dashboard
									    </a>    
									</li>
									<li class="dropdown">
									    <a class="nav-link dropdown-toggle " href="javascript:void(0)">
									        Pages
									    </a>

									    <ul class="dropdown-menu">
									        <li class="dropdown-submenu">
									            <a class="nav-link">
									                Posts
									            </a>
									            <ul class="dropdown-menu">
									                <li>
									                    <a class="nav-link" href="{{route('adminTreads')}}">
															All Posts
									                    </a>
									                </li>
									                <li>
									                    <a class="nav-link" href="{{route('adminTreadsCreate')}}">
									                        New Post
									                    </a>
									                </li>
									                <li>
									                    <a class="nav-link" href="{{route('adminTreadsDraft')}}">
									                        Drafts
									                    </a>
									                </li>
									            </ul>
									        </li>

											<li class="dropdown-submenu">
									            <a class="nav-link">
									                Predict & Win
									            </a>
									            <ul class="dropdown-menu">
									                <li>
									                    <a class="nav-link" href="{{route('quiz')}}">
															All Prediction
									                    </a>
									                </li>
									                <li>
									                    <a class="nav-link" href="{{route('createQuiz')}}">
									                        New Prediction
									                    </a>
									                </li>
									            </ul>
									        </li>

									        <li class="dropdown-submenu">
									            <a class="nav-link">
									                Payout
									            </a>
									            <ul class="dropdown-menu">
									                <li>
									                    <a class="nav-link" href="{{route('requestPayoutOpen')}}">
									                        Activate Requests
									                    </a>
									                </li>
									                <li>
									                    <a class="nav-link" href="{{route('requestPayoutAll')}}">
									                        All Requests
									                    </a>
									                </li>
									                <li>
									                    <a class="nav-link" href="{{route('requestPayoutWallet')}}">
									                        Affiliate Requests
									                    </a>
									                </li>
									                <li>
									                    <a class="nav-link" href="{{route('requestPayoutAllowi')}}">
									                        Activity Requests
									                    </a>
									                </li>
									            </ul>
									        </li>
									        <li class="dropdown-submenu">
									            <a class="nav-link">
									                Users
									            </a>
									            <ul class="dropdown-menu">
									                <li>
									                    <a class="nav-link" href="{{route('adminUsers')}}">
									                        All Users
									                    </a>
									                </li>
									                <li>
									                    <a class="nav-link" href="javascript:void(0)">
									                        Blocked
									                    </a>
									                </li>
									                <li>
									                    <a class="nav-link" href="{{route('sendGeneralMail')}}">
									                        Send General Email
									                    </a>
									                </li>
									            </ul>
									        </li>
									        <li>
									            <a class="nav-link" href="{{route('adminVendors')}}">
									                Vendors
									            </a>
									        </li>
									        <li>
									            <a class="nav-link" href="{{route('adminNotificationSite')}}">
									                Notification
									            </a>
									        </li>

											<li class="dropdown-submenu">
									            <a class="nav-link">
									                Testimonies
									            </a>
									            <ul class="dropdown-menu">
									                <li>
									                    <a class="nav-link" href="{{route('allTestimonies')}}">
									                        All Testimonies
									                    </a>
									                </li>
									                <li>
									                    <a class="nav-link" href="{{route('createTestimony')}}">
									                        Create Testimony
									                    </a>
									                </li>
									            </ul>
									        </li>
											
									        <li>
									            <a class="nav-link" href="{{route('Fmanager')}}">
									                File Manager
									            </a>
									        </li>
									     
									        <li>
									            <a class="nav-link" href="{{ route('adminHowItWorkSite') }}">
									                How it Works
									            </a>
									        </li>
											<hr/>
									            <p class="fw-bold">
									                Management
									            </p>
											
									        <li>
									            <a class="nav-link" href="{{route('coupon')}}">
									                Coupon Code
									            </a>
									        </li>

											<li class="dropdown-submenu">
									            <a class="nav-link">
									                Plans
									            </a>
									            <ul class="dropdown-menu">
									                <li>
									                    <a class="nav-link" href="{{route('plan')}}">
									                        All Plans
									                    </a>
									                </li>
									                <li>
									                    <a class="nav-link" href="{{route('planCreate')}}">
									                        Create
									                    </a>
									                </li>
									            </ul>
									        </li>

											<li class="dropdown-submenu">
									            <a class="nav-link">
									                Market
									            </a>
									            <ul class="dropdown-menu">
									                <li>
									                    <a class="nav-link" href="{{route('marketOverview')}}">
									                        Overview
									                    </a>
									                </li>
									                <li>
									                    <a class="nav-link" href="{{route('marketCategory')}}">
									                        Categories
									                    </a>
									                </li>
									            </ul>
									        </li>

											<li class="dropdown-submenu">
									            <a class="nav-link">
									                Classes
									            </a>
									            <ul class="dropdown-menu">
									                <li>
									                    <a class="nav-link disabled" href="{{route('bundle')}}">
									                        All Classes
									                    </a>
									                </li>
									                {{-- <li>
									                    <a class="nav-link disabled" href="{{route('mysubscriber')}}">
									                        Subscribers
									                    </a>
									                </li> --}}
									                <li>
									                    <a class="nav-link disabled" href="{{route('bundleCreate')}}">
									                        Create New Classe
									                    </a>
									                </li>
									            </ul>
									        </li>

									        <li class="dropdown-submenu">
									            <a class="nav-link">
									                Settings
									            </a>
									            <ul class="dropdown-menu">
									                <li>
									                    <a class="nav-link" href="{{route('AdminHeader')}}">
									                        Site Settings
									                    </a>
									                </li>
									            </ul>
									        </li>
									    </ul>
									</li>
								</ul>
							</nav>
						</div>
					</div>
					<!-- end: header nav menu -->
				</div>

				<!-- start: search & user box -->
				<div class="header-right">

					<a class="btn search-toggle d-none d-md-inline-block d-xl-none" data-toggle-class="active" data-target=".search"><i class="bx bx-search"></i></a>
					<form class="search search-style-1 nav-form d-none d-xl-inline-block">
						<div class="input-group">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
						</div>
					</form>

					<span class="separator"></span>
					<a class="dropdown-language nav-link" href="javascript:void(0)" role="button" id="dropdownLanguage" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="{{('img/blank.gif')}}" class="flag flag-us" alt="English" /> EN
						<i class="fas fa-chevron-down"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownLanguage">
						<a class="dropdown-item" href="javascript:void(0)"><img src="{{('img/blank.gif')}}" class="flag flag-us" alt="English" /> English</a>
						<a class="dropdown-item disabled" href="javascript:void(0)"><img src="{{('img/blank.gif')}}" class="flag flag-es" alt="English" /> Español</a>
						<a class="dropdown-item disabled" href="javascript:void(0)"><img src="{{('img/blank.gif')}}" class="flag flag-fr" alt="English" /> Française</a>
					</div>

					<div id="userbox" class="userbox">
						<a href="javascript:void(0)" data-bs-toggle="dropdown">

							<span class="profile-picture profile-picture-as-text">JD</span>
							<div class="profile-info profile-info-no-role" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name">Hi, <strong class="font-weight-semibold">{{ Auth::user()->name }}</strong></span>
							</div>

							<i class="fas fa-chevron-down text-color-dark"></i>
						</a>

						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li>
									<a role="menuitem" tabindex="-1" href="javascript:void(0)"><i class="bx bx-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="javascript:void(0)" data-lock-screen="true"><i class="bx bx-lock-open-alt"></i> Lock Screen</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="javascript:void(0)"><i class="bx bx-log-out"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">

				    <div class="sidebar-header">
				        <div class="sidebar-toggle d-none d-md-flex" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
				    </div>

				    <div class="nano">
				        <div class="nano-content">
				            <nav id="menu" class="nav-main" role="navigation">

				                <ul class="nav nav-main">
				                    <li>
				                        <a class="nav-link" href="{{route('admin')}}">
				                            <i class="bx bx-home-alt" aria-hidden="true"></i>
				                            <span>Dashboard</span>
				                        </a>                        
				                    </li>
				                    <li class="nav-group-label">CONTROL</li>
				                    <li class="nav-parent nav-expanded">
				                        <a class="nav-link" href="javascript:void(0)">
				                            <i class="bx bx-file" aria-hidden="true"></i>
				                            <span>Posts</span>
				                        </a>
				                        <ul class="nav nav-children">
				                            <li class="">
				                                <a class="nav-link" href="{{route('adminTreads')}}">
				                                    All Post
				                                </a>
				                            </li>
				                            <li>
				                                <a class="nav-link" href="{{route('adminTreadsCreate')}}">
				                                    New Post
				                                </a>
				                            </li>
				                            <li>
				                                <a class="nav-link" href="{{route('adminTreadsDraft')}}">
				                                    Drafts
				                                </a>
				                            </li>
				                        </ul>
				                    </li>
									<li class="nav-parent nav-expanded">
				                        <a class="nav-link" href="javascript:void(0)">
				                            <i class="bx bx-help-circle" aria-hidden="true"></i>
				                            <span>Quiz</span>
				                        </a>
				                        <ul class="nav nav-children">
				                            <li class="">
				                                <a class="nav-link" href="{{route('quiz')}}">
				                                    All Predictions
				                                </a>
				                            </li>
				                            <li>
				                                <a class="nav-link" href="{{route('createQuiz')}}">
				                                    New Predictions
				                                </a>
				                            </li>
				                        </ul>
				                    </li>
				                    <li class="nav-parent nav-expanded">
				                        <a class="nav-link" href="javascript:void(0)">
				                            <i class="bx bx-file" aria-hidden="true"></i>
				                            <span>Payouts</span>
				                        </a>
				                        <ul class="nav nav-children">
				                            <li>
				                                <a class="nav-link" href="{{route('requestPayoutOpen')}}">
				                                    Activate Requests
				                                </a>
				                            </li>
				                            <li>
				                                <a class="nav-link" href="{{route('requestPayoutAll')}}">
				                                    All Requests
				                                </a>
				                            </li>
				                            <li>
				                                <a class="nav-link" href="{{route('requestPayoutWallet')}}">
				                                   Affiliate Requests
				                                </a>
				                            </li>
				                            <li>
				                                <a class="nav-link" href="{{route('requestPayoutAllowi')}}">
				                                    Activity Requests
				                                </a>
				                            </li>
				                        </ul>
				                    </li>
				                    <li class="nav-parent nav-expanded">
				                        <a class="nav-link" href="javascript:void(0)">
				                            <i class="bx bxs-user" aria-hidden="true"></i>
				                            <span>Users</span>
				                        </a> 
				                        <ul class="nav nav-children">
				                            <li>
				                                <a class="nav-link" href="{{route('adminUsers')}}">
				                                    All Users
				                                </a>
				                            </li>
				                            <li>
				                                <a class="nav-link" href="javascript:void(0)">
				                                    Blocked Users
				                                </a>
				                            </li>
				                            <li>
				                                <a class="nav-link" href="{{route('sendGeneralMail')}}">
				                                    Send General Mail
				                                </a>
				                            </li>
				                        </ul>
				                    </li>

									<li>
									<a class="nav-link" href="{{route('adminVendors')}}">
										<i class="bx bx-user-pin" aria-hidden="true"></i>
										<span>Vendors</span>
									</a>
									</li>
				                 
				                    <li class="nav-group-label">Visual</li>
				                    <li>
				                        <a class="nav-link" href="{{route('adminNotificationSite')}}">
				                            <i class="bx bxs-bell-ring" aria-hidden="true"></i>
				                            <span>Announcement</span>
				                        </a>
				                    </li>
									<li class="nav-parent nav-expanded">
				                        <a class="nav-link" href="javascript:void(0)">
				                            <i class="bx bx-page" aria-hidden="true"></i>
				                            <span>Testimonies</span>
				                        </a>
										<ul class="nav nav-children">
				                            <li>
				                                <a class="nav-link" href="{{route('allTestimonies')}}">
				                                    All Testimonies
				                                </a>
				                            </li>

				                            <li>
				                                <a class="nav-link" href="{{route('createTestimony')}}">
				                                    Create Testimonies
				                                </a>
				                            </li>
				                        </ul>
				                    </li>
				                    <li>
				                        <a class="nav-link" href="{{route('Fmanager')}}">
				                            <i class="bx bxs-file-archive" aria-hidden="true"></i>
				                            <span>File Manager</span>
				                        </a>
				                    </li>
				                    <li>
				                        <a class="nav-link" href="{{ route('adminHowItWorkSite') }}">
				                            <i class="bx bxs-help-circle" aria-hidden="true"></i>
				                            <span>How it works</span>
				                        </a>
				                    </li>
				                    <li class="nav-group-label">MANAGEMENT</li>
				                    <li>
				                        <a class="nav-link" href="{{route('coupon')}}">
				                            <i class="bx bxs-coupon" aria-hidden="true"></i>
				                            <span>Coupon Codes</span>
				                        </a>
				                    </li>

									<li>
				                        <a class="nav-link" href="{{ route('adminContest') }}">
											<i class='bx bxs-id-card'aria-hidden="true"></i>
				                            <span>Contest</span>
				                        </a>
				                    </li>

				                    <li class="nav-parent nav-expanded">
				                        <a class="nav-link" href="javascript:void(0)">
				                            <i class="bx bx-cart" aria-hidden="true"></i>
				                            <span>Marketplace</span>
				                        </a>
										<ul class="nav nav-children">
				                            <li>
				                                <a class="nav-link" href="{{route('marketOverview')}}">
				                                    Overview
				                                </a>
				                            </li>
				                            <li>
				                                <a class="nav-link" href="{{route('marketCategory')}}">
				                                    Category
				                                </a>
				                            </li>
				                        </ul>
				                    </li>

				                    <li class="nav-parent nav-expanded">
				                        <a class="nav-link" href="javascript:void(0)">
				                            <i class="bx bx-cog" aria-hidden="true"></i>
				                            <span>Plans</span>
				                        </a>
										<ul class="nav nav-children">
				                            <li>
				                                <a class="nav-link" href="{{route('plan')}}">
				                                    All Plans
				                                </a>
				                            </li>
				                            <li>
				                                <a class="nav-link" href="{{route('planCreate')}}">
				                                    Create New Plan
				                                </a>
				                            </li>
				                        </ul>
				                    </li>

				                    <li class="nav-parent nav-expanded">
				                        <a class="nav-link" href="javascript:void(0)">
				                            <i class="bx bx-cog" aria-hidden="true"></i>
				                            <span>Classes</span>
				                        </a>
										<ul class="nav nav-children">
				                            <li>
				                                <a class="nav-link" href="{{route('bundle')}}">
				                                    All Classes
				                                </a>
				                            </li>
				                            {{-- <li>
				                                <a class="nav-link" href="{{route('mysubscriber')}}">
				                                    Subscribers
				                                </a>
				                            </li> --}}

				                            <li>
				                                <a class="nav-link" href="{{route('bundleCreate')}}">
				                                    Create New Class
				                                </a>
				                            </li>
				                        </ul>
				                    </li>

				                    <li class="nav-parent nav-expanded">
				                        <a class="nav-link" href="javascript:void(0)">
				                            <i class="bx bx-cog" aria-hidden="true"></i>
				                            <span>Settings</span>
				                        </a>
										<ul class="nav nav-children">
				                            <li>
				                                <a class="nav-link" href="{{route('AdminHeader')}}">
				                                    Site Settings
				                                </a>
				                            </li>
				                        </ul>
				                    </li>
				                </ul>
				            </nav>
				        </div>

				        <script>
				            // Maintain Scroll Position
				            if (typeof localStorage !== 'undefined') {
				                if (localStorage.getItem('sidebar-left-position') !== null) {
				                    var initialPosition = localStorage.getItem('sidebar-left-position'),
				                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

				                    sidebarLeft.scrollTop = initialPosition;
				                }
				            }
				        </script>

				    </div>

				</aside>
				<!-- end: sidebar -->

        <section class="content-body content-body-mordern">
          <header class="page-header page-header-left-inline-breadcrumb">
						<h2 class="font-weight-bold text-6">Dashboard</h2>
						<div class="right-wrapper">
							<ol class="breadcrumbs">

								<li><span>Home</span></li>

								<li><span>{{(Request::route()->getName()) }}</span></li>

							</ol>
						</div>
					</header>

          @yield('content')
        </section>

     
  </section>

   
	  <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
		<script src="{{asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
		<script src="{{asset('vendor/jquery-cookie/jquery.cookie.js')}}"></script>
		<script src="{{asset('master/style-switcher/style.switcher.js')}}"></script>
		<script src="{{asset('vendor/popper/umd/popper.min.js')}}"></script>
		<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
		<script src="{{asset('vendor/common/common.js')}}"></script>
		<script src="{{asset('vendor/nanoscroller/nanoscroller.js')}}"></script>
		<script src="{{asset('vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
		<script src="{{asset('vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>

		<!-- Specific Page Vendor -->
		<script src="{{asset('vendor/raphael/raphael.js')}}"></script>
		<script src="{{asset('vendor/morris/morris.js')}}"></script>
		<script src="{{asset('vendor/multi-select/jquery.multi-select.js')}}"></script>
		<script src="{{asset('vendor/dropzone/dropzone.js')}}"></script>
		<script src="{{asset('vendor/datatables/media/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('vendor/datatables/media/js/dataTables.bootstrap5.min.js')}}"></script>
		<script src="{{asset('vendor/tinymce/tinymce.js')}}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{asset('js/theme.js')}}"></script>

		<!-- Theme Custom -->
		<script src="{{asset('js/custom.js')}}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{asset('js/theme.init.js')}}"></script>

		<!-- Examples -->
		<script src="{{asset('js/examples/examples.header.menu.js')}}"></script>
		<script src="{{asset('js/examples/examples.ecommerce.dashboard.js')}}"></script>
		<script src="{{asset('js/examples/examples.ecommerce.datatables.list.js')}}"></script>
  		@yield('scripts')
		@include('partials.notify')
</body>

</html>