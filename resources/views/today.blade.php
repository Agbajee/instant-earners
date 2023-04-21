@extends('newlook2.main')
@section('content')
@php
	$transaction = \App\Models\payoutRequest::orderBy('updated_at', 'desc')->whereDate('updated_at', now())->where('is_payed', 1)->get();
@endphp

<section id="about" class="overlap-height wow animate__fadeIn padding-60px-bottom parallax" data-parallax-background-ratio="0.5" style="background-image:url('images/our-story-bg.jpg');" >
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-xl-8 col-lg-10 text-center overlap-gap-section">
				<div class="w-40px h-2px bg-gradient-orange-pink separator-line-vertical margin-30px-tb d-inline-block"></div>
				<h3 class="alt-font font-weight-500 text-extra-dark-gray letter-spacing-minus-1px">Tod<span class="text-gradient-orange-pink font-weight-600">ay's</span> Pay<span class="text-gradient-orange-pink font-weight-600">out</span></h3>
			</div>
		</div>
	</div>
</section>

<section class="big-section bg-light-gray wow animate__fadeIn" style="visibility: visible; animation-name: fadeIn;">
	<div class="container">
		{{-- <div class="row justify-content-center">
			<div class="col-md-12 text-center margin-four-bottom">
				<h6 class="alt-font text-extra-dark-gray font-weight-500">Lists style 04</h6>
			</div>
		</div> --}}
		<div class="row ">
			<div class="col-12 col-xl-5 col-lg-6 col-md-8">
				<ul class="list-style-04">
					@if(count($transaction) > 0)
					@foreach($transaction as $row)
					<li class="bg-white border-radius-6px margin-20px-bottom">
						<i class="far fa-dot-circle text-fast-blue margin-15px-right" aria-hidden="true"></i>
						<span class="text-extra-dark-gray">{{ $row->name }} -- ₦{{ $row->amount_paid }}</span>
					</li>
					@endforeach
					@else
					<li class="bg-white border-radius-6px margin-20px-bottom">
						<i class="far fa-dot-circle text-fast-blue margin-15px-right" aria-hidden="true"></i>
						<span class="text-extra-dark-gray">No Payment has been made today</span>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</section> 

{{-- 
<div class="col-12 col-md-7 px-md-2 px-0">

	<div class="post-item mb-3 shadow-sm bg-white" style="padding:20px">

	<div class="main-content-inner">
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
</div> --}}
@endsection