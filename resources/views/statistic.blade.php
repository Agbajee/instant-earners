@extends('layouts.main2') 
@section('content')
@include('partials.pageTitle')
<div class="rs-inner-blog pt-120 pb-100 md-pt-80 md-pb-80">
	<div class="container">
		<div class="col-lg-12 pl-70 md-pl-0">
			<div class="content-wrap">
				<div class="sec-title mb-35">
					<h2 class="title title6 pb-50">
						InstantNaire Leaderboard 
					</h2>
					<div class="row">
						@foreach ($earners as $row)
							<div class="col-md-6">
								<div class="custom-list">
									<img class="list-avatar" src="{{ asset('images/users/' . $row->avatar) }}" alt="">
									<div>
										<div class="list-title">{{ $row->username }}</div>
										<div class="list-desc">
											₦{{ number_format($row->balance + $row->total_payouts, 2) }}
										</div>
									</div>
									<div class="lottie-badge"></div>
								</div>
							</div>
						@endforeach
						{{-- @foreach ($earners as $row)
							<div class="col-md-6">
								<div class="custom-list">
									<img class="list-avatar" src="{{ asset('images/users/' . $row->avatar) }}"
										alt="">
									<div>
										<div class="list-title">{{ $row->username }}</div>
										<div class="list-desc">
											₦{{ number_format($row->total, 2) }}
										</div>
									</div>
									<div class="lottie-badge"></div>
								</div>
							</div>
						@endforeach --}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		
@stop 
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.5/lottie.min.js"></script>
<script>
    let containers = document.querySelectorAll('.lottie-badge')
    for (const container of containers) {
      var animation = lottie.loadAnimation({
      container,
      renderer: 'svg',
      loop: true,
      autoplay: true,
      path: '{{asset('sasco/assets/images/badge.json')}}'
    });
    }
  </script>
@endSection