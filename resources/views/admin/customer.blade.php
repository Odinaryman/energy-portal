
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
                <h4 class="card-title">Customer</h4>
                <h6 class="card-subtitle"> Fill all the data </h6>
                <form class="mt-4 form-horizontal" name="customerform" id="customerform" method="{{$method}}" action="{{$action}}">
                {{-- <input name="_method" type="hidden" value="{{$method}}"> --}}
                	@csrf
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input required type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="<?php echo @$customers->name;?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input required type="email" name="email" class="form-control" id="email"  placeholder="Enter email" value="<?php echo @$customers->email;?>">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input required type="password" name="password"class="form-control" id="password" placeholder="Password" value="<?php echo @$customers->password;?>">
                    </div>
                    <div class="form-group">
                        <label for="Phone">Phone</label>
                        <input required type="text" onkeydown="return numberCheck(event,this)" name="phone"class="form-control" id="phone" placeholder="Phone" value="<?php echo @$customers->phone;?>">
                    </div>
                    <div class="form-group">
                        <label for="Adddress">Adddress</label>
                        <textarea name="address" class="form-control" id="address" placeholder="Adddress"><?php echo @$customers->address;?></textarea>
                    </div>
                     <div class="form-group">
                        <label for="meter_no">Meter Number</label>
                        <input onkeydown="return numberCheck(event,this)" required type="text" name="meter_no"class="form-control" id="meter_no" placeholder="Meter Number" value="<?php echo @$customers->meter_no;?>">
                    </div>
                    <input type="hidden" name="customer_id" id="" value="<?php echo @$id;?>"/>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                    <a href="{{URL::to('customers')}}" class="btn btn-danger loadajaxpage">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
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

@endsection
