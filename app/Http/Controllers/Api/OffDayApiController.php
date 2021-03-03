<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Offday;
use DB;
use Validator;
use App\Employee;


class OffDayApiController extends Controller
{
	public function offday_list(Request $request)
	{
		$input = $request->all();
	     $rules=[
	        'page'=>'required',
	        'off_date'=>'required'
	    ];

	    $validator = Validator::make($input, $rules);

	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{
	    	if ($request->page != 0) {
	    		$offdays = new Offday();
	    		$offdays = $offdays->leftjoin('employee','employee.id','=','offday.emp_id')
	    							->leftjoin('branch','branch.id','=','employee.branch_id')
	    							->leftjoin('department','department.id','=','employee.dep_id')
	    							->select(
	    								'offday.*',
	    								'employee.name',
	    								'employee.photo',
	    								'branch.name AS branch_name',
	    								'department.name AS dept_name'
	    							);
	    		// dd($offdays);
	    		if ($request->keyword != '') {
		            $offdays = $offdays->where('employee.name','like','%'.$request->keyword.'%');
		        }
		        if ($request->branch_id != '') {
		            $offdays = $offdays->where('employee.branch_id',$request->branch_id);
		        }
		        if ($request->dept_id != '') {
		            $offdays = $offdays->where('employee.dep_id',$request->dept_id);
		        }

		        if ($request->off_date) {
		        	$offdays = $offdays->where('off_day_1',date('Y-m-d',strtotime($request->off_date)))->orwhere('off_day_2',date('Y-m-d',strtotime($request->off_date)))->orwhere('off_day_3',date('Y-m-d',strtotime($request->off_date)))->orwhere('off_day_4',date('Y-m-d',strtotime($request->off_date)));
		        }
		       
		        $offdays = $offdays->orderBy('offday.id','asc')->limit(10)->paginate(10);

		        return response(['message'=>"Success",'status'=>1,'offdays'=>$offdays]);
	    	}else{
	    		$offdays = new Offday();
	    		$offdays = $offdays->leftjoin('employee','employee.id','=','offday.emp_id')
	    							->leftjoin('branch','branch.id','=','employee.branch_id')
	    							->leftjoin('department','department.id','=','employee.dep_id')
	    							->select(
	    								'offday.*',
	    								'employee.name',
	    								'employee.photo',
	    								'branch.name AS branch_name',
	    								'department.name AS dept_name'
	    							);
	    		// dd($offdays);
	    		if ($request->keyword != '') {
		            $offdays = $offdays->where('employee.name','like','%'.$request->keyword.'%');
		        }
		        if ($request->branch_id != '') {
		            $offdays = $offdays->where('employee.branch_id',$request->branch_id);
		        }
		        if ($request->dept_id != '') {
		            $offdays = $offdays->where('employee.dep_id',$request->dept_id);
		        }
		        if ($request->off_date) {
		        	$offdays = $offdays->where('off_day_1',date('Y-m-d',strtotime($request->off_date)))->orwhere('off_day_2',date('Y-m-d',strtotime($request->off_date)))->orwhere('off_day_3',date('Y-m-d',strtotime($request->off_date)))->orwhere('off_day_4',date('Y-m-d',strtotime($request->off_date)));
		        }
		       
		        $offdays = $offdays->orderBy('attendances.id','asc')->get();

		        return response(['message'=>"Success",'status'=>1,'offdays'=>$offdays]);
	    	}
	    }
	}

	public function emp_off_day(Request $request)
	{
		$input = $request->all();
	     $rules=[
	        'emp_id'=>'required',
	        'month'=>'required',
	        'year'=>'required'
	    ];

	    $validator = Validator::make($input, $rules);

	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{

	    	$off_days = new Offday();
	    	$off_days = $off_days->where('emp_id',$request->emp_id);
	    	
	    	if ($off_days->get()->count() >0) {
	    		
	    		$off_days = $off_days->whereYear('off_day_1', '=', $request->year)
					              ->whereMonth('off_day_1', '=', $request->month);

	    		$off_days = $off_days->get();
	    		return response(['message'=>"Success",'status'=>1,'off_days'=>$off_days]);
	    	}else{
	    		return response(['message'=>"No Offday",'status'=>1]);
	    	}

	    }
	}
}