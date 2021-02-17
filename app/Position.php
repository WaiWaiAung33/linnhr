<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
     protected $table='position';
    protected $fillable =['name'];

     public function employees(){
    	 return $this->hasMany('App\Employee','position_id');
    }
}
