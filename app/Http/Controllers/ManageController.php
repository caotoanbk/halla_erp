<?php

namespace App\Http\Controllers;

use App\Paymentplan;
use App\Purchaserequest;
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

    public function approvalHome(Request $request){
        $query = $request->get('q');
        $apps = Purchaserequest::where('isSubmitted', true)->orderBy('created_at', 'desc')->with('lines')->get();

        $total_user_receive = collect([]);
        $waiting_your_app = collect([]);
        $waiting_final_app = collect([]);
        $your_rejected_list = collect([]);
        $all_rejected_list = collect([]);
        $total_send_request = collect([]);
        $total_send_done = collect([]);
        $total_send_reject = collect([]);
        $total_send_waiting = collect([]);

        $total_payment_receive = collect([]);
        $payment_waiting_your_app = collect([]);
        $payment_waiting_final_app = collect([]);
        $your_payments = Paymentplan::where('user_id', auth()->id())->get();

        $payments = Paymentplan::where('is_submit', true)->orderBy('created_at', 'desc')->with('lines')->get();
        foreach($payments as $p) {
            /* total payment receive */
            if($p->checkContainLine(auth()->id())){
                $total_payment_receive->add($p);
            }
            /* waiting your app */
            if($p->currentLine() == auth()->id()){
                $payment_waiting_your_app->add($p);
            }

            /* waiting final app*/
            if($p->checkContainLine(auth()->id())){
                if($p->isGettingFinalApproval()){
                    $payment_waiting_final_app->add($p);
                }
            }
        }
        $total_done = 0;
        $total_waiting = 0;
        $total_reject = 0;

        foreach ($apps as $value) {
            /* total user receive */
            if($value->checkContainLine(auth()->id())){
                $total_user_receive->add($value);
            }
            /* waiting your approval */
            if($value->currentLine() == auth()->id()){
                $waiting_your_app->prepend($value);
            }
            /* waiting final approval */
            if($value->checkContainLine(auth()->id())){
                if($value->isGettingFinalApproval()){
                    $waiting_final_app->add($value);
                }
            }
            /* your reject list */
            if($value->checkContainLine(auth()->id())){
                if($value->lineRejected() == auth()->id()){
                    $your_rejected_list->add($value);
                }
            }
            /* all rejected you can see */
            if($value->checkContainLine(auth()->id())){
                if($value->isRejected()){
                    $all_rejected_list->add($value);
                }
            }
            /* total sent request */
            if($value->userId == auth()->id()){
                $total_send_request->add($value);
                if($value->isApproved() == true){
                    $total_send_done->add($value);
                }else if($value->isRejected() == true){
                    $total_send_reject->add($value);
                }else{
                    $total_send_waiting->add($value);
                }
            }

            if($value->isApproved()){
                $total_done += 1;
            }else if($value->isRejected()){
                $total_reject += 1;
            }else{
                $total_waiting += 1;
            }
        }

        $not_submitted_reqs = Purchaserequest::where('isSubmitted', false)->where('userId', auth()->id())->get();

        session(['selectedFunc' => 'approval']);
        switch ($query) {
            case 'waiting_your_app':
                $items = $waiting_your_app;
                break;
            case 'waiting_final_app':
                $items = $waiting_final_app;
                break;
            case 'your_rejected_list':
                $items = $your_rejected_list;
                break;
            case 'app_sent':
                $items = $total_send_request;
                break;
            case 'app_sent_done':
                $items = $total_send_done;
                break;
            case 'app_sent_waiting':
                $items = $total_send_waiting;
                break;
            case 'app_sent_reject':
                $items = $total_send_reject;
                break;
            case 'not_submitted':
                $items = $not_submitted_reqs;
                break;
            default:
                $items = $total_user_receive;
                break;
        }
        return view('approval.home', compact('total_user_receive', 'waiting_your_app', 'waiting_final_app', 
        'your_rejected_list', 'all_rejected_list', 'total_send_request', 'total_send_done', 
        'total_send_waiting', 'total_send_reject', 'not_submitted_reqs', 'items', 'total_payment_receive', 'payment_waiting_your_app', 'payment_waiting_final_app', 'your_payments',
    'total_done', 'total_waiting', 'total_reject'));
    }

    public function approvalPaymentHome(Request $request){
        $query = $request->get('q');
        $apps = Purchaserequest::where('isSubmitted', true)->orderBy('created_at', 'desc')->with('lines')->get();

        $total_user_receive = collect([]);
        $waiting_your_app = collect([]);
        $waiting_final_app = collect([]);
        $your_rejected_list = collect([]);
        $all_rejected_list = collect([]);
        $total_send_request = collect([]);
        $total_send_done = collect([]);
        $total_send_reject = collect([]);
        $total_send_waiting = collect([]);

        $total_payment_receive = collect([]);
        $payment_waiting_your_app = collect([]);
        $payment_waiting_final_app = collect([]);
        $your_payments = Paymentplan::where('user_id', auth()->id())->get();

        $payments = Paymentplan::where('is_submit', true)->orderBy('created_at', 'desc')->with('lines')->get();
        foreach($payments as $p) {
            /* total payment receive */
            if($p->checkContainLine(auth()->id())){
                $total_payment_receive->add($p);
            }
            /* waiting your app */
            if($p->currentLine() == auth()->id()){
                $payment_waiting_your_app->add($p);
            }

            /* waiting final app*/
            if($p->checkContainLine(auth()->id())){
                if($p->isGettingFinalApproval()){
                    $payment_waiting_final_app->add($p);
                }
            }
        }
        $total_done = 0;
        $total_waiting = 0;
        $total_reject = 0;

        foreach ($apps as $value) {
            /* total user receive */
            if($value->checkContainLine(auth()->id())){
                $total_user_receive->add($value);
            }
            /* waiting your approval */
            if($value->currentLine() == auth()->id()){
                $waiting_your_app->prepend($value);
            }
            /* waiting final approval */
            if($value->checkContainLine(auth()->id())){
                if($value->isGettingFinalApproval()){
                    $waiting_final_app->add($value);
                }
            }
            /* your reject list */
            if($value->checkContainLine(auth()->id())){
                if($value->lineRejected() == auth()->id()){
                    $your_rejected_list->add($value);
                }
            }
            /* all rejected you can see */
            if($value->checkContainLine(auth()->id())){
                if($value->isRejected()){
                    $all_rejected_list->add($value);
                }
            }
            /* total sent request */
            if($value->userId == auth()->id()){
                $total_send_request->add($value);
                if($value->isApproved() == true){
                    $total_send_done->add($value);
                }else if($value->isRejected() == true){
                    $total_send_reject->add($value);
                }else{
                    $total_send_waiting->add($value);
                }
            }

            if($value->isApproved()){
                $total_done += 1;
            }else if($value->isRejected()){
                $total_reject += 1;
            }else{
                $total_waiting += 1;
            }
        }

        $not_submitted_reqs = Purchaserequest::where('isSubmitted', false)->where('userId', auth()->id())->get();

        session(['selectedFunc' => 'approval']);
        switch ($query) {
            case 'waiting_your_app':
                $items = $payment_waiting_your_app;
                break;
            case 'waiting_final_app':
                $items = $payment_waiting_final_app;
                break;
            case 'your_payments':
                $items = $your_payments;
                break;
            default:
                $items = $total_payment_receive;
                break;
        }
        return view('approval.payment_home', compact('total_user_receive', 'waiting_your_app', 'waiting_final_app', 
        'your_rejected_list', 'all_rejected_list', 'total_send_request', 'total_send_done', 
        'total_send_waiting', 'total_send_reject', 'not_submitted_reqs', 'items', 'total_payment_receive', 'payment_waiting_your_app', 'payment_waiting_final_app', 'your_payments', 'total_done', 'total_waiting', 'total_reject'));
    }

    public function search()
    {
        $apps = Purchaserequest::where('isSubmitted', true)->orderBy('created_at', 'desc')->with('lines')->get();

        $total_user_receive = collect([]);
        $waiting_your_app = collect([]);
        $waiting_final_app = collect([]);
        $your_rejected_list = collect([]);
        $all_rejected_list = collect([]);
        $total_send_request = collect([]);
        $total_send_done = collect([]);
        $total_send_reject = collect([]);
        $total_send_waiting = collect([]);

        $total_payment_receive = collect([]);
        $payment_waiting_your_app = collect([]);
        $payment_waiting_final_app = collect([]);
        $your_payments = Paymentplan::where('user_id', auth()->id())->get();

        $payments = Paymentplan::where('is_submit', true)->orderBy('created_at', 'desc')->with('lines')->get();
        foreach($payments as $p) {
            /* total payment receive */
            if($p->checkContainLine(auth()->id())){
                $total_payment_receive->add($p);
            }
            /* waiting your app */
            if($p->currentLine() == auth()->id()){
                $payment_waiting_your_app->add($p);
            }

            /* waiting final app*/
            if($p->checkContainLine(auth()->id())){
                if($p->isGettingFinalApproval()){
                    $payment_waiting_final_app->add($p);
                }
            }
        }
        $total_done = 0;
        $total_waiting = 0;
        $total_reject = 0;

        foreach ($apps as $value) {
            /* total user receive */
            if($value->checkContainLine(auth()->id())){
                $total_user_receive->add($value);
            }
            /* waiting your approval */
            if($value->currentLine() == auth()->id()){
                $waiting_your_app->prepend($value);
            }
            /* waiting final approval */
            if($value->checkContainLine(auth()->id())){
                if($value->isGettingFinalApproval()){
                    $waiting_final_app->add($value);
                }
            }
            /* your reject list */
            if($value->checkContainLine(auth()->id())){
                if($value->lineRejected() == auth()->id()){
                    $your_rejected_list->add($value);
                }
            }
            /* all rejected you can see */
            if($value->checkContainLine(auth()->id())){
                if($value->isRejected()){
                    $all_rejected_list->add($value);
                }
            }
            /* total sent request */
            if($value->userId == auth()->id()){
                $total_send_request->add($value);
                if($value->isApproved() == true){
                    $total_send_done->add($value);
                }else if($value->isRejected() == true){
                    $total_send_reject->add($value);
                }else{
                    $total_send_waiting->add($value);
                }
            }

            if($value->isApproved()){
                $total_done += 1;
            }else if($value->isRejected()){
                $total_reject += 1;
            }else{
                $total_waiting += 1;
            }
        }

        $not_submitted_reqs = Purchaserequest::where('isSubmitted', false)->where('userId', auth()->id())->get();

        session(['selectedFunc' => 'approval']);

        return view('approval.search', compact('total_user_receive', 'waiting_your_app', 'waiting_final_app', 
        'your_rejected_list', 'all_rejected_list', 'total_send_request', 'total_send_done', 
        'total_send_waiting', 'total_send_reject', 'not_submitted_reqs', 'total_payment_receive', 'payment_waiting_your_app', 'payment_waiting_final_app', 'your_payments', 'total_done', 'total_waiting', 'total_reject'));
    }

}
