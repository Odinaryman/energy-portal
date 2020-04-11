<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Session; 
use DB;

class Transaction extends Model
{
	public static function getAllPaymentTransaction()
    {
		date_default_timezone_set("Africa/Lagos");
		return DB::table('payment_transactions') 
								->join('users', 'payment_transactions.customer_id', '=', 'users.id')
								->get();
	}
}
