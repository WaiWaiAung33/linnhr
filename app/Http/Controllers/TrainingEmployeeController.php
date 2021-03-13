<?php

namespace App\Http\Controllers;

use App\TrainingEmployee;
use App\Training;
use App\Employee;
use Illuminate\Http\Request;

class TrainingEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = new TrainingEmployee();
        $count = $trainings->get()->count();
        $trainings = $trainings->orderBy('training_employees.created_at','desc')->paginate(10);
        return view('admin.training_employee.index',compact('count','trainings'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainings =  Training::all();
        return view('admin.training_employee.create',compact('trainings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          // dd($request->all());
        $this->validate($request,[
            'emp_id'=>'required'
        ]);
        $training = TrainingEmployee::create([
            'training_id'=>$request->training_id,
            'emp_id'=>$request->emp_id,
        ]);
        return redirect()->route('training_emp.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TrainingEmployee  $trainingEmployee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $training_employees = TrainingEmployee::find($id);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.training_employee.show',compact('training_employees','trainings','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TrainingEmployee  $trainingEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training_employees = TrainingEmployee::find($id);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.training_employee.edit',compact('training_employees','trainings','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrainingEmployee  $trainingEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
         $this->validate($request,[
            'emp_id'=>'required'
        ]);
        $trainings = TrainingEmployee::find($id)->update([
           'training_id'=>$request->training_id,
           'emp_id'=>$request->emp_id,
           
        ]);
        return redirect()->route('training_emp.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrainingEmployee  $trainingEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainings = TrainingEmployee::find($id)->delete();
        return redirect()->route('training_emp.index')->with('success','Success');
    }
}