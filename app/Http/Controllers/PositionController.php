<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $positions = new Position();
        $count=$positions->get()->count();
        if ($request->name != '') {
            $positions = $positions->where('name','like','%'.$request->name.'%');
        }
        $positions = $positions->orderBy('created_at','desc')->paginate(10);
        
        return view('admin.position.index',compact('count','positions'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.position.create');
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
        $position=Position::create([
            'name'=> $request->name,
        ]
        );
        return redirect()->route('position.index')->with('success','Position created successfully');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $positions=Position::find($id);
        return view('admin.position.edit',compact('positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $positions=Position::find($id);
        $positions=$positions->update($request->all());
         return redirect()->route('position.index')->with('success','Position updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();
  
        return redirect()->route('position.index')
                        ->with('success','Position deleted successfully');
    }
}
