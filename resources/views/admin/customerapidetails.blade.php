
@extends('layouts.app')

@section('content')

<div class="wrapper">

@include('admin.navbar')


<div id="content">

            @include('inc.topNav')

            <div class="justify-content-center data">
               <div class="container-fluid admin">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Customer API Details</h4>
                <h6 class="card-subtitle"> Fill all the data </h6>
                <form class="mt-4 form-horizontal" name="customerform" id="customerform" method="{{$method}}" action="{{$action}}">
                {{-- <input name="_method" type="hidden" value="{{$method}}"> --}}
                	@csrf
                    <div class="form-group">
                        <label for="Name">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name" value="<?php echo @$customerapidetails->company_name;?>"> 
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        <input type="text" name="username" class="form-control" id="username"  placeholder="User Name" value="<?php echo @$customerapidetails->username;?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="text" name="password"class="form-control" id="password" placeholder="Password" value="<?php echo @$customerapidetails->password;?>">
                    </div>
                    <div class="form-group">
                        <label for="Phone">Customer Number</label>
                        <input type="text" name="customer_no"class="form-control" id="customer_no" placeholder="Customer Number" value="<?php echo @$customerapidetails->customer_no;?>">
                    </div>
                    
                     <div class="form-group">
                        <label for="meter_no">Customer Name</label>
                        <input type="text" name="customer_name"class="form-control" id="customer_name" placeholder="Customer Name" value="<?php echo @$customerapidetails->customer_name;?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Vending User Name</label>
                        <input type="text" name="vending_username" class="form-control" id="vending_username"  placeholder="Vending User Name" value="<?php echo @$customerapidetails->vending_username;?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Vending Password</label>
                        <input type="text" name="vending_password"class="form-control" id="vending_password" placeholder="Vending Password" value="<?php echo @$customerapidetails->vending_password;?>">
                    </div>
                    <input type="hidden" name="api_detail_id" id="" value="<?php echo @$customerapidetails->api_details_id;?>"/>
                    <input type="hidden" name="customer_id" id="" value="<?php echo @$id;?>"/>
                    {{-- <button type="submit" class="btn btn-primary" onclick="submitform('{{URL::to($action)}}','customerform','customers')">Submit</button> --}}
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <a href="{{URL::to('customers')}}" class="btn btn-danger loadajaxpage">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
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

@endsection
