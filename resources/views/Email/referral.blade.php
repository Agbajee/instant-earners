@php
$gt = \App\Models\GeneralSettings::first();
@endphp
@component('mail::layout')
  @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('images/general/'.$gt->logo)}}" style="width:30%" alt="App Logo">
        @endcomponent
  @endslot

<h4>Hello {{ $data['fullname'] }},</h4>
<p>Another Win For you🙂. Your affliate balance have increased by this activity</p>

@component('mail::table') 
| <b>User</b>           | <b>Type</b>        | <b>Amount </b>                          | 
|:---------------------:|:------------------:|:---------------------------------------:| 
| {{$data['downline']}} | {{$data['type']}}  | {{'₦'.number_format($data['amount'])}}  |  
@endcomponent

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
Thanks, {{ config('app.name') }}
@endcomponent
@endslot
@endcomponent
