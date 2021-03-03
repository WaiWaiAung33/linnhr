<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\KpiImport;
use App\KPI;
use App\Department;
use App\Branch;
use App\Employee;
use Maatwebsite\Excel\Facades\Excel;
use File;

class KPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->month);
        $date = $request->month;
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $kpis = new KPI();
          if($date == 'January'){
            $dates = "01";
        }elseif ($date == 'February') {
            $dates = "02";
        }elseif ($date == 'March') {
            $dates = "03";
        }elseif ($date == 'April') {
            $dates = "04";
        }elseif ($date == 'May') {
            $dates = "05";
        }elseif ($date == 'June') {
            $dates = "06";
        }elseif ($date == 'July') {
            $dates = "07";
        }elseif ($date == 'August') {
            $dates = "08";
        }elseif ($date == 'September') {
            $dates = "09";
        }elseif ($date == 'October') {
            $dates = "10";
        }elseif ($date == 'November') {
            $dates = "11";
        }elseif ($date == 'December') {
            $dates = "12";
        }

        $kpis = $kpis->leftjoin('employee','employee.id','=','kpi.emp_id')
                              ->select(
                                        'kpi.*',
                                        'employee.name',
                                        'employee.photo',
                                    );
         if ($request->name != '') {
            $kpis = $kpis->where('employee.name','like','%'.$request->name.'%');
        }

         if ($request->branch_id != '') {
            $kpis = $kpis->where('employee.branch_id',$request->branch_id);
        }
        if ($request->dept_id != '') {
            $kpis = $kpis->where('employee.dep_id',$request->dept_id);
        }

        if ($request->year != '') {
            $kpis = $kpis->where('year',$request->year);
        }

        if ($date != '') {
            $kpis = $kpis->where('month',$dates);
        }

        $count = $kpis->count();
        $kpis = $kpis->paginate(20);

        return view('admin.kpi.index',compact('kpis','departments','count','branches'))->with('no', (request()->input('page', 1) - 1) * 20);;
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

      public function import(Request $request) 
    {
        $request->validate([
            'file'=>'required',
        ]);

        Excel::import(new KpiImport,request()->file('file'));
             
        return back();
    }
}
