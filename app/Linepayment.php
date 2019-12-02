<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linepayment extends Model
{
    protected $fillable = ['user_id', 'type', 'comment', 'status', 'paymentplan_id', 'action_date'];
}
