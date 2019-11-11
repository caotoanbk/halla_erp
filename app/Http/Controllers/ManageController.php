<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ManageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function adminHome(){
        session(['selectedFunc' => 'admin']);
        return view('admin.home');
    }

    public function materialHome(){
        session(['selectedFunc' => 'material']);
        return view('material.home');
    }

    public function approvalHome(){
        session(['selectedFunc' => 'approval']);
        return view('approval.home');
    }

}
