@extends('layouts.main')
	@section('seo')
	<link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" /> {!! SEO::generate() !!} @stop @section('content')

	<main id="main">

		<!-- ======= Contact Section ======= -->
		<section class="breadcrumbs">
		  <div class="container">

			<div class="d-flex justify-content-between align-items-center">
			  <h2>Top Earners</h2>
			  <ol>
				<li><a href="{{ url('/') }}">Home</a></li>
				<li>Top Earners</li>
			  </ol>
			</div>

		  </div>
		</section>

		<section class="pricing section-bg" data-aos="fade-up">
			<div class="container">
				<div class="col-md-7" style="padding: 0;">
					<div class="main-content-inner">
						<div class="main-content-inner-header">
							<div class="clearfix">
								<div class="pull-left_no">Activation Code </div>
							</div>
						</div>
						<div class="main-content-inner-contet">
							<div class="scrool-height"></div>
							<div class="show_profile_info clearfix" style="margin-top: 0 !important;">
								<h2 class="c_p_m">Please chat either of the number below to get your activation code</h2>

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

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
		{{-- @section('right_sidebar')
			@include('partials/right-sidebar')
		@stop  --}}

	@stop
@section('scripts')
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>


    </script>
@endSection
