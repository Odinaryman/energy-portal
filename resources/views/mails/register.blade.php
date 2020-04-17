@component('mail::message')
Dear {{$name}},

Your smart meter account has been activated on NRGBEE portal.<br>
You can now login with the following credentials:<br>
<p>UserID: <b>{{$user}}</b></p>
<p>Password: <b>{{$password}}</b></p><br>

@component('mail::button', ['url' => $url])
Login
@endcomponent

You are advised to change your password immediately, on your first login.<br>

Regards,<br/>
Team NRGBEE

@endcomponent
