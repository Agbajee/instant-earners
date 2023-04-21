@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('styles')
    <style>

        .ck-editor__editable {
            min-height: 250px;
        }


        .replies-default {
            background: #f8f8f8;
            border-radius: 3px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .replies-replied {
            border-left: 5px solid #0288d1;
            padding: 10px;
            background: #f8f8f8;
            border-radius: 3px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .the-support-message {
            background: #f8f8f8;
            border-radius: 3px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 5px solid #4caf50;
        }
        .replies-default blockquote::before {
            content: "\f10d";
            font-size: 16px;
            position: absolute;
            left: 2px;
            top: -9px;
            font-family: 'FontAwesome';
            font-weight: 900;
            opacity: 1;
        }

        .replies-default blockquote {
            padding: 0 32px;
        }

        .replies-body{
            position: relative;
        }

        .replies-body li {
            margin-left: 20px;
        }

        .replies-img-r {
            background-size: contain !important;
            background-repeat: no-repeat !important;
        }

        .replies-img-r {

            width: 30px;
            height: 30px;
            border-radius: 100px;
            border: 2px solid #e6e6e6;

        }

        .ticket-reply-name {
            margin-top: 6px;
            text-transform: capitalize;
            font-weight: 600;
        }

        .ticket-stats.opened i {
            padding-right: 7px;
        }

        .ticket-stats.closed i {
            padding-right: 7px;
        }

        .ticket-stats {

            border-radius: 3px;
            color: #fff;
            font-size: 11px;
            padding: 5px 15px;

        }
        .ticket-stats.closed {

            background: #e74c3c;
            text-transform: uppercase;

        }

        .ticket-stats.opened {

            background: #4caf50;
            text-transform: uppercase;

        }



    </style>
@endsection
@section('content')
        @section('left_sidebar')
			@include('partials/left-sidebar')
		@stop
        <div class="col-md-7"  style="padding: 0;">
            <div class="main-content-inner">
                <div class="main-content-inner-header">
                    <div class="clearfix">
                        <div class="pull-left_no"> Supports </div>
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
                                <div class="col-md-12">
                                    <div class="support-show-page">
                                        <div class="support-show-page-bordered">
                                            <h4 class="support-show-page-heading">
                                                <button>#{{ $support->id }}</button>
                                                - {{ $support->title }}
                                            </h4>
                                            <li><b>Created: </b>{{ $support->created_at->diffForHumans() }}</li>
                                            <li>
                                                @if ($support->status == 0)
                                                    <span class="ticket-stats opened"> <i class="fa fa fa-clock"></i>Open</span>
                                                @else
                                                    <span class="ticket-stats closed"> <i class="fa fa-lock"></i>Closed</span>
                                                @endif
                                            </li>
                                            <li><b>Support Type: </b> {{ $support->reason }}</li>
                                        </div>


                                        <div class="panel-body_s">
                                            <div class="ticket-info1">
                                                <div class="the-support-message">
                                                    <div class="replies-header">
                                                        <div class="col-md-12dwd">
                                                            <div class="replies-body">


                                                                    @if($support->attachment_id != '')

                                                                            <div class="at_id">
                                                                                <a href="{{asset('images/supports/'.$support->attachment_id)}}">
                                                                                <img width="100%" src="{{asset('images/supports/'.$support->attachment_id)}}">
                                                                                <button class="attahcment_if"><i class="fa fa-file"></i>Attachment </button>
                                                                                </a>
                                                                            </div>

                                                                    @endif
                                                                <p style="margin-top: 10px">
                                                                {{  $support->content  }}
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="replies1">
                                                    <?php $d = $support->comment;
                                                    ?>
                                                    @if(count($d) > 0)
                                                    @foreach ($d as $comment)
                                                        <div class="replies-{{$support->user->id == $comment->user->id ? "default" : "replied"}}">
                                                            <div class="replies-header">
                                                                <div class="rows">
                                                                    <div class="col-md-11s2">
                                                                        <div class="ticket-reply-name">
                                                                            @if($comment->user->id == Auth::user()->id)
                                                                                <p><i>Your reply</i></p>
                                                                            @else
                                                                             <p>   {{ $comment->user->fullname }} - <i>replied</i> (Support Agent)</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="replies-body">
                                                                @if($comment->attachment_id != '')

                                                                    <div class="at_id">
                                                                        <a href="{{asset('images/supports/'.$comment->attachment_id)}}">
                                                                        <img width="100%" src="{{asset('images/supports/'.$comment->attachment_id)}}">
                                                                        <button class="attahcment_if"><i class="fa fa-file"></i>Attachment </button> </a>
                                                                    </div>

                                                                @endif
                                                                    <p style="margin-top: 10px">
                                                                        {{  $comment->message }}
                                                                    </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            @if($support->status == 0)
                                            <div class="reply-form">
                                                <form action="{{route('supportInnerPost', $support->id)}}" method="POST" class="form" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                                        <label>Reply to Conversation</label>
                                                        <textarea rows="5" cols="80" id="comment" class="form-control" name="comment" required></textarea>

                                                        @if($errors->has('comment'))
                                                            <div class="er">
                                                                {!!  $errors->get('comment')[0] !!}
                                                            </div>
                                                        @endif
                                                    </div>


                                                    <div class="form-group">
                                                        <label>* Attachment (5MB Max)</label>
                                                        <input type="file" name="attachment">

                                                        @if($errors->has('attachment'))
                                                            <div class="er">
                                                                {!!  $errors->get('attachment')[0] !!}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="cc_b">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            @else
                                                <div class="l_t_c_t">
                                                    This support ticket is closed - <b><a href="{{route('new_ticket')}}">Open new ticket</a></b>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
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
