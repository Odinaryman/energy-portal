<div id="login" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <div class="modal-content">
      <div class="modal-body">
        <button data-dismiss="modal" class="close" id="close1">&times;</button>
        

        {{-- <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
          <div class="row" style="margin-bottom:40px;">
            <div class="col-md-12 col-md-offset-2" style="padding-right:0px;">
              <p>
                <h3 style="margin-bottom:30px;" class="text-center">Confirm and Pay!</h3>
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td><strong>Name</strong></td>
                      <td><strong>Amount</strong></td>
                      <td><strong>Email</strong></td>
                      <td><strong>Fees</strong></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ Auth::user()->name }}</td>
                      <td><i id="confirm"></i></td>
                      <td>{{ Auth::user()->email }}</td>
                      <td>2%</td>
                    </tr>
                  </tbody>
                </table>
              </p>
              <input type="hidden" name="email" value="{{ Auth::user()->email }}"> 
              <input type="hidden" name="subaccount" value="ACCT_dz6nsfv9rkcqx2v"> 
              <input type="hidden" name="amount" id="amount"> 
              <input type="hidden" name="quantity" value="1">
              <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" >
              <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
              <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}">
                @csrf
             <center>
               <button class="btn btn-success login-btn" type="submit" value="Pay Now!" style="width:300px;">
                <i class="fas fa-money-bill-alt fa-lg"></i> Pay Now!
                </button>
             </center>
            </div>
          </div>
        </form> --}}

        <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
          @csrf
          <div class="row" style="margin-bottom:40px;">
            <div class="col-md-12 col-md-offset-2" style="padding-right:0px;">
              <p>
                <h3 style="margin-bottom:30px;" class="text-center">Confirm and Pay!</h3>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <td><strong>Name</strong></td>
                      <td><strong>Amount</strong></td>
                      <td><strong>Email</strong></td>
                      <td><strong>Fees</strong></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ Auth::user()->name }}</td>
                      <td><i id="confirm"></i></td>
                      <td>{{ Auth::user()->email }}</td>
                      <td>2%</td>
                    </tr>
                  </tbody>
                </table>
              </p>
              <input type="hidden" name="email" value="{{ Auth::user()->email }}"> 
              <input type="hidden" name="name" value="{{ Auth::user()->name }}"> 
              <input type="hidden" name="amount" id="amount"> 
              <input type="hidden" name="quantity" value="1">
              {{-- <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > --}}
              {{-- <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> --}}
              {{-- <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> --}}
             <center>
               <button class="btn btn-success login-btn" type="submit" value="Pay Now!" style="width:300px;">
                <i class="fas fa-money-bill-alt fa-lg"></i> Pay Now!
                </button>
             </center>
            </div>
          </div>
        </form>
        
      </div>
    </div>
  </div>  
</div>