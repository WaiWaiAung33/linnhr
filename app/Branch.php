<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table='branch';
    protected $fillable =['name','latitude','longitude'];

    public function employees(){
    	 return $this->hasMany('App\Employee','branch_id');
    }
}
