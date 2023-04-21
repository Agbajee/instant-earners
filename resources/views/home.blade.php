@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('left_sidebar')
	@include('partials/left-sidebar')
@stop
@section('content')
	<div class="contion">
    @if(\Auth::check() == false)
        <div class="container-fluid">
            <div class="ct_section clearfix">
                <button class="close_option"><i class="fa fa-times"></i></button>
                <div class="col-md-6 dn hidden-xs hidden-sm">
                    <h2>Learn, Share, Earn</h2>
                    <p>Each month, over 50 thousand people come to skygold.biz to learn, share their knowledge, and earn money while doing that</p>
                    <p>Join the world’s largest community.</p>
                </div>
                <div class="col-md-6">
                    <div class="form_cta">
                        <div class="col-md-12">
                            <div class="reg_ct_tg">
                                <h2>Create an Account</h2> </div>
                        </div>
                        <form action="{{route('signupHome')}}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button" title="The User Name of your referral Use FreePass if no one referred you" style="cursor: help;">Referral ID</button>
                                        <input name="referral_id" placeholder="Referral ID" value="FreePass"> </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button">Username</button>
                                        <input name="username" type="text" placeholder="Tobi"> </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button">Full Name</button>
                                        <input name="fullname" placeholder="Tobi Johnson"> </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button">Phone</button>
                                        <input name="number" placeholder="08123456789" type="text"> </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button">Email</button>
                                        <input name="email" placeholder="you@example.com"> </div>
                                </div>
                            </div>
                            <div class="col-md-3 dn">
                                <button class="sumbit_cta" type="submit"> <i class="fa fa-magic"></i> Sign up </button>
                            </div>
                        </form>
                        <div class="col-md-9">
                            <p class="reg_concept"> By clicking "Sign up", you agree to our <a>terms of service</a>, <a href="/privacy-policy">privacy policy</a> and <a>cookie policy</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

	<?php $site_notification = App\Models\siteNotifcation::first(); ?>
	@if($site_notification && $site_notification->status == '1')
        {!! $site_notification->content !!}
	@endif

	@section('content')
       <div class="col-md-7 new">
            <div class="main-content-inner">
                <div class="main-content-inner-header">
                    <div class="clearfix">
                        <div class="pull-left"> Trending Discussion</div>
                    </div>
                </div>
                <div class="main-content-inner-contet">
                    <div class="scrool-height"></div>
                    <?php

                    $tread = \App\Models\Treads::where('status', 1)->orderBy('created_at', 'DESC')->where('is_tread', 1)->paginate(50);
                    foreach ($tread as $item){?>
                    <div class="listed clearfix">
                        <div class="col-md-12dd">
                            <div class="listed_title">

                                <div class="clearfix"> <a href="{{route('tread', $item->slug)}}">{{$item->title}} <span class="hidden-md hidden-sm time_ago hidden-lg">{{$item->created_at->diffForHumans()}}</span> </a> </div>
                                <div class="forum_cat">
                                    <?php $the_cat = \App\Models\CategoryTread::where('tread_id', $item->id)->first();
                                    if($the_cat){ ?>
                                    <button class="f_cat">{{$the_cat->cat->name}}</button>
                                    <?php } ?>

                                </div>
                                <div class="forum_meta"> <span class="infosection">
                                       <span class="listed_title_h">Created - {{$item->created_at->format('g:i a')}} - by <a class="listed_title_a">{{$item->user->fullname}}</a> </span>
                                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-scroll-height"></div>
                    </div>

                    <?php }
                    ?>
<div class="clearfix">
                        <div class="text-center pg">
                            {{$tread->links('partials.pagination')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>
@stop
@section('right_sidebar')
	@include('partials/right-sidebar')
@stop
