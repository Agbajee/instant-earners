@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('content')
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
                <div class="col-md-7 text-center py-4 bg-white mt-3 shadow">
                    <div class="main-content-inner">
                        <div class="main-content-inner-header">
                            <div class="clearfix">
                                <div class="pull-left_no">Payment Successful </div>
                            </div>
                        </div>
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
                                        <li>Refer others using your Referral ID which is <button class="btn-natural">{{Auth::user()->referral_id}}</button>  - or by using your referral link which is : <button class="btn-natural"> {{route('refFallback', ['id' => Auth::user()->referral_id])}} </button>, you can always see this information on your accounts dashboard <a href="{{route('account')}}"><i class="fa fa-external-link-square-alt"></i> Visit Dashboard</a> - on  every registered member  you get a referral commission of ₦500.00. </li>
                                        <li>Earn up by Reading and commenting on latest Forum Trends / Topics (articles) - <a href="{{route('home')}}"> Click Here to See Latest Trends</a> </li>
                                        <li>Earn up ₦100 Daily login bonus
                                        <li>Earn up ₦150 by Sharing Sponsored post on Facebook Timeline or Faceboook Group - <a href="{{url('category/sponsored-treads')}}"> Click Here to Learn More</a> </li>

                                    </ul>
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
    <script>

        $(document).on('change','#select_method', function(event) {
           if(event.target.value == '1'){
                $('#ent_code').show();
                $('#ent_cp_code').attr('required', true);
           } else{
               $('#ent_code').hide();
               $('#ent_cp_code').attr('required', false);
           }
        });


    </script>
@endSection
