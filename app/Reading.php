<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Reading extends Model
{
    public static function dailyReadings()
    {
		return DB::table('daily_readings')
                                        ->join('users', 'daily_readings.customer_id', '=', 'users.id')
										->orderBy('day', 'ASC')
										->orderBy('month', 'DESC')
										->orderBy('year', 'DESC')
										->get();
	}

	public static function monthlyReadings()
    {
		return DB::table('monthly_readings')
                                        ->join('users', 'monthly_readings.customer_id', '=', 'users.id')
										->orderBy('month', 'DESC')
										->orderBy('year', 'DESC')
										->get();
	}
}
