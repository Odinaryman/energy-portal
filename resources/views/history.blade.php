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
                <div class="container payments">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header">Payment History</div>

                                        <section class="padded-table">
                                            <div class="table-responsive m-t-40">
                                                <table class="table table-hover" id="table">
                                                        <thead>

                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Token</th>
                                                            <th>Amount</th>
                                                            <th>Units</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($payments) < 1)

                                                                <tr>
                                                                    <td>-</td>
                                                                    <td>-</td
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                </tr>
                                                            @else
                                                                @foreach ($payments as $payment)
                                                                    <tr>
                                                                        <td>{{$payment['dates']}}</td>
                                                                        <td>{{$payment['times']}}</td>
                                                                        <td>{{$payment['token']}}</td>
                                                                        <td>{{$payment['paid_amount']}}</td>
                                                                        <td>{{$payment['paid_unit']}}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</div>

</div>
</div>
@endsection
