@extends('layouts.main2')

@section('content')
@include('partials.pageTitle')
<div class="rs-inner-blog pt-120 pb-120 md-pt-80 md-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 md-mb-50">
                <div class="blog-details">
                    <div class="bs-img mb-50">
                        <a href="#"><img src="{{ asset('/images/treads/'.$tread->featured_image ? : '') }}" alt=""></a>
                    </div>
                    <div class="blog-full">
                        <div class="blog-content-full">
                            <h3>{{$tread->title}}</h3>
                            <p class="pb-25">
                                {!!  $tread->content ? $tread->content : '' !!} 
                            </p>
                            <div class="fs-6">date: {{$tread->created_at->format('g:ia M j')}}</div> 

                            <div class="mt-40">
                                <h6>Share post on:</h6>
                                @auth
                                    @if ($tread->created_at->format('Y-m-d') == date('Y-m-d'))
                                        <a class="readon know px-2 py-2 rounded" href="https://www.tiktok.com/@instantnaire?_t=8bvuEdS0TsU&_r=1" target="_blank">
                                            <i class='bx bxl-tiktok' style='color:#2a1313'></i>
                                        </a>
                                        <a class="readon know px-2 py-2 rounded" href="{{ url('/share') }}/{{ $tread->slug }}" target="_blank">
                                            <i class='bx bxl-facebook-circle'></i>
                                        </a>
                                    @else
                                        <div class="alert alert-warning">you can no longer earn from this post!</div>
                                    @endif
                                @else
                                    <a href="{{route('signin')}}">You are not logged in!</a>
                                @endauth
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 pl-25 md-pl-15">
                <div class="widget-area">
                    <div class="search-widget mb-50">
                        <div class="search-wrap">
                            <input type="search" placeholder="Searching..." name="s" class="search-input" value="">
                            <button type="submit" value="Search"><i class="ri-search-line"></i></button>
                        </div>
                    </div>
                    <div class="recent-posts mb-50">
                        <div class="widget-title">
                            <h3 class="title">Recent Posts</h3>
                        </div>
                        @foreach ($gists as $item)
                        <div class="recent-post-widget no-border">
                            <div class="post-img">
                                <a href="{{route('tread', $item->slug)}}"><img src="{{ asset('/images/treads/'.$item->featured_image ? : '') }}" alt=""></a>
                            </div>
                            <div class="post-desc">
                                <span class="date-post"><i class="ri-calendar-line"></i>{{$item->created_at->format('g:ia M j')}}</span>
                                <a href="{{route('tread', $item->slug)}}"> {{$item->title}}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection


@section('script')
<script>
function adOpen(url) {
 window.open(url, '_blank').focus();
}
</script>
@stop
