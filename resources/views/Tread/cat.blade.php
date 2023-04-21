@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('content')
    <div class="contion">
        <div class="container-fluid">
			@section('left_sidebar')
				@include('partials/left-sidebar')
			@stop
		    @section('content')
			<div class="col-md-7 new">
                <div class="main-content-inner">
                    <div class="main-content-inner-header">
                        <div class="clearfix">
                            <div class="pull-left"> {{$the_cat->name}}</div>
                            {{--<div class="pull-right"> <a href="#" class="start_new_trend"><i class="fa fa-edit"></i> New Topic</a> </div>--}}
                        </div>
                    </div>
                    <div class="main-content-inner-contet">
                        <div class="scrool-height"></div>
                        @if(count($cat) > 0)
                        <?php
                        foreach ($cat as $item){?>
                        <div class="listed clearfix">
                            <div class="col-md-12dd">
                                <div class="listed_title">
                                    <div class="clearfix"> <a href="{{route('tread', $item->tread->slug)}}">{{$item->tread->title}} <span class="hidden-md hidden-sm time_ago hidden-lg">{{$item->tread->created_at->diffForHumans()}}</span> </a> </div>
                                    <div class="forum_meta"> <span class="infosection">
                                       <span style="padding-left: 0;" class="listed_title_h">Created - {{$item->tread->created_at->format('g:i a')}} - by <a class="listed_title_a" href="#">{{$item->tread->user->fullname}}</a> </span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                        ?>
                            @else
                            <div class="nt_f">Sorry This Category is Empty</div>
                            @endif

                    </div>
                </div>
            </div>
			@stop
			@section('right_sidebar')
				@include('partials/right-sidebar')
			@stop
        </div>
    </div>
@stop




