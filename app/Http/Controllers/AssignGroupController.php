<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssignGroup;
use App\Branch;
use App\Department;
use App\Employee;

class AssignGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departmentArr = Department::where('status',1)->orderBy('name','asc')->get();

        $departments = Department::with('groups.employees');
        if($request->dep_id!=''){
            $departments = $departments->where('id',$request->dep_id);
        }
        $count=$departments->with('employees')->get()->count();
        $departments = $departments->orderBy('name','asc')->get();
        return view('admin.group.index',compact('count','departments','departmentArr'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$branches = Branch::where('status',1)->get();
    	$departments = Department::where('status',1)->orderBy('name','asc')->get();

        return view('admin.group.create',compact('branches','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'group'=>'required',
            'branch_id'=>'required',
            'dep_id'=>'required',
            'emp_id'=>'required'
        ];

        $this->validate($request,$rules);

        foreach ($request->emp_id as $key => $emp_id) {
             AssignGroup::create([
                'group'=>$request->group,
                'branch_id'=>$request->branch_id,
                'department_id'=>$request->dep_id,
                'emp_id'=>$emp_id
            ]);
        }

        return redirect()->route('groups.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leave_type = LeaveType::find($id);
        return view('admin.leave_type.show',compact('leave_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leave_type = LeaveType::find($id);
        return view('admin.leave_type.edit',compact('leave_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'leave_type'=>'required',
            'num_of_leave'=>'required'
        ]);
        $leave_type = LeaveType::find($id);
        $leave_type = $leave_type->update([
            'leave_type'=>$request->leave_type,
            'num_of_leave'=>$request->num_of_leave
        ]);
    return redirect()->route('leave_type.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave_type = AssignGroup::where('department_id',$id)->delete();
        return redirect()->route('groups.index')->with('success','Success');
    }

    public function get_gp_employee_data(Request $request)
    {
        $data = Employee::where('active',1)->where('branch_id',$request->branch_id)->where('dep_id',$request->dep_id);

        if($request->has('q')){
            $search = $request->q;
            $data = $data->where('name','like','%'.$search.'%');
        }
       
        $data = $data->get();
        // dd($data);
        // $data =$data->select('name',DB::raw("CONCAT(nrc_code,'/',nrc_state,'(နိုင်)',nrc_no) as full_nrc"));
        return response()->json($data);
    }
}
