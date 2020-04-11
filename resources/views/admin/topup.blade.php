
@extends('layouts.app')

@section('content')

<div class="wrapper">


@include('admin.navbar')


<div id="content">

            @include('inc.topNav')
    <!--<a href="{{URL::to('customers')}}" class="btn btn-danger loadajaxpage">Go back</a>-->
            <div class="justify-content-center data">
                <div class="container-fluid admin">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Topup</h4>
                <h6 class="card-subtitle"> CASH PAYMENT</h6>
                <form class="mt-4 form-horizontal" name="customerform" id="customerform" method="{{$method}}" action="{{$action}}">
                {{-- <input name="_method" type="hidden" value="{{$method}}"> --}}
                	@csrf
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input readonly type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="<?php echo @$customers->name;?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input readonly type="email" name="email" class="form-control" id="email"  placeholder="Enter email" value="<?php echo @$customers->email;?>">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                     <div class="form-group">
                        <label for="meter_no">Amount</label>
                        <input  onkeydown="return numberCheck(event,this)" type="text" name="amount" class="form-control" id="meter_no" placeholder="Amount in Naira" onkeydown="return numberCheck(event,this) >
                    </div>
                    <input type="hidden" name="customer_id" id="" value="<?php echo @$id;?>"/>
                    <button type="submit" class="btn btn-primary mb-4" >Topup</button>
                    <a href="{{URL::to('customers')}}" class="btn btn-danger loadajaxpage mb-4">Cancel</a>
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
