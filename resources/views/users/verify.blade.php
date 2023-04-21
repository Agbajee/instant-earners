<!DOCTYPE html>
<html lang="en">

<head>
    <title>Verify your Account</title>
    <meta name="keywords" content="{{ $gt->keywords }}" />
    <meta name="description" content="{{ $gt->description }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="{{ asset('images/general/' . $gt->favicon) }}">

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('newUser/css/vendors_css.css') }}">
    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('newUser/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('newUser/css/skin_color.css') }}">
</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(https://webkit-admin-template.multipurposethemes.com/bs5/images/auth-bg/bg-1.jpg)">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">
			
			<div class="col-12">
				<div class="row justify-content-center g-0">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded10 shadow-lg">
							<div class="content-top-agile p-20">
								<img src="{{ asset('images/general/' . $gt->logo) }}" alt="Miratel logo" width="200px">
								<h3 class="mb-0">{{$user->fullname}}</h3>
							</div>
							<div class="p-40">
								<form action="{{route('verifyAccountSubmit')}}" method="post">
                                    @csrf
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											<input type="number" class="form-control ps-15 bg-transparent" name="code" placeholder="Verification Code Here" required>
										</div>
									</div>
									  <div class="row">
										<div class="col-12">
                                            <p>Enter the verification code sent to you email</p>
                                            <p>@ <span class="text-danger">{{$user->email}}</span> <a style="text-decoration:underline;" href="javascript:void();" data-bs-target="#changeEmail" data-bs-toggle="modal">change email</a> </p> 
										</div>

										<div class="col-12 mt-10 ">
                                            
										</div>
										<!-- /.col -->
									  </div>
								</form>		


								<div class="text-center">
									<p class="mt-15 mb-0"> <a href="{{route('sendVerify', $user->id)}}" style="text-decoration:underline;">resend verification code</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
						
		</div>
	</div>	

    <div class="modal fade dialogbox" id="changeEmail" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Change Your Email')</h5>
                </div>
                <form action="{{route('changeEmail')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group basic">
                            <div class="form-wrapper">
                                <input type="email" class="form-control" name="email" placeholder="@lang('Enter a valid email...')">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-text-primary">SEND</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<!-- Vendor JS -->
	<script src="{{ asset('newUser/js/vendors.min.js') }}"></script>
	<script src="{{ asset('newUser/js/pages/chat-popup.js') }}"></script>
	<script src="{{ asset('newUser/assets/icons/feather-icons/feather.min.js') }}"></script>

	@yield('js')
	@include('partials.notify')
</body>
</html>l>
