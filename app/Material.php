<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['MaterialName', 'MaterialInformation', 'materialtype_id', 'MaterialStatus'];
}
