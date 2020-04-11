@extends('layouts.app')

@section('content')

<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>

<div id="main_content_load">

<div class="wrapper">

@include('inc.navbar')


<div id="content">

            @include('inc.topNav')

             <div class="row justify-content-center data">
                 @if (session('success'))
                    <div class="container">
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="card info">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            
                            <section>
                                <h2>{{ Auth::user()->name }}</h2>
                                <p>{{ Auth::user()->address }}</p>
                            </section>
                        </div>
                    </div>

                    <div class="card meter">
                        <div class="card-header">Energy Account Balance Warning</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <section class="alert-form">
                                @include('inc.alarm')
                            </section>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card meter">
                        <div class="card-header">Personal Information</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            
                            <div class="flex-container">
                                <p class="left">Email Address</p>
                                <p class="right">{{ Auth::user()->email }}</p>
                            </div>
                            <hr>
                            <div class="flex-container">
                                <p class="left">Phone Number</p>
                                <p class="right">{{ Auth::user()->phone }}</p>
                            </div>  
                        </div>
                    </div>
                    <div class="card meter">
                        <div class="card-header">Meter Information</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            
                            <div class="flex-container">
                                <p class="left">Meter Number</p>
                                <p class="right">{{ Auth::user()->meter_no }}</p>
                            </div>
                            <hr>    
                        </div>
                    </div>

                    
                </div>
            </div>           

</div>

</div>
</div>
@endsection

