@extends('layouts.main2')
@section('content')
@php
    $terms = \App\Models\Terms::where('id', 1)->first(); 
@endphp
@include('partials.pageTitle')
<section class="contact-section contact-two">
    <div class="auto-container">
        <div class="row">
            <div class="col-md-8">
                {!! $terms->content !!}
            </div>
        </div>
    </div>

</section>

@endsection
