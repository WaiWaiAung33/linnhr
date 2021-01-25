<?php

namespace App\Http\Controllers;

use App\Cvform;
use App\Jobopening;
use App\Department;
use App\Position;
use App\NRCCode;
use App\NRCState;
use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Str;

class CvformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobopenings = new Jobopening();
        $jobopenings = $jobopenings->get();
        return view('frontend.home',compact('jobopenings'));
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
        $positions = Position::all();
        $departments = Department::all();
        $nrccode = NRCCode::find($request->nrc_code);
        $nrcstate = NRCState::find($request->nrc_state);
        foreach ($positions as $key => $value) {
           if($value->name == $request->location);
           $id = $value->id;
          }
        foreach ($departments as $key => $value) {
           if($value->name == $request->department);
           $depid = $value->id;
          }
        $destinationPath = public_path() . '/uploads/jobapplicationPhoto/';
        $photo = "";
        if ($file = $request->file('myPhoto')) {
            $extension = $file->getClientOriginalExtension();
            $var = Str::random(32) . '.' . $extension;
            $file->move($destinationPath, $var);
            $photo = $var;
        }
        $fullnrc = $nrccode->name.'/'.$nrcstate->name."(".$request->nrc_status.')'.$request->nrc;
      

        $cvform = Cvform::create([
            'name'=>$request->name,
            'nrc_code'=>$request->nrc_code,
            'nrc_state'=>$request->nrc_state,
            'nrc_status'=>$request->nrc_status,
            'nrc'=>$request->nrc,
            'fullnrc'=>$fullnrc,
            'dob'=>$request->dob,
            'edu'=>$request->education,
            'religion'=>$request->religion,
            'marrical_status'=>$request->marrical_status,
            'email'=>$request->email,
            'fName'=>$request->pName,
            'fPhone'=>$request->pPhone,
            'experience'=>$request->experience,
            'job'=> $id,
            'department'=>$depid,
            'exp_salary'=>$request->salary,
            'hostel'=>$request->isHostel,
            'applied_date'=>$request->appliedDate,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'signature'=>$request->signed,
            'photo'=>$photo
        ]);
    
        return back()->with('success', 'success Full upload signature');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cvform  $cvform
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jobopenings = Jobopening::find($id);
        $departments = Department::all();
        $positions = Position::all();
        $nrccodes = NRCCode::all();
        // dd($nrccodes);
        $nrcstates = NRCState::all();
        return view('frontend.detail',compact('jobopenings','departments','positions','nrccodes','nrcstates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cvform  $cvform
     * @return \Illuminate\Http\Response
     */
    public function edit(Cvform $cvform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cvform  $cvform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cvform $cvform)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cvform  $cvform
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cvform $cvform)
    {
        //
    }

     public function selectcode(Request $request)
    {
        if($request->ajax()){
            $states = nrcstate::where('code_id',$request->nrc_code)->get();
            echo "<option value=''>Select --</opiton>";
            foreach ($states as $key => $state) {
                echo "<option value='".$state->id."'>".$state->name."</opiton>";
            }
        }
    }
}
