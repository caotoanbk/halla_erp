<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = ['PartName', 'PartInformation', 'team_id', 'PartStatus'];
}
