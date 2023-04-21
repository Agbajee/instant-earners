@extends('layouts.main')

@section('content')

    <section class="p-0 cover-background wow animate__fadeIn" style="background-image:url('images/404-bg.jpg');">
        <div class="container">
            <div class="row align-items-stretch justify-content-center full-screen">
                <div class="col-12 col-xl-6 col-lg-7 col-md-8 text-center d-flex align-items-center justify-content-center flex-column">
                    <h6 class="alt-font text-fast-blue font-weight-600 letter-spacing-minus-1px margin-10px-bottom text-uppercase">Hello!</h6>
                    <h1 class="alt-font text-extra-big font-weight-700 letter-spacing-minus-5px text-extra-dark-gray margin-6-rem-bottom md-margin-4-rem-bottom">400</h1>
                    <span class="alt-font font-weight-500 text-extra-dark-gray d-block margin-20px-bottom">It seems you are disconneted from internet!</span>
                    <a href="{{ url('/') }}" class="btn btn-large btn-gradient-sky-blue-pink">Back to homepage</a>
                </div>
            </div>
        </div>
    </section>

@endsection
