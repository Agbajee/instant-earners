@extends('newlook2.main')

@section('seo')

<link
    rel="shortcut icon"
    href="{{asset('/images/general/'.$gt->favicon)}}"
    type="image/x-icon"
    />
{!! SEO::generate() !!}

@endsection

@section('category')

<div class="hero-header bg-secondary mb-2">
    <div class="container">
    <h3 class="m-0 p-0">
        {{$the_cat->name}}
    </h3>
</div>
</div>

@endsection

@section('content')
<div class="col-12 col-md-7 px-md-2 px-0">
@if(count($cat) > 0)
<?php foreach ($cat as $item){?>

<div class="post-item mb-3 shadow-sm bg-white">
              <div class="d-flex justify-content-between flex-wrap p-1">
                <div class="post-feat-image pr-2 d-flex align-items-center">
                  <a
                    href="{{route('tread', $item->tread->slug)}}"
                    class="post-img-link"
                    rel="bookmark"
                  >
                    @if($item->featured_image != null)
                    <img
                      class="post-feat-img img-zoom"
                      src="{{asset('images/treads/'.$item->featured_image)}}"
                      data-src="{{asset('images/treads/'.$item->featured_image)}}"
                      alt="{{$item->title}}"
                    />
                    @else
                    <img
                      src="{{asset('assets/img/logo.png')}}"
                      data-src="{{asset('assets/img/logo.png')}}"
                      alt="{{$item->title}}"
                      class="post-feat-img img-zoom"
                    />
                    @endif
                   </a>
                </div>
                <div class="post-info px-2 py-1">
                  <a
                    href="{{route('tread', $item->tread->slug)}}"
                    rel="bookmark"
                  >
                    <h3 class="post-title" title="{{$item->tread->title}}">
                      {{$item->tread->title}}
                    </h3></a
                  >
                  <div class="post-feed-logo mb-1">
                    <img
                      src="{{asset('assets/img/logo.png')}}"
                      class="feed-logo-img"
                    />
                  </div>
                  <div class="post-time text-muted py-1">
                    <svg class="svg-icon text-success">
                      <use xlink:href="#time" />
                    </svg>
                    {{$item->tread->created_at->format('g:i a')}}
                    <svg class="svg-icon text-primary">
                      <use xlink:href="#eye-outline" />
                    </svg>
                    {{ \App\Models\ViewCount::where('tread_id', $item->tread->id)->count() }}
                  </div>
                </div>
              </div>
            </div>



<?php } ?>
@else
<div class="text-center py-4 bg-white shadow">
    <h4>Nothing found</h4>
    <p class="text-muted">
        No posts found in this category.
    </p>
    <p>
        <button class="btn btn-primary" onclick="document.location.reload(true);">Refresh</button>
    </p>
</div>

@endif
</div>
@endsection