@extends('newlook.main')

@section('seo')

<link
    rel="shortcut icon"
    href="{{asset('/images/general/'.$gt->favicon)}}"
    type="image/x-icon"
    />
{!! SEO::generate() !!}

@endsection

@section('category')

<div class="hero-header bg-secondary mb-2">
    <div class="container">
    <h3 class="m-0 p-0">
        Transactions
    </h3>
</div>
</div>

@endsection

@section('content')
<div class="col-12 col-md-7 px-md-2 px-0">

<div class="post-item mb-3 shadow-sm bg-white" style="padding:20px">
    
    <div class="main-content-inner">
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
							    <?php $transaction = \App\Models\payoutRequest::orderBy('created_at', 'DESC')->where('user_id', Auth::user()->id)->paginate(10); ?>
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
@endsection
