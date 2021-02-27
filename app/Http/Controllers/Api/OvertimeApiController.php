<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use DB;
use Validator;
use App\Employee;
use App\Overtime;
use App\Department;


class OvertimeApiController extends Controller
{
	public function overtime_list(Request $request)
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
	    		$overtimes = new Overtime();
	    		$overtimes = $overtimes->leftjoin('employee','employee.id','=','overtime.emp_id')
	    								->leftjoin('branch','branch.id','=','employee.branch_id')
	    								->leftjoin('department','department.id','=','employee.dep_id')
	    								->select(
	    									'overtime.*',
	    									'employee.name',
	    									'branch.name AS branch_name',
	    									'department.name AS dept_name'
	    								);
	    		if ($request->keyword != '') {
		            $overtimes = $overtimes->where('employee.name','like','%'.$request->keyword.'%');
		        }
		        if ($request->branch_id != '') {
		            $overtimes = $overtimes->where('employee.branch_id',$request->branch_id);
		        }
		        if ($request->dept_id != '') {
		            $overtimes = $overtimes->where('employee.dep_id',$request->dept_id);
		        }
		       
		        $overtimes = $overtimes->orderBy('overtime.id','asc')->limit(10)->paginate(10);

		        return response(['message'=>"Success",'status'=>1,'overtimes'=>$overtimes]);
	    	}else{
	    		$overtimes = new Overtime();
	    		$overtimes = $overtimes->leftjoin('employee','employee.id','=','overtime.emp_id')
	    								->leftjoin('branch','branch.id','=','employee.branch_id')
	    								->leftjoin('department','department.id','=','employee.dep_id')
	    								->select(
	    									'overtime.*',
	    									'employee.name',
	    									'branch.name AS branch_name',
	    									'department.name AS dept_name'
	    								);
	    		if ($request->keyword != '') {
		            $overtimes = $overtimes->where('employee.name','like','%'.$request->keyword.'%');
		        }
		        if ($request->branch_id != '') {
		            $overtimes = $overtimes->where('employee.branch_id',$request->branch_id);
		        }
		        if ($request->dept_id != '') {
		            $overtimes = $overtimes->where('employee.dep_id',$request->dept_id);
		        }
		       
		        $overtimes = $overtimes->orderBy('attendances.id','asc')->get();

		        return response(['message'=>"Success",'status'=>1,'overtimes'=>$overtimes]);
	    	}
	    }
	}
}