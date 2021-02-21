<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = 'awards';
    protected $fillable = ['emp_id','award_name','gift','cash_price','month','year'];

    public function employee()
    {
    	return $this->hasOne('App\Employee','id','emp_id');
    }
}
