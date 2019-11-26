<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentBankPurchase extends Model
{
    protected $fillable = ['paymentplan_id', 'purchaserequest_id', 'bank_id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['bank_name', 'bank_account', 'supplier_name', 'amount', 'purchase_docno', 'purchase_title'];

    public function getBankNameAttribute()
    {
        return $this->bank()->first()->BankName;
    }
    public function getBankAccountAttribute()
    {
        return $this->bank()->first()->BankAccount;
    }
    public function getSupplierNameAttribute()
    {
        return $this->purchaserequest()->first()->supplier_name;
    }
    public function getAmountAttribute()
    {
        return $this->purchaserequest()->first()->total_amount;
    }
    public function getPurchaseDocnoAttribute()
    {
        return $this->purchaserequest()->first()->docNumber;
    }
    public function getPurchaseTitleAttribute()
    {
        return $this->purchaserequest()->first()->title;
    }
    public function purchaserequest()
    {
        return $this->belongsTo('App\Purchaserequest', 'purchaserequest_id');
    }

    public function paymentplan()
    {
        return $this->belongsTo('App\Paymentplan', 'paymentplan_id');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank', 'bank_id');
    }
}
