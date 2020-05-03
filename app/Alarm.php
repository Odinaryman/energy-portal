<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Alarm extends Model
{
    public static function getAllAlarms($id)
    {
        if($id==1){
            return DB::table('alarms')
                ->join('users', 'alarms.customer_id', '=', 'users.id')
                ->get();
        }
		return DB::table('alarms')
            ->join('users', 'alarms.customer_id', '=', 'users.id')
            ->where('users.admin_id',$id)
            ->orWhere('users.id',$id)
            //->select('*','users.name as name')
            ->get();
	}
}
