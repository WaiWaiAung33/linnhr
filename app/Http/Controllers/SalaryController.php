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

        $departments = Department::all();

         $salarys = new Salary();

        $employees = new Employee();
        if($request->name != '') {
        $employees = $employees->Where('name','like','%'.$request->name.'%');
        // dd($employees->get());
        }
         if ($request->dep_id != '') {
            $employees = $employees->where('dep_id',$request->dep_id);
        }

       

        $salarys = $salarys->get();
       
        $count = $employees->count();
        $employees = $employees->paginate(5);

        // dd(DB::table('salarys')->latest()->get()->first());
        return view('admin.salary.index',compact('employees','salarys','departments','count'));
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
        // dd($request->month_total);

        $salary=Salary::create([
            'emp_id'=>$request->emp_id,
            'name'=>$request->name,
            'department'=>$request->department,
            'branch'=>$request->branch,
            'pay_date'=>$dates,
            'year'=>date('Y',strtotime($request->pay_date)),
            'salary_amt'=>$request->salary_amt,
            'bonus'=>$request->bonus,
            'month_total'=>$request->month_total,
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
    public function show(Request $request,$id)
    {
        // dd($request->year);
        $salarys = Salary::all();
        if ($request->year != '') {
            $salarys = $salarys->where('year',$request->year);
            // dd($salarys);
        }
        $employees = Employee::find($id);
        $count = $salarys->count();
       
        return view('admin.salary.show',compact('employees','salarys','count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salarys = Salary::find($id);
        return view('admin.salary.edit',compact('salarys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
         $salarys = Salary::find($id);
          $salarys = $salarys->update([
            'emp_id'=>$request->emp_id,
            'name'=>$request->name,
            'department'=>$request->department,
            'branch'=>$request->branch,
            'pay_date'=>$request->pay_date,
            'year'=>$request->year,
            'salary_amt'=>$request->salary_amt,
            'bonus'=>$request->bonus,
            'month_total'=>$request->month_total,
        ]);
         return redirect()->route('salary.index')->with('success','Salary updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salary = Salary::findorfail($id);
        $salary->delete();
        return redirect()->route('salary.index')
                        ->with('success','Salary deleted successfully');
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
