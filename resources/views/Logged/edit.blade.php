@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('content')
        @section('left_sidebar')
			@include('partials/left-sidebar')
		@stop
        <div class="col-md-7" style="padding: 0;">
            <div class="main-content-inner">
                <div class="main-content-inner-header">
                    <div class="clearfix">
                        <div class="pull-left_no"> Your Account</div>
                    </div>
                </div>
                <div class="main-content-inner-contet">
                    <div class="scrool-height"></div>
                    <div class="show_profile_info clearfix">
                        <div class="most-popular-tag-inner clearfix" style="padding: 0 0 20px 0"><a href="{{route('account')}}"> My Account </a> <a href="{{route('editAccount')}}" class="active"> Edit Profile </a> <a href="{{route('changePassword')}}"> Change Password </a> <a href="{{route('support')}}"> Support Ticket </a> </div>
                        @if(App\PaidMembers::where('user_id', Auth::user()->id)->exists() == false)
                        <a href="{{route('becomeapro')}}" class="become_one_of_us">Click Here to Become a Registered Member » </a>
                        @endif
                        @if(\Session::has('info2'))
                            <div class="info_timed_inner er2_">
                                {{\Session::get('info2')}}
                                    </div>
                        @endif
                        @if($errors->has('file'))
                            <div class="er_" style="margin-top: 0;">
                                {!!  $errors->get('file')[0] !!}
                            </div>
                        @endif

                        <div class="b_of_u">

                            <div class="clearfix" style="padding: 20px;">
                                <form method="post" action="{{route('editAccountPost', 1)}}" enctype="multipart/form-data">
                                <div class="col-md-2" style="padding: 0">
                                    <button class="user_p_image" style="background: url({{asset('/images/users/'.Auth::user()->avatar)}}); background-repeat: no-repeat; background-size: cover; background-position: center;" type="button"></button>

                                        <button class="change_img" id="select_img" type="button">Change Image</button>
                                        <input type="file" style="display: none" id="file" name="file">

                                </div>
                                <div class="col-md-10">
                                    <div class="user_info_d">

                                            @csrf
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input  class="form-control" value="{{Auth::user()->fullname}}" name="fullname">

                                                @if($errors->has('fullname'))
                                                    <div class="er">
                                                        {!!  $errors->get('fullname')[0] !!}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Phone number</label>
                                                <input  class="form-control" value="{{Auth::user()->number ? Auth::user()->number : '' }}" name="number">

                                                @if($errors->has('number'))
                                                    <div class="er">
                                                        {!!  $errors->get('number')[0] !!}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Username</label>
                                                <input disabled class="form-control" value="{{Auth::user()->username}}">

                                            </div>

                                            <div class="form-group">
                                                <label>Email</label>
                                                <input disabled class="form-control" value="{{Auth::user()->email}}">
                                            </div>

                                            <div class="form-group">
                                                <label>Bank Name</label>
                                                <select name="bank" class="form-control">
                                                    <option value="">Select Bank</option>
                                                    @foreach($banks as $row)
                                                        <option value="{{ $row['bankCode'] }}" @if($row['bankCode'] == base64_decode(Auth::user()->bankcode)) selected @endif>{{ $row['bankName'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Account Number</label>
                                                <input name="acc_numb" class="form-control" value="{{ base64_decode(Auth::user()->acc_numb) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Account Name</label>
                                                <input name="acc_name" class="form-control" value="{{ base64_decode(Auth::user()->acc_name) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Facebook</label>
                                                <input name="facebook" class="form-control" value="{{Auth::user()->facebook}}">
                                            </div>

                                            <div class="form-group">
                                                <label>Security Question</label>
                                                <select name="security_question_id" class="form-control">
                                                    <?php $questions = \App\SecurityQuestion::get(); ?>
                                                    <option value="">Select Questions</option>
                                                    @foreach($questions as $row)
                                                        <option value="{{ $row->id }}" @if($row->id == Auth::user()->security_question_id) selected @endif>{{ $row->questions }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Security Answer</label>
                                                <input name="security_answer" class="form-control" value="{{Auth::user()->security_answer}}">
                                            </div>


                                            <button class="custom-btn" type="submit">Edit Profile</button>

                                    </div>
                                </div>
                                </form>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
        @section('right_sidebar')
			@include('partials/right-sidebar')
		@stop
@stop


@section('scripts')

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.sticky.js')}}"></script>
    <script>

        $( ".info_timed_inner" ).delay( 5000 ).fadeOut( 400 );


        $(document).on('click','#select_img', function(event) {
            $('#file').click();
        });

        $(document).on('change','#file', function(event) {
            var p = 'file';

            upload_img(p);
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
@endSection
