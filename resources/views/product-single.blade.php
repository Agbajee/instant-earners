@extends('layouts.main2')
@section('content')
@include('partials.pageTitle')

<section class="product-details">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-12 col-xl-6">
                <a href="{{asset('/images/users/product'.$product->image)}}"
                    class="product-details__image lightbox-image">
                    <img src="{{asset('/images/users/product'.$product->image)}}" alt="">
                </a><!-- /.product-details__image -->
            </div><!-- /.col-md-12 col-lg-6 -->
            <div class="col-lg-12 col-xl-6">
                <div class="product-details__top">
                    <h3 class="product-details__title">
                        {{ $product->Name }}
                    </h3><!-- /.product-details__title -->
                    <p class="product-details__price">₦ {{ number_format($product->price) }}</p>
                </div><!-- /.product-details__top -->
                <div class="product-details__reveiw">
                    <i class="fa fa-heart"></i>
                    <span>{{ $product->likes }} like(s)</span>
                </div><!-- /.product-details__reveiw -->
                <div class="product-details__content">
                    <p>{{ str_limit(strip_tags($product->description), 50, '...') }}<a href="#description"> Full Description</a></p>
                </div><!-- /.product-details__content -->
                <div class="product-details__social">
                    <span>CONTACT ME</span>
                    <a href="{{ $product->contact['whatsapp'] }}" class="fab fa-whatsapp" target="_blank"></a>
                    <a href="{{ $product->contact['instagram'] }}" class="fab fa-instagram" target="_blank"></a>
                    <a href="{{ $product->contact['telegram'] }}" class="fab fa-telegram" target="_blank"></a>
                    <a href="tel:{{ $product->contact['phone'] }}" class="fas fa-phone-alt"></a>
                </div><!-- /.product-details__social -->
            </div><!-- /.col-md-12 col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<section id="description" class="product-description">
    <div class="auto-container">
        <h3 class="product-description__title">Description</h3><!-- /.product-title -->
        <p class="product-description__text">
            {{ $product->description }}
        </p>
    </div><!-- /.container -->
</section>
@endsection
@section('script')
    <script>
        "user strict";
        (function ($) {
            $('#loginForm').on('submit', function(e){
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