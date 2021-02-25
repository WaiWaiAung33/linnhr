<?php
namespace App\Http\Controllers;
use App\Employee;
use App\HoselEmployee;
use Illuminate\Http\Request;
use App\Imports\EmployeeImport;
use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Branch;
use App\Department;
use App\Position;
use App\NRCCode;
use App\NRCState;
use App\Room;
use App\Hostel;
use App\User;
use App\Salary;
use File;
use Illuminate\Support\Str;
use DB;
use Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DateTime;
use PHPExcel_Worksheet_Drawing;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
        // dd($request->join_month);

        $join_date = date('Y-m-d',strtotime($request->join_date));
        $join_month = date('Y-m-d',strtotime($request->join_month));
        // dd($join_date);
        $branchs = Branch::all();
        $departments = Department::all();
        $positions = Position::all();
        $employees = new Employee();
        if($request->name != '') {
            $employees = $employees->where('name','like','%'.$request->name.'%')
                                    ->orwhere('phone_no','like','%'.$request->name.'%')
                                    ->orwhere('emp_id','like','%'.$request->name.'%');
        }
        if ($request->branch_id != '') {
            $employees = $employees->where('branch_id',$request->branch_id);
        }
        if ($request->dep_id != '') {
            $employees = $employees->where('dep_id',$request->dep_id);
        }
        if ($request->position_id != '') {
            $employees = $employees->where('position_id',$request->position_id);
        }

        if ($request->gender != '') {
            $employees = $employees->where('gender',$request->gender);
        }

        if ($request->hostel != '') {
            $employees = $employees->where('hostel',$request->hostel);
        }

        if ($request->join_month != '') {
            $employees = $employees->where('join_month',$request->join_month);
        }
        // if ($join_date != '1970-01-01') {
        //      $employees = $employees->where('join_date',$join_date);
        // }

         if ($request->join_date != '' && $request->join_month != '') {
            $startDate =  date('Y-m-d', strtotime($request->join_date));
            $endDate = date('Y-m-d', strtotime($request->join_month));
            $employees = Employee::whereBetween('employee.join_date',[$startDate,$endDate]);
            // dd($employees->get());
        }


        if ($request->active != '') {
            $employees = $employees->where('active',$request->active);
        }

        
   
        if ($request->age_from!= '' || $request->age_to!='') {

            $age_start= $request->age_from;
            $age_end = $request->age_to;
            if (is_null($age_end)) {
                $age_end = $age_start;
            }
            $age_start = date('Y-m-d', strtotime('-'.$age_start.' years'));
            $age_end = date('Y-m-d', strtotime('-'.$age_end.' years'));
            $employees = $employees->whereBetween('date_of_birth',[$age_end,$age_start]);

        }


       
        if ($request->sy_from != '' && $request->sy_to !='') {
            // $servic_year = date('Y-m-d', strtotime('-'.$request->servic_year_input.' years'));
            // $employees = $employees->where('join_date', '<=', $servic_year);
            $from = $request->sy_from;
            $to = $request->sy_to;

            if (is_null($to)) {
                $to = $from;
            }
            $from = date('Y-m-d', strtotime('-'.$from.' years'));
            $to = date('Y-m-d', strtotime('-'.$to.' years'));

            $employees = $employees->whereBetween('join_date',[$to, $from]);
        }
        $count = $employees->get()->count();
        $employees = $employees->orderBy('emp_id','asc')->paginate(10);
    
        return view('admin.employee.index',compact('branchs','departments','positions','employees','count'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branchs = Branch::all();
        $departments = Department::all();
        $nrccodes = NRCCode::all();
        $nrcstates = NRCState::all();
        $positions= Position::all();
        $hostels = Hostel::all();
       $rooms = Room::all();
        return view('admin.employee.create',compact('branchs','departments','positions','nrccodes','nrcstates','hostels','rooms'));
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
        $validator = Validator::make($request->all(), $rules);
         if ($validator->passes()){
             DB::beginTransaction();
             try{
        $destinationPath = public_path() . '/uploads/employeePhoto/';
        $policePath = public_path() . '/uploads/policestationrecomPhoto/';
        $wardPath = public_path() . '/uploads/wardrecoPhoto/';
        $attachPath = public_path() . '/uploads/attachfile';

        $photo = "";
        //upload image
        if ($file = $request->file('photo')) {
    
            $photo = $request->file('photo');
            $ext = '.'.$request->photo->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->photo->getClientOriginalName());
            $file->move($destinationPath, $fileName);
            $photo = $fileName;
          

        }


$police_reco_photo = "";
        if ($file = $request->file('police_reco')) {
           
            $police_reco = $request->file('police_reco');
            $ext = '.'.$request->police_reco->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->police_reco->getClientOriginalName());
            $file->move($policePath, $fileName);
            $police_reco_photo = $fileName;
        }

        $ward_reco_photo = "";
        if ($file = $request->file('ward_reco')) {

            $ward_reco = $request->file('ward_reco');
            $ext = '.'.$request->ward_reco->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->ward_reco->getClientOriginalName());
            $file->move($wardPath, $fileName);
            $ward_reco_photo = $fileName;
        }


        $cvfile_photo = "";
        if ($file = $request->file('cvfile')) {
            $cvfile = $request->file('cvfile');
            $ext = '.'.$request->cvfile->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->cvfile->getClientOriginalName());
            $file->move($attachPath, $fileName);
            $cvfile_photo = $fileName;
            // $name = $file->getClientOriginalName();
            // $destinationPath = public_path('/uploads/jobapplicationPhoto/');
            // $file->move($destinationPath, $name);
            // $cvfile_photo=$name;
            // dd($cvfile_photo);
            // $extension = $file->getClientOriginalExtension();
            // $var = Str::random(32) . '.' . $extension;
            // $file->move($destinationPath, $var);
            // $cvfile_photo = $var;
            // dd($cvfile_photo);
        }

        $otherfile_photo = "";
        if ($file = $request->file('otherfile')) {
            $otherfile = $request->file('otherfile');
            $ext = '.'.$request->otherfile->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->otherfile->getClientOriginalName());
            $file->move($attachPath, $fileName);
            $otherfile_photo = $fileName;
            // $extension = $file->getClientOriginalExtension();
            // $var = Str::random(32) . '.' . $extension;
            // $file->move($destinationPath, $var);
            // $otherfile_photo = $var;

        }

        $degree_photo = "";
        if ($file = $request->file('degree')) {
            $degree = $request->file('degree');
            $ext = '.'.$request->degree->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->degree->getClientOriginalName());
            $file->move($attachPath, $fileName);
            $degree_photo = $fileName;
            // $extension = $file->getClientOriginalExtension();
            // $var = Str::random(32) . '.' . $extension;
            // $file->move($destinationPath, $var);
            // $degree_photo = $var;
        }

        $nrccode = NRCCode::find($request->nrc_code);
        $nrcstate = NRCState::find($request->nrc_state);
        $fullnrc = $nrccode->name.'/'.$nrcstate->name."(".$request->nrc_status.')'.$request->nrc;
        // dd($fullnrc);

        $month = date('m',strtotime($request->join_date));
        // dd($date);
                $user = new User();
                if($request->phone_no!=''){
                   $user = $user->create(
                    [
                      'loginId'=>$request->phone_no,
                      'name'=>$request->name,
                      'password'=>Hash::make('linn'),
                    ]
                  );

                  $user->assignRole("Employee");
                }
                    $employee=Employee::create([
                    'user_id'=>$user->id,
                    'emp_id'=>$request->emp_id,
                    'branch_id'=>$request->branch,
                    'dep_id'=>$request->department,
                    'position_id'=>$request->position,
                    'name'=> $request->name,
                    'gender'=>$request->gender,
                    'marrical_status'=>$request->marrical_status,
                    'father_name'=>$request->father_name,
                    'phone_no'=>$request->phone_no,
                    'nrc_code'=>$request->nrc_code,
                    'nrc_state'=>$request->nrc_state,
                    'nrc_status'=>$request->nrc_status,
                    'nrc'=>$request->nrc,
                    'fullnrc'=>$fullnrc,
                    'date_of_birth'=>$request->date_of_birth,
                    'join_date'=>date('Y-m-d', strtotime($request->join_date)),
                    'join_month'=>$month,
                    'address'=>$request->address,
                    'city'=>$request->city,
                    'township'=>$request->township,
                    'qualification'=>$request->qualification,
                    'salary'=>$request->salary,
                    'photo'=>$photo,
                    'race'=>$request->race,
                    'religion'=>$request->religion,
                    'email'=>$request->email,
                    'fPhone'=>$request->pPhone,
                    'experience'=>$request->experience,
                    'exp_salary'=>$request->salary,
                    'hostel'=>$request->isHostel,
                    'applied_date'=>$request->appliedDate,
                    'address'=>$request->address,
                    'phone'=>$request->phone,
                    'signature'=>$request->signed,
                    'photo'=>$photo,
                    'city'=>$request->city,
                    'township'=>$request->township,
                    'graduation'=>$request->graduation,
                    'degree'=>$degree_photo,
                    'level'=>$request->level,
                    'course_title'=>$request->course_title,
                    'exp_company'=>$request->exp_company,
                    'exp_position'=>$request->exp_position,
                    'exp_location'=>$request->exp_location,
                    'exp_date_from'=>$request->exp_date_from,
                    'exp_date_to'=>$request->exp_date_to,
                    'skills'=>$request->skills,
                    'proficiency'=>$request->proficiency,
                    'police_reco'=>$police_reco_photo,
                    'ward_reco'=>$ward_reco_photo,
                    'cvfile'=>$cvfile_photo,
                    'otherfile'=> $otherfile_photo,
                    'hostel_location'=>$request->hostel_location,
                    'room_no'=>$request->room_no,
                    'home_no'=>$request->home_no,
                    'hostel_sdate'=>$request->hostel_sdate,
                    'employment_type'=>$request->employment_type,
                ]
                );
                   // dd($employee);

                    if ($employee->hostel == 'Yes') {
                        $hostelemployee=HoselEmployee::create([
                            'emp_id'=> $employee->id,
                            'hostel_id' => $employee->home_no,
                            'room_id' => $employee->room_no,
                            'start_date' => $employee->hostel_sdate,
                            'full_address' => $employee->hostel_location,
                            'name'=>$employee->name,                            
                            'branch_id'=>$employee->branch_id,
                            'dep_id'=>$employee->dep_id,
                            'position_id'=>$employee->position_id
                        ]);
                        // dd($hostelemployee);
                    }
                   
                    // dd($hostelemployee->emp_id);
                DB::commit();

             }catch (Exception $e) {
                  DB::rollback();
                    return redirect()->route('employee.index')->with('success','Successfully');
             }
              return redirect()->route('employee.index')->with('success','Successfully');
         }else{
            return redirect()->route('employee.create');
         }
    
    }

    /**
     * Dis


play the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branchs = Branch::all();
        $departments = Department::all();
        $positions = Position::all();
         $nrccodes = NRCCode::all();
        $nrcstates = NRCState::all(); 
        $salarys = Salary::where('emp_id',$id)->get();
        // dd($salarys);
        $salary_count = $salarys->count();
        $employees = Employee::find($id);
        return view('admin.employee.show',compact('branchs','departments','positions','employees','nrccodes','nrcstates','salarys','salary_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branchs = Branch::all();
        $departments =Department::all();
        $positions=Position::all(); 
        $nrccodes = NRCCode::all();
        $nrcstates = NRCState::all();    
        $employees = Employee::find($id); 
        $hostels = Hostel::all();
       $rooms = Room::all();
         return view('admin.employee.edit',compact('branchs','departments','positions','employees','nrcstates','nrccodes','hostels','rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $rules = [
                    'emp_id'=>'required',
        ];
        $validator = Validator::make($request->all(), $rules);
         if ($validator->passes()){
             DB::beginTransaction();
             try{

        $employees = Employee::find($id);
        // dd($employees);
        $destinationPath = public_path() . '/uploads/employeePhoto/';
        $policePath = public_path() . '/uploads/policestationrecomPhoto/';
        $wardPath = public_path() . '/uploads/wardrecoPhoto/';
        $attachPath = public_path() . '/uploads/attachfile';
        // dd($employees->photo);
        $photos = ($request->photo != '') ? $request->photo : $employees->photo;
        // dd($photo);

        //upload image
         if ($file = $request->file('photo')) {
    
            $photos = $request->file('photo');
            $ext = '.'.$request->photo->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $photos->getClientOriginalName());
            $file->move($destinationPath, $fileName);
            $photos = $fileName;
            // dd($photos);
          

        }

        // if ($file = $request->file('photo')) {
        //    $photo = $request->file('photo');
        //     $ext = '.'.$request->photo->getClientOriginalExtension();
        //     $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $photo->getClientOriginalName());
        //     $file->move($destinationPath, $fileName);
        //     $photo = $fileName;
        // }

          $police_reco_photo = ($request->police_reco != '') ? $request->police_reco : $employees->police_reco;
         
        if ($file = $request->file('police_reco')) {
            $police_reco = $request->file('police_reco');
            $ext = '.'.$request->police_reco->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->police_reco->getClientOriginalName());
            $file->move($policePath, $fileName);
            $police_reco_photo = $fileName;
        }

        $ward_reco_photo =  ($request->ward_reco != '') ? $request->ward_reco : $employees->ward_reco;
        if ($file = $request->file('ward_reco')) {
           $ward_reco = $request->file('ward_reco');
            $ext = '.'.$request->ward_reco->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->ward_reco->getClientOriginalName());
            $file->move($wardPath, $fileName);
            $ward_reco_photo = $fileName;
        }


        $cvfile_photo = ($request->cvfile != '') ? $request->cvfile : $employees->cvfile;
        if ($file = $request->file('cvfile')) {
            $cvfile = $request->file('cvfile');
            $ext = '.'.$request->cvfile->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->cvfile->getClientOriginalName());
            $file->move($attachPath, $fileName);
            $cvfile_photo = $fileName;
            // dd($cvfile_photo);
            // $extension = $file->getClientOriginalExtension();
            // $var = Str::random(32) . '.' .


$extension;
            // $file->move($destinationPath, $var);
            // $cvfile_photo = $var;
            // dd($cvfile_photo);
        }

        $otherfile_photo = ($request->otherfile != '') ? $request->otherfile : $employees->otherfile;
        if ($file = $request->file('otherfile')) {
           $otherfile = $request->file('otherfile');
            $ext = '.'.$request->otherfile->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->otherfile->getClientOriginalName());
            $file->move($attachPath, $fileName);
            $otherfile_photo = $fileName;
        }

        $degree_photo = "";
        if ($file = $request->file('degree')) {
            $degree = $request->file('degree');
            $ext = '.'.$request->degree->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->degree->getClientOriginalName());
            $file->move($attachPath, $fileName);
            $degree_photo = $fileName;
        }

        $nrccode = NRCCode::find($request->nrc_code);
        $nrcstate = NRCState::find($request->nrc_state);
        $fullnrc = $nrccode->name.'/'.$nrcstate->name."(".$request->nrc_status.')'.$request->nrc;

        $month = date('m',strtotime($request->join_date));
        // dd($date);
        $user = User::where("loginId",$employees->phone_no)->get();
            // dd();
            if($user->count()>0){
              $user = User::find($user[0]->id);
              $arr=[
                    'loginId'=>$employees->phone_no,
                    'name'=>$employees->name,
                    'password'=>Hash::make('linn')
                  ];

              $user->fill($arr)->save();
              $user_id=$user->id;
              $user->assignRole("Employee");
            }else{

               $user = User::create(
                [
                  'loginId'=>$employees->phone_no,
                  'name'=>$employees->name,
                  'password'=>Hash::make('linn')
                ]
              );
              $user_id=$user->id;
              $user->assignRole("Employee");
          }

          if ($request->isHostel == 'Yes') {
            $hostelemployee = HoselEmployee::where('emp_id',$employees->id)->get();
            // dd($hostelemployee);
            if ($hostelemployee->count()>0) {

                  $employees = $employees->update([
                    'user_id'=>$user_id,
                    'emp_id'=>$request->emp_id,
                    'branch_id'=>$request->branch,
                    'dep_id'=>$request->department,
                    'position_id'=>$request->position,
                    'name'=> $request->name,
                    'gender'=>$request->gender,
                    'marrical_status'=>$request->marrical_status,
                    'father_name'=>$request->father_name,
                    'phone_no'=>$request->phone_no,
                    'nrc_code'=>$request->nrc_code,
                    'nrc_state'=>$request->nrc_state,
                    'nrc_status'=>$request->nrc_status,
                    'nrc'=>$request->nrc,
                    'fullnrc'=>$fullnrc,
                    'date_of_birth'=>$request->date_of_birth,
                    'join_date'=>$request->join_date,
                    'join_month'=>$month,
                    'address'=>$request->address,
                    'city'=>$request->city,
                    'township'=>$request->township,
                    'qualification'=>$request->qualification,
                    'salary'=>$request->salary,
                    'photo'=>$photos,
                    'race'=>$request->race,
                    'religion'=>$request->religion,
                    'email'=>$request->email,
                    'fPhone'=>$request->pPhone,
                    'experience'=>$request->experience,
                    'exp_salary'=>$request->salary,
                    'hostel'=>$request->isHostel,
                    'address'=>$request->address,
                    'phone'=>$request->phone,
                    'signature'=>$request->signed,
                    // 'photo'=>$photo,
                    'city'=>$request->city,
                    'township'=>$request->township,
                    'graduation'=>$request->graduation,
                    'degree'=>$degree_photo,
                    'level'=>$request->level,
                    'course_title'=>$request->course_title,
                    'exp_company'=>$request->exp_company,
                    'exp_position'=>$request->exp_position,
                    'exp_location'=>$request->exp_location,
                    'exp_date_from'=>$request->exp_date_from,
                    'exp_date_to'=>$request->exp_date_to,
                    'skills'=>$request->skills,
                    'proficiency'=>$request->proficiency,
                    'police_reco'=>$police_reco_photo,
                    'ward_reco'=>$ward_reco_photo,
                    'cvfile'=>$cvfile_photo,
                    'otherfile'=> $otherfile_photo,
                    'hostel_location'=>$request->hostel_location,
                    'room_no'=>$request->room_no,
                    'home_no'=>$request->home_no,
                    'hostel_sdate'=>$request->hostel_sdate,
                    'employment_type'=>$request->employment_type,
                    

                ]);

                 $hostelemployee = User::find($hostelemployee[0]->id);
                  $arr=[
                         'hostel_id' => $request->home_no,
                         'room_id' => $request->room_no,
                        'start_date' => $request->hostel_sdate,
                        'full_address' => $request->hostel_location,
                        'name'=>$request->name,                           
                        'branch_id'=>$request->branch,
                        'dep_id'=>$request->department,
                        'position_id'=>$request->position
                      ];

                  $hostelemployee->fill($arr)->save();
            }else{

                  $employees = $employees->update([
                    'user_id'=>$user_id,
                    'emp_id'=>$request->emp_id,
                    'branch_id'=>$request->branch,
                    'dep_id'=>$request->department,
                    'position_id'=>$request->position,
                    'name'=> $request->name,
                    'gender'=>$request->gender,
                    'marrical_status'=>$request->marrical_status,
                    'father_name'=>$request->father_name,
                    'phone_no'=>$request->phone_no,
                    'nrc_code'=>$request->nrc_code,
                    'nrc_state'=>$request->nrc_state,
                    'nrc_status'=>$request->nrc_status,
                    'nrc'=>$request->nrc,
                    'fullnrc'=>$fullnrc,
                    'date_of_birth'=>$request->date_of_birth,
                    'join_date'=>$request->join_date,
                    'join_month'=>$month,
                    'address'=>$request->address,
                    'city'=>$request->city,
                    'township'=>$request->township,
                    'qualification'=>$request->qualification,
                    'salary'=>$request->salary,
                    'photo'=>$photos,
                    'race'=>$request->race,
                    'religion'=>$request->religion,
                    'email'=>$request->email,
                    'fPhone'=>$request->pPhone,
                    'experience'=>$request->experience,
                    'exp_salary'=>$request->salary,
                    'hostel'=>$request->isHostel,
                    'address'=>$request->address,
                    'phone'=>$request->phone,
                    'signature'=>$request->signed,
                    // 'photo'=>$photo,
                    'city'=>$request->city,
                    'township'=>$request->township,
                    'graduation'=>$request->graduation,
                    'degree'=>$degree_photo,
                    'level'=>$request->level,
                    'course_title'=>$request->course_title,
                    'exp_company'=>$request->exp_company,
                    'exp_position'=>$request->exp_position,
                    'exp_location'=>$request->exp_location,
                    'exp_date_from'=>$request->exp_date_from,
                    'exp_date_to'=>$request->exp_date_to,
                    'skills'=>$request->skills,
                    'proficiency'=>$request->proficiency,
                    'police_reco'=>$police_reco_photo,
                    'ward_reco'=>$ward_reco_photo,
                    'cvfile'=>$cvfile_photo,
                    'otherfile'=> $otherfile_photo,
                    'hostel_location'=>$request->hostel_location,
                    'room_no'=>$request->room_no,
                    'home_no'=>$request->home_no,
                    'hostel_sdate'=>$request->hostel_sdate,
                    'employment_type'=>$request->employment_type,
                    

                ]);
                  
                $hostelemployee = HoselEmployee::create(
                [
                  'emp_id'=>  $id,
                        'hostel_id' => $request->home_no,
                        'room_id' => $request->room_no,
                        'start_date' => $request->hostel_sdate,
                        'full_address' => $request->hostel_location,
                        'name'=>$request->name,                           
                        'branch_id'=>$request->branch,
                        'dep_id'=>$request->department,
                        'position_id'=>$request->position
                ]
              );
            }
                        // dd($hostelemployee);
         }else{
              $employees = $employees->update([
                    'user_id'=>$user_id,
                    'emp_id'=>$request->emp_id,
                    'branch_id'=>$request->branch,
                    'dep_id'=>$request->department,
                    'position_id'=>$request->position,
                    'name'=> $request->name,
                    'gender'=>$request->gender,
                    'marrical_status'=>$request->marrical_status,
                    'father_name'=>$request->father_name,
                    'phone_no'=>$request->phone_no,
                    'nrc_code'=>$request->nrc_code,
                    'nrc_state'=>$request->nrc_state,
                    'nrc_status'=>$request->nrc_status,
                    'nrc'=>$request->nrc,
                    'fullnrc'=>$fullnrc,
                    'date_of_birth'=>$request->date_of_birth,
                    'join_date'=>$request->join_date,
                    'join_month'=>$month,
                    'address'=>$request->address,
                    'city'=>$request->city,
                    'township'=>$request->township,
                    'qualification'=>$request->qualification,
                    'salary'=>$request->salary,
                    'photo'=>$photos,
                    'race'=>$request->race,
                    'religion'=>$request->religion,
                    'email'=>$request->email,
                    'fPhone'=>$request->pPhone,
                    'experience'=>$request->experience,
                    'exp_salary'=>$request->salary,
                    'hostel'=>$request->isHostel,
                    'address'=>$request->address,
                    'phone'=>$request->phone,
                    'signature'=>$request->signed,
                    // 'photo'=>$photo,
                    'city'=>$request->city,
                    'township'=>$request->township,
                    'graduation'=>$request->graduation,
                    'degree'=>$degree_photo,
                    'level'=>$request->level,
                    'course_title'=>$request->course_title,
                    'exp_company'=>$request->exp_company,
                    'exp_position'=>$request->exp_position,
                    'exp_location'=>$request->exp_location,
                    'exp_date_from'=>$request->exp_date_from,
                    'exp_date_to'=>$request->exp_date_to,
                    'skills'=>$request->skills,
                    'proficiency'=>$request->proficiency,
                    'police_reco'=>$police_reco_photo,
                    'ward_reco'=>$ward_reco_photo,
                    'cvfile'=>$cvfile_photo,
                    'otherfile'=> $otherfile_photo,
                    'hostel_location'=>$request->hostel_location,
                    'room_no'=>$request->room_no,
                    'home_no'=>$request->home_no,
                    'hostel_sdate'=>$request->hostel_sdate,
                    'employment_type'=>$request->employment_type,
                    

                ]);
         }
                   
                    // dd($hostelemployee->emp_id);
                DB::commit();

             }catch (Exception $e) {
                  DB::rollback();
                    return redirect()->route('employee.index')->with('success','Employee updated successfully');
             }
               return redirect()->route('employee.index')->with('success','Employee updated successfully');
         }else{
            return redirect()->route('employee.edit');
         }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findorfail($id);
        $user = User::find($employee->user_id)->delete();
        $employee->delete();
        return redirect()->route('employee.index')
                        ->with('success','Employee deleted successfully');
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

    public function get_department_data(Request $request){
      // dd($request->all());
      
      $employee = new Employee();

       $employee = $employee->leftjoin('department','department.id','=','employee.dep_id')
                            ->leftjoin('branch','branch.id','=','employee.branch_id')
                       ->select(
                        'department.name',
                        'branch.name AS branch_name',
                        'employee.name AS employee_name'
                       );
        $search_employee = $employee->find($request->emp_id);
      // dd($search_employee);
      return response()->json($search_employee);
    }

    public function import(Request $request) 
    {
        $request->validate([
            'file'=>'required',
        ]);

        Excel::import(new EmployeeImport,request()->file('file'));
             
        return back();
    }

     public function export() 
    {

        $employee = new Employee();
       
          $branch_id = (!empty($_POST['branch_id']))?$_POST['branch_id']:'';
        $dep_id = (!empty($_POST['dep_id']))?$_POST['dep_id']:'';
        $position_id = (!empty($_POST['position_id']))?$_POST['position_id']:'';

        $employee = $employee->leftjoin('department','department.id','=','employee.dep_id')->leftjoin('branch','branch.id','=','employee.branch_id')->leftjoin('position','position.id','=','employee.position_id');

        if($branch_id!=''){
            $employee = $employee->where('employee.branch_id',$branch_id);
        }

        if($dep_id!=''){
            $employee = $employee->where('employee.dep_id',$dep_id);
        }

        if($position_id!=''){
            $employee = $employee->where('employee.position_id',$position_id);
        }

        $employees =$employee->select(
                           'employee.id',
                           'employee.emp_id',
                           'employee.name',
                           'employee.father_name',
                           'employee.date_of_birth',
                           'position.name AS positon_name',
                           'department.name AS department_name',
                           'branch.name AS branch_name',
                           'employee.join_date',
                           'employee.phone_no',
                           'employee.address',
                           'employee.photo',
                        )->get()->toArray();

        // \Excel::store(
        //         new \App\Exports\EmployeeExport(array_keys($employees[0]),$employees, $employees),
        //         'employees'.'.xlsx',
        //         'local',
        //         \Maatwebsite\Excel\Excel::XLSX);
        return Excel::download(new EmployeeExport(array_keys($employees[0]),$employees, $employees), 'employee.xlsx');
    }

     public function downloadEmployeesCSV()
    {

        $strpath = public_path().'/uploads/files/employees.xlsx';

        $isExists = File::exists($strpath);

        if(!$isExists){
            return redirect()->back()->with('error','File does not exists!');
        }

        $csvFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $fileName = 'Employee Template.xlsx';

        return response()->download($csvFile, $fileName, $headers);

        
    }

    public function changestatus(Request $request)
    {
        // dd($request->all());
        $employee = Employee::find($request->file_id);
        $employee->active = $request->active;

        $employee->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

     public function changestatusid(Request $request)
    {
        // dd($request->all());
        $max = Employee::max('emp_id');
                    $items = (string)$max;
                    // dd($items);
                    $max_year = substr($items, 0, 2);
                    $max_count = substr($items,-2);
                    $max_middle = substr($items,-4);
                    $max_middle_month = substr($max_middle, 0, 2);
                    $join_count = sprintf("%02d", ++$max_count);
                    $data = $max_year . $max_middle_month . $join_count;
                    // dd($data);
                    return response()->json($data);
    }

     public function selectdepartment(Request $request)
    {
        // $data = new Department();
        $data = Department::where('status',1);
        // $data = $data->leftjoin('inquiries','inquiries.id','=','customers.cust_id')
        //                ->select(
        //                 'customers.id',
        //                 'inquiries.name',
        //                 'inquiries.ph_no'
        //                );
        if($request->has('q')){
            $search = $request->q;
            $data = $data->where('name','like','%'.$search.'%');
        }
       
        $data = $data->get();
        // dd($data);
        // $data =$data->select('name',DB::raw("CONCAT(nrc_code,'/',nrc_state,'(နိုင်)',nrc_no) as full_nrc"));
        return response()->json($data);
    }

      public function selectrank(Request $request)
    {
        $data = new Position();
        
        // $data = $data->leftjoin('inquiries','inquiries.id','=','customers.cust_id')
        //                ->select(
        //                 'customers.id',
        //                 'inquiries.name',
        //                 'inquiries.ph_no'
        //                );
        if($request->has('q')){
            $search = $request->q;
            $data = $data->where('name','like','%'.$search.'%');
        }
       
        $data = $data->get();
        // dd($data);
        // $data =$data->select('name',DB::raw("CONCAT(nrc_code,'/',nrc_state,'(နိုင်)',nrc_no) as full_nrc"));
        return response()->json($data);
    }

    public function updateuser($id)
    {
        $employees = Employee::find($id);
        $user = User::where("loginId",$employees->phone_no)->get();
            // dd();
            if($user->count()>0){
              $user = User::find($user[0]->id);
              $arr=[
                    'loginId'=>$employees->phone_no,
                    'name'=>$employees->name,
                    'password'=>Hash::make('linn')
                  ];

              $user->fill($arr)->save();
              $user_id=$user->id;
              $user->assignRole("Employee");
            }else{

               $user = User::create(
                [
                  'loginId'=>$employees->phone_no,
                  'name'=>$employees->name,
                  'password'=>Hash::make('linn')
                ]
              );
              $user_id=$user->id;
              $user->assignRole("Employee");
          }
          $employees = $employees->update([
            'user_id'=>$user_id


]);
          return redirect()->route('employee.index')->with('success','Employee updated successfully');;
    }

 
  

}