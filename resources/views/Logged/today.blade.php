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
								<div class="pull-left_no">Today's Payout</div>
							</div>
						</div>
						<div class="main-content-inner-contet">
							<div class="scrool-height"></div>
							<div class="show_profile_info clearfix" style="margin-top: 0 !important;">
								<h2 class="c_p_m">Today's Payout</h2>
								<table class="table table-bordered table-striped table-hover" style="width: 100%;">
									<thead>
										<tr style="height: 26.2833px;">
											<th style="width: 95px; height: 26.2833px;">Username</th>
											<th style="width: 67px; height: 26.2833px;">Amount</th>
										</tr>
									</thead>
									<tbody>
										<?php $transaction = \App\payoutRequest::orderBy('updated_at', 'desc')->whereDate('updated_at', now())->where('is_payed', 1)->get(); ?>
										@if(count($transaction) > 0)
											@foreach($transaction as $row)
											<tr style="height: 52px;">
												<td style="width: 50%; height: 52px;">{{ $row->name }}</td>
												<td style="width: 50%; height: 52px;">₦{{ $row->amount_paid }}</td>
											</tr>
											@endforeach
										@else
											<tr style="width: 100%; height: 52px;"><td colspan="2">No payment made out today</td></tr>
										@endif
									</tbody>
								</table>

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
	<script>

@endSection
