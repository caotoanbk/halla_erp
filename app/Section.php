<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['SectionId', 'SectionName', 'SectionInformation', 'team_id', 'SectionStatus'];
}
