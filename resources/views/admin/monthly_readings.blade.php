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
                                <h4 class="card-title">Monthly Readings</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="table" class="table display table-bordered table-striped no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>User</th>
                                                <th>Total Units Consumed</th>
                                                <th>Units Remaining</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($monthlyReadings as $monthlyReading)
                                            @php
                                                $date	=	$monthlyReading->month."/".$monthlyReading->year;
                                            @endphp
                                            <tr>
                                                <td>{{$date}}</td>
                                                <td>{{$monthlyReading->name}}</td>
                                                <td>{{$monthlyReading->units_used}}</td>
                                                <td>{{$monthlyReading->units_remaining}}</

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

