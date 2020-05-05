
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
                <div style="font-size: 13px" class="table-responsive m-t-40">
                    <table  id="table" class="table display table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Admin</th>
                                <th>Meter No</th>
                                <th>DCU No</th>
                                <th>Account Type</th>
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
                                <td>{{$customer->admin_id}}</td>
                                <td>{{$customer->meter_no}}</td>
                                <td>{{$customer->dcu_no}}</td>
                                <td>
                                    @if(!$customer->admin_level)User
                                    @else Admin
                                    @endif
                                </td>
                                <td style="font-size: 10px">
                                    {{-- Edit customer --}}
                                    <a class="loadajaxpage" href="customers/{{$customer->id}}/edit"><i class="fas fa-pencil-alt" title="Customer Details"></i></a>
                                     |
                                     {{-- Show customer API details --}}
                                      <a class="loadajaxpage" href="customerapidetails/{{$customer->id}}" title="Customer API Details"><i class="fas fa-file-alt"></i></a>
                                      |
                                      <a class="loadajaxpage" href="customers/{{$customer->id}}/topup" title="Topup"><i class="fas fa-money-bill-alt"></i></a>
                                      |
                                     {{-- Delete customer --}}
                                     @if ($customer->admin_level!=2)
                                        <a data-id="{{$customer->id}}" style="cursor: pointer" href="javascript:;" title="Delete User" data-toggle="modal" data-target="#deleteModal"
                                           onclick="transferId(this)"><i class="fas fa-trash-alt"></i></a>
                                        <!--<span data-id="{{$customer->id}}" id="edit-info" title="Delete User" data-toggle="modal" data-target="#deleteModal" onclick="transferId(this)">
                                <i class='fas fa-trash-alt'></i>
                            </span>-->
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
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div style="text-align: center" class="modal-body">
                <h3>Do you want to permanently delete this user</h3>
                <p><i style="font-size: 40px" class="fas fa-question"></i></p>
                <a id="delete_submit" href="javascript:;" class="btn" style="background-color: #FFA519;color: white" >Delete</a>
                <a href="javascript:;" data-dismiss="modal" class="btn">Cancel</a>
            </div>
        </div>
    </div>
</div>







<script>
    function transferId(a){
        var id=$(a).attr('data-id');
        $('#delete_submit').attr('href','deleteCustomer/'+id);
    }
    $(function () {
        /*$('#config-table').DataTable( {
            responsive: true,
            "order": [[ 0, "desc" ]]
        } );*/
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

