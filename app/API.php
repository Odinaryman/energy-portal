<?php
namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Alarm;

class API extends Model
{

	public static function getUserDailyData()
    {
		$customers	=	DB::table('users')->get();
        //dd($customers);die();
		if(!$customers->isEmpty())
		{
            $meter_array	=	array();
			foreach($customers as $customer)
			{
				$customer_id	=	$customer->id;
                if($customer->id==1)continue;
                if(!isset($customer->meter_no) || empty($customer->meter_no))continue;
				if($customer_id > 1)
				{

                    $dates_unread=array();
                    //dd(gettype($customer->dates_unread));
                    if(isset($customer->dates_unread) && $customer->dates_unread!='')$dates_unread=unserialize($customer->dates_unread);

					$meter_no	=	$customer->meter_no;

					//$meter_array['Meter available'][$customer_id]	=	$customer->email;
					$customer_api_details	=	DB::table('api_details')->where('customer_id',$customer_id)->first();
					if(!empty($customer_api_details))
					{
					    $date1=date_create(date("Y-m-d",strtotime("yesterday")));
                        //$date1=date_create(date("Y-m-d",strtotime($real)));
                        $date2=date_format($date1,"Y/m/d");
                        if(!isset($customer->dates_unread) || $customer->dates_unread==''){
                            array_push($dates_unread,$date2);

                        }else{
                            if(!in_array($date2, $dates_unread))array_push($dates_unread,$date2);
                        }
                        $num=0;
                        foreach($dates_unread as $unread_dates){
                            $checkCurlError=0;
                            $dat=(explode("/",$unread_dates));
                            $year=$dat[0];
                            $month=$dat[1];
                            $day=$dat[2];
                            $company_name	= 	$customer_api_details->company_name;
                            $username		= 	$customer_api_details->username;
                            $password 		= 	$customer_api_details->password;
                            $url			=	'https://prepayment.calinhost.com/api/COMM_DailyData';
                            $customer_array	= array(
                                "CompanyName"	=> $company_name,
                                "UserName"		=> $username,
                                "Password" 		=> $password
                            );
                            $customer_array['QueryList'][]	= array(
                                "MeterNo"		=>	$meter_no,
                                "Year"			=>	$year,
                                "Month"			=>	$month,
                                "Day"			=>	$day
                            );
                            $data_string = json_encode($customer_array);
                            // print_r($data_string);
                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
                            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                    'Content-Type: application/json',
                                    'Content-Length: ' . strlen($data_string))
                            );
                            curl_setopt($curl, CURLOPT_TIMEOUT, 5);
                            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
                            $response = curl_exec($curl);
                            $err = curl_error($curl);
                            curl_close($curl);
                            if ($err)
                            {
                                $checkCurlError=1;
                                $meter_array[$meter_no][$unread_dates]['cURL Error'][$customer_id]	=	$customer->email."//".$err;
                                //echo "cURL Error #:" . $err;
                            }
                            else
                            {
                                $data	=	json_decode($response,true);
                                //$meter_array['API response']	=	$data;
                                $reason	=	$data['Reason'];
                                if($reason == 'OK')
                                {
                                    $result_check=$data['Result'];
                                    $result	= $data['Result'][0];
                                    if(!isset($result['TotalUnitsCounter']))$result['TotalUnitsCounter']=0;

                                    if(!(isset($result_check))){
                                        $units_used	            =	0;
                                        $units_remaining		=	0;
                                        $meter_status			=	0;
                                        $rd_st                  =   0;
                                    }else{
                                        $units_used	            =	$result['TotalUnitsCounter'];
                                        $units_remaining		=	$result['CurrentCreditRegister'];
                                        $meter_status			=	$result['RelayStatus'];
                                        $year                   =   $result['Year'];
                                        $month                  =   $result['Month'];
                                        $day                    =   $result['Day'];
                                        $rd_st                  =   1;
                                        unset($dates_unread[$num]);
                                    }

                                    $daily_readings			=	DB::table('daily_readings')
                                        ->where('customer_id',$customer_id)
                                        ->where('day',$day)
                                        ->where('month',$month)
                                        ->where('year',$year)
                                        ->get()
                                        ->first();
                                    //dd($daily_readings);
                                    $insert_array	=	array("customer_id"=>$customer_id,"reading_status"=>$rd_st,"day"=>$day,"month"=>$month,"year"=>$year,"units_used"=>$units_used,"units_remaining"=>$units_remaining,"meter_status"=>$meter_status);
                                    if(empty($daily_readings))
                                    {
                                        //dd($insert_array);
                                        DB::table('daily_readings')->insert($insert_array);
                                        $meter_array[$meter_no][$unread_dates]['Daily Data Inserted'][$customer_id]	=	$customer->email;
                                    }
                                    else if(!$daily_readings->reading_status)
                                    {
                                        if($rd_st){
                                            $insert_array["reading_status"]=$rd_st;
                                            //dd($insert_array);
                                            DB::table('daily_readings')
                                                ->where('customer_id',$customer_id)
                                                ->where('day',$day)
                                                ->where('month',$month)
                                                ->where('year',$year)
                                                ->update($insert_array);
                                        }else $meter_array[$meter_no][$unread_dates]['Data already in table'][$customer_id]	=	$data;

                                    }else $meter_array[$meter_no][$unread_dates]['Data already in table'][$customer_id]	=	$data;

                                }
                            }
                            $num++;
                        }
					}
					else
					{
					    $meter_array[$meter_no]['API Details not available'][$customer_id]	=	$customer->email;
						continue;
					}

                    if(!count($dates_unread))$dates_unread=null;
                    else{
                        $ar=array_values($dates_unread);
                        $dates_unread=serialize($ar);
                    }
                    $ar=array('dates_unread' => $dates_unread);

                    //dd($ar);
                    DB::table('users')
                        ->where('id', $customer_id)
                        ->update($ar);
				}
			}
			return array("status"=>"success",'response'=>$meter_array);
		}
		else
		{
			return array("status"=>"failure","messge"=>"Customers not available in DB");
		}
	}

	public static function getUserMonthlyData()
    {
		$customers	=	DB::table('users')->get();
		//dd($customers);
		if(!$customers->isEmpty())
		{
            $meter_array	=	array();
			foreach($customers as $customer)
			{
                if($customer->id==1)continue;
                if(!isset($customer->meter_no) || empty($customer->meter_no))continue;
                $customer_id	=	$customer->id;
				if($customer_id > 0)
				{
					$meter_no	=	$customer->meter_no;
					if(empty($meter_no))
					{
						$meter_array[$meter_no]['Meter not available'][$customer_id]	=	$customer->email;
						continue;
					}
					else
					{
						//$meter_array['Meter available'][$customer_id]	=	$customer->email;
						$customer_api_details	=	DB::table('api_details')->where('customer_id',$customer_id)->first();
						if(!empty($customer_api_details))
						{
							$company_name	= 	$customer_api_details->company_name;
							$username		= 	$customer_api_details->username;
							$password 		= 	$customer_api_details->password;
							$customer_no	=	$customer_api_details->customer_no;
							$customer_name	=	$company_name;
							$url			=	'https://prepayment.calinhost.com/api/COMM_MonthlyData';

							$customer_array	= array(
														"CompanyName"	=> $company_name,
														"UserName"		=> $username,
														"Password" 		=> $password
														);
                            /*$year=date("Y",strtotime($real));
                            $month=date("m",strtotime($real));*/
                            $year=date("Y");
                            $month=date("m")-1;
                            if(!$month){
                                $month=12;
                                $year=$year-1;
                            }
							$customer_array['QueryList'][]	= array(
																"MeterNo"		=>	$meter_no,
																"Year"			=>	$year,
																"Month"			=>	$month
															);

							$data_string = json_encode($customer_array);
							// print_r($data_string);
							$curl = curl_init($url);
							curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
							curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
							curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($curl, CURLOPT_HTTPHEADER, array(
								'Content-Type: application/json',
								'Content-Length: ' . strlen($data_string))
							);
							curl_setopt($curl, CURLOPT_TIMEOUT, 5);
							curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
							$response = curl_exec($curl);
							$err = curl_error($curl);
							curl_close($curl);
							if ($err)
							{
								$meter_array[$meter_no]['cURL Error'][$customer_id]	=	$customer->email;
							  //echo "cURL Error #:" . $err;
							}
							else
							{
							 	$data	=	json_decode($response,true);
								//$meter_array['API response']	=	$data;
								$reason	=	$data['Reason'];
								if($reason == 'OK')
								{

                                    $result_check=$data['Result'];
                                    $result	= $data['Result'][0];
                                    //if(!isset($result['TotalUnitsCounter']))$result['TotalUnitsCounter']=0;

                                    if(!(isset($result_check))){
                                        $units_used	            =	0;
                                        $units_remaining		=	0;
                                        $month			        =	$month;
                                        $year                   =   $year;
                                    }else{
                                        $year					=	$result['Year'];
                                        $month					=	$result['Month'];
                                        $units_used	            =	$result['TotalUnitsCounter'];
                                        $units_remaining        =	$result['CurrentCreditRegister'];

                                    }
                                    $monthly_readings			=	DB::table('monthly_readings')
																		->where('customer_id',$customer_id)
																		->where('year',$year)
																		->where('month',$month)
																		->first();
									if(empty($monthly_readings))
									{

									    $insert_array	=	array("customer_id"=>$customer_id,"year"=>$year,"month"=>$month,"units_used"=>$units_used,"units_remaining"=>$units_remaining);
										DB::table('monthly_readings')->insert($insert_array);
										$meter_array[$meter_no]['Monthly Data Inserted'][$customer_id]	=	$customer->email;
									}
									else
									{
										$meter_array[$meter_no]['Data already in table'][$customer_id]	=	$data;
									}
								}
							}
						}
						else
						{
							$meter_array['API Details not available'][$customer_id]	=	$customer->email;
							continue;
						}
					}
				}
			}

			return array("status"=>"success","messge"=>"",'response'=>$meter_array);
		}
		else
		{
			return array("status"=>"failure","messge"=>"Customers not available in DB");
		}
	}

	public static function sendAlarm()
    {
        $daily_readings	=	DB::table('users')
                                ->join('alarms', 'alarms.customer_id', '=', 'users.id')
                                ->join('daily_readings', function($join) {
                                    $join->on('daily_readings.customer_id', '=', 'users.id')
                                    ->on('daily_readings.id', '=', DB::raw("(SELECT max(id) from daily_readings WHERE daily_readings.customer_id = users.id AND daily_readings.reading_status=1)"));
                                })->orderBy('daily_readings.id', 'DESC')->select('users.id','users.name', 'users.email', 'users.meter_no','daily_readings.units_used', 'alarms.trigger_unit_1', 'alarms.trigger_unit_2', 'alarms.trigger_1_status', 'alarms.trigger_2_status', 'units_remaining')
                                ->get();


        //dd($daily_readings);

		foreach($daily_readings as $daily_reading)
		{
            $user_id		=	$daily_reading->id;
			$name			=	$daily_reading->name;
			$email			=	$daily_reading->email;
			$meter_no		=	$daily_reading->meter_no;
			$units_left	=	$daily_reading->units_remaining;
			$trigger_unit_1	=	$daily_reading->trigger_unit_1;
            $trigger_unit_2	=	$daily_reading->trigger_unit_2;
            $trigger_1_status = $daily_reading->trigger_1_status;
            $trigger_2_status = $daily_reading->trigger_2_status;

            $to = $email;

            if($trigger_1_status == false && $units_left < $trigger_unit_1 ) {

				Mail::to($to)->send(new SendMail($name, $units_left,env('APP_URL')));
				if (Mail::failures()) {dd('here');} else {
                    DB::table('alarms')
                        ->where('customer_id', $user_id)
                        ->update(array('trigger_1_status' => true, 'trigger_unit_1'=>null));
				}
            }

            if($trigger_2_status == false && $units_left < $trigger_unit_2 ) {
				Mail::to($to)->send(new SendMail($name, $units_left));
                if (Mail::failures()) {} {
                    DB::table('alarms')
                        ->where('customer_id', $user_id)
                        ->update(array('trigger_2_status' => true, 'trigger_unit_2'=>null));
				}
            }
		}

    }
}
