<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    protected $table = 'leave_applications';
    protected $fillable = ['emp_id','leavetype_id','halfDayType','last_updated_by','start_date','end_date','days','apply_date','reason','application_status'];

    public function employee()
    {
    	return $this->hasOne('App\Employee','id','emp_id');
    }
    public function leave_type()
    {
    	return $this->hasOne('App\LeaveType','id','leavetype_id');
    }

}
