
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
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

             <div class="row justify-content-center data">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <p>Energy Balance</p>
                            <h1>{{$balance['units_remaining']}} <small>kwh</small></h1>
                            <i>You have used {{$balance['units_used']}} total units.</i>
                        </div>
                        <div class="card-header"><a href="./energy">Detailed Energy Usage</a></div>
                    </div>
                </div>

            </div>


{{--
<footer class="page-footer">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
      <p><strong>NRG</strong> BEE</p>

  </div>
  <!-- Copyright -->

</footer> --}}

</div>

</div>

</div>
@endsection


