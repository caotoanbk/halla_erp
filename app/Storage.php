<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = ['material_id', 'area_id', 'StorageCurrentqty'];
}
