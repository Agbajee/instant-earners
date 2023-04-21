@extends("newlook3.main")
@section('content')
@php
  $user = Auth::user();
  $country = \App\Models\Country::orderBy('country_name', 'asc')->get();
  $banks = \App\Models\Banks::orderBy('name', 'asc')->get();
  $upline = App\Models\User::where('id', Auth::user()->referred_by_id)->select('username')->first();
  $plan = App\Models\Plan::where('id', Auth::user()->plan)->select('name')->first();
  $referred = \App\Models\User::orderBy('created_at', 'DESC')->where('referred_by_id', $user->id)->count();
@endphp
<div class="content-wrapper">
  <div class="content-bg"></div>
  <div class="container-full">
  <!-- Content Header (Page header) -->	  

  <!-- Main content -->
  <section class="content">
    <div class="row mb-20">
      <div class="col-12 d-flex align-items-center justify-content-center flex-column mb-40" style="z-index:1;">
        <img src="{{ asset('images/users/' . $user->avatar) }}" alt="profile-image" class="profile-pic-b">
        <div class="d-flex justify-content-center align-items-center flex-column w-p100 mt-10 text-white">
          <div class="fs-22 fw-bold">{{ $user->username }}</div>
          <div>{{ $plan->name }}</div>
          <div style="color:#F1602B;">{{ $user->email }}</div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-5">
        <div class="details-card card-body mb-20">              
          <div class="d-flex flex-column justify-content-space-between">
              <div class="d-info">
                <span><i data-feather="user"></i>  Referred By </span>
                <span class="fw-bold">{{$upline->username}}</span>
              </div>
              <div class="d-info">
                <span><i data-feather="user-plus"></i>  Total Referred </span>
                <span class="fw-bold">{{$referred}}</span>
              </div>
              <div class="d-info">
                <span><i class="fa fa-calendar"></i> Joined On </span>
                <span class="fw-bold">{!! date('d:m:y - g A',strtotime(Auth::user()->created_at))!!}</span>
              </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-7 col-xl-8">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs justify-content-center">
            <li><a href="#settings" data-bs-toggle="tab" class="active"> <i data-feather="tool"></i> Profile</a></li>
            <li><a href="#usertimeline" data-bs-toggle="tab"><i data-feather="shield"></i>Security</a></li>
          </ul>

          <div class="tab-content">

            <div class="tab-pane active" id="settings">
              
              <div class="edit-form">		
                <form class="form-horizontal form-element col-12" action="{{route('editAccountPost', 1)}}" method="POST" enctype="multipart/form-data">
                  @csrf

                <div class="title">Profile Details</div>

                @if (Auth::user()->is_vendor)
                <div class="form-group row d-none mt-5">
                  <label for="proifilePic" class="col-sm-2 form-label">Upload Profile Photo</label>

                  <div class="col-sm-10">
                  <input type="file" accept="image/*" class="form-control" id="proifilePic" value="{{Auth::user()->number}}" name="file">
                  </div>
                </div>
                @endif

                <div class="form-group row">
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" value="{{Auth::user()->fullname}}" required placeholder="Fullname" name="fullname">
                  </div>
                </div>
                <div class="form-group row d-none">
                  <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail" value="{{Auth::user()->email}}" name="email" placeholder="Email" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10">
                  <input type="tel" class="form-control" id="inputPhone" value="{{Auth::user()->number}}" placeholder="Phone" required name="number">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="country">
                      <option selected="selected">{{Auth::user()->country}}</option>
                      @foreach($country as $c)
                        <option value="{{ $c->country_name }}">{{ $c->country_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="title" >Payment Details</div>

                <div class="form-group row mt-5">
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="AccNo" name="acc_numb" placeholder="Account Name" value="{{Auth::user()->acc_numb}}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-10">
                    <select class="form-control select2" style="width: 100%;" name="bank">
                      @foreach($banks as $row)
                        <option value="{{ $row->name }}" @if($row->name == Auth::user()->bank) selected @endif>{{ $row->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="accName" name="acc_name" placeholder="Account Name" value="{{Auth::user()->acc_name}}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-10">
                    <button type="submit" class="btn-custom w-p100 waves-effect waves-dark">Submit</button>
                  </div>
                </div>
                </form>
              </div>

            </div>

            <div class="tab-pane" id="usertimeline">
              <div class="edit-form">		
                <form class="form-horizontal form-element col-12" action="{{route('changePasswordPost')}}" method="POST">
                  @csrf
                  <div class="form-group row">
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="oldPass" placeholder="Old Password" name="old_password">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="newPass" placeholder="New Password" name="new_password">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="c_pass" placeholder="Confirm New Password" name="new_password_confirmation">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-10">
                      <button type="submit" class="btn-custom w-p100 waves-effect waves-dark">Submit</button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="edit-form">		
                <form class="form-horizontal form-element col-12" action="{{route('userSettings')}}" method="POST">
                  @csrf
                  <div class="form-group row">
                    <div class="checkbox">
                      <input type="checkbox" id="2fa" @if(Auth::user()->gfa) checked @endif value="1"  disabled>
                      <label for="2fa"  >Google 2FA Authenticator <a href="{{route('twofactor')}}"><small>Settings</small></a></label>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="checkbox">
                      <input type="checkbox" id="check" @if(Auth::user()->w_auto) checked @endif  value="1" name="withdrawal_auto">
                      <label for="check"  >Auto Withdrawal <small>recommended</small></label>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Minimum Payout" value="{{Auth::user()->w_limit}}" required name="withdrawal_limit">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class=" col-sm-10">
                    <button type="submit" class="btn-custom wp100 waves-effect waves-dark">Submit</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>    
          </div>
        </div>
      </div>

    </div>

    <!-- /.row -->

  </section>
  <!-- /.content -->
  </div>
</div>

@endsection
@section('js')
<script>
       $( ".info_timed_inner" ).delay( 5000 ).fadeOut( 400 );


      $(document).on('click','#select_img', function(event) {
          $('#file').click();
      });

      $(document).on('change','#file', function(event) {
          var p = 'file';

          upload_img(p);
      });

      $(document).on('click','#pinToggle', function(event) {
        $( "#wPin" ).prop( "disabled", false );
      });


      function upload_img(a){
          console.log(a);
          var fuData = document.getElementById(a);
          var FileUploadPath = fuData.value;
          if (FileUploadPath == '') {
              alert("Please upload an image");
          } else {
              var Extension = FileUploadPath.substring(
                  FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
              if (Extension == "gif" || Extension == "png" || Extension == "jpeg" || Extension == "jpg") {
                  if (fuData.files && fuData.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function(e) {
                          $('.user_p_image').css('background-image','url(' + e.target.result + ')');
                      }
                      reader.readAsDataURL(fuData.files[0]);
                  }
              }
              else {
                  alert("Sorry, Only Files With The Following Extensions are allowed: GIF, PNG, JPG, JPEG. ");

              }
          }

      }
</script>
@endsection
