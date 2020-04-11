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

            <div class="justify-content-center data">
                @if (session('success'))
                    <div class="container">
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    </div>
                @endif
                @if (isset($error))
                    <div class="container">
                        <div class="alert alert-success">
                            {{$error}}
                        </div>
                    </div>
                @else
                    <div class="row topup">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body" style="padding:0px;">
                                        <div class="text-center">
                                            <div class="card-header">Topup Your Account!</div>
                                        </div>
                                        <section style="padding:10px 30px 10px 30px;">
                                            <div class="text-center" >
                                            <p style="font-weight:unset; margin-bottom:0px;margin-top:30px; font-weight:700;">Select Amount</p>
                                        </div>


                                             <center>
                                                 <div class="card amounts" style="border:none;" id="card">
                                                    <div class="card-body" style="padding:0px;">

                                                        <button type="button" data-amount="5000" class="btn btn-success" onclick="collectAmount(this)">N5,000</button>
                                                        <button type="button" data-amount="10000" onclick="collectAmount(this)" class="btn btn-success">N10,000</button>
                                                        <button type="button" data-amount="20000" onclick="collectAmount(this)" class="btn btn-success">N20,000</button>
                                                        <button type="button" data-amount="50000" onclick="collectAmount(this)" class="btn btn-success">N50,000</button>


                                                    </div>

                                                </div>
                                             </center>

                                        <form action="#">
                                            <div class="form-group amounts">
                                                <button type="button" class="btn btn-success right" style="margin:auto;width:100%;" id="other">OTHER</button>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter Other Amount" style="display:none" id="other-input" onkeydown="return numberCheck(event,this)">
                                            </div>
                                        </form>
                                        </section>
                                        <hr style="margin-top:0px;">
                                        <section style="padding:30px; padding-bottom:10px; padding-top:0px">
                                            <form action="#">
                                            <div class="form-group confirm">
                                                <button type="button" onclick="confirm()" class="btn btn-primary login-btn ">CONFIRM</button>
                                                <p id="demo"></p>
                                                <a class="login-trigger" href="#" data-target="#login" data-toggle="modal" id="click"></a>
                                            </div>
                                        </form>
                                        </section>

                                    </div>
                                </div>
                            </div>
                        </div>
                @endif

                    </div>

@include('inc.confirm')

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
