<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests; 
use App\Transaction;
use Response;
use Session;
use Validator;
use Auth;

class PaymentTransactionController extends Controller
{
	public function __construct()
    {
        $this->payment_transactions	=	new Transaction;
    }
	public function index()
    {
		if (Auth::user()->isAdmin != true) {
			return redirect('dashboard');
		}
		
		$payment_transactions	=	$this->payment_transactions->getAllPaymentTransaction();
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{		
			return view('admin.payment_transactions', compact('payment_transactions'));
		}
		else
		{
            $page 		=	"payment_transactions";
            return view('admin.payment_transactions', compact('payment_transactions'));
			return view('layout', compact('page','payment_transactions'));
		}
    }

    public function create()
    {
		
	} 
	public function store(Request $request)
    {
		
    }
    public function show($id)
    {
		
    }
	
	public function edit($id)
    {
	}
	
	public function update(Request $request, $id)
    {
		
	}
}
