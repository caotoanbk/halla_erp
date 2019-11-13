<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Cashgroup;
use App\Material;
use App\User;

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
        $materials = Material::orderBy('MaterialName', 'asc')->get();
        $users = User::with('employee')->get();
        $forcedLines = User::where('forced_line', true)->orderBy('sortIndex', 'asc')->pluck('id');
        return collect([
            'suppliers' => $suppliers, 
            'cashgroups' => $cashgroups, 
            'materials' => $materials, 
            'users' => $users,
            'forcedLines' => $forcedLines
        ]);
    }
}
