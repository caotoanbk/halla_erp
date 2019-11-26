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
        'comment',
        'action_date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function purchaseRequest()
    {
        return $this->belongsTo('App\Purchaserequest', 'purchaserequest_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'user_id');
    }
}
