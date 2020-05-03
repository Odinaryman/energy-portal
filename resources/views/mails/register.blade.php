@component('mail::message')
Dear {{$name}},

Your smart meter account has been activated on NRGBEE portal.<br>
You can now login with the following credentials:<br>
<p>UserID: <b>{{$user}}</b></p>
<p>Password: <b>{{$password}}</b></p><br>

To change your password, go to the login page, click on forgot password and enter this email address.
A password reset link shall be sent to your email. Follow the link and reset your password.<br>

@component('mail::button', ['url' => $url])
Login
@endcomponent



Regards,<br/>
Team NRGBEE

@endcomponent
