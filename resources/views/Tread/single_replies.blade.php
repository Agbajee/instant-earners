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
                        <div class="text-left">
                            <h2 class="topic_title"><a href="{{route('tread', $tread->slug)}}" style="color:#fff">← {{$tread->title}} </a></h2> </div>

                    </div>
                </div>
                <div class="main-content-single-contet" style="margin-top: 15px">
                    <div class="scrool-height"></div>
                        <div class="site-related-posts">

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

                            @if(\Auth::check() == 'true')
                                <form action="{{route('comment', $tread->id )}}" method="post">
                                    @csrf
                                    <div class="clearfix">
                                        <div class="custom-comment-form">
                                            <h2> Share your thoughts </h2>
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
                        </div>
                </div>
            </div>
        </div>
		@section('right_sidebar')
			@include('partials/right-sidebar')
		@stop
@stop

@section('scripts')
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
