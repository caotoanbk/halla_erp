<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accesslist extends Model
{
    protected $fillable= ['user_id', 'subpage_id', 'accesstext_id'];
}
