<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UserName', 'UserEmail', 'password', 'employee_id'
    ];

    protected $appends = ['employee_opt_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function getEmployeeOptNameAttribute()
    {
        $employee = $this->employee()->first();
        if($employee){
            return $employee->EmployeeName.' - '.$employee->EmployeeInformation;
        }
        return 'Not found user';
    }
    

}
