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

<section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Success Payment</h2>
        <ol>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>Success Payment</li>
        </ol>
      </div>

    </div>
  </section>


@endsection

@section('content')
<div class="col-12 col-md-7 px-md-2 px-0">

<div class="post-item mb-3 shadow-sm bg-white" style="padding:20px">
    
   <div class="main-content-inner">
                
                <div class="main-content-inner-contet">
                    <div class="scrool-height"></div>
                    <div class="show_profile_info clearfix">
                        <div class="most-popular-tag-inner clearfix" style="padding: 0 0 20px 0">
                            <h2 class="su_py">Payment Successful <i class="fa fa-check-circle"></i> </h2>
                            <div class="alert alert-info">Your Membership upgrade was successful, <a class="sp" href="{{route('account')}}">Click Here</a> to see <b>your referral id</b> and <b>referral link</b>. <br> Here are some few tips to start earning with us.
                            </div>
                        </div>

                        <div class="earning_tips">
                            <h2>How to Maximize Your Earnings</h2>
                            <ul>
                                <li>Refer others using your Referral ID which is <button class="btn-natural">{{Auth::user()->referral_id}}</button>  - or by using your referral link which is : <button class="btn-natural"> {{route('refFallback', ['id' => Auth::user()->referral_id])}} </button>, you can always see this information on your accounts dashboard <a href="{{route('account')}}"><i class="fa fa-external-link-square-alt"></i> Visit Dashboard</a> - on  every registered member  you get a referral commission of ₦700.00. </li>
                                <li>Earn up ₦200 by Sharing Sponsored post on Facebook Timeline or Faceboook Group - <a href="{{url('category/sponsored-treads')}}"> Click Here to Learn More</a> </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

</div>

</div>
@endsection

