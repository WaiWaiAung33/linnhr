<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;
use App\Imports\SalaryImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Employee;
use App\Department;
use DB;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $employees =Employee::with('viewSalary')->get();
        // dd($employees->viewSalary);
        $departments = Department::all();

         $salarys = new Salary();

        // if ($request->name != '') {
        //     $salarys = $salarys->Where('name','like','%'.$request->name.'%');
        // }
        // if ($request->dep_id != '') {
        //     $salarys = $salarys->where('department',$request->dep_id);
        // }

        $salarys = $salarys->get();
        // dd(DB::table('salarys')->latest()->get()->first());
        return view('admin.salary.index',compact('employees','salarys','departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('admin.salary.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = date('m',strtotime($request->pay_date));
        // dd($date);
        if($date == '01'){
            $dates = "January";
        }elseif ($date == '02') {
            $dates = "Febuary";
        }elseif ($date == '03') {
            $dates = "March";
        }elseif ($date == '04') {
            $dates = "April";
        }elseif ($date == '05') {
            $dates = "May";
        }elseif ($date == '06') {
            $dates = "June";
        }elseif ($date == '07') {
            $dates = "July";
        }elseif ($date == '08') {
            $dates = "Augest";
        }elseif ($date == '09') {
            $dates = "September";
        }elseif ($date == '10') {
            $dates = "October";
        }elseif ($date == '11') {
            $dates = "November";
        }elseif ($date == '12') {
            $dates = "December";
        }

        $salary=Salary::create([
            'emp_id'=>$request->emp_id,
            'name'=>$request->name,
            'department'=>$request->department,
            'branch'=>$request->branch,
            'pay_date'=>$dates,
            'year'=>date('Y',strtotime($request->pay_date)),
            'salary_amt'=>$request->salary_amt,
            'bonus'=>$request->bonus,
        ]
        );

          return redirect()->route('salary.index')->with('success','Salary created successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $employees = Employee::find($id);
        $salarys = Salary::all();
        return view('admin.salary.show',compact('employees','salarys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        //
    }

      public function import(Request $request) 
    {
        $request->validate([
            'file'=>'required',
        ]);

        Excel::import(new SalaryImport,request()->file('file'));
             
        return back();
    }
}
