<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table='department';
    protected $fillable =['name','in_time','out_time'];


    public function employees(){
    	 return $this->hasMany('App\Employee','dep_id');
    }
}
