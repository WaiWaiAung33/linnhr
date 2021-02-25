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
            $attendance = DB::table('attendances')->where('emp_id',$request->emp_id)->get()->first();
            // dd($attendance->id);
            if ($attendance != null) {
                if ($attendance->clock_out != null) {
                return response(['message'=>"Success",'status'=>1,'attendance_id'=>$attendance->id,'timein_status'=>0,'time_in'=>$attendance->clock_in]);
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
	