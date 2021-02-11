<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Branch;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_employees = Employee::count();
        $total_branches = Branch::count();
        $total_departments = Department::count();

        // $new_empoyee = Employee::WhereRaw('(DATEDIFF(employee.join_date, NOW())>10)')->get();

        $dateS = Carbon::now()->startOfMonth()->subMonth(3);
        $dateE = Carbon::now()->startOfMonth(); 
        $new_empoyee = Employee::whereBetween('join_date',[$dateS,$dateE])->get()->count();

        //get employee count by dept
        $dept_employees = Department::with('employees')->get();

        $deptArr =[];
        $deptEmpArr =[];

        $malecount = 0;
        $femalecount = 0;
        $deptMaleArr = [];
        $deptFemaleArr = [];


        foreach ($dept_employees as $key => $dep) {
            array_push($deptArr, $dep->name);
            array_push($deptEmpArr, $dep->employees()->count());
        }

        $maleTotal = Employee::where('gender','Male')->count();
        $femaleTotal = Employee::where('gender','Female')->count();



        $deptMaleArr = DB::table('department')
                             ->select('department.name', DB::raw('count(employee.id) as mtotal'))
                             ->leftjoin('employee','employee.dep_id','department.id')
                             ->where('employee.gender','Male')
                             ->groupBy('dep_id')
                             ->get();

        $deptfeMaleArr = DB::table('department')
                             ->select('department.name', DB::raw('count(employee.id) as fmtotal'))
                             ->leftjoin('employee','employee.dep_id','department.id')
                             ->where('employee.gender','Female')
                             ->groupBy('dep_id')
                             ->get();


        $branchArr =[];
        $branchEmpArr =[];

        $branchs = Branch::with('employees')->get();

        foreach ($branchs as $key => $branch) {
            array_push($branchArr, $branch->name);
            array_push($branchEmpArr, $branch->employees()->count());
        }


        $hostelNotStay = Employee::whereNull('hostel')->count();
        $hostelStay = Employee::whereNotNull('hostel')->count();


        return view('dashboard',compact('total_employees','total_departments','total_branches','new_empoyee','deptArr','deptEmpArr','maleTotal','femaleTotal','branchArr','branchEmpArr','hostelStay','hostelNotStay'));
    }
}
