<?php

namespace App\Http\Controllers;

use App\Hostel;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hostels = new Hostel();
        $count=$hostels->get()->count();
        if ($request->name != '') {
            $hostels = $hostels->where('name','like','%'.$request->name.'%');
        }
        $hostels = $hostels->orderBy('created_at','desc')->paginate(10);
        
        return view('admin.hostel.index',compact('count','hostels'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hostel.create');
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
            'full_address'=>'required'
        ];

        $this->validate($request,$rules);
        $hostel=Hostel::create([
            'name'=> $request->name,
            'full_address'=>$request->full_address
        ]
        );
        return redirect()->route('hostel.index')->with('success','Hostel created successfully');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function show(Hostel $hostel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hostels=Hostel::find($id);
        return view('admin.hostel.edit',compact('hostels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hostels=Hostel::find($id);
         $hostels=$hostels->update([
            'name'=>$request->name,
            'full_address'=> $request->full_address,
        ]
        );
         return redirect()->route('hostel.index')->with('success','Hostel updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hostels = Hostel::find($id);
        $hostels->delete();
        return redirect()->route('hostel.index')
                        ->with('success','Hostel deleted successfully');
    }
}
