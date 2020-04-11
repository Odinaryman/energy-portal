@extends('layouts.app')

@section('content')

<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>

<div id="main_content_load">

<div class="wrapper">

@include('admin.navbar')


<div id="content">

            @include('inc.topNav')
            <div class="justify-content-center data">
                <div class="container-fluid admin">
                    <div class="row">
                        <div class="col-12">
                        <!-- table responsive -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daily Readings</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="table" class="table display table-striped table-bordered no-wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>User</th>
                                                <th>Total Units Consumed</th>
                                                <th>Units Remaining</th>
                                                <th>Meter Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dailyReadings as $dailyReading)
                                                @php
                                                    $date	=	$dailyReading->day."/".$dailyReading->month."/".$dailyReading->year;

                                                    ($dailyReading->meter_status==1) ? $dailyReading->meter_status='ON' : $dailyReading->meter_status='OFF';
                                                @endphp

                                                <tr>
                                                    <td>{{$date}}</td>
                                                    <td>{{$dailyReading->name}}</td>
                                                    <td>{{$dailyReading->units_used}}</td>
                                                    <td>{{$dailyReading->units_remaining}}</td>
                                                    <td>{{$dailyReading->meter_status}}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
                </div>
            </div>
<script>
$(function () {
	$('#config-table').DataTable({
		responsive: true,
		orderable: false
	});
 });
</script>


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

