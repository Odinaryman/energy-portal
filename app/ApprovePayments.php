<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use App\PaymentHistory;

class ApprovePayments extends Model
{
    public function approvePayments($transaction) {

		$meter_array	=	array();

		$company_name	= 	$transaction['company_name'];
		$user_name	= 	$transaction['user_name'];
		$password	= 	$transaction['password'];
		$password_vend	= 	$transaction['password_vend'];
		$meter_no	= 	$transaction['meter_number'];
		$amount	= 	$transaction['amount'];

		$url			=	'https://prepayment.calinhost.com/api/POS_Purchase';
		$payment	= array(
									"company_name"	=> $company_name,
									"user_name"		=> $user_name,
									"password" 		=> $password,
									"password_vend" => $password_vend,
									"meter_number" => $meter_no,
									"is_vend_by_unit" => false,
									"amount" => $amount
									);

		$data_string = json_encode($payment);
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
			$meter_array['cURL Error'][$transaction['id']]	=	$transaction['email'];
			//echo "cURL Error #:" . $err;
		}
		else
		{


			$data	=	json_decode($response,true);
			//$meter_array['API response']	=	$data;
			if(isset($data['reason']) && $data['reason'] == 'OK')
			{
				$result=$data['result'];
				if(!empty($result) && $result['meter_number'] > 0)
				{

					$token = $result['token'];
					$total_paid = $result['total_paid'];
					$total_unit	= $result['total_unit'];
					$price 	= $result['price'];
					$vat = $result['vat'];
					$currency =	$result['currency'];
					$unit =	$result['unit'];

					date_default_timezone_set("Africa/Lagos");
					$history = new PaymentHistory;
					$history->customer_id = $transaction['id'];
					$history->token = $token;
					$history->price = $price;
					$history->vat = $vat;
					$history->currency = $currency;
					$history->unit = $unit;
					$history->paid_amount = $total_paid;
					$history->paid_unit = $total_unit;
					$history->payment_method=$transaction['payment_method'];
					$history->save();

					// DB::table('payment_histories')->insert($insert_array);
					$meter_array['Payment History Inserted'][$transaction['id']]	=	$transaction['email'];
					return true;

				}
				else
				{
					$meter_array['API Response'][$transaction['id']]	=	$data;
				}
			} else {
				return false;
			}
		}
		//print_r($meter_array);
		//return array("status"=>"success","messge"=>"",'response'=>$meter_array);

    }
}
