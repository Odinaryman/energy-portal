<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Alarm;
use Auth;
use DB;
use App\User;


class AlarmsController extends Controller
{
    public function __construct()
    {
        $this->alarms	=	new Alarm;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin != true) {
			return redirect('dashboard');
        }

        $alarms	=	$this->alarms->getAllAlarms(Auth::user()->id);
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return view('alarms', compact('alarms'));
		}
		else
		{
            return view('admin.alarms', compact('alarms'));
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first' => 'required',
            'second' => 'required'
        ]);

        if(Alarm::where('customer_id', Auth::user()->id)->count() < 1) {
            //Insert alarms trigger into alarms table
            $alarm = new Alarm;
            $alarm->customer_id = Auth::user()->id;
            $alarm->trigger_unit_1 = $request->input('first');
            $alarm->trigger_unit_2 = $request->input('second');
            $alarm->trigger_1_status = false;
            $alarm->trigger_2_status = false;

            if ($alarm->save()) {
                $success = 'Energy Alarm Set!';

                return redirect('account')->with('success', $success);
            }

        } else {
            $alarm = Alarm::where('customer_id', Auth::user()->id)->first();
            $alarm->trigger_unit_1 = $request->input('first');
            $alarm->trigger_unit_2 = $request->input('second');
            $alarm->trigger_1_status = false;
            $alarm->trigger_2_status = false;

            if ($alarm->save()) {
                $success = 'Energy Alarm Updated!';

                return redirect('account')->with('success', $success);
            }
        }
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
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $user->name=$request->input('name');
        $user->phone=$request->input('phone');
        $user->address=$request->input('address');
        //dd($user);
        if($user->save()) {
            $success = 'Your account update was successful!';
            return redirect('account')->with('success', $success);
        }

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
