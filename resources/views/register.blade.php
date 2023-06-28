@php
    $userWithRefId = App\Models\User::where('referral_id', $ref_id)->select('username')->first();
@endphp
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
		<link rel="stylesheet" href="{{ asset('newUser/css/style.css') }}">
		<!-- Select2 CSS -->
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
		<!-- Custom Style-->
		<link rel="stylesheet" href="{{ asset('newUser/css/custom.css') }}">
	</head>
	

<body class="hold-transition theme-primary">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">

            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-5 col-md-5 col-12">
						<div class="content-top-agile p-20 pb-0">
							<img src="{{ asset('newUser/images/logo-potrait-green.png') }}" width="280" alt="logo">
							<p class="my-10 text-primary">Joining under {{$userWithRefId->username }} </p>
						</div>
						<div class="p-20 form-custom">
							<form action="{{ route('signupPost') }}" method="post">
								@csrf
								<div class="form-group">
									<input type="text" class="form-primary ps-15 bg-transparent"
										placeholder="Full Name" value="{{ old('fullname') }}" name="fullname"
										autocomplete="off" required>
								</div>
								<div class="form-group">
									<input type="email" class="form-primary ps-15 bg-transparent"
										placeholder="Email" value="{{ old('email') }}" name="email"
										autocomplete="off" required>
								</div>

								<div class="form-group">
									<input type="text" class="form-primary ps-15 bg-transparent"
										placeholder="Username" value="{{ old('username') }}" name="username"
										autocomplete="off" required>
								</div>
								<div class="form-group d-flex g-0">
										<input type="password" id="change-type" class="form-primary"
											placeholder="Password" value="{{ old('password') }}" name="password"
											autocomplete="off" required>
										<button type="button" id="toggle-password" class="btn-custom"><i class="fa fa-eye-slash"></i></button>
								</div>
								<div class="form-group">
									<input type="tel" class="form-primary ps-15 bg-transparent"
										placeholder="Phone" value="{{ old('number') }}" name="number"
										autocomplete="off" required>
								</div>

								<div class="form-group">
									<select class="form-primary ps-15 bg-transparent select2-enable" name="country">
										<option selected>Select Country</option>
										@php $countries = \App\Models\Country::get(); @endphp
										@foreach ($countries as $country)
											<option value="{{ $country->id }}">
												{{ $country->country_name }}
											</option>
										@endforeach
									</select>
								</div>

								<div class="form-group">

									<input type="text" class="form-primary ps-15 bg-transparent"
										placeholder="Coupon Code" value="{{ old('coupon') }}" name="coupon"
										autocomplete="off" required>
									<p class="text-sm">Dont Have Code? <a href="{{ route('activationCode') }}"
										class="text-dark fw-700">Get Code</a></p>
								</div>

								<div class="form-group">
									<select class="form-primary ps-15 bg-transparent" name="user_package">
										<option selected>Choose Your Package</option>
										@php $plan = \App\Models\Plan::get(); @endphp
										@foreach ($plan as $p)
											<option value="{{ $p->id }}">
												{{ $p->name }}
												<span
													class="text-align-right fw-bolder">{{ '₦' . $p->amount }}</span>
											</option>
										@endforeach
									</select>
								</div>

								<div class="form-group collapse">
									<input type="text" class="form-primary ps-15 bg-transparent"
										name="referral_id" value="{{ $ref_id }}" readonly>
								</div>

								<div class="row">
									<div class="col-12">
										<div class="checkbox">
											<input type="checkbox" id="basic_checkbox_1">
											<label for="basic_checkbox_1">I agree to the <a
													href="{{ route('signin') }}"
													class="text-warning"><b>Terms</b></a></label>
										</div>
									</div>
									<!-- /.col -->
									<div class="col-12">
										<button type="submit" class="btn-custom w-p100">Register</button>
									</div>
									<!-- /.col -->
								</div>
							</form>
							<div class="text-center">
								<p class="mt-15 mb-0">Already have an account?<a href="{{ route('signin') }}"
										class="text-danger ms-5"> Sign In</a></p>
							</div>
						</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('newUser/js/vendors.min.js') }}"></script>
    <script src="{{ asset('newUser/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('newUser/assets/icons/feather-icons/feather.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $("#toggle-password").click(function(e) {
            e.preventDefault();
            let inp = $('#change-type').attr('type');
            if (inp == "password") {
                $('#change-type').attr('type', 'text');
                $('.fa-eye-slash').toggleClass('fa-eye-slash fa-eye');
            } else if (inp == "text") {
                $('#change-type').attr('type', 'password');
                $('.fa-eye').toggleClass('fa-eye fa-eye-slash');
            }
        });

		$(document).ready(function() {
			$('.select2-enable').select2();
		});
    </script>

    @include('partials.notify')
</body>

</html>
