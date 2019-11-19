<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchaserequest extends Model
{
    protected $fillable = ['purchaseType', 'cashgroupId', 'numOfPayments', 'title', 
        'paymentDate', 'receiveDate', 'currency', 'purpose', 'supplierId', 'termOfPayment', 'paymentMethod'
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
}