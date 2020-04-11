<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DailyReading;
use App\MonthlyReading;
use Auth;
use DB;
use App\ApiDetails;
use App\Alarm;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        if (Auth::user()->isAdmin == true) {
            return redirect('customers');
        }
        $data = DailyReading::where('customer_id', Auth::user()->id)
            ->where('units_used','>',0)
            ->orderBy('id', 'DESC')->select('units_remaining', 'units_used')->first();


        if ($data==null) {
            $data['units_remaining']=0;
            $data['units_used']=0;
        }

        $balance = [
            'balance' => $data,
        ];

        return view('dashboard')->with($balance);
    }

    public function account() {
        $alarm=DB::table('alarms')
            ->where('customer_id', Auth::user()->id)
            ->join('users', 'alarms.customer_id', '=', 'users.id')
            ->first();
        //dd($alarm);

        if (isset($alarm)) {
            $alarms=[
                'trigger_unit_1' =>$alarm->trigger_unit_1,
                'trigger_unit_2' =>$alarm->trigger_unit_2
            ];

        }else{
            $alarms=[
                'trigger_unit_1' =>null,
                'trigger_unit_2' =>null
            ];
        }


        return view('account')->with($alarms);
    }

    public function reset() {
        return view('reset');
    }

    public function topup() {

        if (ApiDetails::where('customer_id', Auth::user()->id)->count() < 1) {
            $error = [
                'error' => 'Please contact administrator to configure your account for payments!'
            ];

            return view('topup')->with($error);
        } else {
            return view('topup');
        }

    }

    public function history() {
        return view('history');
    }

    public function energy() {

        $datas = DailyReading::where('customer_id', Auth::user()->id)->orderBy('id', 'DESC')->take(16)->get();

        $daily_array = [
                'daily_values' => [[0, 0]],
                'monthly_values' => [[0, 0]]
        ];
        //dd(gettype($datas));die();
        if (count($datas) > 0) {
            $main_data=[];
            foreach ($datas as $data) {
                $good_date = date_format(date_create($data->year . "-" . $data->month . "-" . $data->day ), "M d, Y");
                array_push($main_data, [$good_date,$data->units_used]);
            }
            //dd($main_data);die();
            if(count($main_data)>1){
                $main_data=array_reverse($main_data);
                $val=$main_data[0][1];
                for($i=1;$i<count($main_data);$i++){
                    if($main_data[$i][1]){
                        $init_value=$main_data[$i][1];
                        $main_data[$i][1]=$main_data[$i][1]-$val;
                        $val=$init_value;
                    }else $main_data[$i][1]=0;
                }
                unset($main_data[0]);
            }
            $daily_array['daily_values'] = $main_data;
        }

        $datas = MonthlyReading::where('customer_id', Auth::user()->id)->orderBy('id', 'DESC')->take(13)->get();
        if (count($datas) > 0) {
            $main_data=[];
            foreach ($datas as $data) {
                $good_date = date_format(date_create($data->year . "-" . $data->month ), "M Y");
                array_push($main_data, [$good_date, $data->units_used]);
            }
            if(count($main_data)>1){
                $main_data=array_reverse($main_data);
                $val=$main_data[0][1];
                for($i=1;$i<count($main_data);$i++){
                    if($main_data[$i][1]){
                        $init_value=$main_data[$i][1];
                        $main_data[$i][1]=$main_data[$i][1]-$val;
                        $val=$init_value;
                    }else $main_data[$i][1]=0;
                }
                unset($main_data[0]);
            }
            $daily_array['monthly_values'] = $main_data;
            //dd($daily_array);
        }

        return view('energy')->with($daily_array);
    }

    public function lastLogin() {
        // date_default_timezone_set("Africa/Lagos");
        // $user = Auth::user();
        // $user->last_login = date('d-m-Y | h:i:s A');
        // $user->save();
    }
}
