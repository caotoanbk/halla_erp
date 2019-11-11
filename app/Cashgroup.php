<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashgroup extends Model
{
    protected $fillable = ['CashgroupCode', 'CashgroupName', 'CashgroupSecondname', 'CashgroupUnit', 'CashgroupFrequency', 'CashgroupBudget'];
}
