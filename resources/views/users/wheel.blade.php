@extends("newlook3.main")
<style>
  .spin-title {
    text-transform: capitalize;
    color:#171717;
    font-weight: 700;
    font-size: 46px;
  }

  .wins{
    color: #171717;
    width: 100%;
    height: auto;
    padding: 20px 10px;
    border-radius: 25px;
    background: #bebcbc40;
    -webkit-backdrop-filter: blur(6px);
    backdrop-filter: blur(6px);
    border: 1px solid rgba(255,255,255,0.125);
  }

  .object{
    position:absolute;
    width: 100%;
    z-index: -1;
  }
  .card-transparent{
    background: transparent;
  }

  @keyframes animate {
    0%{
      transform: rotate(0deg);
    }
    100%{
      transform: rotate(180deg);
    }
  }

  .success{
    border: 2px solid rgb(95, 224, 52);
  }
  .warning{
    border: 2px solid rgb(255, 225, 0);
  }
  .error{
    border: 2px solid red;
  }

  
</style>

@php
  $per_spin = \App\Models\requestPayout::first()->per_spin;
@endphp
@section('content')
<div class="content-wrapper">
  <div class="container-full">
    <section class="content">
      <div class="row justify-content-center align-content-center">
          <div class="col-md-6 ">
            <div class="ccard p-3 text-center">
                <h3 class="spin-title">Lucky Wheel</h3>
                <p>Spin for free and win Amazing prices...</p>
                <button href="#" class="waves-effect waves-light btn-danger-light rounded10 w-50 h-50 l-h-50 fs-18 "
                    data-bs-toggle="modal" 
                    data-bs-target="#info" 
                    title="infomation">
                    <i data-feather="help-circle"></i>
                </button>
            </div>
          </div>

          <div style="z-index: 99" class="col-md-6 mb-3 text-center">
              <div id="gameBox"></div>

              <div id="wins" class=" text-center wins">Touch The Wheel to test your luck</div>
                
              <form id="wheelForm" class="collapse">
                @csrf
                <input id="price" name="price" data-plugin-textarea-autosize value="" type="hidden" class="form-control my-2">
                <button id="claimPrice" type="submit" class="btn btn-primary hidden"> Claim Price </button>
              </form>
          </div>
      </div>
    </section>

  </div>
</div>

{{-- Modal --}}

{{-- modal success --}}
<div id="success" class="modal success fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">Success</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body msg-success"> </div>
    </div>
  </div>
</div>

{{-- modal not allowed --}}
<div id="warning" class="modal warning fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">Not Allowed</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body msg-warning"> </div>
    </div>
  </div>
</div>

{{-- modal unsuccessful --}}
<div id="error" class="modal error fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">Unsuccessful</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body msg-error"> </div>
    </div>
  </div>
</div>
{{-- modal --}}

<div class="modal fade dialogbox" id="info" data-bs-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">@lang('Spin Instruction')</h4>
          </div>
            <div class="modal-body">
                <p class="font-20">Each Spin Cost <strong>{{$per_spin}}</strong> activity point whether you win or you lose.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
            </div>
      </div>
  </div>
</div>

@endsection
@section('js')
<script src="{{asset('newUser/js/phaser.min.js')}}"></script>
<script src = "{{asset('newUser/js/game.js')}}"></script>
<script>
  'use strict';
  (function($) {
    $('#wheelForm').on('submit', function(e) {
      e.preventDefault();
      var data = $(this).serialize();
      $.ajax({
        type:"POST",
        url:"{{route('luckyWheelPost')}}",
        data:data,
        dataType:"json",

        success:function(response) {
          if(response.info){
            $('.msg-error').text(response.info);
            $('#error').modal('show');
          }
          else if(response.warning){
            $('.msg-warning').text(response.warning);
            $('#warning').modal('show');
          }
          else{
            $('.msg-success').text(response.success);
            $('#success').modal('show');
          }
        }
      });
    })
  })(jQuery)
</script>
@endsection