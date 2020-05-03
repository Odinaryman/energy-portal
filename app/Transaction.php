<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Transaction extends Model
{
	public static function getAllPaymentTransaction($id)
    {
		date_default_timezone_set("Africa/Lagos");

        if($id==1){
            return DB::table('payment_transactions')
                ->join('users', 'payment_transactions.customer_id', '=', 'users.id')
                ->get();
        }
        return DB::table('payment_transactions')
            ->join('users', 'payment_transactions.customer_id', '=', 'users.id')
            ->where('users.admin_id',$id)
            ->orWhere('users.id',$id)
            ->get();
	}
}
