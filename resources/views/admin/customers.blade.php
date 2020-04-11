
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
                @if (isset(session('success')['error']) && session('success')['error'] != '')
                    <div class="container">
                        <div class="alert alert-danger">
                            {{session('success')['error']}}
                        </div>
                    </div>
                @endif
                @if (isset(session('success')['success']) && session('success')['success'] != '')
                    <div class="container">
                        <div class="alert alert-success">
                            {{session('success')['success']}}
                        </div>
                    </div>
                @endif
                @if (session('success'))
                    <div class="container">
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    </div>
                @endif
                <div class="container-fluid admin">
	<div class="row">
        <div class="col-12">
        <!-- table responsive -->
        <div class="card">
            <div class="card-body">
            <a href="{{route('customers.create')}}" class="btn float-right btn-success loadajaxpage" style="margin-bottom:10px;"><i class="fas fa-plus-circle"></i> Create</a>
                <h4 class="card-title">Customers</h4>
                <div class="table-responsive m-t-40">
                    <table id="table" class="table display table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <th>Create Date</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Meter No</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{$customer->created_at}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->phone}}</td>
                                <td>{{$customer->meter_no}}</td>
                                <td>
                                    {{-- Edit customer --}}
                                    <a class="loadajaxpage" href="customers/{{$customer->id}}/edit"><i class="fas fa-pencil-alt" title="Customer Details"></i></a>
                                     | 
                                     {{-- Show customer API details --}}
                                      <a class="loadajaxpage" href="customerapidetails/{{$customer->id}}" title="Customer API Details"><i class="fas fa-file-alt"></i></a>
                                      | 
                                      <a class="loadajaxpage" href="customers/{{$customer->id}}/topup" title="Topup"><i class="fas fa-money-bill-alt"></i></a>
                                      | 
                                     {{-- Delete customer --}}
                                     @if ($customer->isAdmin==0)
                                         <a href="deleteCustomer/{{$customer->id}}"><i class="fas fa-trash-alt" title="Delete Customer"></i></span></a>
                                    </td>
                                     @endif
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







<script>
$(function () {
	$('#config-table').DataTable({
		responsive: true,
		orderable: false
	});
 });
</script>
            </div>

@include('inc.confirm')

        

{{-- <footer class="page-footer">

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

   