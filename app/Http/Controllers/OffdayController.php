<?php

namespace App\Http\Controllers;

use App\Offday;
use App\Employee;
use App\Branch;
use App\Department;
use App\User;
use Illuminate\Http\Request;

class OffdayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offdays = new Offday();
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $count=$offdays->get()->count();
          $offdays = $offdays->leftjoin('employee','employee.id','=','offday.emp_id')->leftjoin('users','users.id','=','offday.actionBy')->leftjoin('department','department.id','=','employee.dep_id')->leftjoin('branch','branch.id','=','employee.branch_id') ->select(
                                                    'offday.*',
                                                    'employee.name',
                                                    'employee.photo',
                                                    'users.name',
                                                    'department.name As department_name',
                                                    'branch.name As branch_name'
                                                );
        if ($request->name != '') {
            $offdays = $offdays->where('employee.name','like','%'.$request->name.'%');
        }
        if ($request->branch_id != '') {
            $offdays = $offdays->where('employee.branch_id',$request->branch_id);
        }
        if ($request->dept_id != '') {
            $offdays = $offdays->where('employee.dep_id',$request->dept_id);
        }

        if($request->date !=''){
            $offdays = $offdays->where('off_day_1',date('Y-m-d',strtotime($request->date)))
                                ->orwhere('off_day_2',date('Y-m-d',strtotime($request->date)))
                                ->orwhere('off_day_3',date('Y-m-d',strtotime($request->date)))
                                ->orwhere('off_day_4',date('Y-m-d',strtotime($request->date)));
        }

        $offdays = $offdays->orderBy('created_at','desc')->paginate(10);
        return view('admin.offday.index',compact('offdays','count','branches','departments'))->with('i', (request()->input('page', 1) - 1) * 10);;
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
            'off_day_1'=>($request->off_day_1!='')?date('Y-m-d',strtotime($request->off_day_1)):NULL,
            'off_day_2'=>($request->off_day_2!='')?date('Y-m-d',strtotime($request->off_day_2)):NULL,
            'off_day_3'=>($request->off_day_3!='')?date('Y-m-d',strtotime($request->off_day_3)):NULL,
            'off_day_4'=>($request->off_day_4!='')?date('Y-m-d',strtotime($request->off_day_4)):NULL,
            'actionBy'=>auth()->user()->id,
        ]
        );
        return redirect()->route('offday.index')->with('success','Offday created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offday  $offday
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

            $date = now();
           $emp_offdays = Offday::where('emp_id',$id)->get();
           $emp_offday_arr = [];
           foreach ($emp_offdays as $key => $value) {
            // dd($value->off_day_1);
               array_push($emp_offday_arr, $value->off_day_1);
               array_push($emp_offday_arr, $value->off_day_2);
               array_push($emp_offday_arr, $value->off_day_3);
               array_push($emp_offday_arr, $value->off_day_4);
           }

        return view('admin.offday.show',compact('emp_offdays','emp_offday_arr'));
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
            'off_day_1'=>($request->off_day_1!='')?date('Y-m-d',strtotime($request->off_day_1)):NULL,
            'off_day_2'=>($request->off_day_2!='')?date('Y-m-d',strtotime($request->off_day_2)):NULL,
            'off_day_3'=>($request->off_day_3!='')?date('Y-m-d',strtotime($request->off_day_3)):NULL,
            'off_day_4'=>($request->off_day_4!='')?date('Y-m-d',strtotime($request->off_day_4)):NULL,
            'actionBy'=>auth()->user()->id,
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
