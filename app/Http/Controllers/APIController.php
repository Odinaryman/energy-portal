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
        /*$date = '2020-04-01';
        $end_date = 'yesterday';
        $daily = new API;
        while (strtotime($date) <= strtotime($end_date)) {
            $daily->getUserDailyData($date);
            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
        }*/
		$apiData	=	new API;
		$response	=	$apiData->getUserDailyData();
		dd($response);
    }

	public function getMonthlyData()
    {
        /*$date = '2019-11-01';
        $end_date = 'last month';
        $apiData	=	new API;
        while (strtotime($date) <= strtotime($end_date)) {
            $apiData->getUserMonthlyData($date);
            $date = date ("Y-m-d", strtotime("+1 month", strtotime($date)));
        }*/
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
