<?php

namespace App\Http\Controllers;

use App\TestResult;
use App\Training;
use App\Employee;
use Illuminate\Http\Request;

class TestResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = new TestResult();
        $count = $trainings->get()->count();
        $trainings = $trainings->orderBy('test_results.created_at','desc')->paginate(10);
        return view('admin.test_result.index',compact('trainings','count'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainings =  Training::all();
       return view('admin.test_result.create',compact('trainings'));
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
        $test_result = TestResult::create([
            'training_id'=>$request->training_id,
            'emp_id'=>$request->emp_id,
            'test_date'=>date('Y-m-d',strtotime($request->test_date)),
            'marks'=>$request->marks,
            'remark'=>$request->remark
        ]);
        return redirect()->route('test_result.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $test_result = TestResult::find($id);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.test_result.show',compact('test_result','trainings','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test_result = TestResult::find($id);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.test_result.edit',compact('test_result','trainings','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'emp_id'=>'required'
        ]);
        $trainings = TestResult::find($id)->update([
            'training_id'=>$request->training_id,
            'emp_id'=>$request->emp_id,
            'att_date'=>date('Y-m-d',strtotime($request->att_date)),
            'status'=>$request->status,
            'remark'=>$request->remark
        ]);
        return redirect()->route('test_result.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainings = TestResult::find($id)->delete();
        return redirect()->route('test_result.index')->with('success','Success');
    }
}