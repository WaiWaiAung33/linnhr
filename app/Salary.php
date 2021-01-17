<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salarys';
    protected $fillable = ['emp_id','pay_date','salary_amt','bonus'];
    public function viewEmployee()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }
}
