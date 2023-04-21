@extends('layouts.main2')

@section('content')
@php
  $gists = \App\Models\Treads::where('status', 1)->orderBy('created_at', 'DESC')->where('is_tread', 1)->paginate(1);
@endphp
<!-- start page title -->
@include('partials.pageTitle')

<section class="news-section">
   <div class="auto-container">

       <div class="row clearfix">
           <!--News Block-->
           @foreach ($gists as $item)
           <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
               data-wow-duration="1500ms">
               <div class="inner-box">
                   <div class="image-box">
                       <a href="{{route('tread', $item->slug)}}"><img src="{{ asset('/images/treads/'.$item->featured_image ? : '') }}" alt="Post Image"></a>
                   </div>
                   <div class="lower-box">
                       <div class="post-meta">
                           <ul class="clearfix">
                               <li><span class="far fa-clock"></span> {{$item->created_at->format('g:ia M j')}}</li>
                               <li><span class="far fa-user-circle"></span> {{$item->user->fullname}}</li>
                           </ul>
                       </div>
                       <h5><a href="{{route('tread', $item->slug)}}">{{$item->title}}</a></h5>
                       <div class="text">{{ str_limit(strip_tags($item->content), 300, '...') }}</div>
                       <div class="link-box"><a class="theme-btn" href="{{route('tread', $item->slug)}}"><span class="flaticon-next-1"></span></a></div>
                   </div>
               </div>
           </div>
           @endforeach
       </div>
       <div class="more-box">
           {{-- <a class="theme-btn btn-style-one" href="blog.html">
               <i class="btn-curve"></i>
               <span class="btn-title">Load more posts</span>
              
           </a> --}}
           {{ $gists->links() }}
       </div>
   </div>
</section>

{{-- <section class="ws-section-spacing">
  <div class="container">
   <div class="row">
   <div class="col-lg-8">
      <div class="row">
         <!--item-->
         @foreach ($gists as $item)
         <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="blog-card">
               <div class="blog-img">
                  <img src="/newHome/images/blog-img-02.jpg" alt="team-01">                          
               </div>
               <span class="date">{{$item->created_at->format('g:ia M j')}}</span>
               <div class="admin">
                  <span class="admin-img"><img src="/newHome/images/admin.jpg" alt="admin.jpg"></span>
                  <a href="javascript:void(0)"> {{$item->user->fullname}}</a>                            
               </div>
               <div class="blog-content">
                  <h4><a href="blog-detail.html">{{$item->title}}</a></h4>
                  <p>
                    @if(strlen($item->content) > 30)
                      {{ str_limit(strip_tags($item->content), 300, '...') }}
                    @endif
                  </p>
                  <a href="{{route('tread', $item->slug)}}" class="blog-btn">Read More<i class="fas fa-angle-double-right"></i></a>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
   <!--side-bar-->
   <div class="col-lg-4 col-md-12">
      <!--Search-bar-->
      <div class="side-bar-bg">
         <h3>Search Bar</h3>
         <div class="search">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            <a href="#" class="side-bar-btn"><i class="fas fa-search"></i></a>
         </div>
      </div>
   </div>
   <!---Side-bar-End-->
   <!---pagination-->
   <nav aria-label="Page navigation example" class="navigation-btn">
      <ul class="pagination justify-content-center">
         <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
            </a>
         </li>
         <li class="page-item"><a class="page-link" href="#">1</a></li>
         <li class="page-item"><a class="page-link" href="#">2</a></li>
         <li class="page-item"><a class="page-link" href="#">3</a></li>
         <li class="page-item"><a class="page-link" href="#">....</a></li>
         <li class="page-item"><a class="page-link" href="#">15</a></li>
         <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
            </a>
         </li>
      </ul>
   </nav>

 </div>
</div>
</section> --}}
@endsection
<script>
function adOpen(url) {
 window.open(url, '_blank').focus();
}
</script>
