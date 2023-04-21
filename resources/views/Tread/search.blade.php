@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('content')
	@section('left_sidebar')
		@include('partials/left-sidebar')
	@stop
    <div class="col-md-7 new">
                <div class="main-content-inner">
                    <div class="main-content-inner-header">
                        <div class="clearfix">
                            <div class="pull-left"> Search Result</div>

                        </div>
                    </div>
                    <div class="main-content-inner-contet">
                        <div class="scrool-height"></div>
                        @if(count($get_tread) > 0)
                        <?php
                        foreach ($get_tread as $item){?>
                        <div class="listed clearfix">
                            <div class="col-md-12dd">
                                <div class="listed_title">
                                    <div class="clearfix"> <a href="{{route('tread', $item->slug)}}">{{$item->title}} <span class="hidden-md hidden-sm time_ago hidden-lg">{{$item->created_at->diffForHumans()}}</span> </a> </div>
                                    <div class="forum_meta"> <span class="infosection">
                                       <span style="padding-left: 0;" class="listed_title_h">Created - {{$item->created_at->format('g:i a')}} - by <a class="listed_title_a" href="#">{{$item->user->fullname}}</a> </span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                        ?>
                            @else
                            <div class="nt_f">Sorry no Tread was found for your search term <b>{{\Session::has('search') ? \Session::get('search') : ''}}</b></div>
                            @endif

                    </div>
                </div>
            </div>
	@section('right_sidebar')
		@include('partials/right-sidebar')
	@stop
@stop
