<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Cashgroup;

class ApprovalController extends Controller
{
    public function create($approvaltype)
    {
        return view('approval.'.$approvaltype.'-create');
    }

    public function getPurchaseConfigData()
    {
        $suppliers = Supplier::orderBy('created_at', 'desc')->get();
        $cashgroups = Cashgroup::orderBy('created_at', 'desc')->get();
        return collect(['suppliers' => $suppliers, 'cashgroups' => $cashgroups]);
    }
}
