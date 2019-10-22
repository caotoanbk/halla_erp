<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materialtype extends Model
{
    protected $fillable = ['MaterialtypeName', 'MaterialtypeInformation', 'MaterialtypeRemark', 'MaterialtypeStatus'];
}
