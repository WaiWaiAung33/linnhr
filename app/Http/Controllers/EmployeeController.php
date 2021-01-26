<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Imports\EmployeeImport;
use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Branch;
use App\Department;
use App\Position;
use App\NRCCode;
use App\NRCState;
use File;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // dd($request->join_month);
        $branchs = Branch::all();
        $departments = Department::all();
        $positions = Position::all();
        $employees = new Employee();
        if($request->name != '') {
        $employees = $employees->Where('name','like','%'.$request->name.'%');
        }
        if ($request->branch_id != '') {
            $employees = $employees->where('branch_id',$request->branch_id);
        }
        if ($request->dep_id != '') {
            $employees = $employees->where('dep_id',$request->dep_id);
        }
        if ($request->position_id != '') {
            $employees = $employees->where('position_id',$request->position_id);
        }

        if ($request->join_month != '') {
            $employees = $employees->where('join_month',$request->join_month);
        }
        if ($request->join_date != '') {
            $startDate = date('Y-m-d', strtotime($request->join_date))." 00:00:00";
            $employees = $employees->where('join_date',$startDate);
            // dd($customers);
        }
        $count = $employees->get()->count();
        $employees = $employees->orderBy('created_at','desc')->paginate(10);
    
        return view('admin.employee.index',compact('branchs','departments','positions','employees','count'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branchs = Branch::all();
        $departments = Department::all();
        $nrccodes = NRCCode::all();
        $nrcstates = NRCState::all();
        $positions= Position::all();
        return view('admin.employee.create',compact('branchs','departments','positions','nrccodes','nrcstates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $destinationPath = public_path() . '/uploads/employeePhoto/';
        $photo = "";
        //upload image
        if ($file = $request->file('photo')) {
            $extension = $file->getClientOriginalExtension();
            $var = Str::random(32) . '.' . $extension;
            $file->move($destinationPath, $var);
            $photo = $var;
        }

        $nrccode = NRCCode::find($request->nrc_code);
        $nrcstate = NRCState::find($request->nrc_state);
        $fullnrc = $nrccode->name.'/'.$nrcstate->name."(".$request->nrc_status.')'.$request->nrc;
        // dd($fullnrc);

        $month = date('m',strtotime($request->join_date));
        // dd($date);

         $employee=Employee::create([
            'emp_id'=>$request->emp_id,
            'branch_id'=>$request->branch,
            'dep_id'=>$request->department,
            'position_id'=>$request->position,
            'name'=> $request->name,
            'gender'=>$request->gender,
            'father_name'=>$request->father_name,
            'phone_no'=>$request->phone_no,
            'nrc_code'=>$request->nrc_code,
            'nrc_state'=>$request->nrc_state,
            'nrc_status'=>$request->nrc_status,
            'nrc'=>$request->nrc,
            'fullnrc'=>$fullnrc,
            'date_of_birth'=>$request->date_of_birth,
            'join_date'=>$request->join_date,
            'join_month'=>$month,
            'address'=>$request->address,
            'city'=>$request->city,
            'township'=>$request->township,
            'qualification'=>$request->qualification,
            'salary'=>$request->salary,
            'photo'=>$photo,
            'religion'=>$request->religion,
            'email'=>$request->email,
            'fPhone'=>$request->pPhone,
            'experience'=>$request->experience,
            'exp_salary'=>$request->salary,
            'hostel'=>$request->isHostel,
        ]
        );

          return redirect()->route('employee.index')->with('success','Employee created successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branchs = Branch::all();
        $departments = Department::all();
        $positions = Position::all();
         $nrccodes = NRCCode::all();
        $nrcstates = NRCState::all(); 
        $employees = Employee::find($id);
        return view('admin.employee.show',compact('branchs','departments','positions','employees','nrccodes','nrcstates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branchs = Branch::all();
        $departments =Department::all();
        $positions=Position::all(); 
        $nrccodes = NRCCode::all();
        $nrcstates = NRCState::all();    
        $employees = Employee::find($id); 
         return view('admin.employee.edit',compact('branchs','departments','positions','employees','nrcstates','nrccodes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employees = Employee::find($id);
        $destinationPath = public_path() . '/uploads/employeePhoto/';
        $photo = ($request->photo != '') ? $request->photo : $employees->photo;
        //upload image
        if ($file = $request->file('photo')) {
            $extension = $file->getClientOriginalExtension();
            $var = Str::random(32) . '.' . $extension;
            
            $file->move($destinationPath, $var);
            $photo = $var;
        }
        $nrccode = NRCCode::find($request->nrc_code);
        $nrcstate = NRCState::find($request->nrc_state);
        $fullnrc = $nrccode->name.'/'.$nrcstate->name."(".$request->nrc_status.')'.$request->nrc;

        $month = date('m',strtotime($request->join_date));
        // dd($date);
      
         $employees = $employees->update([
            'emp_id'=>$request->emp_id,
            'branch_id'=>$request->branch,
            'dep_id'=>$request->department,
            'position_id'=>$request->position,
            'name'=> $request->name,
            'gender'=>$request->gender,
            'father_name'=>$request->father_name,
            'phone_no'=>$request->phone_no,
            'nrc_code'=>$request->nrc_code,
            'nrc_state'=>$request->nrc_state,
            'nrc_status'=>$request->nrc_status,
            'nrc'=>$request->nrc,
            'fullnrc'=>$fullnrc,
            'date_of_birth'=>$request->date_of_birth,
            'join_date'=>$request->join_date,
            'join_month'=>$month,
            'address'=>$request->address,
            'city'=>$request->city,
            'township'=>$request->township,
            'qualification'=>$request->qualification,
            'salary'=>$request->salary,
            'photo'=>$photo,
            

        ]);
         return redirect()->route('employee.index')->with('success','Employee updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findorfail($id);
        $employee->delete();
        return redirect()->route('employee.index')
                        ->with('success','Employee deleted successfully');
    }

    public function selectcode(Request $request)
    {
        if($request->ajax()){
            $states = nrcstate::where('code_id',$request->nrc_code)->get();
            echo "<option value=''>Select --</opiton>";
            foreach ($states as $key => $state) {
                echo "<option value='".$state->id."'>".$state->name."</opiton>";
            }
        }
    }

    public function get_department_data(Request $request){
      // dd($request->all());
      
      $employee = new Employee();

       $employee = $employee->leftjoin('department','department.id','=','employee.dep_id')
                            ->leftjoin('branch','branch.id','=','employee.branch_id')
                       ->select(
                        'department.name',
                        'branch.name AS branch_name',
                        'employee.name AS employee_name'
                       );
        $search_employee = $employee->find($request->emp_id);
      // dd($search_employee);
      return response()->json($search_employee);
    }

    public function import(Request $request) 
    {
        $request->validate([
            'file'=>'required',
        ]);

        Excel::import(new EmployeeImport,request()->file('file'));
             
        return back();
    }

     public function export() 
    {
        return Excel::download(new EmployeeExport, 'employee.xlsx');
    }

}
