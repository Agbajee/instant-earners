@php
    $gt = \App\Models\GeneralSettings::first();
@endphp
@component('mail::layout')
  @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('images/general/'.$gt->logo)}}" style="width:30%" alt="App Logo">
        @endcomponent
  @endslot

<h2>Withdrawal Notification</h2>
<hr>
<h4>Hello {{ Auth::user()->fullname }}</h4>
<p>Hello, You just made a withdrawal request of {{'₦'.number_format($amount)}} on your {{config('app.name')}} account</p><hr>

@component('mail::panel') 
  <p style="text-align:center; color:red; font-size:16px;">If you do not make this request please appeal now!</p>
@endcomponent

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
Thanks, {{ config('app.name') }}
@endcomponent
@endslot
@endcomponent