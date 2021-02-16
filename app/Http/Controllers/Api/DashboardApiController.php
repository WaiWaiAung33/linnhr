<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Branch;
use App\Position;
use Carbon\Carbon;
use DB;

class DashboardApiController extends Controller
{
    public function dashboard()
    {
        $total_employees = Employee::count();
        $total_branches = Branch::count();
        $total_departments = Department::count();

        $branches = Branch::with('employees')->get();
        $branches = DB::table('branch')
                     ->select('branch.name','branch.id','branch.branch_color',DB::raw('count(employee.id) as total'))
                     ->leftjoin('employee','employee.branch_id','branch.id')
                     ->where('employee.name','!=','')
                     ->groupBy('branch_id')
                     ->get();

        $department = Department::with('employees')->get();
        $department = DB::table('department')
                     ->select('department.name','department.id','department.dept_color',DB::raw('count(employee.id) as total'))
                     ->leftjoin('employee','employee.dep_id','department.id')
                     ->where('employee.name','!=','')
                     ->groupBy('dep_id')
                     ->get();
        $maleTotal = Employee::where('gender','Male')->count();
        $femaleTotal = Employee::where('gender','Female')->count();
        $positions = Position::all();
        return response(['employee' => ['male'=>$maleTotal,'female'=>$femaleTotal],'branch'=>$branches,'department'=>$department,'positions'=>$positions,'message'=>"Successfully login",'status'=>1]);
    }
}
