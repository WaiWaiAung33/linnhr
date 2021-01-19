<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table ='employee';
    protected $fillable =['emp_id','branch_id','dep_id','position_id','name','gender','father_name','phone_no','nrc_code','nrc_state','nrc_status','nrc','fullnrc','date_of_birth','join_date','address','city','township','qualification','salary','photo'];

    public function viewBranch()
    {
    	return $this->hasOne('App\Branch','id','branch_id');
    }

     public function viewDepartment()
    {
    	return $this->hasOne('App\Department','id','dep_id');
    }

       public function viewPosition()
    {
    	return $this->hasOne('App\Position','id','position_id');
    }

    public function viewCode()
    {
        return $this->hasOne('App\NRCCode','id','nrc_code');
    }
    
    public function viewState()
    {
        return $this->hasOne('App\NRCState','id','nrc_state');
    }

    public function viewSalary()
    {
        return $this->hasMany('App\Salary','emp_id');
    }
    
}
