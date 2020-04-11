@extends('layouts.app')

@section('content')
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>

<div id="main_content_load">
    <div class="container content2">
            <center>
                <a href="/"><img src="{{asset('/img/PNG.png')}}" alt="NRG BEE" class="logo"></a>
            </center>
            <div class="row justify-content-center">
        <div class="col-md-8 content2">
            
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
         
                            <div class="col-md-6 input">
                                <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <div class="col-md-6 input">
                                <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror    
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6 input">
                                <button type="submit" class="btn btn-primary login-btn">
                                    <strong>{{ __('CONTINUE') }}</strong>
                                </button>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 input">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link reset-link" href="{{ route('password.request') }}">
                                        <i class="fas fa-key text-warning"></i>
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>            
        </div>
    </div>

        </div>
</div>

@endsection

