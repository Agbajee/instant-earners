@extends("newlook3.main")
@section('content')
<div class="content-wrapper">
  <div class="container-full">
    <section class="content">
      <div class="row mx-auto">
        @if (!$user->gfa)
          <div class="ccard card-body text-center">
            <img src="{{$qrCodeUrl}}" alt="QR Code" class="mx-auto ">
            <h2>Scan the QR Code</h2>
            <p class="fs-24">or copy and paste the code below</p>
          </div>

          <div class="card card-body">

            <div class="justify-content-start  mt-3">
                <div class="d-flex form-group">
                    <input id="code" type="text" class="form-control" name="key" value="{{$secret}}" disabled>
                    <button class="mx-2 waves-effect waves-light btn btn-sm btn-warning-light" id="qr-copy"><i data-feather="clipboard"></i></button>
                </div>

                <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#enableModal">
                    <i class="fa fa-open bg-primary"></i> Enable 2FA
                </button>

                <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#info">
                    <i class="fa fa-question bg-primary"> How TO...</i>
                </button>
            </div>

          </div>
        @else
          <div class="ccard card-body text-center">
                <h2>Two Factor Authentication</h2>
                <button type="button" class="btn btn-block btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#disableModal">@lang('Disable Two Factor Authenticator')</button>
          </div>
        @endif
      </div>
    </section>

  </div>
</div>

{{-- Enable modal --}}
<div class="modal fade dialogbox" id="enableModal" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Verify Your OTP')</h5>
            </div>
            <form action="{{route('twofactorEnable')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group basic">
                        <div class="form-wrapper">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-primary">SEND</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- disable modal --}}
<div class="modal fade show" id="disableModal" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Verify Your OTP to Disable')</h5>
            </div>
            <form action="{{route('twofactorDisable')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group basic">
                        <div class="form-wrapper">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-text-primary">SEND</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Info modal --}}
<div class="modal fade dialogbox" id="info" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('Google Authenticator')</h4>
            </div>
                <div class="modal-body">
                    <h3 class="mb-2">@lang('HOW TO ACTIVATE')</h3>
                    <p class="font-20">Download the <strong>GOOGLE AUTHENTICATOR APP </strong>from <strong>App Store</strong> or <strong>Play Store</strong> </p>
                    <p>Click on the plus Icon below the app, and choose <strong>Scan QR code</strong> or <strong>Enter a setup key</strong></p>
                    <p>If u chose the QR code method <small>(recomended)</small>, scan the QR code on your screen and it will immediately add to your Authenticator account.</p>
                    <p>If u chose the Setup key method, Copy and paste the text on your screen and it will immediately add to your Authenticator account.</p>
                    <h5>HOLD ON</h5>
                    <p>Click on the <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#enableModal">Enable 2FA</button> here in your account and paste the 6 digits code on your Google Authenticator App before it changes <strong>That is it, you are done!</strong> </p>
                    <h5>NOTE:</h5>
                    <p>Refreshing this after scanning will change the QR code/ Setup Key. Make sure you did not refresh this page after scanning or entering the setup key or else you might have to start the scanning all over again</p>
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCEL</button>
                        <b class="btn btn-primary" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">@lang('DOWNLOAD APP')</b>

                    </div>
                </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    'use strict';
    document.getElementById("qr-copy").onclick = function()
    {
        document.getElementById('code').select();
        document.execCommand('copy');
        notify('success', 'Copied successfully');
    }
</script>
@endsection
