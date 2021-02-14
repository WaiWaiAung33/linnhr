<?php

namespace App\Http\Controllers;

use App\HoselEmployee;
use App\Room;
use App\Hostel;
use App\Employee;
use Illuminate\Http\Request;
use DB;
use Validator;

class HostelEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hostelemployees = new HoselEmployee();
        $count=$hostelemployees->get()->count();
       
        $hostelemployees = $hostelemployees->orderBy('created_at','desc')->paginate(10);
        
        return view('admin.hostelemployee.index',compact('count','hostelemployees'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $employees = Employee::all();
       $hostels = Hostel::all();
       $rooms = Room::all();
       return view('admin.hostelemployee.create',compact('employees','hostels','rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rooms = Room::all();
        $hostels = Hostel::all();

        foreach ($rooms as $key => $value) {
            if ($value->id == $request->room_id) {
                $roomname = $value->room_no;
            }
        }

        foreach ($hostels as $key => $value) {
            if ($value->id == $request->hostel_id) {
                $hostelname = $value->name;
            }  
       }
         $rules = [
           'emp_id'=> 'required',
            'hostel_id' => 'required',
            'room_id' => 'required',
            'start_date' =>'required',
            'full_address' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()){
              DB::beginTransaction();
            try {
                            $hostelemployee=HoselEmployee::create([
                            'emp_id'=> $request->emp_id,
                            'hostel_id' => $request->hostel_id,
                            'room_id' => $request->room_id,
                            'start_date' => $request->start_date,
                            'full_address' => $request->full_address,
                        ]);

                     $updatedata = Employee::find($request->emp_id);
                     $updatedatas = $updatedata->update([
                        'hostel'=>'Yes',
                        'hostel_location'=>$request->full_address,
                        'room_no'=>$roomname,
                        'home_no'=>$hostelname,
                        'hostel_sdate'=>$request->start_date
                     ]);
                             
                     DB::commit();

                 } catch (Exception $e) {
                  DB::rollback();
                    return redirect()->route('hostelemployee.index')->with('success','Successfully');
             }
            return redirect()->route('hostelemployee.index')->with('success','Successfully');

        }else{
            return redirect()->route('hostelemployee.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HoselEmployee  $hoselEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(HoselEmployee $hoselEmployee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HoselEmployee  $hoselEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hostelemployees=HoselEmployee::find($id);
        $rooms = Room::all();
        $employees = Employee::all();
        $hostels = Hostel::all();
        return view('admin.hostelemployee.edit',compact('hostelemployees','rooms','employees','hostels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HoselEmployee  $hoselEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rooms = Room::all();
        $hostels = Hostel::all();

        foreach ($rooms as $key => $value) {
            if ($value->id == $request->room_id) {
                $roomname = $value->room_no;
            }
        }

        foreach ($hostels as $key => $value) {
            if ($value->id == $request->hostel_id) {
                $hostelname = $value->name;
            }  
       }
         $rules = [
            'emp_id'=> 'required',
            'hostel_id' => 'required',
            'room_id' => 'required',
            'start_date' =>'required',
            'full_address' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()){
              DB::beginTransaction();
            try {
                    $updatehostel = HoselEmployee::find($id);
                            $updatehostel=$updatehostel->update([
                            'emp_id'=> $request->emp_id,
                            'hostel_id' => $request->hostel_id,
                            'room_id' => $request->room_id,
                            'start_date' => $request->start_date,
                            'full_address' => $request->full_address,
                        ]);

                     $updatedata = Employee::find($request->emp_id);
                     $updatedatas = $updatedata->update([
                        'hostel'=>'Yes',
                        'hostel_location'=>$request->full_address,
                        'room_no'=>$roomname,
                        'home_no'=>$hostelname,
                        'hostel_sdate'=>$request->start_date
                     ]);
                             
                     DB::commit();

                 } catch (Exception $e) {
                  DB::rollback();
                    return redirect()->route('hostelemployee.index')->with('success','Successfully');
             }
            return redirect()->route('hostelemployee.index')->with('success','Successfully');

        }else{
            return redirect()->route('hostelemployee.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HoselEmployee  $hoselEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(HoselEmployee $hoselEmployee)
    {
        //
    }

    public function selecthostel(Request $request)
    {
        if($request->ajax()){
            $rooms = room::where('hostel_id',$request->room_id)->get();
            echo "<option value=''>Select --</opiton>";
            foreach ($rooms as $key => $room) {
                echo "<option value='".$room->id."'>".$room->room_no."</opiton>";
            }
        }
    }

    public function selectSearch(Request $request)
    {
        $data = new Employee();
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

     public function get_department_address(Request $request){
      // dd($request->all());
      
        $hostels = new Hostel();

        $hostels = $hostels->select(
                        'hostel.full_address'
                       );
        $search_hostel = $hostels->find($request->emp_id);
      
      return response()->json($search_hostel);
    }

}
