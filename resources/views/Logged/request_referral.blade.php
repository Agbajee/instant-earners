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
								<div class="pull-left_no">Buy Referral </div>
							</div>
						</div>
						<div class="main-content-inner-contet">
							<div class="scrool-height"></div>
							<div class="show_profile_info clearfix" style="margin-top: 0 !important;">
								<h2 class="c_p_m">Fill the form below to buy referral</h2>

								<p><strong>Please note:</strong> do not Send money to another person apart from the contact listed above, if you face any challenge / mis-conduct from any of our coupon agent, please contact us immediately.</p>
								<br> @if(\Session::has('info'))
								<div class="info_timed_inner er_"> {{\Session::get('info')}} </div> @endif
								<br>
								<div class="choose_payment_option">
									<form autocomplete="off" method="post">
										@csrf
										<br>
										<div class="form-group">
											<label>Number of referral</label>
											<input name="referral" type="number" class="form-control" placeholder="Please enter number of referral"> </div>
											<div class="form-group">
											<label>Phone Number</label>
											<input name="number" type="text" class="form-control" placeholder="Phone Number"> </div>
											<div class="form-group">
											<label>Email</label>
											<input name="email" type="email"  class="form-control" placeholder="Email Address"> </div>
											<button class="custom-btn-2" type="submit">Buy referral</button>
									</form>
									<br><br>
									<a id="paymentbutton" class="custom-btn-2">Fund your wallet</a>
								</div>
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
	<script type="text/javascript">
        var QTCheckout = QTCheckout || {};
        var testMode = false;
        var baseUrl = "";
        QTCheckout.paymentItems = QTCheckout.paymentItems || [];
        QTCheckout.paymentItems.push({
            paymentCode: document.getElementById('paymentbutton'),
            extraData: {
                amount: 'default',
                buttonSize: 'default',
                customerId: 'default',
                mobileNumber: 'default',
                emailAddress: 'default',
                redirectUrl: 'default'
            }
        });
        if (testMode == true) baseUrl = "https://testwebpay.interswitchng.com/quicktellercheckout/scripts/quickteller-checkout.js?v=";
        else baseUrl = "https://paywith.quickteller.com/scripts/quickteller-checkout-min.js?v=";
        if (!QTCheckout.qtScript) {
            var qtScript = document.createElement('script');
            qtScript.type = 'text/javascript';
            qtScript.async = true;
            qtScript.src = baseUrl + new Date().getDay();
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(qtScript, s);
            QTCheckout.qtScript = qtScript;
        }
        else if (QTCheckout.buildPaymentItemsUI) {
            QTCheckout.buildPaymentItemsUI();
        }

    </script>
@endSection
