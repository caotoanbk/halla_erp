<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Paymentplan extends Model
{
    protected $fillable = ['user_id', 'docno', 'date_payment', 'usd_krw', 'vnd_krw', 'usd_vnd', 'is_submit'];

    public function getUserNameAttribute()
    {
        $user = User::find($this->user_id);
        if($user)
        {
            return $user->employee()->first()->EmployeeName;
        }
        return '';
    }

    public function payment_bank_purchases()
    {
        return $this->hasMany('App\PaymentBankPurchase', 'paymentplan_id');
    }

    public function lines()
    {
        return $this->hasMany('App\Linepayment', 'paymentplan_id');
    }

    public function isApproved()
    {
       $lines = $this->lines()->get();
       foreach ($lines as $line) {
            if($line->status != 1)
            {
                return false;
            }
       }
       return true;
    }

    public function isRejected()
    {
        $lines = $this->lines()->get();
       foreach ($lines as $line) {
            if($line->status == 2)
            {
                return true;
            }
       }
       return false;
    }

    public function currentLine()
    {
        $line = $this->lines()->where('status', 3)->first();
        if($line){
            return $line->user_id;
        }

    }
    public function isGettingFinalApproval()
    {
        $line = $this->lines()->orderBy('id', 'desc')->first();
        if($line){
            if($line->status == 3){
                return true;
            }
        }
        return false;
    }
    public function checkContainLine($user_id)
    {
        $lines = $this->lines()->where('status', '!=', 0)->pluck('user_id')->all();
        return in_array($user_id, $lines);
    }

    public function getNumberOfLinePassed()
    {
        return ($this->lines()->count() - $this->lines()->where('status', 0)->count());
    }
}
