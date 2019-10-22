<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subpage extends Model
{
    protected $fillable = ['SubpageName', 'SubpageInformation', 'SubpageStatus'];
}
