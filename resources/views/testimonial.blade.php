<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Goldmine -- Testimonials</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="A platform to earn by performing simple tasks" name="description">
    <meta content="Affiliate, Cash, BLog, Earn, Money, News, Sponsored posts" name="keywords">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url(//fonts.googleapis.com/css?family=Montserrat:300,400,500);
.testimonial6 {
  font-family: "Montserrat", sans-serif;
  color: #8d97ad;
  font-weight: 300;
}

.testimonial6 h1,
.testimonial6 h2,
.testimonial6 h3,
.testimonial6 h4,
.testimonial6 h5,
.testimonial6 h6 {
  color: #3e4555;
}

.testimonial6 .font-weight-medium {
  font-weight: 500;
}

.testimonial6 h5 {
    line-height: 22px;
    font-size: 18px;
}

.testimonial6 .subtitle {
  color: #8d97ad;
  line-height: 24px;
	font-size: 16px;
}

.testimonial6 .testi6 {
  border-right: 1px solid rgba(120, 130, 140, 0.13);
}

.testimonial6 .testi6 .nav-link {
  border-radius: 0px;
  margin: 8px -2px 8px 0;
}

.testimonial6 .testi6 .nav-link img {
  width: 70px;
  opacity: 0.5;
}

.testimonial6 .testi6 .nav-link.active {
  background: transparent;
  color: #8d97ad;
  border-right: 3px solid #2cdd9b;
}

.testimonial6 .testi6 .nav-link.active img {
  opacity: 1;
}

.testimonial6 .btn-danger {
    background: #ff4d7e !important;
    border: 1px solid #ff4d7e !important;
}

.testimonial6 .btn-md {
    padding: 18px 0px;
    width: 60px;
    height: 60px;
    font-size: 20px;
}

@media (max-width: 767px) {
	.testimonial6 .testi6 .nav-link {
    margin: 0px 0px -2px 0;
    padding: 10px;
	}
	.testimonial6 .testi6 {
    -webkit-box-orient: horizontal !important;
    -webkit-box-direction: normal !important;
    -webkit-flex-direction: row !important;
    -ms-flex-direction: row !important;
    flex-direction: row !important;
    border-right: 0px solid rgba(120, 130, 140, 0.13);
    border-bottom: 1px solid rgba(120, 130, 140, 0.13);
    margin-bottom: 40px;
	}
	.testimonial6 .testi6 .nav-link img {
    width: 40px;
	}
	.testimonial6 .testi6 .nav-link.active {
			border-right: 0px solid #2cdd9b;
			border-bottom: 3px solid #2cdd9b;
	}
}

.bg-cover {
    background-attachment: static;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
    </style>

</head>
<?php 
    $test = \App\Models\Testimonial::get();
?>
<body>
    <div class="jumbotron bg-cover text-white" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.6) 0%,rgba(0,0,0,0.6) 100%), url(https://placeimg.com/1000/480/nature)">
        <div class="container">
        <h1 class="display-4">Testimonial</h1>
        <p class="lead text-uppercase">These are Testimonies of our Users (GOLDMINERS)As Regards the Website in Terms of Accessibility and Payouts with Ease</p>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg" href="#more" role="button">Read more</a>
          </div>
      <!-- /.container   -->
      </div>

    <div id="more" class="testimonial6 py-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-2 col-md-3">
              <div class="nav flex-column nav-pills testi6" id="v-pills-tab" role="tablist">

                {{-- <a class="nav-link active" data-toggle="pill" href="#t6-1" role="tab" aria-controls="t6-1" aria-expanded="true">
                    <img src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/testimonial/1.jpg" alt="wrapkit" class="rounded-circle" />
                </a> --}}

                @foreach ($test as $te)
                    @if ($te->user_id == 1)
                     <a class="nav-link active" data-toggle="pill" href="#t6-1" role="tab" aria-controls="t6-1" aria-expanded="true">
                        <img src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/testimonial/1.jpg" alt="wrapkit" class="rounded-circle" />
                    </a>   
                    @else
                    <a class="nav-link " data-toggle="pill" href="#t6-{{ $te->user_id }}" role="tab" aria-controls="t6-1" aria-expanded="true">
                        <img src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/testimonial/1.jpg" alt="wrapkit" class="rounded-circle" />
                    </a> 
                    @endif
                
                @endforeach
              </div>
            </div>

            <div class="col-lg-9 col-md-8 ml-auto align-self-center">
              <div class="tab-content" id="v-pills-tabContent">

                <div class="tab-pane fade show active" id="t6-1" role="tabpanel">
                  <h3 class="font-weight-medium">We Make Impact</h3>
                  <h6 class="subtitle mt-4 font-weight-normal">Our Platform aims to improve people's standard of living </h6>
                  <div class="d-flex mt-5">
                    <div>
                      <h5 class="mb-0 text-uppercase font-weight-normal">Goldmine</h5>
                      {{-- <h6 class="subtitle font-weight-normal">Texas</h6> --}}
                    </div>
                    {{-- <button class="btn rounded-circle btn-danger btn-md ml-auto"><i class="icon-bubble"></i></button> --}}
                  </div>
                </div>

                @foreach ($test as $te)
                <div class="tab-pane fade" id="t6-{{ $te->user_id }}" role="tabpanel">
                  <h3 class="font-weight-medium">Here is what {{ $te->fullname }} has to say </h3>
                  <h6 class="subtitle mt-4 font-weight-normal">{{ $te->testimony }}</h6>
                  <div class="d-flex mt-5">
                    <div>
                      <h5 class="mb-0 text-uppercase font-weight-normal">{{ $te->fullname }}</h5>
                      {{-- <h6 class="subtitle font-weight-normal">Texas</h6> --}}
                    </div>
                  </div>
                </div>
                @endforeach

              </div>
            </div>
          </div>

          <button class="btn rounded-circle btn-danger btn-md ml-auto float-right"><i class="icon-arrow-left"></i></button> 
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>