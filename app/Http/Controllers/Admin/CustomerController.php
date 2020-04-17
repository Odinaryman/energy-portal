<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use Illuminate\Validation\Rule;
use App\Customer;
use App\PaymentTransaction;
use App\ApprovePayments;
use App\ApiDetails;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;

class CustomerController extends Controller
{
	public function __construct()
    {
		$this->customers	=	new Customer;

    }
    public function index()
    {
		if (Auth::user()->isAdmin != true) {
			return redirect('dashboard');
		}

		$customers	=	$this->customers->getAllRecords();
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return view('admin.customers', compact('customers'));
		}
		else
		{
			$page 		=	"customers";
			return view('admin.customers', compact('customers'));
		}

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$method		=	"POST";
		$action		=	"/customers/create";
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return view('admin.customer',compact('method','action'));
		}
		else
		{
			$page	=	"customer";
			return view('admin.customer', compact('method','action'));
		}

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		$this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'meter_no' => 'required'
		]);

		$name		=	$request->input('name');
		$email		=	$request->input('email');
		$password	=	$request->input('password');
		$phone		=	$request->input('phone');
		$address	=	$request->input('address');
		$meter_no	=	$request->input('meter_no');


		$customer_array	=	array('name'=>$name,'email'=>$email,'password'=>$password,'meter_no'=>$meter_no);

		$validator 	=	Validator::make($customer_array	,
										array('name'=>'required','email'=>'required|email|unique:users','password'=>'required|min:8','meter_no'=>'required|unique:users')
										);
		if($validator->fails())
		{
		    $success="Error saving customer. Please contact the admin";
            //$success['error']=$validator->getMessageBag()->toArray();
            //$success = implode(",",$validator->getMessageBag()->toArray());
            //return redirect('customers')->with('error', $validator->getMessageBag());
			//return $response = array('errors' => $validator->getMessageBag()->toArray());
		}
		else
		{
			$customer_array['phone']	=	$phone;
			$customer_array['address']	=	$address;

			if ($this->customers->insertRecord($customer_array)) {
				$success= 'User Created Successfully!';

				Mail::to($email)->send(new RegisterMail($name, $email, $password,env('APP_URL')));


			}

		}
        return redirect('customers')->with('success', $success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$method		=	"POST";
		$action		=	"/customers/edit";
		$customers	=	$this->customers->getRecord($id);
       // dd($customers);
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return view('admin.customer',compact('customers','method','action'));
		}
		else
		{
			$page	=	"customer";
			return view('admin.customer', compact('customers','method','action', 'id'));

		}
	}

	public function topup_form($id)
    {
		$method		=	"POST";
		$action		=	"/customers/topup";
		$customers	=	$this->customers->getRecord($id);
       //dd($customers);
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{

			return view('admin.topup',compact('customers','method','action'));
		}
		else
		{
			$page	=	"customer";
			$myAPI = ApiDetails::where('customer_id', $id)->first();
			if (count($myAPI) > 0) {
				return view('admin.topup', compact('customers','method','action', 'id'));
			}
			$success = 'API Details Not Set';
			return redirect('customers')->with('success', $success);
		}
	}

	public function topup(Request $request) {
		$this->validate($request, [
            'customer_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'amount' => 'required'
		]);

		$id = $request->input('customer_id');
       	$amount =	$request->input('amount');
       	$email =	$request->input('email');

		$transaction = new PaymentTransaction;
        $transaction->account_type = 'CASH PAYMENT';
        $transaction->credit_amount = $amount;
        $transaction->transaction_status = true;
        $transaction->customer_id = $id;

		if ($transaction->save()) {
			$myAPI = ApiDetails::where('customer_id', $id)->first();
			$user = User::where('id', $id)->first();
			$meter = $user->meter_no;

			if (count($myAPI) > 0) {
				$success = [
					'success' => '',
					'error' => '',
				];

                $transaction = array(
                    'company_name' => $myAPI->company_name,
                    'user_name' => $myAPI->username,
                    'password' => $myAPI->password,
                    'password_vend' => $myAPI->vending_password,
                    'meter_number' => $meter,
                    'amount' => $amount,
                    'email' => $email,
                    'id' => $id
			    );

                $myPayment = new ApprovePayments;
                if ($myPayment->approvePayments($transaction)) {
                    $success['success']='Payment Successful!';
                } else {
                    $success['error']='Invalid Meter Number!';
                }

            } else {
                $success = ['error'=>'Payment Successful! API Details Not Set!'];
			}
			$customers	=	$this->customers->getAllRecords();
            return redirect('customers')->with('success', $success);
		}


	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		$this->validate($request, [
            'customer_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'meter_no' => 'required'
		]);

		$id = $request->input('customer_id');

       	$name		=	$request->input('name');
		$email		=	$request->input('email');
		$password	=	$request->input('password');
		$phone		=	$request->input('phone');
		$address	=	$request->input('address');
		$meter_no	=	$request->input('meter_no');

		$customer_array	=	array('name'=>$name,'email'=>$email,'password'=>$password,'meter_no'=>$meter_no);
		$validator 	=	Validator::make($customer_array	,
										array(	'name'=>'required',
												//'email'=>"required|email|unique:customers",
												'email' => [
													'required',
													'email',
													Rule::unique('users')->ignore($id,'id'),
												],
												'password' => [
													'required',
													'min:8',
													Rule::unique('users')->ignore($id,'id'),
												]
												//'password'=>'required|min:8','meter_no'=>'required|unique:customers'
												)
										);
		if($validator->fails())
		{
			return $response = array('errors' => $validator->getMessageBag()->toArray());
		}
		else
		{
			$customer_array['phone']	=	$phone;
			$customer_array['address']	=	$address;


			if ($this->customers->updateRecord($customer_array,$id)) {
				$success = 'User Updated Successfully!';

            	return redirect('customers')->with('success', $success);
			}
			// return $response		= 	array('success' => "Data updated successfully.");
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		if ($this->customers->deleteRecord($id)) {
			$success = 'User Deleted Successfully!';

			return redirect('customers')->with('success', $success);
		}

		// return response()->json(["success" => "1",'systemmessage'=>"Record deleted successfully."],200);
    }

	 public function customerAPIDetails($id)
    {
		$method				=	"POST";
		$action				=	"/customerapidetailsaction";
		$customerapidetails	=	$this->customers->getAPIDetails($id);
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return view('admin.customerapidetails',compact('method','action','customerapidetails','id'));
		}
		else
		{
			$page	=	"customerapidetails";
			return view('admin.customerapidetails', compact('method','action','customerapidetails','id'));
		}

    }

	public function customerAPIDetailsAction(Request $request)
    {
		$this->validate($request, [
            'customer_id' => 'required',
            'api_detail_id' => 'required',
            'company_name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'customer_no' => 'required',
            'customer_name' => 'required',
            'vending_username' => 'required',
            'vending_password' => 'required'
		]);

		$customer_id		=	$request->input('customer_id');
		$api_detail_id		=	$request->input('api_detail_id');

       	$company_name		=	$request->input('company_name');
		$username			=	$request->input('username');
		$password			=	$request->input('password');
		$customer_no		=	$request->input('customer_no');
		$customer_name		=	$request->input('customer_name');
		$vending_username	=	$request->input('vending_username');
		$vending_password	=	$request->input('vending_password');

		$customer_api_array	=	array('company_name'=>$company_name,'username'=>$username,'password'=>$password,'customer_no'=>$customer_no,'customer_name'=>$customer_name,'vending_username'=>$vending_username,'vending_password'=>$vending_password);


		$validator 	=	Validator::make($customer_api_array	,
										array(	'company_name'=>'required',
												'username'=>"required",
												'password'=>'required',
												'customer_no'=>'required',
												'customer_name'=>'required',
												'vending_username'=>'required',
												'vending_password'=>'required'
												)
										);
		if($validator->fails())
		{
			return $response = array('errors' => $validator->getMessageBag()->toArray());
		}
		else
		{
			$customer_api_array['customer_id']	=	$customer_id;

			if($api_detail_id != '')
			{

				if ($this->customers->updateAPIDetailRecord($customer_api_array,$api_detail_id)) {
					$success = 'API Details Updated Successfully!';

            		return redirect('customers')->with('success', $success);
				}
			}
			else
			{
				if ($this->customers->insertAPIDetailRecord($customer_api_array)) {
					$success = 'API Details Inserted Successfully!';

            		return redirect('customers')->with('success', $success);
				}
			}
		}
    }
}
