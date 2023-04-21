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
		<link rel="stylesheet" href="{{ asset('css/theme.css')}}" />
		<link rel="stylesheet" href="{{ asset('css/custom.css')}}">
		<script src="{{ asset('vendor/modernizr/modernizr.js')}}"></script>
	</head>
    <body>
    		<!-- start: page -->
		<section class="body-sign">
      <div class="center-sign">
				<a href="/" class="logo float-left">
					<img src="{{asset('images/general/'.$gt->favicon)}}" height="70" alt="Porto Admin" />
				</a>

				<div class="panel card-sign">
					<div class="card-title-sign mt-3 text-end">
						<h2 class="title text-uppercase font-weight-bold m-0"><i class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Recover Password</h2>
					</div>
					<div class="card-body">
						<div class="alert alert-info">
							<p class="m-0">Enter your e-mail below and we will send you reset instructions!</p>
						</div>
                <form  action="{{route('acctPasswordPost')}}" method="post">
                  @csrf
                  <div class="form-group mb-0">
                    <div class="input-group">
                      <input name="email" type="email" placeholder="E-mail" class="form-control form-control-lg" />
                      <button class="btn btn-primary btn-lg" type="submit">Proceed!</button>
                    </div>
                  </div>
    
                  <p class="text-center mt-3">Remembered? <a href="{{route('signin')}}">Sign in</a></p>
                </form>
              </div>
            </div>
    
            <p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2023. All Rights Reserved.</p>
          </div>
    </section>
    <!-- end: page -->

  <!-- Vendor -->
  <script src="{{ asset('vendor/jquery/jquery.js')}}"></script>
  <script src="{{ asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
  <script src="{{ asset('vendor/popper/umd/popper.min.js')}}"></script>
  <script src="{{ asset('vendor/common/common.js')}}"></script>
  <script src="{{ asset('js/theme.js')}}"></script>
  <script src="{{ asset('js/custom.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @yield('js')
  @include('partials.notify')
</body>

</html>