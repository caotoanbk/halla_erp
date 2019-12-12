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
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

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
        if($approvaltype != 'purchase')
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
        $users = User::all();
        $forcedLines = User::where('forced_line', true)->orderBy('sortIndex', 'asc')->get();
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
        $users = User::where('forced_line', null)->get();
        $forcedLines = User::where('forced_line', true)->orderBy('sortIndex', 'asc')->get();
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

        $suppliers = Supplier::all();
        $cashgroups = Cashgroup::all();
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
        $payment = Paymentplan::where('id', $id)->with('payment_bank_purchases')->with('lines')->get();
        $purchaseRequests = Purchaserequest::where('isSubmitted', true)->get()->each(function($item){
            $item->append('total_amount_format');
            $item->append('supplier_name');
        });
        $users = User::with('employee')->get();
        $banks = Bank::orderBy('BankName', 'desc')->get()->groupBy('BankName');
        $rate = Exrate::orderBy('created_at', 'desc')->first();

        return collect([
            'paymentplan' => $payment,
            'purchases' => $purchaseRequests,
            'banks' => $banks,
            'users' => $users,
            'exrate' => $rate
        ]);
    }

    public function getPaymentplanDataShow($id)
    {
        $payment = Paymentplan::where('id', $id)->with('payment_bank_purchases')->with('lines')->get();
        $users = User::with('employee')->get();
        $banks = Bank::orderBy('BankName', 'desc')->get()->groupBy('BankName');

        return collect([
            'paymentplan' => $payment,
            'banks' => $banks,
            'users' => $users
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

    public function purchaseDatatable()
    {
        $purchases = Purchaserequest::where('isSubmitted', true)->select();
        return Datatables::of($purchases)
        ->addColumn('category', function($value){
            return 'Purchase';
        })
        ->addColumn('group_name', function($model){
            return $model->cashgroup_name;
        })
        ->editColumn('title', function($model){
            return '<a href="/approval/purchase/show/'.$model->id.'">'.$model->title."</a>";
        })
        ->addColumn('user_name', function($model){
            return $model->user_name;
        })
        ->editColumn('created_at', function($model){
            return Carbon::parse($model->created_at)->format('d-M-Y');
        })
        ->addColumn('approved_date', function($model){
            return 'today';
        })
        ->addColumn('total_amount', function($model){
            return $model->total_amount;
        })
        ->addColumn('app', function($model){
            return '';
        })
        ->addColumn('status', function($model){
            return '';
        })
        ->rawColumns(['title'])
        ->make(true);
    }
}
