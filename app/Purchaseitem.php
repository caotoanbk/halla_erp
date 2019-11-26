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
        'amount',
        'mark'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
