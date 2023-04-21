@php
$gt = \App\Models\GeneralSettings::first();
@endphp
@component('mail::layout')
  @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('images/general/'.$gt->logo)}}" style="width:30%" alt="App Logo">
        @endcomponent
  @endslot

<h4>Hello {{$user->fullname}},</h4>
<p><b>Congratulations!</b> The sum of <u>{{'₦'.''.number_format($amount)}}</u> Has been transferred to <b>{{ base64_decode($user->bank)}}<b>.</p>

@component('mail::panel') 
  Account Information
@endcomponent

@component('mail::table') 

| <b>Balance</b>                                                                 | <b>Affiliate</b>                            | <b>Activity </b>                                    | 
|:------------------------------------------------------------------------------:|:-------------------------------------------:|:---------------------------------------------------:| 
| {{'₦'.number_format(($user->balance)+($user->allowi_balance))}}                | {{'₦'.number_format($user->balance)}}       | {{'₦'.number_format($user->allowi_balance)}}        |  

@endcomponent

@component('mail::panel') 
  Other Account Info
@endcomponent


@component('mail::table') 

| Total Balance                                   | Indirect Affiliate                         |
| ----------------------------------------------- |:------------------------------------------:| 
| {{ '₦'.number_format($user->indirect_ref) }}    | {{'₦'.number_format($user->indirect_ref)}} | 

@endcomponent

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
Thanks, {{ config('app.name') }}
@endcomponent
@endslot
@endcomponent
