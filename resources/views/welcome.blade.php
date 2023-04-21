<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('soft/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('soft/img/favicon.png')}}">
  <title>
    Goldmine - Claim Bonus
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('soft/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('soft/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js')}}" crossorigin="anonymous"></script>
  <link href="{{asset('soft/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('soft/css/soft-ui-dashboard.css?v=1.0.3')}}" rel="stylesheet" />
</head>
@php
  $payout = \App\Models\requestPayout::first();
  $user =Auth::user();
  if( $user->plan == 2)
    $value = 1000;
  else {
    $value = 500;
  }
  
@endphp
<body class="g-sidenav-show  bg-gray-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">
      <div class="container">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="{{url('/')}}">
          Goldmine
        </a>
        <a class="navbar-toggler shadow-none ms-2" href="{{route('account')}}" type="button" >
          <span class="navbar-toggler-icon mt-2">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
          </span>
        </a>
      </div>
    </nav>
    <!-- End Navbar -->
    <section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{asset('soft/img/curved-images/curved14.jpg')}}');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">Claim ur Mtn data bonus prize</h1>
              <p class="text-lead text-white">Provide MTN phone number only</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
              <div class="card-header text-center pt-4">
                <h5>Claim Bonus</h5>
              </div>
              <div class="row px-xl-5 px-sm-4 px-3">
                @if($errors)
                    @if (\Session::has('info'))
                    <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text"><strong> {!!  \Session::get('info')!!}</strong></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                @endif

                @if($errors)
                    @if (\Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text"><strong> {!!  \Session::get('success')!!}</strong></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                @endif

              </div>
              <div class="card-body">
                  @if(\App\Models\payoutRequest::where('user_id', $user->id)->where('from_account', 4)->exists()  == false)
                  
                <form id="airtimeForm" action="{{route('welcomeBonus')}}" method="POST" >
                    @csrf
                    
                    <div class="mb-3">
                      <input name=data_tel type="tel" class="form-control" placeholder="Your Phone Number" aria-label="Tel" aria-describedby="tel-addon" required>
                    </div>
                   <div class="mb-3">
                      <input name="data" type="number" min="50" max="10000" class="form-control" placeholder="amount" value="{{$value}}" aria-label="cardAmount" aria-describedby="Cardamount-addon" readonly >
                    </div>
                    
                    <div class="col-6">
                      <label class="form-label mt-2">Network</label>
                      <div class="form-check">
                        <input id="mtn" class="form-check-input" value="Mtn" type="radio" name="network" selected required>
                        <label class="custom-control-label" for="mtn">Mtn</label>
                      </div>
                    </div>
        
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">submit</button>
                    </div>
                  </form>
                  @else
                  <div class="alert alert-info">
                      <h4 class=" text-sm alert-heading text-center text-white">You have filled this form before!</h4>
                  </div>
                  @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
      <div class="container">
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>
                document.write(new Date().getFullYear())
              </script> Goldmine
            </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('soft/js/core/popper.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('soft/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('soft/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('soft/js/plugins/smooth-scrollbar.min.js')}}"></script>
    
    <script>
    window.setTimeout(function() {
      $(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
      });
    }, 4000);

      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('soft/js/soft-ui-dashboard.min.js?v=1.0.3')}}"></script>
  </body>
  
  </html>