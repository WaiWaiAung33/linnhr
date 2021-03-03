<?php

namespace App\Http\Controllers;

use App\Ro;
use App\Employee;
use App\Branch;
use App\Department;
use Illuminate\Http\Request;

class RoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ro = new Ro();
        $departmentArr = Department::where('status',1)->orderBy('name','asc')->get();
       

        $departments = Department::with('group.employees');
       
        $count=$departments->with('employees')->get()->count();
        $departments = $departments->orderBy('name','asc')->get();
        // dd($ro->get());
        return view('admin.ro.index',compact('ro','count','departments','departmentArr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        $branchs = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        return view('admin.ro.create',compact('employees','branchs','departments'));
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
            'branch_id'=>'required',
        ];
        // dd($request->all());
        $this->validate($request,$rules);

             Ro::create([
                'group'=>'ro',
                'branch_id'=>$request->branch_id,
                'department_id'=>$request->department_id,
                'ro_id'=>$request->ro_id
            ]);
       

        foreach ($request->emp_id as $key => $emp) {
            Ro::create([
               'group'=>'member',
               'branch_id'=> $request->branch_id,
               'department_id'=>$request->department_id,
               'ro_id'=>$emp,
            ]);
        }
        return redirect()->route('ro.index')->with('success','Ro created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ro  $ro
     * @return \Illuminate\Http\Response
     */
    public function show(Ro $ro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ro  $ro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->orderBy('name','asc')->get();

        $groups = Ro::with('employees')->where('department_id',$id)->get();

        return view('admin.ro.edit',compact('branches','departments','groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ro  $ro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $rules = [
           'branch_id'=>'required',
        ];

        $this->validate($request,$rules);
        $res = Ro::where('department_id',$id)->delete();
        // dd($request->all());
        
             Ro::create([
                'group'=>'ro',
                'branch_id'=>$request->branch_id,
                'department_id'=>$request->department_id,
                'ro_id'=>$request->ro_id
            ]);


       foreach ($request->emp_id as $key => $emp) {
            Ro::create([
               'group'=>'member',
               'branch_id'=> $request->branch_id,
               'department_id'=>$request->department_id,
               'ro_id'=>$emp,
            ]);
        }

        return redirect()->route('ro.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ro  $ro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Ro::where('department_id',$id)->delete();
        return redirect()->route('ro.index')->with('success','Success');
    }
}
