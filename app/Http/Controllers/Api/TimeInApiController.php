<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance;
use DB;
use Validator;
use App\Employee;


class BranchApiController extends Controller
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

}
	