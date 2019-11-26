<?php

namespace App\Http\Controllers;

use App\Paymentplan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentplanController extends Controller
{
    public function store(Request $request)
    {
        $paymentPlan = new Paymentplan();
        $paymentPlan->date_payment = Carbon::now();
        $paymentPlan->user_id = Auth::id();
        $paymentPlan->docno = 'HEV-PAYPLAN-'.date('ym').'-'.$this->getNumberOfPaymentplan();
        $paymentPlan->save();
        $request->session()->flash('status', 'Payment plan created successfully!');
        return redirect()->route('paymentplan.index');
    }

    public function index()
    {
        $payments = Paymentplan::orderBy('created_at', 'desc')->paginate(10);
        return view('approval.paymentplan-create', compact('payments'));
    }

    public function edit($id)
    {
        if(!Paymentplan::find($id)){
            return abort('404');
        }
        return view('approval.paymentplan.edit', compact('id'));
    }

    public function getNumberOfPaymentplan()
    {
        $count = Paymentplan::count() + 1;
        if($count < 10)
            return '000'.$count;
        if($count >= 10 && $count < 100)
            return '00'.$count;
        if(count >= 100 && $count < 1000)
            return '0'.$count;
        return $count;
    }

}
