<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PaymentTransaction;
use App\ApprovePayments;
use App\ApiDetails;
use App\User;
use Auth;

class PaymentsController extends Controller
{


    public function standardPay(Request $request) {

        $curl = curl_init();

        $name = $request->input('name');
        $email = $request->input('email');
        $amount = $request->input('amount');

        // url to go to after payment
        $callback_url = url("/topup/callback");

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'amount'=>$amount,
            'name' => $name,
            'email'=>$email,
            'callback_url' => $callback_url,
            'subaccount' => 'ACCT_dz6nsfv9rkcqx2v'
        ]),
        CURLOPT_HTTPHEADER => [
            "authorization: Bearer sk_test_5e909a0de247dd0cf337edcf5ede4cbf25122a08", //replace this with your own test key
            "content-type: application/json",
            "cache-control: no-cache"
        ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
        // there was an error contacting the Paystack API
        die('Curl returned error: ' . $err);
        }

        $tranx = json_decode($response, true);

        if(!$tranx['status']){
        // there was an error from the API
        print_r('API returned error: ' . $tranx['message']);
        }

        // comment out this line if you want to redirect the user to the payment page
        // print_r($tranx);

        // redirect to page so User can pay
        // uncomment this line to allow the user redirect to the payment page
        return redirect($tranx['data']['authorization_url']);

        header('Location: ' . $tranx['data']['authorization_url']);


    }

    public function callback() {
        $curl = curl_init();

        $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
        if(!$reference){
        die('No reference supplied');
        }

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "authorization: Bearer sk_test_5e909a0de247dd0cf337edcf5ede4cbf25122a08",
            "cache-control: no-cache"
        ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
            // there was an error contacting the Paystack API
        die('Curl returned error: ' . $err);
        }

        $tranx = json_decode($response);

        if(!$tranx->status){
        // there was an error from the API
        die('API returned error: ' . $tranx->message);
        }

        if('success' == $tranx->data->status){
        // transaction was successful...
        // please check other things like whether you already gave value for this ref
        // if the email matches the customer who owns the product etc
        // Give value

        // dd($tranx);

        $account_type = $tranx->data->authorization->card_type;
        $credit_amount = $tranx->data->amount/100 * 0.98;
        $transaction_status = $tranx->status;



        $transaction = new PaymentTransaction;
        $transaction->account_type = $account_type;
        $transaction->credit_amount = $credit_amount;
        $transaction->transaction_status = $transaction_status;
        $transaction->customer_id = Auth::user()->id;

        if ($transaction->save()) {

            $myAPI = ApiDetails::where('customer_id', Auth::user()->id)->first();
            $user = User::where('id', Auth::user()->id)->first();
            $meter = $user->meter_no;
            $email = $user->email;

            if ($myAPI->count() > 0) {


                $transaction = array(
                'company_name' => $myAPI->company_name,
                'user_name' => $myAPI->username,
                'password' => $myAPI->password,
                'password_vend' => $myAPI->vending_password,
                'meter_number' => $meter,
                'amount' => $credit_amount,
                'email' => $email,
                'id' => Auth::user()->id
            );

            $myPayment = new ApprovePayments;
            if ($myPayment->approvePayments($transaction)) {
                $success = 'Payment Successful!';
            }

            } else {
                $success = 'Payment Successful! API Details Not Set!';
            }

            return redirect('topup')->with('success', $success);
        }

        }
    }

    // public function test() {
    //     date_default_timezone_set("Africa/Lagos");
    //     $transaction = new PaymentTransaction;
    //     $transaction->account_type = 'VERVE';
    //     $transaction->credit_amount = 5000;
    //     $transaction->transaction_status = true;
    //     $transaction->customer_id = Auth::user()->id;
    //     $transaction->save();


    //     $myAPI = ApiDetails::where('customer_id', Auth::user()->id)->first();
    //         $user = User::where('id', Auth::user()->id)->first();
    //         $meter = $user->meter_no;
    //         $email = $user->email;

    //         if (count($myAPI) > 0) {
    //             $success = 'Payment Successful!';

    //             $transaction = array(
    //             'company_name' => 'Sunhive',
    //             'user_name' => 'POS1',
    //             'password' => 123456,
    //             'password_vend' => 123456,
    //             'meter_number' => $meter,
    //             'amount' => 5000,
    //             'email' => $email,
    //             'id' => Auth::user()->id
    //         );

    //         $myPayment = new ApprovePayments;
    //         if ($myPayment->approvePayments($transaction)) {
    //             $success = 'Payment Successful!';
    //         }

    //         } else {
    //             $success = 'Payment Successful! API Details Not Set!';
    //         }
    //         return redirect('topup')->with('success', $success);
    // }


}
