<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use DB;
use Validator;
use App\Employee;


class LeaveApiController extends Controller
{
	public function leave_list(Request $request)
	{
		$input = $request->all();
	     $rules=[
	        'page'=>'required'
	    ];

	    $validator = Validator::make($input, $rules);

	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{
	    	if ($request->page != 0) {
	    		$leave_applications = new LeaveApplication();
	    		$leave_applications = $leave_applications->leftjoin('employee','employee.id','=','leave_applications.emp_id')
	                ->leftjoin('leave_types','leave_types.id','=','leave_applications.leavetype_id')
	                ->leftjoin('users','users.id','=','leave_applications.last_updated_by')
	                ->select(
	                    'leave_applications.*',
	                    'employee.name',
	                    'employee.photo',
	                    'leave_types.leave_type',
	                    'users.name'
	                );
	             if ($request->name != '') {
		            $leave_applications = $leave_applications->where('employee.name','like','%'.$request->name.'%');
		        }
		        if ($request->branch_id != '') {
		            $leave_applications = $leave_applications->where('employee.branch_id',$request->branch_id);
		        }
		        if ($request->dept_id != '') {
		            $leave_applications = $leave_applications->where('employee.dep_id',$request->dept_id);
		        }

		        $attendances = $attendances->orderBy('attendances.id','asc')->limit(10)->paginate(10);

		        return response(['message'=>"Success",'status'=>1,'attendances'=>$attendances]);
	    	}else{
	    		$leave_applications = new LeaveApplication();
	    		$leave_applications = $leave_applications->leftjoin('employee','employee.id','=','leave_applications.emp_id')
	                ->leftjoin('leave_types','leave_types.id','=','leave_applications.leavetype_id')
	                ->leftjoin('users','users.id','=','leave_applications.last_updated_by')
	                ->select(
	                    'leave_applications.*',
	                    'employee.name',
	                    'employee.photo',
	                    'leave_types.leave_type',
	                    'users.name'
	                );
	             if ($request->name != '') {
		            $leave_applications = $leave_applications->where('employee.name','like','%'.$request->name.'%');
		        }
		        if ($request->branch_id != '') {
		            $leave_applications = $leave_applications->where('employee.branch_id',$request->branch_id);
		        }
		        if ($request->dept_id != '') {
		            $leave_applications = $leave_applications->where('employee.dep_id',$request->dept_id);
		        }

		        $attendances = $attendances->orderBy('attendances.id','asc')->get();

		        return response(['message'=>"Success",'status'=>1,'attendances'=>$attendances]);
	    	}
	    }
	}
	
}	