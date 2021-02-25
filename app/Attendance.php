<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = ['emp_id','clock_in','clock_out','date','out_date','attendance_status','clockin_ip_address','colckout_ip_address','working_from','note','is_late'];

    public function employee()
    {
    	return $this->hasOne('App\Employee','id','emp_id');
    }
}
