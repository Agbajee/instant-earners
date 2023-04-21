@extends('layouts.main')
	@section('seo')
	<link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" /> {!! SEO::generate() !!} @stop @section('content')

		@section('left_sidebar')
			@include('partials/left-sidebar')
		@stop
		<div class="col-md-7" style="padding: 0;">
			<div class="main-content-inner">
				<div class="main-content-inner-header">
					<div class="clearfix">
						<div class="pull-left_no">Earning History</div>
					</div>
				</div>
				<div class="main-content-inner-contet">
					<div class="scrool-height"></div>
					<div class="show_profile_info clearfix" style="margin-top: 0 !important;">
						<h2 class="c_p_m">User Earning History </h2>
						<table class="table table-bordered table-striped table-hover" style="width: 100%;">
							<thead>
								<tr style="height: 26.2833px;">
									<th style="width: 95px; height: 26.2833px;">Type</th>
									<th style="width: 67px; height: 26.2833px;">Amount</th>
									<th style="width: 137.183px; height: 26.2833px;">Date</th>
								</tr>
							</thead>
							<tbody>
							    <?php $transaction = \App\EarningHistory::orderBy('created_at', 'DESC')->where('user_id', Auth::user()->id)->paginate(10); ?>
							    @foreach($transaction as $row)
								<tr style="height: 52px;">
									<td style="width: 95px; height: 52px;">{{ $row->type }}</td>
									<td style="width: 67px; height: 52px;">₦{{ $row->amount }}</td>
									<td style="width: 95px; height: 52px;">{{ $row->created_at }}</td>
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
		@section('right_sidebar')
			@include('partials/right-sidebar')
		@stop

	@stop
@section('scripts')
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script>

@endSection
