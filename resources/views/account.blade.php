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

             <div class="row justify-content-center data">
                 @if (session('success'))
                    <div class="container">
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="card info">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                            <section>
                                <h2>{{ Auth::user()->name }}</h2>
                                <p>{{ Auth::user()->address }}</p>
                            </section>
                        </div>
                    </div>

                    <div class="card meter">
                        <div class="card-header">Energy Account Balance Warning</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <section class="alert-form">
                                @include('inc.alarm')
                            </section>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card meter">
                        <div class="card-header">
                            <span style="float: left">Personal Information</span>
                            <span data-id="{{Auth::user()->customer_id}}" id="edit-info" title="Edit Personal details" data-toggle="modal" data-target="#userModal">
                                <i class='fas fa-pencil-alt'></i>
                            </span>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                            <div class="flex-container">
                                <p class="left">Email Address</p>
                                <p class="right">{{ Auth::user()->email }}</p>
                            </div>
                            <hr>
                            <div class="flex-container">
                                <p class="left">Phone Number</p>
                                <p class="right">{{ Auth::user()->phone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card meter">
                        <div class="card-header">Meter Information</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                            <div class="flex-container">
                                <p class="left">Meter Number</p>
                                <p class="right">{{ Auth::user()->meter_no }}</p>
                            </div>
                            <hr>
                        </div>
                    </div>


                </div>
            </div>

</div>

</div>
</div>

<div id="userModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Personal Information</h4>
            </div>
            <div class="modal-body">
                <form class="mt-4 form-horizontal" name="detailsform" id="detailsform" method="POST" action="/info/edit">
                    @csrf
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input required type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="Phone">Phone</label>
                        <input required type="text" onkeydown="return numberCheck(event,this)" name="phone"class="form-control" id="phone" placeholder="Phone" value="{{Auth::user()->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="Address">Address</label>
                        <textarea name="address" class="form-control" id="address" placeholder="Address">{{Auth::user()->address}}</textarea>
                    </div>
                    <button type="submit" class="btn" style="background-color: #FFA519;color: white" >Submit</button>
                    <a href="javascript:;" data-dismiss="modal" class="btn">Cancel</a>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection

