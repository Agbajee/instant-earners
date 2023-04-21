@extends('newlook2.main')

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
        Request Referral
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
@endsection
@section('script')
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
