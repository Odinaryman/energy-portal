<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Reading;
use Auth;

class ReadingController extends Controller
{
    public function index() {
        if (Auth::user()->isAdmin != true) {
			return redirect('dashboard');
        }

        $dailyReadings	=	new Reading;
		$dailyReadings	=	$dailyReadings->dailyReadings(Auth::user()->id);
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return view('admin.daily_readings', compact('dailyReadings'));
		}
		else
		{
            $page 	=	"daily_readings";
            return view('admin.daily_readings', compact('dailyReadings'));
			return view('layout', compact('page','dailyReadings'));
		}
    }

    public function monthlyReadings() {

        if (Auth::user()->isAdmin != true) {
			return redirect('dashboard');
        }

        $monthlyReadings	=	new Reading;
		$monthlyReadings	=	$monthlyReadings->monthlyReadings(Auth::user()->id);
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return view('admin.monthly_readings', compact('monthlyReadings'));
		}
		else
		{
            $page 	= 	"monthly_readings";
            return view('admin.monthly_readings', compact('monthlyReadings'));
			return view('layout', compact('page','monthlyReadings'));
		}
    }
}
