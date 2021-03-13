<?php

namespace App\Http\Controllers;

use App\TrainingAttendance;
use App\Training;
use App\Employee;
use Illuminate\Http\Request;

class TrainingAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = new TrainingAttendance();
        $count = $trainings->get()->count();
        $trainings = $trainings->orderBy('training_attendances.created_at','desc')->paginate(10);
        return view('admin.training_attendance.index',compact('trainings','count'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainings =  Training::all();
        return view('admin.training_attendance.create',compact('trainings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'emp_id'=>'required'
        ]);
        $training = TrainingAttendance::create([
            'training_id'=>$request->training_id,
            'emp_id'=>$request->emp_id,
            'att_date'=>date('Y-m-d',strtotime($request->att_date)),
            'status'=>$request->status,
            'remark'=>$request->remark
        ]);
        return redirect()->route('training_attendance.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TrainingAttendance  $trainingAttendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $training_attendances = TrainingAttendance::find($id);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.training_attendance.show',compact('training_attendances','trainings','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TrainingAttendance  $trainingAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training_attendances = TrainingAttendance::find($id);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.training_attendance.edit',compact('training_attendances','trainings','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrainingAttendance  $trainingAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $this->validate($request,[
            'emp_id'=>'required'
        ]);
        $trainings = TrainingAttendance::find($id)->update([
            'training_id'=>$request->training_id,
            'emp_id'=>$request->emp_id,
            'att_date'=>date('Y-m-d',strtotime($request->att_date)),
            'status'=>$request->status,
            'remark'=>$request->remark
        ]);
        return redirect()->route('training_attendance.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrainingAttendance  $trainingAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainings = TrainingAttendance::find($id)->delete();
        return redirect()->route('training_attendance.index')->with('success','Success');
    }
}