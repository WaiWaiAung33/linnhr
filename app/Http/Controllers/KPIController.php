<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\KpiImport;
use App\Exports\KpiExport;
use App\KPI;
use App\Department;
use App\Branch;
use App\Employee;
use Maatwebsite\Excel\Facades\Excel;
use File;
use PHPExcel_Worksheet_Drawing;

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
        $kpis = $kpis->orderBy('created_at','desc')->paginate(20);

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



        $total = $request->knowledge + $request->discipline + $request->skill_set + $request->team_work + $request->social + $request->motivation;

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
                            'total' => $total,
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

        $month = ($request->month!='')?$request->month:date('m');
        $year = ($request->year!='')?$request->year:date('Y');

        $kpis = KPI::with('employee')->where('kpi.year',$year)->where('emp_id',$kpi->emp_id)->orderBy('month','asc')->get();

        $monthArr =[];
        $kpiPoint = [];
        
        foreach ($kpis as $key => $val) {
            $point = $val['knowledge'] + $val['descipline'] + $val['skill_set'] + $val['team_work'] + $val['social'] + $val['motivation'];

            $month = $val['month'];

            if( $month== '01'){
                 $month = "Jan";
            }elseif ( $month== '02') {
                 $month = "Feb";
            }elseif ( $month== '03') {
                 $month = "Mar";
            }elseif ( $month== '04') {
                 $month = "Apr";
            }elseif ( $month== '05') {
                 $month = "May";
            }elseif ( $month== '06') {
                 $month = "June";
            }elseif ( $month== '07') {
                 $month = "July";
            }elseif ( $month== '08') {
                 $month = "Aug";
            }elseif ( $month== '09') {
                 $month = "Sept";
            }elseif ( $month== '10') {
                 $month = "Oct";
            }elseif ( $month== '11') {
                 $month = "Nov";
            }elseif ( $month== '12') {
                 $month = "Dec";
            }
            array_push($monthArr,$month);
            array_push($kpiPoint, $point);
         }

        return view('admin.kpi.show',compact('kpi','departments','monthArr','kpiPoint','kpis'));
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
            'total' => $request->knowledge + $request->descipline + $request->skill_set + $request->team_work + $request->social + $request->motivation,
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

    public function downloadKpisCSV()
    {

        $strpath = public_path().'/uploads/files/kpi.xlsx';
        // dd($strpath);
        $isExists = File::exists($strpath);

        if(!$isExists){
            return redirect()->back()->with('error','File does not exists!');
        }

        $csvFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $fileName = 'Kpi Template.xlsx';

        return response()->download($csvFile, $fileName, $headers);

        
    }


      public function kpiexport(Request $request) 
    {

        $kpi = new Kpi();
        $date = $request->month;
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

        if($request->branch_id != ''){
            $kpi = $kpi->where('employee.branch_id',$request->branch_id);
        }

        if($request->dept_id != ''){
            $kpi = $kpi->where('employee.dep_id',$request->dept_id);
        }

         if ($request->year != '') {
            $kpis = $kpis->where('year',$request->year);
        }

        if ($date != '') {
            $kpis = $kpis->where('month',$dates);
        }

        $kpi = $kpi->leftjoin('employee','employee.id','=','kpi.emp_id')
        ->select(
                
                'employee.photo As photo',
                'employee.name As name',
                'kpi.knowledge',
               'kpi.descipline',
               'kpi.skill_set',
               'kpi.team_work',
               'kpi.social',
               'kpi.motivation',
               'kpi.month',
               'kpi.year'
        )->get()->toArray();
        // dd($kpi);

      
        // \Excel::store(
        //         new \App\Exports\EmployeeExport(array_keys($employees[0]),$employees, $employees),
        //         'employees'.'.xlsx',
        //         'local',
        //         \Maatwebsite\Excel\Excel::XLSX);
        return Excel::download(new KpiExport(array_keys($kpi[0]),$kpi, $kpi), 'kpi.xlsx');
    }
}
