@extends('layouts.main')
	@section('seo')
	<link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" /> {!! SEO::generate() !!} @stop @section('content')

		{{-- @section('left_sidebar')
			@include('partials/left-sidebar')
		@stop --}}
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
			<div class="col-md-7 text-center py-4 bg-white mt-3 shadow"">
				<div class="main-content-inner">
					<div class="main-content-inner-header">
						<div class="clearfix">
							<div class="pull-left_no">Transactions</div>
						</div>
					</div>
					<div class="main-content-inner-contet">
						<div class="scrool-height"></div>
						<div class="show_profile_info clearfix" style="margin-top: 0 !important;">
							<h2 class="c_p_m">User Transaction Details </h2>
							<table class="table table-bordered table-striped table-hover" style="width: 100%;">
								<thead>
									<tr style="height: 26.2833px;">
										<th style="width: 95px; height: 26.2833px;">Type</th>
										<th style="width: 67px; height: 26.2833px;">Amount</th>
										<th style="width: 137.183px; height: 26.2833px;">Status</th>
										<th style="width: 137.183px; height: 26.2833px;">Amount Paid</th>
									</tr>
								</thead>
								<tbody>
									<?php $transaction = \App\payoutRequest::orderBy('created_at', 'DESC')->where('user_id', Auth::user()->id)->paginate(10); ?>
									@foreach($transaction as $row)
									<tr style="height: 52px;">
										<td style="width: 95px; height: 52px;">@if($row->from_account == 1) Wallet @elseif($row->from_account == 2) Allowi @elseif($row->from_account == 3) Wallet + Allowi @endif</td>
										<td style="width: 67px; height: 52px;">₦{{ $row->amount }}</td>
										<td style="width: 137.183px; height: 52px; text-align: center;">{{ $row->is_payed == 1 ? 'Paid' : 'Pending' }}</td>
										<td style="width: 95px; height: 52px;"> @if(!empty($row->amount_paid)) ₦{{ $row->amount_paid }} @endif </td>
									</tr>
									@endforeach
								</tbody>
								<div class="text-left pg">
									{{$transaction->links('partials.pagination')}}
								</div>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
	@stop
@section('scripts')
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script>

@endSection
