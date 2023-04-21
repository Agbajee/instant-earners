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
				<div class="col-md-7 text-center py-4 bg-white mt-3 shadow" >
					<div class="main-content-inner">
						<div class="main-content-inner-header">
							<div class="clearfix">
								<div class="pull-left_no">How it works </div>
							</div>
						</div>
						<div class="main-content-inner-contet">
							<div class="scrool-height"></div>
							<?php $how_it_works = \App\siteHowItWork::where('id', 1)->first(); ?>
							<div class="show_profile_info clearfix" style="margin-top: 0 !important;">
								{!! $how_it_works->content !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

	@stop
@section('scripts')

    </script>
@endSection
