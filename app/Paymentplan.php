<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Paymentplan extends Model
{
    protected $fillable = ['user_id', 'docno', 'date_payment'];

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
}
