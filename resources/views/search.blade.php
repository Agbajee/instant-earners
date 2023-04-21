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
        Search Result for {{\Session::has('search') ? \Session::get('search') : ''}}
    </h3>
</div>
</div>

@endsection

@section('content')
<section id="about" class="overlap-height wow animate__fadeIn padding-60px-bottom parallax" data-parallax-background-ratio="0.5" style="background-image:url('images/our-story-bg.jpg');" >
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-8 col-lg-10 text-center overlap-gap-section">
        <div class="w-40px h-2px bg-gradient-orange-pink separator-line-vertical margin-30px-tb d-inline-block"></div>
        <h6 class="alt-font font-weight-500 text-extra-dark-gray letter-spacing-minus-1px">Search Result for <span class="text-gradient-orange-pink font-weight-400">  {{\Session::has('search') ? \Session::get('search') : ''}}</span></h6>
      </div>
    </div>
  </div>
</section>

<section class="big-section wow animate__fadeIn bg-light-gray" style="visibility: visible; animation-nam: feadeIn;">
    <div class="container">
      <div class="col-12 col-md-7 px-md-2 px-0">
        @if(count($get_tread) > 0)
        <ul class="list-style-04">
          @foreach ($get_tread as $item)
          <li class="bg-white border-radius-6px margin-20px-bottom">
            <a rel="bookmark" class="margin-15px-right" href="{{route('tread', $item->slug)}}" target="_blank"><i class="fab fa-whatsapp text-green fw-bold" aria-hidden="true"></i></a>
            <span class="text-extra-dark-gray text-small fw-bolder">{{$item->title}}</span>
            <span class="text-extra-dark-gray text-small margin-20px-left">{{$item->created_at->format('g:i a')}}</span>
            <span class="text-extra-dark-gray text-small margin-20px-left">{{ \App\Models\ViewCount::where('tread_id', $item->id)->count() }}</span>
          </li>
          @endforeach
        </ul>
      @else
      <div class="text-center">
          <h4>Nothing found</h4>
          <p class="text-muted">Sorry no Tread was found for your search term <b>{{\Session::has('search') ? \Session::get('search') : ''}}</b></p>

          {{-- <button class="btn btn-primary" onclick="document.location.reload(true);">Refresh</button> --}}
      </div>
      @endif
      </div>
    </div>
</section>
@endsection