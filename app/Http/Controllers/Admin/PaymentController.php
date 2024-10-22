<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    //payment list show data
    public function list(){
        $payments= Payment::orderBy('created_at', 'desc')->paginate(3);
        return view('admin.payment.list', compact('payments'));
    }

    //payment list
    public function create(Request $request){
        $this->paymentListValidation($request);
        $data= $this->paymentData($request);
        Payment::create($data);

        Alert::success('Payment Account', 'Payment Account had been created successfully');//alert message from sweetalert
        return back();

    }

    //payment data
    public function paymentData($request){
        return [
            'account_name'=> $request->accountName,
            'account_number'=> $request->accountNumber,
            'type'=> $request->accountType
        ];
    }

    //payment validation
    private function paymentListValidation($request){
        $request->validate([
            'accountName'=> 'required',
            'accountNumber'=> 'required|min:9|max:18|unique:payments,account_number,'.Auth::user()->id,
            'accountType'=> 'required'
        ]);
    }
}
