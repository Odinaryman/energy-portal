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
                        <div class="col-md-12">
                        <!-- table responsive -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Alarms</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="table" class="table display table-striped table-bordered no-wrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Customer</th>
                                                <th>Trigger 1</th>
                                                <th>Trigger 2</th>
                                                <th>Trigger 1 Status</th>
                                                <th>Trigger 2 status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($alarms as $alarm)
                                                @php
                                                    ($alarm->trigger_1_status==0) ? $alarm->trigger_1_status='False' : $alarm->trigger_1_status='True';
                                                    ($alarm->trigger_2_status==1) ? $alarm->trigger_2_status='True' : $alarm->trigger_2_status='False';
                                                @endphp

                                                <tr>
                                                    <td>{{$alarm->name}}</td>
                                                    <td>{{$alarm->trigger_unit_1}}</td>
                                                    <td>{{$alarm->trigger_unit_2}}</td>
                                                    <td>{{$alarm->trigger_1_status}}</td>
                                                    <td>{{$alarm->trigger_2_status}}</td>
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

