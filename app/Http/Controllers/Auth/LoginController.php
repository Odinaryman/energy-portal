<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    //  protected function authenticated(Request $request, $user)
    //     {
    //     if (! $user ) {// do your magic here
    //         return redirect()->route('home');
    //     }

    //     return redirect('/dashboard');
    //     }

    protected $redirectTo = '/dashboard';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function authenticated(Request $request, $user)
    {
        date_default_timezone_set("Africa/Lagos");
        $user->update([
            'last_login' => date('d-m-Y | h:i:s A')
        ]);
    }

}
