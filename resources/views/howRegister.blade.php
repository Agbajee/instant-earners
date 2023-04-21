@extends('newlook2.main')

@section('seo')

<link
    rel="shortcut icon"
    href="{{asset('/images/general/'.$gt->favicon)}}"
    type="image/x-icon"
    />
{!! SEO::generate() !!}

@endsection

@section('content')
@php
    $how_it_works = \App\Models\HowToRegister::where('id', 1)->first(); 
@endphp

@include('partials.pageTitle')
<section class="portfolio_details_area sec_pad">
    <div class="container">
        <div class="portfolio_details_text">
            {!! $how_it_works->content !!}
        </div>
    </div>
</section>
@endsection