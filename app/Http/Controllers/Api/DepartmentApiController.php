<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use DB;

class DepartmentApiController extends Controller
{
    public function department()
    {
        // $departments = Department::where('status',1)->get();
        $department = Department::with('employees')->get();
        $department = DB::table('department')
                     ->select('department.name', 'department.dept_color','department.in_time','department.out_time','department.created_at','department.updated_at','department.status',DB::raw('count(employee.id) as total'))
                     ->leftjoin('employee','employee.dep_id','department.id')
                     ->where('employee.name','!=','')
                     ->groupBy('dep_id')
                     ->get();
        $departments = $department->where('status',1);
        return response(['departments' => $departments,'message'=>"Successfully login",'status'=>1]);
    }
}
