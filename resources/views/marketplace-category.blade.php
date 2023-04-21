@extends('layouts.main2')
@section('content')
@include('partials.pageTitle')

<section class="shop-page">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop-sidebar">
                    <div class="shop-search shop-sidebar__single">
                        <form action="{{route('productSearch')}}">
                            {{-- @csrf --}}
                            <input name="term" type="text" placeholder="Search" required>
                            <button type="submit"><i class="flaticon-magnifying-glass"></i></button>
                        </form>
                    </div>
                    <div class="shop-category shop-sidebar__single">
                        <h3 class="shop-sidebar__title">Categories</h3>
                        <ul class="list-unstyled">
                            @foreach ($category as $cat )
                            <li><a href="{{route('marketplaceCategory', $cat->slug)}}">{{$cat->category_name}}</a></li>    
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="product-sorting default-form">
                    <p>Showing 1–9 of 12 results</p>
                </div><!-- /.product-sorting -->

                <div class="row">
                  @foreach ($products as $product)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="product-card">
                            <div class="product-card__image">
                                <img src="{{asset('/images/users/product'.$product->image)}}" alt="">
                                <div class="product-card__buttons">
                                    <a class="theme-btn btn-style-one" href="{{route('productDetails', $product->slug)}}">
                                        <i class="btn-curve"></i>
                                        <span class="btn-title">Details</span>
                                    </a>

                                    <form id="likeAction" action="{{route('productLike')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                        <input type="hidden" name="user_id" value="{{$product->user_id}}">
                                        <button class="theme-btn btn-style-two">
                                            <i class="btn-curve"></i>
                                            <span class="btn-title">Like</span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="product-card__content">
                                <h3 class="product-card__title"><a href="javascript:void(0);">{{ $product->product_name }}</a>
                                </h3>
                                <p class="product-card__price">{{ $product->price }}</p>
                                <div class="product-card__stars">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="text-center load-more-products">
                    <a class="theme-btn btn-style-one" href="">
                        <i class="btn-curve"></i>
                        <span class="btn-title">Load More</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
    <script>
        "user strict";
        (function ($) {
            $('#likeAction').on('submit', function(e){
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ route('productLike') }}",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if(response.error) {
                            notify('error', response.error)
                        }else{
                            notify('success', response.success)
                        }
                    }
                });
            })
        })(jQuery);
    </script>
@endsection