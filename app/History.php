<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
class History extends Model
{
	public static function getAllPaymentHistory($id)
    {
		date_default_timezone_set("Africa/Lagos");
        /*return DB::table('payment_histories')
            ->join('users', 'users.id', '=', 'payment_histories.customer_id')
            ->join('payment_transactions', 'users.id', '=', 'users.id')
            ->get();*/
        if($id==1){
            return DB::table('payment_histories')
                ->join('users', 'payment_histories.customer_id', '=', 'users.id')
                ->get();
        }
        return DB::table('payment_histories')
            ->join('users', 'payment_histories.customer_id', '=', 'users.id')
            ->where('users.admin_id',$id)
            ->orWhere('users.id',$id)
            ->get();

	}
}
