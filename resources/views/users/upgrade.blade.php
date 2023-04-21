@extends('newlook3.main') 
	
@section('content')
@php
	$plans = \App\Models\Plan::get(); 
	$counter = 1;
@endphp
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
			<div class="row">
				<div class="col">
					<div class="box">
						<div class="box-header with-border">						
                            <h4 class="box-title">Your plan will be upgraded according to your coupon code</h4>
                        </div>
						<div class="box-body">
							<div class="table-responsive">
								<table class="table table-sm invoice-archive table-striped mb-0" style="min-width: 550px;">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Name</th>
											<th>Amount</th>
											<th>Referral Bonus</th>
											<th>Indirect Ref</th>
											<th>Posts</th>
											<th>Logins</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										@if(count($plans) > 0)
										@foreach($plans as $ui)
										<tr>
											<td>{{$counter++}}</td>
											<td><b>{{$ui->name}}</b></td>
											<td>₦ {{number_format($ui->amount, 2)}}</td>  
											<td>{{ number_format($ui->referral_bonus) }}</td>  
											<td>{{ number_format($ui->indirect_ref) }}</td>
											<td>{{$ui->sponsored}}</td>
											<td>{{$ui->login}}</td>
											<td>
												@if(( Auth::user()->plan == $ui->id))
												<a href="#" class="btn btn-success" >
													Active
												</a>
												@else
												<a href="#" class="btn btn-danger btn-sm" >
													Available
												</a>
												@endif
											</td>

										</tr>
										@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div>
						<div class="box-footer">
							<form action="{{route('becomeaproPost')}}" autocomplete="off" method="post">
								@csrf
								<div class="d-md-flex me-4 justify-content-between">
									<div class="form-group">
										<label>Coupon Code</label>
										<input name="coupon_code" class="form-control" placeholder="Please enter Coupon Code"  style="min-width: 170px;">
									</div>

									<button class="btn btn-light btn-sm" type="submit">Upgrade now</button>
								</div>
							</form>
						</div> 
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
@stop 