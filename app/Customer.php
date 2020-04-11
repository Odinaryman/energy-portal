<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Session; 
use DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\ApiDetails;


class Customer extends Model
{
	public $table = 'users';

	public static function getAllRecords()
    {
		return DB::table('users')->get();
	}
	
	public static function insertRecord($customer_array)
    {
		$user = new User;
		$user->name = $customer_array['name'];
		$user->email = $customer_array['email'];
		$user->password = Hash::make($customer_array['password']);
		$user->phone = $customer_array['phone'];
		$user->address = $customer_array['address'];
		$user->meter_no = $customer_array['meter_no'];

		if($user->save()) {

			$id = DB::table('users')->where('email', $customer_array['email'])->get();
			$api = new ApiDetails;
			$api->customer_id = $id[0]->id;
			$api->company_name = 'Sunhive';
			$api->username = 'POS1';
			$api->password = '123456';
			$api->customer_no = '0001';
			$api->customer_name = 'Sunhive';
			$api->vending_username = 'POS1';
			$api->vending_password = '123456';
			$api->save();		
			return true;
		}	
	}
	
	public static function deleteRecord($id)
    {
		if (User::where("id",$id)->delete()) {
			ApiDetails::where('customer_id', $id)->delete();
			return true;
		}
	}
	
	public static function getRecord($id)
    {
		return DB::table('users')->where('id',$id)->first();
	}
	
	public static function updateRecord($customer_array,$id)
    {
		$user = User::find($id);
		$user->name = $customer_array['name'];
		$user->email = $customer_array['email'];
		$user->password = Hash::make($customer_array['password']);
		$user->phone = $customer_array['phone'];
		$user->address = $customer_array['address'];
		$user->meter_no = $customer_array['meter_no'];

		if ($user->save()) {
			return true;
		}	
	}
	
	public static function getAPIDetails($id)
    {
		return DB::table('api_details')->where('customer_id',$id)->first();
	}
	
	public static function insertAPIDetailRecord($customer_api_array)
    {

		$api = new ApiDetails;
		$api->customer_id = $customer_api_array['customer_id'];
		$api->company_name = $customer_api_array['company_name'];
		$api->username = $customer_api_array['username'];
		$api->password = $customer_api_array['password'];
		$api->customer_no = $customer_api_array['customer_no'];
		$api->customer_name = $customer_api_array['customer_name'];
		$api->vending_username = $customer_api_array['vending_username'];
		$api->vending_password = $customer_api_array['vending_password'];
		
		if ($api->save()) {
			return true;
		}
	}
	
	public static function updateAPIDetailRecord($customer_api_array,$id)
    {
		if (ApiDetails::where('api_details_id', $id)->update($customer_api_array)) {
			return true;
		}	
	}
}