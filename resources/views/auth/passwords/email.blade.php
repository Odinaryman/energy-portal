@extends('layouts.app')

@section('content')
    <div class="container content2">
        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

            <center>
            <a href="/"><img src="{{asset('/img/PNG.png')}}" alt="NRG BEE" class="logo"></a>
            </center>
            <div class="row justify-content-center">
        <div class="col-md-8 content2">

                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('password.email') }}">
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
                                <button type="submit" class="btn btn-primary login-btn">
                                    <strong>{{ __('Send Password Reset Link') }}</strong>
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>

        </div>
@endsection


