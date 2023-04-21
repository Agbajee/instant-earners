@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('content')
    <?php $l = $tread->comments()->paginate(30)->withPath(route('rep', $tread->id)) ?>
	@section('left_sidebar')
		@include('partials/left-sidebar')
	@stop
    <div class="col-md-7 new">
            <div class="main-content-inner single">
                <div class="main-content-inner-header">
                    <div class="clearfix">
                        <div class="scrool-height"></div>

                        <div class="text-left">
                            <h2 class="topic_title">{{$tread->title ? $tread->title : '<i>No Title Draft</i>'}} </h2> </div>

                    </div>
                </div>
                <div class="main-content-single-contet">
                    <div class="site-single-post">

                        <?php $d_c = \App\Models\Comment::where('tread_id', $tread->id); ?>
                        <div class="singl_topic_in">
                        @if($tread->is_tread == 1)

                            <div class="user_point_action">
                                <div class="clearfix">
                                    <div class="mobile_object clearfix">
                                        @if($d_c->count() > 0)
                                            <button class="mb_comments">{{$d_c->count()}} <i class="fa fa-comments"></i></button>
                                        @endif

                                        <button class="mb_views">{{$the_v}} <i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="s_t_inner">
                                {!!  $tread->content ? $tread->content : '' !!}
                                {!!  $tread->tread_source ? '<div class="tread_source">
                                <p>Source: <a href="'. $tread->tread_source .'" class="source_ls"><i class="fa fa-external-link-square-alt"></i> '. $tread->tread_source_name .'</a></p>
                                </div>' : '' !!}

                                <?php $the_cat = \App\Models\CategoryTread::where('tread_id', $tread->id)->get();
                                        $sponsored_post = \App\Models\CategoryTread::where('tread_id', $tread->id)->get();
                                if(count($the_cat) > 0 ){

                                ?>
                                @if($sponsored_post[0]->cat_id == 18)
                                    <a href="{{ url('/share') }}/{{ $tread->slug }}" style="display: block;height:40px; text-align:center; padding: 3px 10px;border-radius: 2px;margin: 0 2px 4px 0;font-size: 20px !important;border: 2px solid #fba408;background: #fba408;color: #444 !important;text-decoration: none;font-weight: 600;">
                                        Click here to earn
                                    </a>
                                @endif
                                @if($tread->is_tread == 1)
                                <div class="topic_cat_inner clearfix">
                                    <?php   foreach($the_cat as $cat){ ?>
                                    <a href="{{route('cat', $cat->cat->slug)}}">{{$cat ? $cat->cat->name : '' }}</a>
                                    <?php    } ?>

                                </div>

                                @endif

                                <?php
                                }
                                ?>

                                @if($tread->is_tread == 1)
                                <div class="trend_started_by">
                                    Tread Started by: <a href="#"><b>{{$tread->user->fullname}}</b></a> <span style="position: relative"> </span> <span class="the_true_date">On {{$tread->created_at->format('g:ia M j')}}  </span>
                                </div>
                                @endif

                                {!! \Share::currentPage()->facebook()
	->twitter()
	->whatsapp() !!}
                            </div>
                        </div>
                    </div>

                    @if($tread->is_tread == 1)
                        @if($tread->is_commentable == 1)

                    <div class="site-related-posts">
                        <?php
                        if($d_c->count() > 0){ ?>

                        <h2 class="rep_count"> {{$d_c->count()}} Replies  -
                            {{$tread->title}}
                        </h2>
                        <div class="clearfix">
                            <div class="text-left pg">
                                {{$l->links('partials.pagination')}}
                            </div>
                        </div>
                        @include('partials._comments_replies', ['comments' => $tread->comments()->OrderBy('created_at', 'DESC')->paginate(30), 'tread_id' => $tread->id])
                        <div class="clearfix">
                            <div class="text-left pg">
                                {{$l->links('partials.pagination')}}
                            </div>
                        </div>
                        <?php } ?>

                                    @if(\Auth::check() == 'true')
                                        <form action="{{route('comment', $tread->id )}}" method="post">
                                            @csrf

                                            <div class="clearfix">
                                                <div class="custom-comment-form">
                                                    <h2> Share your thoughts </h2>
                                                    <div class="comment_not">
                                                        <h4>Please Observe The Following Rules: </h4>
                                                        <ul>
                                                            <li>Don't abuse, bully, deliberately insult/provoke, fight, or wish harm to Allowi.ng members OR THEIR TRIBES.</li>
                                                            <li> Don't post pornographic or disgusting pictures or videos on any section of Allowi.ng.
                                                            </li>
                                                            <li>Don't say, do, or THREATEN to do anything that's detrimental to the security, success, or reputation of Allowi.ng</li>
                                                            <li>Don't abuse, bully, deliberately insult/provoke, fight, or wish harm to Allowi.ng members OR THEIR TRIBES.</li>
                                                            <li>Don't ask Allowi.ng members for contact details (email, phone, or eany social network profile).</li>
                                                        </ul>
                                                    </div>

                                                    <div class="send_comment">
                                                        <div id="editbar" style="display: block;">
                                                            <a href="javascript:void(0);" onclick='wrapText("post_c_id", "[b]", "[/b]")' title="Bold">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/bold.gif')}}"></span></a>
                                                            <a href="javascript:void(0);" onclick='wrapText("post_c_id", "[i]", "[/i]")' title="Italic">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/italicize.gif')}}"></span></a>
                                                            <a href="javascript:void(0);" onclick='wrapText("post_c_id", "[s]", "[/s]")' title="Strikethrough">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/strike.gif')}}"></span></a>
                                                            <a href="javascript:void(0);" onclick='wrapText("post_c_id", "[left]", "[/left]")' title="Align Left">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/left.gif')}}"></span></a>
                                                            <a href="javascript:void(0);" onclick='wrapText("post_c_id", "[right]", "[/right]")' title="Align Right">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/right.gif')}}"></span></a>
                                                            <a href="javascript:void(0);" onclick='wrapText("post_c_id", "[center]", "[/center]")' title="Align Center">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/center.gif')}}"></span></a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", "[hr]")' title="Horizontal Rule">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/hr.gif')}}"></span></a>
                                                            <a href="javascript:void(0);" onclick='wrapText("post_c_id", "[size=6]", "[/size]")' title="Font Size">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/size.gif')}}"></span></a>

                                                            <a href="javascript:void(0);" onclick='wrapText("post_c_id", "[img]", "[/img]")' title="Insert Image/Picture">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/img.gif')}}"></span></a>
                                                            <a href="javascript:void(0);" onclick='wrapText("post_c_id", "[url=example.com] ", "Example Text [/url]")' title="Insert Hyperlink">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/url.gif')}}"></span></a>

                                                            <a href="javascript:void(0);" onclick='wrapText("post_c_id", "[sub]", "[/sub]")' title="Subscript">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/sub.gif')}}"></span></a>
                                                            <a href="javascript:void(0);"onclick='wrapText("post_c_id", "[sup]", "[/sup]")' title="Superscript">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/sup.gif')}}"></span></a>
                                                            <a href="javascript:void(0);"onclick='wrapText("post_c_id", "[code]", "[/code]")' title="Code">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/code.gif')}}"></span></a>
                                                            <a href="javascript:void(0);" onclick='wrapText("post_c_id", "[quote]", "[/quote]")' title="Quote">
                                                                <span class="eb"><img src="{{asset('assets/img/editor/quote.gif')}}"></span></a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " :)")'>	&#128512</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " ;)")'>	&#128515</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " :D")'>	&#129315</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " ;D")'> &#128521</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " 8)")'> &#128536</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " :P")'> &#128540</a>
                                                            <a href="javascript:void(0);"  onclick='addText("post_c_id", " ???")'>	&#129300</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " >:(")' > &#128527</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " :o")'> &#128543</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " :(")'>	&#128547</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " :-[")'> &#128548</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " :-X")'> &#129310</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " :-\\")'> &#128074</a>
                                                            <a href="javascript:void(0);" onclick='addText("post_c_id", " :-*")'>	&#128170</a>
                                                            <select onchange="wrapText('post_c_id', '[color='+this.options[this.selectedIndex].value+']', '[/color]'); this.selectedIndex = 0;" style="margin-bottom: 1ex;">
                                                                <option value="" selected="selected">Change Color</option>
                                                                <option value="#990000">Red</option>
                                                                <option value="#006600">Green</option>
                                                                <option value="#000099">Blue</option>
                                                                <option value="#770077">Purple</option>
                                                                <option value="#550000">Brown</option>
                                                                <option value="#000000">Black</option></select>
                                                        </div>
                                                    </div>
                                                    <textarea placeholder="Enter Message..." name="body" id="post_c_id">{{old('body')}}</textarea>
                                                    @if($errors->has('body'))
                                                        <div class="er">
                                                            {!!  $errors->get('body')[0] !!}
                                                        </div>
                                                    @endif
                                                    <button type="submit" class="snd_rep">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <div class="l_t_c_t">
                                            You Most be logged in to comment in this tread <a href="{{route('signin')}}">Login Here</a>
                                        </div>
                                    @endif
                            <div class="bottom-scroll-height"></div>

                    </div>
                        @endif
                        @endif
                </div>
            </div>
        </div>
	@section('right_sidebar')
		@include('partials/right-sidebar')
	@stop
@stop

@section('scripts')
    <script src="//connect.facebook.net/en_US/sdk.js"></script>
    <script>
        function replyComment(a) {
            $('#r-'+a+'').fadeToggle('fast');
            $('#c-'+a+'').focus();
        }

        function wrapText(elementID, openTag, closeTag) {
            var textArea = document.getElementById(elementID);
            var len = textArea.value.length;
            var start = textArea.selectionStart;
            var end = textArea.selectionEnd;
            var selectedText = textArea.value.substring(start, end);
            var replacement = openTag + selectedText + closeTag;
            textArea.value = textArea.value.substring(0, start) + replacement + textArea.value.substring(end, len);
            textArea.focus();
            textArea.selectionStart = textArea.selectionEnd = end + openTag.length + closeTag.length;
        }

        function addText(elementID, tag) {
            var textArea = document.getElementById(elementID);
            var len = textArea.value.length;
            var insertposition = textArea.selectionEnd;
            textArea.value = textArea.value.substring(0, insertposition) + tag + textArea.value.substring(insertposition, len);
            textArea.focus();
            textArea.selectionStart = textArea.selectionEnd = insertposition + tag.length;
        }

    </script>
@stop
