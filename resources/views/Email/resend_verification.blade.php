@php
$gt = \App\Models\GeneralSettings::first();
@endphp
@component('mail::layout')
  @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('images/general/'.$gt->logo)}}" style="width:30%" alt="App Logo">
        @endcomponent
  @endslot

<h4>New Email For {{$data['fullname']}}</h4>
<div>{!! $data['note'] !!}</div>

{{-- Subcopy --}}
@slot('subcopy')
@component('mail::subcopy')
    <p>Treat this message a important<p>
@endcomponent
@endslot


{{-- Footer --}}
@slot('footer')
@component('mail::footer')
Thanks, {{ config('app.name') }}
@endcomponent
@endslot
@endcomponent
