@component('mail::message')
Hi, {{$name}}

You have <b>{{$units_left}}</b> units left on your meter. Please login to your account and topup your meter so you don't run out of units.

@component('mail::button', ['url' => '{{url('/')}}'])
Topup My Account
@endcomponent

Cheers!
@endcomponent
