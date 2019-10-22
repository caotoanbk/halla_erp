<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = [
        "DivisionName", "DivisionInfo", "DivisionStatus", "company_id"
    ];
}
