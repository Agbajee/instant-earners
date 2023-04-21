@php
$gt = \App\Models\GeneralSettings::first();
@endphp
@component('mail::layout')
  @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('images/general/'.$gt->logo)}}" style="width:30%" alt="App Logo">
        @endcomponent
  @endslot
  

<h4>Hello {{$data['fullname']}},</h4>
<p>Welcome to the INSTANTNAIRE Family. This email is the details of your registration.</p>
<hr />

<span><strong> Verification Code :</strong> <span style="font-size:32px;">{{$data['code']}}</span></span>

@component('mail::panel') 
  <p style="text-align:start; font-size:16px;">
     <b> Email :</b> {{$data['email']}} <br/>
     <b> Username :</b>{{$data['username']}} <br/>
     <b> Verification Code :</b>{{$data['code']}} <br/>
  </p>
@endcomponent

<p>
<b>NOTE:</b> We will never ask you for your details .
 If you have any questions about this receipt, simply send an email to supoport@instantnaire.com, and we'll be in touch.
</p>

@component('mail::button', ['url' => config('app.url')])
Profile
@endcomponent

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
Thanks, {{ config('app.name') }}
@endcomponent
@endslot
@endcomponent