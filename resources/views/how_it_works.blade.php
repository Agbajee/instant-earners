@extends('layouts.main2')
@section('content')
@php
    $how_it_works = \App\Models\siteHowItWork::where('id', 1)->first();
@endphp
@include('partials.pageTitle')


<div class="rs-about about-style1 pt-140 pb-140 md-pt-80 md-pb-75">
    <div class="container">
        <div class="row y-middle">
            <div class="col pl-30 md-pl-15">
                {!! $how_it_works->content !!}
            </div>
        </div>
    </div>
</div>

@endsection
