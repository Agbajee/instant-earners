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
                        <div class="pull-left_no"> Update bank Account</div>
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

                                <div class="col-md-10">
                                    <div class="user_info_d">

                                            @csrf
                                            <div class="form-group">
                                                <label>Bank Name</label>
                                                <input name="bank" class="form-control" value="{{ base64_decode(Auth::user()->bank) }}">
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
