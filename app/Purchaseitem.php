<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchaseitem extends Model
{
    protected $fillable = [
        'purchaserequest_id',
        'MaterialName',
        'unit',
        'quantity',
        'unp',
        'amount'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
