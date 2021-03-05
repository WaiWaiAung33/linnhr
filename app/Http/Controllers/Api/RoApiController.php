<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OfficeReporter;
use App\ROMember;
use Validator;


class RoApiController extends Controller
{
	public function ro_list(Request $request)
	{
		// dd($request->emp_id);
		$input = $request->all();
		  $rules=[
	        'emp_id'=>'required',
	    ];
	    $validator = Validator::make($input,$rules);
	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{
	        $ro = ROMember::where('member_id',$request->emp_id);
	        $ro = $ro->leftjoin('employee','employee.id','=','r_o_members.repoter_id')
	    							->select(
	    								'employee.name',
	    								'employee.photo',
	    							)->get();
	        return response(['message'=>"Success",'status'=>1,'ro'=>$ro]);
	       
	    }
	}
}