<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Branch;
use Carbon\Carbon;
use DB;
use App\LeaveApplication;
use App\Offday;
use App\Overtime;
use App\Attendance;

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


        // $hostelNotStay = Employee::whereNull('hostel')->count();
        // $hostelStay = Employee::whereNotNull('hostel')->count();

        $hostelNotStay = Employee::where('hostel','No')->count();
        $hostelStay = Employee::where('hostel','!=','No')->count();


        $date = now();
        $bd_employess = Employee::select('name','date_of_birth')->whereMonth('date_of_birth', '=', $date->month)
                             ->whereDay('date_of_birth', '>=', $date->day)
                            ->orWhere(function ($query) use ($date) {
                               $query->whereMonth('date_of_birth', '=', $date->month)
                                   ->whereDay('date_of_birth', '>=', $date->day);

                           })
           // ->orderByRaw("DAYOFMONTH('date_of_birth')",'desc')
           ->orderByRaw('DATE_FORMAT(date_of_birth, "%m-%d")')
           ->get()->toArray();


        

        $branchHostelArr = DB::table('branch')
                             ->selectRaw('branch.name')
                             ->selectRaw("count(case when gender = 'Male' then 1 end) as hmcont")
                             ->selectRaw("count(case when gender = 'Female' then 1 end) as hfmcont")
                             // ->leftjoin('hostel_employee','hostel.id','hostel_employee.hostel_id')
                             ->leftjoin('employee','employee.branch_id','branch.id')
                             ->groupBy('branch.name')
                             ->where('employee.hostel','Yes')
                             ->get()->toArray();


        $hostelArr = DB::table('hostel')
                             ->selectRaw('hostel.name')
                             ->selectRaw("count(case when gender = 'Male' then 1 end) as mcont")
                             ->selectRaw("count(case when gender = 'Female' then 1 end) as fmcont")
                             ->leftjoin('hostel_employee','hostel.id','hostel_employee.hostel_id')
                             ->leftjoin('employee','employee.id','hostel_employee.emp_id')
                             ->groupBy('hostel.name')
                             ->get()->toArray();

       
        return view('dashboard',compact('total_employees','total_departments','total_branches','new_empoyee','deptArr','deptEmpArr','maleTotal','femaleTotal','branchArr','branchEmpArr','hostelStay','hostelNotStay','bd_employess','hostelArr','branchHostelArr'));
    }


    public function hrDashboard()
    {

        $attendance_count = Attendance::where('date',date('Y-m-d'))->get()->count();

        $leave_count = LeaveApplication::whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->get()->count();
        

        $offday_count = OffDay::where('off_day_1',date('Y-m-d'))->orwhere('off_day_2',date('Y-m-d'))->orwhere('off_day_3',date('Y-m-d'))->orwhere('off_day_4',date('Y-m-d'))->get()->count();
        
        $overtime_count = Overtime::where('apply_date',date('Y-m-d'))->get()->count();
        $emp_count = Employee::where('active',1)->get()->count();

        
        $attbrArr = DB::table('branch')
                             ->selectRaw('branch.name')
                             ->selectRaw("count(attendances.id) as attcount")
                             ->leftjoin('employee','branch.id','employee.branch_id')
                             ->leftjoin('attendances','employee.id','attendances.emp_id')
                             ->where('date',date('Y-m-d'))
                             ->groupBy('branch.id')
                             ->get()->toArray();

        $branchArr = [];
        $branchAttCountArr = [];

        foreach ($attbrArr as $key => $attb) {
            array_push($branchArr, $attb->name);
            array_push($branchAttCountArr, $attb->attcount);
        }


        $attDetpArr = DB::table('department')
                             ->selectRaw('department.name')
                             ->selectRaw("count(attendances.id) as attcount")
                             ->leftjoin('employee','department.id','employee.dep_id')
                             ->leftjoin('attendances','employee.id','attendances.emp_id')
                             ->where('date',date('Y-m-d'))
                             ->groupBy('department.id')
                             ->get()->toArray();

        $deptArr = [];
        $deptAttCountArr = [];

        foreach ($attDetpArr as $key => $attdept) {
            array_push($deptArr, $attdept->name);
            array_push($deptAttCountArr, $attdept->attcount);
        }


        $date = now();
        $bd_employess = Employee::select('name','date_of_birth')->whereMonth('date_of_birth', '=', $date->month)
                             ->whereDay('date_of_birth', '>=', $date->day)
                            ->orWhere(function ($query) use ($date) {
                               $query->whereMonth('date_of_birth', '=', $date->month)
                                   ->whereDay('date_of_birth', '>=', $date->day);

                           })
                           ->orderByRaw('DATE_FORMAT(date_of_birth, "%m-%d")')
                           ->get()->toArray();


        $offday_employess = OffDay::select('employee.name as empname','branch.name as branch_name','department.name as dep_name','employee.photo')
                                    ->leftjoin('employee','employee.id','offday.emp_id')
                                    ->leftjoin('branch','branch.id','employee.branch_id')
                                    ->leftjoin('department','department.id','employee.dep_id')
                                    ->where('off_day_1',date('Y-m-d'))
                                    ->orwhere('off_day_2',date('Y-m-d'))
                                    ->orwhere('off_day_3',date('Y-m-d'))
                                    ->orwhere('off_day_4',date('Y-m-d'))
                                    ->paginate(10);


        $total_branches = Branch::count();
        $total_departments = Department::count();

        $dateS = Carbon::now()->startOfMonth()->subMonth(3);
        $dateE = Carbon::now()->startOfMonth(); 
        $new_empoyee = Employee::whereBetween('join_date',[$dateS,$dateE])->get()->count();

       
        return view('admin.dashboard.hr_dashboard',compact('attendance_count','leave_count','offday_count','overtime_count','emp_count','deptArr','branchArr','branchAttCountArr','deptArr','deptAttCountArr','bd_employess','offday_employess','total_branches','total_departments','new_empoyee'));
    }
}
