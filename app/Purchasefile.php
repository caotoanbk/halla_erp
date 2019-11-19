<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchasefile extends Model
{
    protected $fillable = [
        'purchaserequest_id',
        'filename',
        'size',
    ];
}
