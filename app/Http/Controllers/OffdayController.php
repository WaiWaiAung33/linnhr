<?php

namespace App\Http\Controllers;

use App\Offday;
use App\Employee;
use Illuminate\Http\Request;

class OffdayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offdays = new Offday();
        $count=$offdays->get()->count();
        $offdays = $offdays->orderBy('created_at','desc')->paginate(10);
        return view('admin.offday.index',compact('offdays','count'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offday.create');
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
        $offday=Offday::create([
            'emp_id'=> $request->emp_id,
            'off_day_1'=>date('Y-m-d',strtotime($request->off_day_1)),
            'off_day_2'=>date('Y-m-d',strtotime($request->off_day_2)),
            'off_day_3'=>date('Y-m-d',strtotime($request->off_day_3)),
            'off_day_4'=>date('Y-m-d',strtotime($request->off_day_3))
        ]
        );
        return redirect()->route('offday.index')->with('success','Offday created successfully');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offday  $offday
     * @return \Illuminate\Http\Response
     */
    public function show(Offday $offday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offday  $offday
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offdays=Offday::find($id);
        $employees = Employee::all();
        return view('admin.offday.edit',compact('offdays','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offday  $offday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $offdays=Offday::find($id);
        $offdays=$offdays->update([
            'emp_id'=> $request->emp_id,
            'off_day_1'=>date('Y-m-d',strtotime($request->off_day_1)),
            'off_day_2'=>date('Y-m-d',strtotime($request->off_day_2)),
            'off_day_3'=>date('Y-m-d',strtotime($request->off_day_3)),
            'off_day_4'=>date('Y-m-d',strtotime($request->off_day_3))
        ]
        );
        return redirect()->route('offday.index')->with('success','Offday updated successfully');;;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offday  $offday
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offdays = Offday::find($id);
        $offdays->delete();
        return redirect()->route('offday.index')->with('success','Offday deleted successfully');;;
    }
}
