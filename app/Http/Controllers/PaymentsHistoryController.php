<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentHistory;
use Auth;

class PaymentsHistoryController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = PaymentHistory::where('customer_id', Auth::user()->id)->orderBy('id', 'DESC')->take(20)->get();

        return view('history')->with('payments', $payments);
    }


    public function filter(Request $request) {

        // $this->validate($request, [
        //     'from' => 'required',
        //     'to' => 'required'
        // ]);

        $inputs = [];
        if (empty($request->input('from')) || empty($request->input('to')) ) {
            return redirect('/paymentHistory');
        } else {
            array_push($inputs, $request->input('from'), $request->input('to'));
        }
        dd($inputs);
        $payments = PaymentHistory::whereBetween('created_at', [$inputs[0], $inputs[1]])->where('customer_id', Auth::user()->id)->get();


            $inputs[1] = strval($inputs[1]);
            $inputs[1] = strtotime("-1 day", strtotime($inputs[1]));
            $inputs[1] = date('Y-m-d', $inputs[1]);

            $data = [
                'payments' => $payments,
                'from' => $inputs[0],
                'to' => $inputs[1]
            ];

            return view('history')->with($data);

            // $history = new PaymentHistory;
            // $history->title = $request->input('from');
            // $history->body = $request->input('to');
            // $history->save();


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
