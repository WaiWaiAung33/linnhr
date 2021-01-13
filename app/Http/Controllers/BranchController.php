<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branchs = new Branch();
        if ($request->name != '') {
            $branchs = $branchs->where('name','like','%'.$request->name.'%');
        }
        $count=$branchs->get()->count();
        $branchs = $branchs->orderBy('created_at','desc')->paginate(10);
        // dd($count);
        return view('admin.branch.index',compact('count','branchs'))->with('i', (request()->input('page', 1) - 1) * 10);;
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
        ];

         $this->validate($request,$rules);
        $branch=Branch::create([
            'name'=> $request->name,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
        ]
        );
        return redirect()->route('branch.index')->with('success','Branch created successfully');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branchs=Branch::find($id);
        return view('admin.branch.edit',compact('branchs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       $branchs=Branch::find($id);
        $branchs=$branchs->update($request->all());
         return redirect()->route('branch.index')->with('success','Branch updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
         $branch->delete();
  
        return redirect()->route('branch.index')
                        ->with('success','Branch deleted successfully');
    }
}
