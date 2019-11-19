<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linepurchase extends Model
{
    protected $fillable = [
        'purchaserequest_id',
        'user_id',
        'type',
        'status',
        'comment'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
