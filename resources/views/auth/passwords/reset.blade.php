@extends('layouts.app')

@section('content')
    <div class="container content2">
            <center>
               <a href="/"><img src="{{asset('/img/PNG.png')}}" alt="NRG BEE" class="logo"></a>
            </center>
            <div class="row justify-content-center">
        <div class="col-md-8 content2">

                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">

                            <div class="col-md-6 input">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="Email Address" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 input">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">

                            <div class="col-md-6 input">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6 input">
                                <button type="submit" class="btn btn-primary login-btn">
                                    <strong>{{ __('Reset Password') }}</strong>
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>

        </div>
@endsection


