<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KPI;
use App\Department;
use App\Employee;

class KPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $departments = Department::all();

        $kpis = new KPI();

        if ($request->year != '') {
            $kpis = $kpis->where('year',$request->year);
        }

        $count = $kpis->count();
        $kpis = $kpis->paginate(20);

        return view('admin.kpi.index',compact('kpis','departments','count'))->with('no', (request()->input('page', 1) - 1) * 20);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$departments = Department::all();
        return view('admin.kpi.create',compact('departments'));
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
      		'emp_id'=>'required',
            'knowledge'=>'required',
            'discipline'=>'required',
            'skill_set'=>'required',
            'team_work'=>'required',
            'social'=>'required',
            'motivation'=>'required',
            'date'=>'required',
            'comment'=>'required'
      ]);

        $month = date('m',strtotime($request->date));
        $year = date('Y',strtotime($request->date));

        $data = KPI::where('emp_id',$request->emp_id)->where('month',$month)->where('year', $year)->get();

         if ($data->count()>0) {
            return redirect()->route('kpi.index')->with('success','Data already exist.');             
         }else{
             $kpi=KPI::create([
				            'emp_id'=>$request->emp_id,
				            'knowledge'=>$request->knowledge,
				            'descipline'=>$request->discipline,
				            'skill_set'=>$request->skill_set,
				            'team_work'=>$request->team_work,
				            'social'=>$request->social,
				            'motivation'=>$request->motivation,
				            'month'=>$month,
				            'year'=>$year,
				            'comment'=>$request->comment
			        	]
			        );
            return redirect()->route('kpi.index')->with('success','KPI created successfully');
           
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KPI  $kpi
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {	
    	$departments = Department::all();
        $kpi = KPI::find($id);
        return view('admin.kpi.show',compact('kpi','departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KPI  $kpi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$departments = Department::all();
        $kpi = KPI::find($id);
        $employees = Employee::where('active',1)->where('dep_id',$kpi->employee->dep_id)->get();
        return view('admin.kpi.edit',compact('kpi','departments','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KPI  $kpi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$month = date('m',strtotime($request->date));
        $year = date('Y',strtotime($request->date));


       	$kpi = KPI::find($id);
        $kpi = $kpi->update([
            'emp_id'=>$request->emp_id,
            'knowledge'=>$request->knowledge,
            'descipline'=>$request->descipline,
            'skill_set'=>$request->skill_set,
            'team_work'=>$request->team_work,
            'social'=>$request->social,
            'motivation'=>$request->motivation,
            'month'=>$month,
            'year'=>$year,
            'comment'=>$request->comment
        ]);
         return redirect()->route('kpi.index')->with('success','KPI updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kpi  $kpi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kpi = KPI::findorfail($id);
        $kpi->delete();
        return redirect()->route('kpi.index')
                        ->with('success','KPI deleted successfully');
    }
}
