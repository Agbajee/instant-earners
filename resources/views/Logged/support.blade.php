@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('content')
        @section('right_sidebar')
			@include('partials/right-sidebar')
		@stop
        <div class="col-md-7"  style="padding: 0;">
            <div class="main-content-inner">
                <div class="main-content-inner-header">
                    <div class="clearfix">
                        <div class="pull-left_no"> Your Account</div>
                    </div>
                </div>
                <div class="main-content-inner-contet">
                    <div class="scrool-height"></div>
                    <div class="show_profile_info clearfix">
                        <div class="most-popular-tag-inner clearfix" style="padding: 0 0 20px 0"><a href="{{route('account')}}"> My Account </a> <a href="{{route('editAccount')}}"> Edit Profile </a> <a href="#"> Change Password </a> <a  class="active" href="{{route('support')}}"> Support Ticket </a> </div>
                        @if(App\PaidMembers::where('user_id', Auth::user()->id)->exists() == false)
                        <a href="{{route('becomeapro')}}" class="become_one_of_us">Click Here to Become a Registered Member » </a>
                        @endif
                        @if(\Session::has('info2'))
                            <div class="info_timed_inner er2_">
                                {{\Session::get('info2')}}
                                    </div>
                        @endif

                        @if(\Session::has('info'))
                            <div class="info_timed_inner er_">
                                {{\Session::get('info')}}
                            </div>
                        @endif


                        <div class="b_of_u_2">


                            <div class="clearfix">
                                <a href="{{route('new_ticket')}}" class="cc_b"><i class="far fa-edit" style="margin-right: 5px"></i> Open New Ticket</a>

								<?php $sp = \App\Support::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get(); ?>

								@if(count($sp) > 0)
                                <div class="suppor_table">
                                    <table class="table table-striped table-bordered">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Status</th>
                                                <th>Title</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($sp as $p)
                                            <tr>
                                                <td width="10%">
                                                    #{{$p->id}}
                                                </td>
                                                <td width="10%">
                                                    @if($p->status == 0)
                                                        <button class="sP_status opened">Open</button>
                                                     @else
                                                        <button class="sP_status closed">Closed</button>
                                                    @endif
                                                </td>
                                                <td width="90%">
                                                    <?php
                                                    $is_r = \App\supportMessage::where('support_id', $p->id)->where('is_read', 0)->get();
                                                    if(count($is_r) > 0){ ?>
                                                    <button class="ms_al">{{count($is_r)}} New <i class="fa fa-envelope"></i></button>
                                                    <?php }
                                                    ?>
                                                    <a href="{{route('supportInner', $p->id)}}" class="the_s_c"><b> {{$p->title}}</b> - <i>{{$p->created_at->diffForHumans()}}</i></a>
                                                </td>

                                            </tr>
											@endforeach
                                            </tbody>
                                        </table>
                                    </table>
                                </div>
							    @else
								<div class="l_t_c_t"> You have not created any tickets. <b><a href="{{route('new_ticket')}}">Create one here</a></b>
                                </div>
							    @endif
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
         @section('left_sidebar')
			@include('partials/left-sidebar')
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
