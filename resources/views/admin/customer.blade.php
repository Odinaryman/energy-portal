
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
                    <div class="row" id="user_row">
                        <div class="form-group col-xs-12 col-md-6 ">
                            <label for="admin_level">Account Type:</label>
                            <select required name="admin_level" class="form-control" id="admin_level">
                                <option disabled <?php if(!isset($customers->id)) echo "selected"; ?>>Select the account type</option>
                                <option <?php if(isset($customers->id) && !@$customers->isAdmin) echo "selected"; ?> value="0">User</option>
                                <option <?php if(@$customers->isAdmin) echo "selected"; ?> value="1">Admin</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-md-6 ">
                            <label for="admin_id">Admin:</label>
                            <select required name="admin_id" class="form-control" id="admin_id">
                                <option disabled <?php if(!isset($customers->id)) echo "selected"; ?>>Select the account admin</option>
                                <?php $admin=[];$admin_id=[]; if(!empty($users)){ foreach ($users as $user){  $ad=$user->name."(".$user->dcu_no.")";array_push($admin_id,$user->id);array_push($admin,$ad); ?>
                                <option <?php if(!empty($customers->admin_id) && $customers->admin_id==$user->id) echo "selected"; ?> value="<?php echo $user->id ?>>"><?php echo $user->name."(".$user->dcu_no.")" ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input required type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="<?php use Illuminate\Support\Facades\Auth;echo @$customers->name;?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input <?php if(isset($customers->id)  && Auth::user()->id !=1)echo 'readonly' ?> required type="email" name="email" class="form-control" id="email"  placeholder="Enter email" value="<?php echo @$customers->email;?>">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input <?php if(isset($customers->id))echo 'readonly' ?> required type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo @$customers->password;?>">
                    </div>
                    <div class="form-group">
                        <label for="Phone">Phone</label>
                        <input required type="text" onkeydown="return numberCheck(event,this)" name="phone"class="form-control" id="phone" placeholder="Phone" value="<?php echo @$customers->phone;?>">
                    </div>
                    <?php if((isset($customers->admin_level) && ($customers->admin_level)) || !isset($customers->id)){ ?>
                    <div class="form-group">
                        <label for="dcu_no">DCU Number</label>
                        <input <?php if(isset($customers->id) && Auth::user()->id !=1)echo 'readonly'; ?> onkeydown="return numberCheck(event,this)" required type="text" name="dcu_no"class="form-control" id="dcu_no" placeholder="DCU Number" value="<?php echo @$customers->dcu_no;?>">
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="meter_no">Meter Number</label>
                        <input <?php if(isset($customers->id) && Auth::user()->id !=1)echo 'readonly'; ?> onkeydown="return numberCheck(event,this)" required type="text" name="meter_no"class="form-control" id="meter_no" placeholder="Meter Number" value="<?php echo @$customers->meter_no;?>">
                    </div>

                    <div class="form-group">
                        <label for="Address">Adddress</label>
                        <textarea required name="address" class="form-control" id="address" placeholder="Address"><?php echo @$customers->address;?></textarea>
                    </div>
                    <input type="hidden" name="customer_id" id="" value="<?php echo @$customers->id;?>"/>
                    <input type="hidden" name="isAdmin" id="isAdmin"/>
                    <button type="submit" class="btn" style="background-color: #FFA519">Submit</button>
                    <a href="/customers" class="btn">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
            </div>

@include('inc.confirm')



<script>
    var isAdmin =<?php if(isset($customers->isAdmin))echo @$customers->isAdmin;else echo 0; ?>

    var admin= <?php echo json_encode($admin) ?>;
    var admin_id= <?php echo json_encode($admin_id) ?>;
    $(document).ready(function(){
        $('#admin_level').change(function(){
            var val = $("#admin_level option:selected").val();
            createAdmin(parseInt(val));
        })
        if(isAdmin)removeAdmin(0);
    })

    function createAdmin(a){
        if(!a) {
            $('#isAdmin').val(0);
            //if(!$('#meter_no').get(0).hasAttribute('required'))$('#meter_no').attr('required');
            removeAdmin(1);
            if ($('#admin_id').length)return;

            var form_group = $('<div>').addClass("form-group col-xs-12 col-md-6").appendTo('#user_row').hide();
            $('<label>').text('Admin:').attr('for', 'admin_id').appendTo(form_group);
            var select = $('<select>').attr({
                'required': 'required',
                'name': 'admin_id',
                'class': 'form-control',
                'id': 'admin_id'
            }).appendTo(form_group);
            $('<option>').attr({
                'disabled': 'disabled',
                'selected': 'selected'
            }).text('Select the admin').appendTo(select);
            for (var i = 0; i < admin.length; i++) {
                $('<option>').attr('value', admin_id[i]).text(admin[i]).appendTo(select);
            }
            $(form_group).slideDown();

        }else{
            $('#isAdmin').val(1);
            removeAdmin(0);
            if ($('#dcu_no').length)return;
            var phone = $('#phone').closest('.form-group');
            var form_group1 = $('<div>').addClass("form-group").insertAfter(phone).hide();
            $('<label>').attr('for', 'dcu_no').text('DCU Number').appendTo(form_group1);
            $('<input>').attr({
                onkeydown: "return numberCheck(event,this)", 'required': 'required',
                'type': "text", 'name': "dcu_no", 'class': "form-control", 'id': "dcu_no", 'placeholder': "DCU Number"
            }).appendTo(form_group1);
            $(form_group1).slideDown();

        }

    }

    function removeAdmin(a){
        if(a){
            if(!$('#meter_no').get(0).hasAttribute('required'))$('#meter_no').attr('required');
            var dcu='#dcu_no';
        } else{
            var dcu='#admin_id';
            $('#meter_no').removeAttr('required');
        }
        $(dcu).closest('.form-group').slideUp(function(){
            $(this).remove();
        });
    }
</script>
</div>


</div>

@endsection
