@component('mail::message')
Hi, {{$name}}

You can now login to your NRGBEE account using the details below:<br>
<p>UserID: <b>{{$user}}</b></p>
<p>Password: <b>{{$password}}</b></p>

@component('mail::button', ['url' => '{{url('/')}}'])
Login
@endcomponent

Regards
@endcomponent
