<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\API;

class APIController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDailyData()
    {
		$apiData	=	new API;
		$response	=	$apiData->getUserDailyData();
		dd($response);
    }
	
	public function getMonthlyData()
    {
		$apiData	=	new API;
		$response	=	$apiData->getUserMonthlyData();
		dd($response);
    }
    public function sendAlarm()
    {
        $apiData    =   new API;
        $response   =   $apiData->sendAlarm();
        dd($response);
    }
}
