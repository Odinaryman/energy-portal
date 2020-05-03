<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Reading extends Model
{
    public static function dailyReadings($id)
    {
        if($id==1){
            return DB::table('daily_readings')
                ->join('users', 'daily_readings.customer_id', '=', 'users.id')
                ->get();
        }
		return DB::table('daily_readings')
            ->join('users', 'daily_readings.customer_id', '=', 'users.id')
            ->where('users.admin_id',$id)
            ->orWhere('users.id',$id)
			->get();
	}

	public static function monthlyReadings($id)
    {
        if($id==1){
            return DB::table('monthly_readings')
                ->join('users', 'monthly_readings.customer_id', '=', 'users.id')
                ->orderBy('month', 'DESC')
                ->orderBy('year', 'DESC')
                ->get();
        }
		return DB::table('monthly_readings')
            ->join('users', 'monthly_readings.customer_id', '=', 'users.id')
            ->where('users.admin_id',$id)
            ->orWhere('users.id',$id)
			->orderBy('month', 'DESC')
			->orderBy('year', 'DESC')
			->get();
	}
}
