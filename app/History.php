<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Session; 
use DB;
class History extends Model
{
	public static function getAllPaymentHistory()
    {
		date_default_timezone_set("Africa/Lagos");
		return DB::table('payment_histories') 
								->join('users', 'payment_histories.customer_id', '=', 'users.id')
								->get();
	}
}