<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Cashgroup;
use App\Material;
use App\User;
use App\Purchaserequest;

class ApprovalController extends Controller
{
    public function create($approvaltype)
    {
        return view('approval.'.$approvaltype.'-create');
    }

    public function update($approvaltype, $id)
    {
        if(!Purchaserequest::find($id))
            return abort('404');
        return view('approval.'.$approvaltype.'-update', compact('id'));
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
}
