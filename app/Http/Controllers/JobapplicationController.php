<?php

namespace App\Http\Controllers;

use App\Cvform;
use App\Department;
use App\Position;
use App\NRCCode;
use App\NRCState;
use App\Employee;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use DB;

class JobapplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobapplications = new Cvform();
        $departments = Department::all();
        $positions = Position::all();
        if($request->name != '') {
        $jobapplications = $jobapplications->Where('name','like','%'.$request->name.'%');
        }
        $count = $jobapplications->get()->count();
        $jobapplications = $jobapplications->orderBy('created_at','desc')->paginate(10);
        return view('admin.jobapplication.index',compact('jobapplications','departments','positions','count'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $departments = Department::all();
        $positions = Position::all();
        $destinationPath = public_path() . '/uploads/employeePhoto/';
        $photo = ($request->photo != '') ? $request->photo : null;
        //upload image
        if ($file = $request->file('photo')) {
            $extension = $file->getClientOriginalExtension();
            $var = Str::random(32) . '.' . $extension;
            $file->move($destinationPath, $var);
            $photo = $var;
        }
        foreach ($departments as $key => $value) {
            if ($value->name == $request->department) {
               $dep_id = $value->id ;
            }
        }
        foreach ($positions as $key => $value) {
           if ($value->name == $request->location) {
             $pos_id = $value->id;
             // dd($pos_id);
           }
        }
        $max = DB::table('employee')->max('emp_id');
        $max_id = ++$max;
        $date = date('d-m-Y');
        $month = date('m');

         $employee=Employee::create([
            'emp_id'=>$max_id,
            'branch_id'=>1,
            'dep_id'=>$dep_id,
            'position_id'=>$pos_id,
            'name'=> $request->name,
            'gender'=>$request->gender,
            'marrical_status'=>$request->marrical_status,
            'father_name'=>$request->fName,
            'phone_no'=>$request->phone,
            'nrc_code'=>$request->nrc_code,
            'nrc_state'=>$request->nrc_state,
            'nrc_status'=>$request->nrc_status,
            'nrc'=>$request->nrc,
            'fullnrc'=>$request->fullnrc,
            'date_of_birth'=>$request->dob,
            'join_date'=>$date ,
            'join_month'=>$month,
            'address'=>$request->address,
            'city'=>null,
            'township'=>null,
            'qualification'=>$request->education,
            'photo'=>$photo,
            'religion'=>$request->religion,
            'email'=>$request->email,
            'fPhone'=>$request->fPhone,
            'experience'=>$request->experience,
            'exp_salary'=>$request->salary,
            'hostel'=>$request->hostel,
        ]
        );

         $updatedata = DB::table('cvform')
                        ->update(['status' => 1]);

         DB::commit();

          return redirect()->route('jobapplication.index')->with('success','Employee created successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departments = Department::all();
        $positions = Position::all();
         $nrccodes = NRCCode::all();
        $nrcstates = NRCState::all(); 
        $jobapplications = Cvform::find($id);
        return view('admin.jobapplication.show',compact('departments','positions','jobapplications','nrccodes','nrcstates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
