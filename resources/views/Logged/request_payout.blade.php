@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('content')
        @section('left_sidebar')
			@include('partials/left-sidebar')
		@stop
        <div class="col-md-7"  style="padding: 0;">
            <div class="main-content-inner">

                <div class="main-content-inner-header">
                    <div class="clearfix">
                        <div class="pull-left_no_1">
                            @if(!\App\payoutRequest::where('user_id', Auth::user()->id)->where('is_payed', 0)->exists()  == true) Request Payout - Fill in the form below request payout @else Payment request sent successfully @endif</div>
                    </div>
                </div>
                <div class="main-content-inner-contet">
                    <div class="scrool-height"></div>
                    @if(\Session::has('notice'))
                        <div class="er3_">
                            {!!  \Session::get('notice') !!}
                        </div>
                    @endif
                    <div class="show_profile_info clearfix">

                    @if(!\App\payoutRequest::where('user_id', Auth::user()->id)->where('is_payed', 0)->exists()  == true)
                                <div class="b_of_u_2">
                                    <div class="clearfix">
                                        <p><b>Please Note</b> Payout request takes a maximum of 2 - 3 days to complete</p>
                                        <form method="post" action="{{route('requestPayoutPost')}}">
                                            @csrf
                                            <div class="form-group"><br>
                                                 Referral Earnings {{number_format(Auth::user()->balance)}} + Activity Earnings ({{number_format(Auth::user()->allowi_balance)}}) = Total ₦ {{ number_format((int)Auth::user()->balance + (int)Auth::user()->allowi_balance, 2) }}<br><br>
                                                <label>From</label>
                                                <br>
                                                <?php $the_payout = \App\requestPayout::first(); ?>
                                                <select name="from" class="form-control" id="select_amount">
                                                    @if(Auth::user()->is_plan == 1)
                                                        @if($the_payout && $the_payout->wallet == '1' && !\App\payoutRequest::where('user_id', Auth::user()->id)->where('is_payed', 0)->where('from_account', 1)->exists()  == true)
                                                        <option value="1"> Referral Earnings ₦ {{ number_format((int)Auth::user()->balance) }}</option>
                                                        @endif
                                                        @if($the_payout && $the_payout->allowi == '1' && !\App\payoutRequest::where('user_id', Auth::user()->id)->where('is_payed', 0)->where('from_account', 2)->exists()  == true)
                                                        <option value="2"> Activity Earnings ₦ {{ number_format((int)Auth::user()->allowi_balance) }}</option>
                                                        @endif
                                                        @if($the_payout && $the_payout->walletallowi == '1' && !\App\payoutRequest::where('user_id', Auth::user()->id)->where('is_payed', 0)->where('from_account', 3)->exists()  == true)
                                                        <option value="3"> Referral + Activity Earnings ₦ {{ number_format((int)Auth::user()->balance + (int)Auth::user()->allowi_balance) }}</option>
                                                        @endif
                                                    @endif

                                                    @if(Auth::user()->is_plan == 2)
                                                        @if($the_payout && $the_payout->wallet2 == '1' && !\App\payoutRequest::where('user_id', Auth::user()->id)->where('is_payed', 0)->where('from_account', 1)->exists()  == true)
                                                        <option value="1"> Referral Earnings ₦ {{ number_format((int)Auth::user()->balance) }}</option>
                                                        @endif
                                                        @if($the_payout && $the_payout->allowi2 == '1' && !\App\payoutRequest::where('user_id', Auth::user()->id)->where('is_payed', 0)->where('from_account', 2)->exists()  == true)
                                                        <option value="2"> Referral Earnings ₦ {{ number_format((int)Auth::user()->allowi_balance) }}</option>
                                                        @endif
                                                        @if($the_payout && $the_payout->walletallowi2 == '1' && !\App\payoutRequest::where('user_id', Auth::user()->id)->where('is_payed', 0)->where('from_account', 3)->exists()  == true)
                                                        <option value="3"> Referral + Activity Earnings ₦ {{ number_format((int)Auth::user()->balance + (int)Auth::user()->allowi_balance) }}</option>
                                                        @endif
                                                    @endif
                                                </select>
                                            </div>


                                            <div class="form-group"><br>
                                                <label>Referral Earnings</label>
                                                <br> <input type="text" class="form-control" name="amount" value="" placeholder="Amount in Naira">
                                            </div>
                                            <div class="form-group" id="referral_amount" style="display:none"><br>
                                                <label>Activities Earnings</label>
                                                <br> <input type="text" class="form-control" name="activities_amount" value="" placeholder="Referral Amount in Naira">
                                            </div>

                                            <div class="form-group">
                                                <label>Bank Account Name</label>
                                                <input type="text" name="bank_account_name" class="form-control" placeholder="Bank Account Name" value="{{ base64_decode(Auth::user()->acc_name) }}" readonly>

                                                @if($errors->has('bank_account_name'))
                                                    <div class="er">
                                                        {!!  $errors->get('bank_account_name')[0] !!}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Bank Account Number</label>
                                                <input type="text" name="bank_account_number" class="form-control" placeholder="Bank Account Number" value="{{ base64_decode(Auth::user()->acc_numb) }}" readonly>

                                                @if($errors->has('bank_account_number'))
                                                    <div class="er">
                                                        {!!  $errors->get('bank_account_number')[0] !!}
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="form-group">
                                                <label>Bank Name</label>
                                                <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="{{ base64_decode(Auth::user()->bank) }}" readonly>

                                                @if($errors->has('bank_name'))
                                                    <div class="er">
                                                        {!!  $errors->get('bank_name')[0] !!}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Facebook Profile Link</label>
                                                <input type="text" name="facebook_profile_link" class="form-control" placeholder="Facebook Profile Link" value="{{Auth::user()->facebook}}" readonly>

                                                @if($errors->has('facebook_profile_link'))
                                                    <div class="er">
                                                        {!!  $errors->get('facebook_profile_link')[0] !!}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <button class="custom-btn" type="submit">Send request</button>
                                            </div>


                                        </form>
                                    </div>

                                </div>
                    @else
                                <div class="payemtn_r_s">
                                <h2><i class='fa fa-check-circle'></i> Request sent successfully</h2> <br>Payout request Sent successfully, please note payout request takes a maximum of 2 - 3 days to complete
                                </div>
                    @endif

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
    <script src="{{asset('assets/js/jquery.sticky.js')}}"></script>
    <script>
        $(document).ready(function(){
            if($("#select_amount").val() == 3){
                $("#referral_amount").css("display", "block");
            }
        });
        $("#select_amount").change(function(){
           var from = $(this).val();
           if(from == 3){
               $("#referral_amount").css("display", "block");
           } else {
               $("#referral_amount").css("display", "none");
           }
        });
    </script>
@endSection
