@extends('layouts.main2')

@section('content')

@include('partials.pageTitle')
<!-- Contact Start -->
<div class="rs-contact contact-style2 pt-130 md-pt-80">
    <div class="container">
        <div class="row y-middle">
            <div class="col-lg-6 md-mb-50">
                <div class="sec-title mb-35">
                    <h4 class="title pb-27">
                        Contact Information
                    </h4>
                    <p class="desc">
                        Tincidunt nunc pulvinar sapien et ligula ullamcorper. Eu tincidunt tortor aliquam nulla facilisi. Id venenatis a condimentum vitae
                    </p>
                </div>
                <div class="address-boxs mb-30">
                    <div class="address-icon">
                        <i class="ri-phone-fill"></i>
                    </div>
                    <div class="address-text">
                        <div class="text">
                            <span class="label">Phone</span>
                            <span class="des">
                                +00 123 456 789
                            </span>
                        </div>
                    </div>
                </div>
                <div class="address-boxs mb-30">
                    <div class="address-icon">
                        <i class="ri-mail-fill"></i>
                    </div>
                    <div class="address-text">
                        <div class="text">
                            <span class="label">Email</span>
                            <span class="des">
                                hello@yourmail.com
                            </span>
                        </div>
                    </div>
                </div>
                <div class="address-boxs">
                    <div class="address-icon">
                        <i class="ri-map-pin-fill"></i>
                    </div>
                    <div class="address-text">
                        <div class="text">
                            <span class="label">Location</span>
                            <span class="des">
                                New Jesrsy, 1201, USA
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pl-70 md-pl-15">
                <div class="content-wrap">
                    <div class="sec-title mb-35">
                        <h2 class="title title6 pb-20">
                            24/7 Support
                        </h2>
                        <p class="desc">
                            Tincidunt nunc pulvinar sapien et ligula ullamcorper. Eu tincidunt tortor aliquam nulla facilisi.
                        </p>
                    </div>
                    <div id="form-messages"></div>
                    <form id="contact-form" method="post" action="mailer.php">
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-12 mb-20">
                                    <div class="form-group">
                                        <i class="ri-user-3-line"></i>
                                        <input class="from-control" type="text" id="name" name="name" placeholder="Enter Your name" required="">
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-20">
                                    <div class="form-group">
                                        <i class="ri-mail-line"></i>
                                        <input class="from-control" type="text" id="email" name="email" placeholder="Enter your email address" required="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <i class="ri-edit-line"></i>
                                        <textarea class="from-control" id="message" name="message" placeholder="Write your messags here" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                              <div class="btn-part">
                                  <div class="form-group mt-20">
                                      <input class="readon submit submit3" type="submit" value="Submit Now">
                                  </div>
                              </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


@endsection
@section('script')
@stop
