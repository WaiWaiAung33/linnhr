<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Employee;
use DB;
use Validator;

class DepartmentApiController extends Controller
{
    public function department()
    {
        // $departments = Department::where('status',1)->get();
        // $department = Department::with('employees')->get();
        // $department = DB::table('department')
        //              ->select('department.id','department.name', 'department.dept_color','department.in_time','department.out_time','department.created_at','department.updated_at','department.status',DB::raw('count(employee.id) as total'))
        //              ->leftjoin('employee','employee.dep_id','department.id')
        //              ->groupBy('dep_id')
        //              ->get();
        // $departments = $department->where('status',1);
        $departments = new Department();
        $departments = $departments->where('status',1)->orderBy('id','asc')->get();
        $departmentlist = [];
            foreach ($departments as $department) { 
                $department->total= $this->getEmpCount($department->id);
                // dd($car);
                array_push($departmentlist, $department);
            }

        return response(['departments' => $departments,'message'=>"Successfully login",'status'=>1]);
    }

    public function department_create(Request $request)
    {
        $input = $request->all();
        $rules=[
            'dept_name'=>'required',
            'color_code'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            $department = Department::create([
                'name'=>$request->dept_name,
                'color_code'=>$request->color_code,
                'status'=>1
            ]);
        return response(['message'=>"Successfully create",'status'=>1]);
        }
    }

    public function department_edit($id,Request $request)
    {
        $input = $request->all();
        $rules=[
            'dept_name'=>'required',
            'color_code'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            $department = Department::find($id);
            $department = $department->update([
                'name'=>$request->dept_name,
                'color_code'=>$request->color_code,
            ]);
            return response(['message'=>"Successfully update",'status'=>1]);
        }
    }

    public function department_delete($id)
    {
        $department = Department::find($id);
        if ($department != null) {
            $department = $department->delete();
            return response(['message'=>"Successfully delete",'status'=>1]);
        }else{
            return response(['message'=>"Delete id does not exit!!!",'status'=>0]);
        }
    }

    public function department_activeInactive($id,Request $request)
    {
        $input = $request->all();
        $rules=[
            'status'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Status Required",'status'=>0]);
        }else{
            $department = Department::find($id);
            $department = $department->update([
                'status'=>$request->status
            ]);
            return response(['message'=>"Successfully",'status'=>1]);
        }
    }

    public function getEmpCount($id)
    {
        $employee_count = Employee::where('dep_id',$id)->get();
        $count = $employee_count->count();
        return $count;
    }
}
