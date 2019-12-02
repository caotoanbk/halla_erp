<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchaserequest extends Model
{
    protected $fillable = ['purchaseType', 'cashgroupId', 'numOfPayments', 'title', 
        'paymentDate', 'receiveDate', 'currency', 'purpose', 'supplierId', 'termOfPayment', 'paymentMethod', 'docNumber','KRW', 'userId', 'isSubmitted'
    ];

    //relationships
    public function items()
    {
        return $this->hasMany('App\Purchaseitem', 'purchaserequest_id');
    }

    public function lines()
    {
        return $this->hasMany('App\Linepurchase', 'purchaserequest_id');
    }

    public function files()
    {
        return $this->hasMany('App\PurchaseFile', 'purchaserequest_id');
    }

    public function cashgroup()
    {
        return $this->belongsTo('App\Cashgroup', 'cashgroupId');
    }

    public function getCashgroupNameAttribute()
    {
        $cashgroup = $this->cashgroup()->first();
        if($cashgroup){
            return $cashgroup->CashgroupName;
        }
        return '';
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier', 'supplierId');
    }

    public function getSupplierNameAttribute()
    {
        $supp = Supplier::find($this->supplierId);
        if($supp){
            return $supp->SupplierShortName;
        }
        return '';
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function getUserNameAttribute()
    {
        $user = $this->user()->first();
        if($user){
            return $user->UserName;
        }
        return ;
    }

    public function getTotalAmountAttribute()
    {
        $total = 0;
        foreach ($this->items()->get() as $item) {
            $total += $item->amount;
        }
        return $total;
    }
    public function getTotalAmountFormatAttribute()
    {
        return number_format($this->getTotalAmountAttribute(), 0);
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
    public function lineRejected()
    {
        $line = $this->lines()->where('status', 2)->first();
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
}