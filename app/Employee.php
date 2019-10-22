<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['EmployeeName', 'EmployeeFirstName', 'EmployeeLastName', 'EmployeeInformation', 'section_id', 'EmployeeStatus', 'EmployeeEmail', 'EmployeeImage'];
}
