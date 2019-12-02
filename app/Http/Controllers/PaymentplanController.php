<?php

namespace App\Http\Controllers;

use App\Exrate;
use App\Linepayment;
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

    public function show($id)
    {
        $payment = Paymentplan::find($id);
        if(!$payment){
            return abort('404');
        }
        if(!$payment->is_submit){
            return 'Payment not submitted';
        }
        return view('approval.paymentplan.show', compact('id'));
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

    public function update(Request $request, $id)
    {
        $paymentplan = Paymentplan::find($id);
        if($paymentplan){
            if($paymentplan->is_submit){
                return abort('403');
            }
            $paymentplan->update($request->all());
            $paymentplan->lines()->delete();
            $lines = $request->get('lines');

            foreach ($lines as $key => $line) {
                if($line['user_id']){
                    $lp = new Linepayment();
                    $lp->paymentplan_id = $id;
                    $lp->user_id = $line['user_id'];
                    $lp->comment = '';    
                    if($paymentplan->is_submit && $key == 0){
                        $lp->status = 3;
                    }else{
                        $lp->status = 0;
                    }
                    $lp->save();
                }
            }
        }
    }

    public function getNewestRate()
    {
        $exrate = Exrate::orderBy('id', 'desc')->first();
        return $exrate;
    }

    public function updateLineComment($id, Request $request)
    {
        $line = Linepayment::find($id);
        if($line)
        {
            $request->merge(['action_date' => Carbon::now()]);
            $line->update($request->all());
        }
    }

}
