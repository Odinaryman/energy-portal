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
                                    <br>
                                    <b class="range">Date Range</b>
                                        <div class="md-form">
                                            <section>
                                                <!--<form class="form-inline">

                                                        @if (empty($from) || empty($to))
                                                            <div class="form-group">
                                                                <label for="from"><b>From: &nbsp;</b></label>
                                                                <input readonly="readonly" type="text" id="date-picker1" class="form-control datepicker" autocomplete="off" value="2020/01/01">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="to"><b>To: &nbsp;</b></label>
                                                                <input readonly="readonly" type="text" id="date-picker2" class="form-control datepicker" value="2020/01/01">
                                                            </div>
                                                        @else
                                                            <div class="form-group">
                                                                <label for="from"><b>From: &nbsp;</b></label>
                                                                <input readonly="readonly" type="text" id="date-picker1" class="form-control datepicker" value="{{$from}}" autocomplete="off">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="to"><b>To: &nbsp;</b></label>
                                                                <input readonly="readonly" type="text" id="date-picker2" class="form-control datepicker" value="{{$to}}">
                                                            </div>
                                                        @endif
                                                </form>
                                                <a class="btn btn-success retrieve" style="margin-top:5px;" onclick="submit()">Retrieve</a>
                                                <br>
                                                <form action="{{ action('PaymentsHistoryController@filter') }}" method="POST">
                                                    @csrf
                                                    <input type="text" id="from" name="from" hidden>
                                                    <input type="text" id="to" name="to" hidden>
                                                    <button class="btn btn-success" name="submit" id="submit" hidden></button>
                                                </form>-->
                                            </section>

                                        </div>
                                        <section class="padded-table">
                                            <div class="table-responsive m-t-40">
                                                <table class="table table-hover" id="table">
                                                        <thead>

                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Token</th>
                                                            <th>Amount</th>
                                                            <th>Units</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($payments) < 1)
                                                                <tr>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                </tr>
                                                            @else
                                                                @foreach ($payments as $payment)
                                                                    <tr>
                                                                        <td>{{$payment->created_at}}</td>
                                                                        <td>{{$payment->token}}</td>
                                                                        <td>{{$payment->paid_amount}}</td>
                                                                        <td>{{$payment->paid_unit}}</td>
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
