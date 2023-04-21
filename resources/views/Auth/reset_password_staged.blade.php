<!DOCTYPE html>
<html lang="en">

  <head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>{{$gt->title}}</title>
		<meta name="keywords" content="{{$gt->keywords}}" />
		<meta name="description" content="{{$gt->description}}">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="shortcut icon" href="{{asset('images/general/'.$gt->favicon)}}">
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{ asset('vendor/animate/animate.compat.css')}}">
		<link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('vendor/boxicons/css/boxicons.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css')}}" />
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.css')}}" />
		<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.theme.css')}}" />
		<link rel="stylesheet" href="{{ asset('vendor/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />
		<link rel="stylesheet" href="{{ asset('vendor/morris/morris.css')}}" />
		

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('css/theme.css')}}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('css/custom.css')}}">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.css" rel="stylesheet" />

		<!-- Head Libs -->
		<script src="{{ asset('vendor/modernizr/modernizr.js')}}"></script>

		<script src="{{ asset('master/style-switcher/style.switcher.localstorage.js')}}"></script>

	</head>
    <body>
    		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo float-left">
					<img src="{{asset('images/general/'.$gt->socialIcon)}}" height="100" alt="Porto Admin" />
				</a>

				<div class="panel card-sign">
					<div class="card-title-sign mt-3 text-end">
						<h2 class="title text-uppercase font-weight-bold m-0"><i class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Change Password</h2>
					</div>
					<div class="card-body">
                    <form action="{{route('acctPasswordStagedPost', $id)}}" method="post" role="form text-left">
                        @csrf

                        <div class="form-group mb-3">
                          <div class="clearfix">
                            <label class="float-left">New Password</label>
                          </div>
                          <div class="input-group">
                            <input name="new_password" value="{{old('id') ? old('id') : ''}}" type="password" class="form-control form-control-lg" />
                            <span class="input-group-text">
                              <i class="bx bx-lock text-4"></i>
                            </span>
                          </div>
                        </div>

                        <div class="form-group mb-3">
                          <div class="clearfix">
                            <label class="float-left">Confirm New Password</label>
                          </div>
                          <div class="input-group">
                            <input name="new_password_confirmation" value="{{old('new_password_confirmation') ? old('new_password_confirmation') : ''}}" type="password" class="form-control form-control-lg" />
                            <span class="input-group-text">
                              <i class="bx bx-lock text-4"></i>
                            </span>
                          </div>
                        </div>             

                        <div class="col-sm-4 text-end">
                          <button type="submit" class="btn btn-primary mt-2">Sign In</button>
                        </div>
                        <p class="text-center">Don't have an account yet?<a href="{{route('signup')}}">Create new account</a> <br> <a href="{{route('signin')}}"> Sing in Here ?</a> </p>
                    </form>
                  </div>
                </div>
        
                <p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2022. All Rights Reserved.</p>
              </div>
            </section>
            <!-- end: page -->
      
          <!-- Vendor -->
          <script src="{{ asset('vendor/jquery/jquery.js')}}"></script>
          <script src="{{ asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
          <script src="{{ asset('vendor/jquery-cookie/jquery.cookie.js')}}"></script>
          <script src="{{ asset('master/style-switcher/style.switcher.js')}}"></script>
          <script src="{{ asset('vendor/popper/umd/popper.min.js')}}"></script>
          <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
          <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
          <script src="{{ asset('vendor/common/common.js')}}"></script>
          <script src="{{ asset('vendor/nanoscroller/nanoscroller.js')}}"></script>
          <script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
          <script src="{{ asset('vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>
      
          <!-- Specific Page Vendor -->
          <script src="{{ asset('vendor/jquery-ui/jquery-ui.js')}}"></script>
          <script src="{{ asset('vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js')}}"></script>
          <script src="{{ asset('vendor/jquery-appear/jquery.appear.js')}}"></script>
          <script src="{{ asset('vendor/bootstrapv5-multiselect/js/bootstrap-multiselect.js')}}"></script>
          <script src="{{ asset('vendor/jquery.easy-pie-chart/jquery.easypiechart.js')}}"></script>
          <script src="{{ asset('vendor/flot/jquery.flot.js')}}"></script>
          <script src="{{ asset('vendor/flot.tooltip/jquery.flot.tooltip.js')}}"></script>
          <script src="{{ asset('vendor/flot/jquery.flot.pie.js')}}"></script>
          <script src="{{ asset('vendor/flot/jquery.flot.categories.js')}}"></script>
          <script src="{{ asset('vendor/flot/jquery.flot.resize.js')}}"></script>
          <script src="{{ asset('vendor/jquery-sparkline/jquery.sparkline.js')}}"></script>
          <script src="{{ asset('vendor/raphael/raphael.js')}}"></script>
          <script src="{{ asset('vendor/morris/morris.js')}}"></script>
          <script src="{{ asset('vendor/gauge/gauge.js')}}"></script>
          <script src="{{ asset('vendor/snap.svg/snap.svg.js')}}"></script>
          <script src="{{ asset('vendor/liquid-meter/liquid.meter.js')}}"></script>
          <script src="{{ asset('vendor/jqvmap/jquery.vmap.js')}}"></script>
          <script src="{{ asset('vendor/jqvmap/data/jquery.vmap.sampledata.js')}}"></script>
          <script src="{{ asset('vendor/jqvmap/maps/jquery.vmap.world.js')}}"></script>
          <script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.africa.js')}}"></script>
          <script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.asia.js')}}"></script>
          <script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.australia.js')}}"></script>
          <script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.europe.js')}}"></script>
          <script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.north-america.js')}}"></script>
          <script src="{{ asset('vendor/jqvmap/maps/continents/jquery.vmap.south-america.js')}}"></script>
      
          <!-- Theme Base, Components and Settings -->
          <script src="{{ asset('js/theme.js')}}"></script>
      
          <!-- Theme Custom -->
          <script src="{{ asset('js/custom.js')}}"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            @yield('js')
      
          @include('partials.notify')
          <script>
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
      
            today = mm + '-' + dd + '-' + yyyy;
            document.getElementById('today').innerHTML = today;
          </script>
      
          <!-- Theme Initialization Files -->
          <script src="{{ asset('js/theme.init.js')}}"></script>
          <!-- Examples -->
          <script src="{{ asset('js/examples/examples.dashboard.js')}}"></script>
        </body>
        
        </html>