<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance;
use DB;
use Validator;
use App\Employee;


class TimeInApiController extends Controller
{
    public function attendance_list(Request $request)
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
                    $attendances = new Attendance();
                    $attendances = $attendances->leftjoin('employee','employee.id','=','attendances.emp_id')
                                    ->leftjoin('branch','branch.id','=','employee.branch_id')
                                    ->leftjoin('department','department.id','=','employee.dep_id')
                                    ->leftjoin('position','position.id','=','employee.position_id')
                                    ->select(
                                        'attendances.*',
                                        'employee.name',
                                        'employee.photo',
                                        'branch.name AS branch_name',
                                        'department.name AS dept_name',
                                        'position.name AS position_name'
                                    );
                    if ($request->date != '') {
                        $date = date('Y-m-d', strtotime($request->date));
                        $attendances = $attendances->whereDate('attendances.date',$date)->orwhereDate('attendances.out_date',$date);
                    }
                    if ($request->keyword != '') {
                        $attendances = $attendances->where('employee.name','like','%'.$request->keyword.'%');
                    }
                    if ($request->branch_id != '') {
                        $attendances = $attendances->where('employee.branch_id',$request->branch_id);
                    }
                    if ($request->dept_id != '') {
                        $attendances = $attendances->where('employee.dep_id',$request->dept_id);
                    }
                    if ($request->emp_id != null) {
                        $attendances = $attendances->where('attendances.emp_id',$request->emp_id);
                        $attendances = $attendances->orderBy('attendances.id','desc')->limit(10)->paginate(10);
                        
                    }else{
                        $attendances = $attendances->orderBy('attendances.id','desc')->limit(10)->paginate(10);
                    }
                    
                    return response(['message'=>"Success",'status'=>1,'attendances'=>$attendances]);
                }else{
                    $attendances = new Attendance();
                    $attendances = $attendances->leftjoin('employee','employee.id','=','attendances.emp_id')
                                    ->leftjoin('branch','branch.id','=','employee.branch_id')
                                    ->leftjoin('department','department.id','=','employee.dep_id')
                                    ->leftjoin('position','position.id','=','employee.position_id')
                                    ->select(
                                        'attendances.*',
                                        'employee.name',
                                        'employee.photo',
                                        'branch.name AS branch_name',
                                        'department.name AS dept_name',
                                        'position.name AS position_name'
                                    );
                    if ($request->date != '') {
                        $date = date('Y-m-d', strtotime($request->date));
                        $attendances = $attendances->whereBetween('attendances.date',$date)->orwhere('attendances.out_date',$date);
                    }
                    if ($request->keyword != '') {
                        $attendances = $attendances->where('employee.name','like','%'.$request->keyword.'%');
                    }
                    if ($request->branch_id != '') {
                        $attendances = $attendances->where('employee.branch_id',$request->branch_id);
                    }
                    if ($request->dept_id != '') {
                        $attendances = $attendances->where('employee.dep_id',$request->dept_id);
                    }
                    if ($request->emp_id != null) {
                        $attendances = $attendances->where('attendances.emp_id',$request->emp_id);
                        $attendances = $attendances->orderBy('attendances.id','desc')->get();
                        
                    }else{
                        $attendances = $attendances->orderBy('attendances.id','desc')->get();
                    }
                    
                    return response(['message'=>"Success",'status'=>1,'attendances'=>$attendances]);
                }
            }
    }

    public function time_in(Request $request)
    {
        $input = $request->all();
        $rules=[
            'clock_in'=>'required',
            'date'=>'required',
            'attendance_status'=>'required',
            'emp_id'=>'required',
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            $attendance = Attendance::create([
                'clock_in'=>$request->clock_in,
                'date'=>date('Y-m-d',strtotime($request->date)),
                'attendance_status'=>$request->attendance_status,
                'emp_id'=>$request->emp_id,
                
            ]);
            return response(['message'=>"Successfully create",'status'=>1]);
        }
    }

    public function check_in_out(Request $request)
    {
        $input = $request->all();
        $rules=[
            'emp_id'=>'required',
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Emp_id is null",'status'=>0]);
        }else{
            $attendance = DB::table('attendances')->where('emp_id',$request->emp_id)->latest()->first();
            // dd($attendance->id);
            if ($attendance != null) {
                if ($attendance->clock_out != null) {
                return response(['message'=>"Success",'status'=>1,'attendance_id'=>$attendance->id,'timein_status'=>0,'timein_date'=>$attendance->date,'time_in'=>$attendance->clock_in]);
            }else{
                return response(['message'=>"Success",'status'=>1,'attendance_id'=>$attendance->id,'timein_status'=>1,'timein_date'=>$attendance->date,'time_in'=>$attendance->clock_in]);
            }
            }else{
                return response(['message'=>"Success",'status'=>1,'timein_status'=>0]);
            }

        }
        
    }

    public function time_out(Request $request)
    {
        $input = $request->all();
        $rules=[
            'attendance_id'=>'required',
            'out_date'=>'required',
            'clock_out'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            $attendance = Attendance::find($request->attendance_id);
            $attendance = $attendance->update([
                'clock_out'=>$request->clock_out,
                'out_date'=>date('Y-m-d',strtotime($request->out_date))
            ]);
            return response(['message'=>"Success",'status'=>1]);
        }
    }

}
	