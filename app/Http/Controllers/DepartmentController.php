<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $departments = new Department();
        $count=$departments->get()->count();
         if ($request->name != '') {
            $departments = $departments->where('name','like','%'.$request->name.'%');
        }
        $departments = $departments->orderBy('created_at','desc')->paginate(10);
        
        return view('admin.department.index',compact('count','departments'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'=>'required',
        ];

         $this->validate($request,$rules);
        $department=Department::create([
            'name'=> $request->name,
            'in_time'=>$request->in_time,
            'out_time'=>$request->out_time,
        ]
        );
        return redirect()->route('department.index')->with('success','Department created successfully');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $departments=Department::find($id);
        return view('admin.department.edit',compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $rules = [
            'name'=>'required',
        ];

         $this->validate($request,$rules);
        $departments=Department::create([
            'name'=> $request->name,
            'in_time'=>$request->in_time,
            'out_time'=>$request->out_time,
        ]
        );
        return redirect()->route('department.index')->with('success','Department created successfully');;;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
  
        return redirect()->route('department.index')
                        ->with('success','Department deleted successfully');
    }
}
