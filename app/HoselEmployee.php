<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoselEmployee extends Model
{
    protected $table='hostel_employee';
    protected $fillable =['emp_id','hostel_id','room_id','start_date','full_address'];


    public function viewEmployee()
    {
    	return $this->hasOne('App\Employee','id','emp_id');
    }

     public function viewHostel()
    {
    	return $this->hasOne('App\Hostel','id','hostel_id');
    }

     public function viewRoom()
    {
    	return $this->hasOne('App\Room','id','room_id');
    }
}
