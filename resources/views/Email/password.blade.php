@php
$gt = \App\Models\GeneralSettings::first();
@endphp
@component('mail::layout')
  @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('images/general/'.$gt->logo)}}" style="width:30%" alt="App Logo">
        @endcomponent
  @endslot
<h2 style="text-align:center;">Reset account password!</h2>
<h4>Hello {{$user->fullname}},</h4>
<p>You or someone requested to reset your account password on {{config('app.name')}}<br><br> To reset your password, please click on the button below </p><hr>

@component('mail::panel') 
  <p style="text-align:center; color:red; font-size:16px;">Ignore if you did not make this request</p>
@endcomponent

@component('mail::button', ['url' => route('acctPasswordStaged', $user->token) ])
Click here to continue
@endcomponent


{{-- Footer --}}
@slot('footer')
@component('mail::footer')
Thanks, {{ config('app.name') }}
@endcomponent
@endslot
@endcomponent