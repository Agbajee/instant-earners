@extends('layouts.main2')

@section('content')

@include('partials.pageTitle')

<!-- About Start -->
<div class="rs-about about-style1 pt-140 pb-140 md-pt-80 md-pb-75">
    <div class="container">
        <div class="row y-middle">
            <div class="col-lg-6 md-mb-50">
                <div class="about-image-wrap">
                    <div class="images-part">
                        <img class="js-tilt" src="{{asset('sasco/assets/images/about/MK9.jpg')}}" alt="About">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pl-30 md-pl-15">
                <div class="sec-title">
                    <h2 class="title pb-25">
                        A better team to build best software and technology
                    </h2>
                    <p class="desc pb-30">
                        Lincidunt nunc pulvinar sapien et ligula ullamcorper. Eu tincidunt tortor aliquam nulla facilisi. Id venenatis a condimentum vitae sapien pellentesque. Id neque aliquam vestibulum morbi blandit.
                    </p>
                    <ul class="check-lists">
                        <li class="list-item">
                            <span class="icon-list-icon">
                                <i class="fa fa-check-circle"></i>
                            </span>
                            <span class="list-text">AI Powered Search</span>
                        </li>
                        <li class="list-item">
                            <span class="icon-list-icon">
                                <i class="fa fa-check-circle"></i>
                            </span>
                            <span class="list-text">Free Templates</span>
                        </li>
                        <li class="list-item">
                            <span class="icon-list-icon">
                                <i class="fa fa-check-circle"></i>
                            </span>
                            <span class="list-text">Connect with other tools</span>
                        </li>
                    </ul>
                    <div class="btn-part mt-45">
                        <a class="readon " href="about-1.html">
                            <span class="btn-text">Get Started</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Cta Start -->
<div class="rs-cta cta-style2 cta-modify5 cta-purple1 cta-about-style1">
    <div class="container custom5">
       <div class="cta-wrap">
               <div class="sec-title text-center mb-35">
                   <h2 class="title white-color pb-35">
                       Get reday to start record<br>
                        your moment?
                   </h2>
                   <div class="cta-btn">
                       <a class="readon started small-cta" href="contact-1.html">
                           <span class="btn-text">Get Started</span>
                       </a>
                   </div>
               </div>
               <div class="cta-animate">
                   <div class="cta-shapes one">
                       <img class="rotated-style" src="{{asset('sasco/assets/images/cta/style3/shape-7.png')}}" alt="Images">
                   </div>
                   <div class="cta-shapes two">
                       <img class="horizontal3" src="{{asset('sasco/assets/images/cta/style3/dots-1.png')}}" alt="Images">
                   </div>
                   <div class="cta-shapes three">
                       <img class="horizontal3" src="{{asset('sasco/assets/images/cta/style3/dots-2.png')}}" alt="Images">
                   </div>
                   <div class="cta-shapes four">
                       <img class="spiner" src="{{asset('sasco/assets/images/cta/style3/shape-1.png')}}" alt="Images">
                   </div>
                   <div class="cta-shapes five">
                       <img class="horizontal3" src="{{asset('sasco/assets/images/cta/style3/shape-2.png')}}" alt="Images">
                   </div>
                   <div class="cta-shapes six">
                       <img class="rotated-style" src="{{asset('sasco/assets/images/cta/style3/shape-6.png')}}" alt="Images">
                   </div>
                   <div class="cta-shapes seven">
                       <img class="left-right2" src="{{asset('sasco/assets/images/cta/style3/shape-5.png')}}" alt="Images">
                   </div>
                   <div class="cta-shapes eight">
                       <img class="scale2" src="{{asset('sasco/assets/images/cta/style3/circle-2.png')}}" alt="Images">
                   </div>
               </div>
       </div>
    </div>
</div>
<!-- Cta End -->
<!--End pagewrapper-->

@endsection
@section('script')
@stop
