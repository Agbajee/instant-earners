<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $gt->title }}</title>
    <meta name="keywords" content="{{ $gt->keywords }}" />
    <meta name="description" content="{{ $gt->description }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="{{ asset('images/general/' . $gt->favicon) }}">

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('newUser/css/vendors_css.css') }}">
    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('newUser/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('newUser/css/style.css') }}">
</head>

<body class="hold-transition theme-primary">

    <div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			<div class="col-12">
				<div class="row justify-content-center g-0">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="content-top-agile p-20 pb-0">
							{{-- <img src="{{ asset('images/general/' . $gt->favicon) }}" width="40px" alt="icon"> --}}
							<img src="{{ asset('newUser/images/logo-potrait-green.png') }}" width="280" alt="logo">
						</div>

						<div class="p-40 form-custom">
							<form action="{{ route('signin') }}" method="post">
								@csrf
								<div class="form-group">
									<input type="text" class="form-primary" placeholder="Username/Email" name="id" autocomplete="off" autocorrect="off">
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<input type="password" class="form-primary" placeholder="Password" name="password" autocomplete="off" autocorrect="off">
									</div>
								</div>
									<div class="row g-4">
										<div class="col-12">
											<div class="fog-pwd text-end">
											<a href="{{ route('acctPassword') }}" class="hover-warning"><i class="ion ion-locked"></i> Forgot password?</a><br>
											</div>
										</div>

										<div class="col-12">
											<button type="submit" class="btn-custom w-p100">LOG IN</button>
										</div>
									</div>
							</form>	
							<div class="text-center">
								<p class="mt-15 mb-0">Don't have an account? <a href="{{ route('signup') }}" class="text-warning ms-5">Sign Up</a></p>
							</div>	
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="{{ asset('newUser/js/vendors.min.js') }}"></script>
	@yield('js')
	@include('partials.notify')
</body>
</html>
