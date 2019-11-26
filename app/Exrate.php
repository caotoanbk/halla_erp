<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exrate extends Model
{
    protected $fillable = ['usd_krw', 'vnd_krw', 'usd_vnd'];
}
