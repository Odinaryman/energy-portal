<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Alarm extends Model
{
    public static function getAllAlarms()
    {
		return DB::table('alarms')
								->join('users', 'alarms.customer_id', '=', 'users.id')
                                //->select('*','users.name as name')
								->get();
	}
}
