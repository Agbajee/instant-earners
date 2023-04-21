@extends('layouts.main2')
@section('content')
    @php
        $vendors = \App\Models\User::inRandomOrder()
            ->where('is_vendor', '1')
            ->get();
        // $vendors= \App\Models\User::inRandomOrder()->where('is_vendor', '1')->where('id', '!=', 1)->get();
    @endphp
    @include('partials.pageTitle')

    <!-- Blog Section Start -->
    <div class="rs-inner-blog pt-120 pb-100 md-pt-80 md-pb-80">
        <div class="container">
            <div class="col-lg-12 pl-70 md-pl-0">
                <div class="content-wrap">
                    <div class="sec-title mb-35">
                        <h2 class="title title6 pb-50">
                            Message Any Vendor To Get Your Code
                        </h2>
                        <div class="row">
                            @foreach ($vendors as $row)
                                <div class="col-md-6">
                                    <div class="custom-list">
                                        <img class="list-avatar" src="{{ asset('images/users/' . $row->avatar) }}"
                                            alt="">
                                        <div>
                                            <div class="list-title">{{ $row->username }}</div>
                                            <div class="list-desc">
                                                <i class="ri-bank-fill"></i>
                                                {{ $row->bank }}
                                            </div>
                                        </div>
                                        <a href="https://api.whatsapp.com/send?phone={{ $row->number }}&amp;text=Hello%2C%20Good%20day%20-%20I%20want%20To%20Purchase%20InstantNaire%20Coupon%20Code"
                                            target="_blank"><img width="70"
                                                src="{{ asset('sasco/assets/images/whatsapp.gif') }}" alt=""></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Section End -->
@endsection
