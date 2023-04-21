@extends('layouts.main2')

@section('content')
@php
  $gists = \App\Models\Treads::where('status', 1)->orderBy('created_at', 'DESC')->where('is_tread', 1)->paginate(4);
@endphp
@include('partials.pageTitle')

<div class="rs-inner-blog gray-bg24 pt-120 pb-120 md-pt-80 md-pb-80">
   <div class="container">
       <div class="row">
           <div class="col-lg-8 md-mb-50">
               @foreach ($gists as $item)
               <div class="blog-item mb-50">
                  <div class="blog-img">
                        <a href="{{route('tread', $item->slug)}}"><img src="{{ asset('/images/treads/'.$item->featured_image ? : '') }}" alt=""></a>
                     <div class="blog-meta">
                           <ul class="btm-cate">
                              <li>
                                 <div class="user-svg">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> {{$item->user->fullname}}
                                 </div>
                              </li>
                              <li>
                                 <div class="blog-date">
                                       <i class="ri-calendar-line"></i> {{$item->created_at->format('g:ia M j')}}
                                 </div>
                              </li>
                           </ul>
                     </div>
                  </div>
                  <div class="blog-content">
                        <h3 class="blog-title"><a href="{{route('tread', $item->slug)}}">{{$item->title}}.</a></h3>
                        <div class="blog-desc">
                           {{ str_limit(strip_tags($item->content), 300, '...') }}
                        </div>
                        <div class="blog-button inner-btn">
                           <a class="blog-btn" href="{{route('tread', $item->slug)}}">Continue Reading
                              <i class="ri-arrow-right-line"></i>
                           </a>
                        </div>
                  </div>
               </div>
               @endforeach

               {{-- pagination --}}
               <div class="col-lg-12">
                  {{-- {{ $gists->links() }} --}}
                     <div class="pagination-area">
                        <div class="nav-link">
                           <span class="page-number white-color">1</span>
                           <a class="page-number" href="#">2</a>
                           <a class="page-number border-none" href="#">Next</a>
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
                       <div class="recent-post-widget no-border">
                           <div class="post-img">
                               <a href="blog-details.html"><img src="./assets/images/services/MK5.jpg" alt=""></a>
                           </div>
                           <div class="post-desc">
                              <span class="date-post"><i class="ri-calendar-line"></i>October 10, 2022</span>
                               <a href="blog-details.html">What’s Next for Sasco? Trusted Systems.</a>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
<script>
function adOpen(url) {
 window.open(url, '_blank').focus();
}
</script>
