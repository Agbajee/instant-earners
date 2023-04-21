@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('content')
        @section('left_sidebar')
			@include('partials/left-sidebar')
		@stop
        <div class="col-md-7" style="padding: 0;">
            <div class="main-content-inner">
                <div class="main-content-inner-header">
                    <div class="clearfix">
                        <div class="pull-left_no"> Your Account</div>
                    </div>
                </div>
                <div class="main-content-inner-contet">
                    <div class="scrool-height"></div>
                    @if(\Session::has('info'))
                        <div class="er3_">
                            {!!  \Session::get('info') !!}
                        </div>
                    @endif
                    <div class="show_profile_info clearfix">
                        <div class="most-popular-tag-inner clearfix" style="padding: 0 0 20px 0">
                            <a class="active" href="{{route('account')}}"> My account </a>
                            <a href="{{route('editAccount')}}"> Edit Profile </a>
                            </a> <a href="{{route('editAccount')}}"> Update bank detail </a>
                            <a href="{{route('changePassword')}}"> Change Password </a>
                            <a href="{{route('postTread')}}"> Post Treads </a>
                            <a href="{{route('earningHistory')}}"> Earning History </a>
                            <a href="{{route('support')}}"> Support Ticket </a>
                            @if(Auth::user()->is_admin)
                                <a href="{{route('admin')}}"> Admin </a>
                            @endif
                            @if(Auth::user()->is_vendor)
                                <a href="{{route('vendor')}}"> Vendor </a>
                            @endif
                            @if(Auth::user()->is_moderator)
                                <a href="{{route('moderator')}}"> Moderator </a>
                            @endif
                        </div>
                        @if(App\PaidMembers::where('user_id', Auth::user()->id)->exists() == false)
                        <a href="{{route('becomeapro')}}" class="become_one_of_us">Click Here to Become a Registered Member » </a>
                        @endif

                        @if(App\PaidMembers::where('user_id', Auth::user()->id)->exists() == true)
                            <div class="re_cashout" style="background: #e74c3c;color: #fff;">Your referral link is : <a style="color:blue" href="{{route('refFallback', ['id' => Auth::user()->referral_id])}}">{{route('refFallback', ['id' => Auth::user()->referral_id])}}</a> </div>
                            <?php $ptt = App\requestPayout::where('id', 1)->first(); ?>
                            @if( $ptt->status == '1' && Auth::user()->is_block == 0)

                                <a href="{{route('requestPayout')}}" class="re_cashout"><i class="fa fa-bell"></i> Payment portal is now open click here to cash out your money » </a>
                            @endif
                            @if(\App\payoutRequest::where('user_id', Auth::user()->id)->where('is_payed', 0)->exists()  == true)
                                <div class="re_cashout"><i class="fa fa-clock"></i> Payment request sent successfully</div>
                            @endif
                            @if(Auth::user()->is_block == 1)
                                <div class="re_cashout"><i class="fa fa-clock"></i>Congratulation, You account has been blocked. Contact admin to unblock it</div>
                            @endif
                        @endif
                        <a href="{{route('upgrade')}}" class="re_cashout"><i class="fa fa-bell"></i> Upgrade your account to the next plan » </a>
                        <?php $the_notification = \App\siteNotifcation::where('id', 1)->first(); ?>

                        @if($the_notification->status == 1)
                        <div class="acct_info_sec">
                            <p style="color:white;">Notice Board</p>
                            {!! $the_notification->content !!}
                        </div>
                        @endif
                        <div class="b_of_u">
                            <div class="clearfix" style="padding: 20px;">
                                <div class="col-md-2 col-xs-3 col-sm-2" style="padding: 0;">
                                    <button class="user_p_image" style="background: url({{asset('/images/users/'.Auth::user()->avatar)}}); background-repeat: no-repeat; background-size: cover; background-position: center;" ></button>
                                </div>
                                    <div class="user_info_d nm">
                                        <li><b>Name: </b> {{\Auth::user()->fullname}}</li>
                                        <br>
                                        <li><b>Referral Balance : </b>   {!!  '<button class="mem_s">₦'.number_format(Auth::user()->balance, 2).'</button>'!!}</li>
                                        <li><b>IP Point Balance : </b>   {!!  '<button class="mem_s">'.Auth::user()->allowi_balance.'</button>'!!}</li>

                                        <br>
                                        <?php $plan_name = \App\Plan::where('id', Auth::user()->is_plan)->first()->name; ?>
                                        <li><b>Plan : </b><button class="nt_a_pro_memeber">{{ $plan_name }}</button></li>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="acct_info_sec">
                            Hello, <b>{{Auth::user()->fullname}}</b> want to join us make money online ? all you have to do is refer others to register on our platform using your referral link, and you could earn up to <b>₦10,000</b> Weekly <a href="https://infiniteearners.com.ng//account/how-it-works">Show Me How »</a>
                        </div>



                        <div class="clearfix">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="the_bars">
                                        <div class="text-center">
                                            <?php

                                                $registered = \App\User::where('referred_by_id', Auth::user()->id)->get()->count();
                                                if(Auth::user()->id == 57){

                                                    $registered = 20;

                                                } else {

                                                    $registered = $registered;
                                                }
                                            ?>
                                            <h1><div class="alert alert-danger" role="alert">Registered Referra</h1>
                                            <b> {{$registered}} </div></b>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="the_bars">
                                        <div class="text-center">
                                            <?php

                                                $payed_referral = \App\PaidMembers::where('referred_by_id', Auth::user()->id)->get()->count();
                                                if(Auth::user()->id == 57){

                                                    $payed_referral = 20;

                                                } else {

                                                    $payed_referral = $payed_referral;
                                                }


                                            ?>
                                            <h1>Paid Referral</h1>
                                            <b> {{$payed_referral}} </b>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="the_bars">
                                        <div class="text-center">
                                            <h1>Referral Balance</h1>
                                            <b> ₦ {{number_format(Auth::user()->balance, 2)}} </b>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="the_bars">
                                        <div class="text-center">
                                            <h1>IP point Balance</h1>
                                            <b>{{Auth::user()->allowi_balance}}</b>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
		@section('right_sidebar')
			@include('partials/right-sidebar')
		@stop
@stop
