<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests; 
use App\History;
use Response;
use Session;
use Validator;
use Auth;

class PaymentHistoryController extends Controller
{
	public function __construct()
    {
        $this->payment_history	=	new History;
    }
	public function index()
    {
		if (Auth::user()->isAdmin != true) {
			return redirect('dashboard');
		}
		
		$payment_history	=	$this->payment_history->getAllPaymentHistory();
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{		
			return view('admin.payment_history', compact('payment_history'));
		}
		else
		{
            $page 		=	"payment_history";
            return view('admin.payment_history', compact('payment_history'));
			return view('layout', compact('page','payment_history'));
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
