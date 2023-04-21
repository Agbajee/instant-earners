@extends('layouts.main2')
@section('content')
@include('partials.pageTitle')

<!-- Coupon Section Start -->
<div class="rs-inner-blog pt-120 pb-120 md-pt-80 md-pb-80">
    <div class="container">
      <div class="col-lg-6 pl-0 md-pl-0">
        <div class="content-wrap">
          <div class="sec-title mb-35">
            <h2 class="title title6 pb-20">
              Check Your Code
            </h2>
            <p class="desc">
              Paste In Your Code to Confirm Your Code Status
            </p>
          </div>
          <div id="form-messages"></div>
          <form id="contact-form" method="post" action="mailer.php">
            <fieldset>
              <div class="row">
                <div class="col-12 mb-20">
                  <div class="form-group">
                    <!-- <i class="ri-user-3-line"></i> -->
                    <input class="from-control col-12 p-3" type="text" id="name" name="code" placeholder="Paste code here..."
                      required="true">
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
  <!-- Coupon Section End -->



@endsection
