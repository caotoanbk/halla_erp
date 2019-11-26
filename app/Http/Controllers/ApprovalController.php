<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;
use App\Supplier;
use App\Cashgroup;
use App\Exrate;
use App\Material;
use App\PaymentBankPurchase;
use App\Paymentplan;
use App\User;
use App\Purchaserequest;

class ApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create($approvaltype)
    {
        if($approvaltype != 'purchase')
        {
            return abort('404');
        }
        return view('approval.'.$approvaltype.'-create');
    }

    public function update($approvaltype, $id)
    {
        if($approvaltype != 'purchase' && $approvaltype != 'paymentplan')
        {
            return abort('404');
        }
        if(!Purchaserequest::find($id))
            return abort('404');
        return view('approval.'.$approvaltype.'-update', compact('id'));
    }

    public function show($approvaltype, $id)
    {
        if($approvaltype != 'purchase' && $approvaltype != 'paymentplan')
        {
            return abort('404');
        }
        $purchase = Purchaserequest::find($id);
        if(!$purchase)
            return abort('404');
        if($purchase->isSubmitted == false)
            return 'Not submitted';
        return view('approval.'.$approvaltype.'-show', compact('id'));
    }

    public function print($approvaltype, $id)
    {
        if($approvaltype != 'purchase' && $approvaltype != 'paymentplan')
        {
            return abort('404');
        }
        $purchase = Purchaserequest::find($id);
        if(!$purchase)
            return abort('404');
        if($purchase->isSubmitted == false)
            return 'Not submitted';
        $purchase = Purchaserequest::where('id', $id)->with('items')->with('lines')->first();
        $supplier = Supplier::find($purchase->supplierId);
        // dd($purchase);
        return view('approval.'.$approvaltype.'-print', compact('purchase', 'supplier'));
    }

    public function getPurchaseConfigData()
    {
        $suppliers = Supplier::orderBy('created_at', 'desc')->get();
        $cashgroups = Cashgroup::orderBy('created_at', 'desc')->get();
        $materials = Material::orderBy('MaterialName', 'asc')->get();
        $users = User::with('employee')->get();
        $forcedLines = User::where('forced_line', true)->orderBy('sortIndex', 'asc')->with('employee')->get();
        return collect([
            'suppliers' => $suppliers, 
            'cashgroups' => $cashgroups, 
            'materials' => $materials, 
            'users' => $users,
            'forcedLines' => $forcedLines
        ]);
    }

    public function getPurchaseData($id)
    {
        $purchase = Purchaserequest::where('id', $id)->with('items')->with('lines')->with('files')->get();

        $suppliers = Supplier::orderBy('created_at', 'desc')->get();
        $cashgroups = Cashgroup::orderBy('created_at', 'desc')->get();
        $materials = Material::orderBy('MaterialName', 'asc')->get();
        $users = User::where('forced_line', null)->with('employee')->get();
        $forcedLines = User::where('forced_line', true)->orderBy('sortIndex', 'asc')->with('employee')->get();
        return collect([
            'suppliers' => $suppliers, 
            'cashgroups' => $cashgroups, 
            'materials' => $materials, 
            'users' => $users,
            'forcedLines' => $forcedLines,
            'curPur' => $purchase
        ]);
    }

    public function getPurchaseShowData($id)
    {
        $purchase = Purchaserequest::where('id', $id)->with('items')->with('lines')->with('files')->get();

        $suppliers = Supplier::orderBy('created_at', 'desc')->get();
        $cashgroups = Cashgroup::orderBy('created_at', 'desc')->get();
        // $materials = Material::orderBy('MaterialName', 'asc')->get();
        $users = User::with('employee')->get();

        return collect([
            'suppliers' => $suppliers, 
            'cashgroups' => $cashgroups, 
            // 'materials' => $materials, 
            'users' => $users,
            'curPur' => $purchase
        ]);
    }

    public function getPaymentplanData($id)
    {
        $payment = Paymentplan::where('id', $id)->with('payment_bank_purchases')->get();
        $purchaseRequests = Purchaserequest::where('isSubmitted', true)->get()->each(function($item){
            $item->append('total_amount_format');
            $item->append('supplier_name');
        });
        $banks = Bank::orderBy('BankName', 'desc')->get()->groupBy('BankName');
        $rate = Exrate::orderBy('created_at', 'desc')->first();

        return collect([
            'paymentplan' => $payment,
            'purchases' => $purchaseRequests,
            'banks' => $banks,
            'exrate' => $rate
        ]);
    }

    public function deletePurchaseBankPayment($id)
    {
        $record = PaymentBankPurchase::find($id);
        $payment_id = $record->paymentplan_id;
        if($record){
            $record->delete();
        }
        $payment = Paymentplan::where('id', $payment_id)->with('payment_bank_purchases')->get();
        return collect([
            'paymentplan' => $payment
        ]);
    }

    public function addBankToPayment($payment_id, $bank_id, Request $request)
    {
        $purchaserequestIds = $request->get('data');
        foreach ($purchaserequestIds as $id) {
            PaymentBankPurchase::create([
                'paymentplan_id' => $payment_id,
                'purchaserequest_id' => $id,
                'bank_id' => $bank_id
            ]);
        }
        $payment = Paymentplan::where('id', $payment_id)->with('payment_bank_purchases')->get();
        return collect([
            'paymentplan' => $payment
        ]);
    }

    public function exRate()
    {
        $rates = Exrate::orderBy('created_at', 'desc')->paginate(10);
        return view('approval.exrate', compact('rates'));
    }

    public function storeExrate(Request $request)
    {

        $usd_krw = $request->get('usd_krw');
        $vnd_krw = $request->get('vnd_krw');
        $usd_vnd = round((100/$vnd_krw)*$usd_krw,2);

        Exrate::create([
            'usd_krw' => $usd_krw,
            'vnd_krw' => $vnd_krw,
            'usd_vnd' => $usd_vnd
        ]);
        session()->flash('status', 'ExRate created!');
        return redirect()->route('approval.exrate');
    }
}
