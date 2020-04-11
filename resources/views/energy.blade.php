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
                        <div class="row topup energy">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body" style="padding:0px;">
                                        <div class="text-center">
                                            <div class="card-header">Energy Usage</div>
                                        </div>

                                        <section style="padding:10px 5px 10px 5px;">
                                            <div class="containerr">
                                                @php
                                                    $daily_array = [];
                                                    $monthly_array = [];
                                                @endphp
                                                @if (count($daily_values) > 1)

                                                    @foreach ($daily_values as $value)
                                                        @php
                                                            array_push($daily_array, $value);
                                                        @endphp
                                                    @endforeach
                                                @else
                                                    @php
                                                        if(isset($monthly_values[0]))array_push($monthly_array, $daily_values[0]);
                                                        else array_push($monthly_array, $daily_values[0]);
                                                    @endphp
                                                @endif

                                                @if (count($monthly_values) > 1)
                                                    @foreach ($monthly_values as $value)
                                                        @php
                                                            array_push($monthly_array, $value);
                                                        @endphp
                                                    @endforeach
                                                @else
                                                    @php
                                                        if(isset($monthly_values[0]))array_push($monthly_array, $monthly_values[0]);
                                                        else array_push($monthly_array, $monthly_values[1]);
                                                    @endphp
                                                @endif

                                                <br>
                                                <center>
                                                <ul class="tabs">
                                                    <li class="tab-link current" id="first" data-tab="tab-1">Daily Usage</li>
                                                    <li class="tab-link" data-tab="tab-2">Monthly Usage</li>
                                                </ul>
                                                <hr style="width:100px;">
                                                </center>
                                                <div id="tab-1" class="tab-content current">
                                                    <div id="dashboard_div">
                                                        <div id="filter_div"></div>
                                                        <div id="chart_div"></div>
                                                    </div>
                                                </div>
                                                <div id="tab-2" class="tab-content">
                                                    <div id="dashboard_div2">
                                                        <div id="filter_div2"></div>
                                                        <div id="chart_div2"></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </section>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

@include('inc.confirm')

<script>


        var daily_values = <?php echo json_encode($daily_array); ?>;
        var daily_value = [['Day', 'Units Consumed', { role: 'style' } ]];
        var current = new Date();
        mon = current.getMonth();
        year = current.getFullYear();
        //mon=element[2];
            daily_values.forEach(element => {
                daily_value.push([element[0], element[1], '#FFA519']);
            });

        var monthly_values = <?php echo json_encode($monthly_array); ?>;
        var monthly_value = [['Month', 'Units Consumed', { role: 'style' } ]];
        var current = new Date();
            monthly_values.forEach(element => {
                monthly_value.push([element[0], element[1], '#FFA519']);
            });
            console.log(JSON.stringify(monthly_value));
            console.log(JSON.stringify(daily_value));
            console.log(daily_value.length+' // '+monthly_value.length);



</script>


</div>

</div>

</div>

@endsection
