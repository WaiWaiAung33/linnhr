<?php

namespace App\Http\Controllers;

use App\Cvform;
use App\Department;
use App\Position;
use App\NRCCode;
use App\NRCState;
use Illuminate\Http\Request;

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
          $rules = [
            'name'=>'required',
            'nrc'=>'required',
            'dob'=>'required',
            'education'=>'required',
            'religion'=>'required',
            'marrical_status'=>'required',
            'pName'=>'required',
            'pPhone'=>'required',
            'experience'=>'required',
            'location'=>'required',
            'salary'=>'required',
            'isHostel'=>'required',
            'appliedDate'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'signed'=>'required',
            'myphoto'=>'required'
        ];

        $customMessage = [
            'name.required'=>'Please enter your name',
            'nrc.required'=>'Please enter your nrc number',
            'dob.required'=>'Please enter your date of birth',
            'education.required'=>'Please enter your education',
            'religion.required'=>'Please enter your religion',
            'marrical_status.required'=>'Please enter marrical status',
            'pName.required'=>'Please enter your parents name',
            'pPhone.required'=>'Please enter your parents phone number',
            'experience.required'=>'Please enter your experience',
            'location.required'=>'Please enter your location',
            'salary.required'=>'Pleae enter expected salary',
            'isHostel.required'=>'Please enter living or not living at hostel',
            'appliedDate.required'=>'Please enter applied date',
            'address.required'=>'Please enter your eddress',
            'phone.required'=>'Please enter your phone number',
            'signed.required'=>'Please enter your signature',
            'myphoto.required'=>'Please enter your photo'
        ];

        $this->validate($request,$rules,$customMessage);

        // $folderPath = public_path('upload/');
      
        // $image_parts = explode(";base64,", $request->signed);
            
        // $image_type_aux = explode("image/", $image_parts[0]);
          
        // $image_type = $image_type_aux[1];
          
        // $image_base64 = base64_decode($image_parts[1]);
          
        // $file = $folderPath . uniqid() . '.'.$image_type;
        // // dd(uniqid() . '.'.$image_type);
        // file_put_contents($file, $image_base64);

        $cvform = Cvform::create([
            'name'=>$request->name,
            'nrc'=>$request->nrc,
            'dob'=>$request->dob,
            'edu'=>$request->education,
            'religion'=>$request->religion,
            'marrical_status'=>$request->marrical_status,
            'email'=>$request->email,
            'fName'=>$request->pName,
            'fPhone'=>$request->pPhone,
            'experience'=>$request->experience,
            'job'=>$request->location,
            'exp_salary'=>$request->salary,
            'hostel'=>$request->isHostel,
            'applied_date'=>$request->appliedDate,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'signature'=>$request->signed,
            'photo'=>$request->myPhoto
        ]);
        // dd($cvform);
        return back()->with('success', 'success Full upload signature');
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
