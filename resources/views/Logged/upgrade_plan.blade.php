@extends('layouts.main')
	@section('seo')
	<link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" /> {!! SEO::generate() !!}
	@stop

	@section('content')

		@section('left_sidebar')
			@include('partials/left-sidebar')
		@stop
		<div class="col-md-7" style="padding: 0;">
			<div class="main-content-inner">
				<div class="main-content-inner-header">
					<div class="clearfix">
						<div class="pull-left_no">Upgrade My Plan </div>
					</div>
				</div>
				<div class="main-content-inner-contet">
					<div class="scrool-height"></div>
					<div class="show_profile_info clearfix" style="margin-top: 0 !important;">
						<h2 class="c_p_m">Upgrade My Plan</h2>
						<p> Here is list of available plan </p>
						<table class="table table-bordered table-striped table-hover" style="width: 100%;">
							<thead>
								<tr style="height: 26.2833px;">
									<th style="width: 95px; height: 26.2833px;">Name</th>
									<th style="width: 67px; height: 26.2833px;">Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php $vendor = \App\Plan::get(); ?>
								@if(count($vendor) > 0)
								@foreach($vendor as $row)
								<tr style="height: 52px;">
									<td style="width: 95px; height: 52px;">{{ $row->name }}</td>
									<td style="width: 67px; height: 52px;">₦ {{number_format($row->amount, 2)}}</td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>

						<table class="table table-bordered table-striped table-hover" style="width: 100%;">
							<thead>
								<tr style="height: 26.2833px;">
									<th style="width: 95px; height: 26.2833px;">Name</th>
									<th style="width: 67px; height: 26.2833px;">Phone Number</th>
									<th style="width: 137.183px; height: 26.2833px;">Whatsapp</th>
								</tr>
							</thead>
							<tbody>
								<?php $vendor = \App\User::inRandomOrder()->where('is_vendor', '1')->get(); ?>
								@if(count($vendor) > 0)
								@foreach($vendor as $row)
								<tr style="height: 52px;">
									<td style="width: 95px; height: 52px;">{{ $row->fullname }}</td>
									<td style="width: 67px; height: 52px;">{{ $row->number }}</td>
									<td style="width: 137.183px; height: 52px; text-align: center;"><a href="https://api.whatsapp.com/send?phone=234{{ $row->number }}&amp;text=Hello%2C%20Good%20day%20-%20I%20want%20To%20Purchase%20infiniteearners%20Activation%20Code">Chat on Whatsapp</a></td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
						<p><strong>Please note:</strong> do not Send money to another person apart from the contact listed above, if you face any challenge / mis-conduct from any of our coupon agent, please contact us immediately.</p>
						<br> @if(\Session::has('info'))
						<div class="info_timed_inner er_"> {{\Session::get('info')}} </div> @endif
						<br>
						<div class="choose_payment_option">
							<form action="{{route('becomeaproPost')}}" autocomplete="off" method="post">
							    @csrf
								<br>
								<div class="form-group">
									<label>Coupon Code</label>
									<input name="coupon_code" id="ent_cp_code" class="form-control" placeholder="Please enter Coupon Code">
									@if($errors->has('coupon_code')) <div class="er"> {!! $errors->get('coupon_code')[0] !!} </div> @endif
								</div>
								<button class="custom-btn-2" type="submit">Upgrade now</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		@section('right_sidebar')
			@include('partials/right-sidebar')
		@stop

	@stop
@section('scripts')
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script>
		$(document).on('change', '#select_method', function (event) {
			if (event.target.value == '1') {
				$('#ent_code').show();
				$('#ent_cp_code').attr('required', true);
			}
			else {
				$('#ent_code').hide();
				$('#ent_cp_code').attr('required', false);
			}
		});
	</script>
@endSection
