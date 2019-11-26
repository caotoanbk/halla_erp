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
}