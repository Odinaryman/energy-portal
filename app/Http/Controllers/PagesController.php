<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Alarm;

use App\Traits\ApprovePayments;

class PagesController extends Controller
{
    
    public function index() {
        return view('pages.index');
    }

    // public function test() {
    //     $var = DB::table('alarms')->get();
    //     echo $var;
    // }
}
