<?php

namespace App\Http\Controllers;

use App\Overtime;
use App\Employee;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $overtimes = new Overtime();
        $count=$overtimes->get()->count();
        $overtimes = $overtimes->orderBy('created_at','desc')->paginate(10);
        return view('admin.overtime.index',compact('overtimes','count'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.overtime.create');
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
            'emp_id'=>'required',
        ];

         $this->validate($request,$rules);
        $overtime=Overtime::create([
            'emp_id'=> $request->emp_id,
            'apply_date'=>date('Y-m-d',strtotime($request->apply_date)),
            'reason'=> $request->reason,
          
        ]
        );
        return redirect()->route('overtime.index')->with('success','Overtime created successfully');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function show(Overtime $overtime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $overtimes=Overtime::find($id);
        $employees = Employee::all();
        return view('admin.overtime.edit',compact('overtimes','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $overtimes=Overtime::find($id);
        $overtimes=$overtimes->update([
            'emp_id'=> $request->emp_id,
            'apply_date'=>date('Y-m-d',strtotime($request->apply_date)),
            'reason'=> $request->reason,
        ]
        );
        return redirect()->route('overtime.index')->with('success','Overtime updated successfully');;;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $overtimes = Overtime::find($id);
        $overtimes->delete();
        return redirect()->route('overtime.index')->with('success','Overtime deleted successfully');;;
    }
}
