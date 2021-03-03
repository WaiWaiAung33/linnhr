<?php

namespace App\Http\Controllers;

use App\NoticeBoard;
use App\Position;
use App\Branch;
use App\Department;

use Illuminate\Http\Request;

class NoticeBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notice_boards = new NoticeBoard();

        if ($request->name != '') {
            $notice_boards = $notice_boards->where('title',$request->name);
        }
        $count=$notice_boards->get()->count();
        $notice_boards = $notice_boards->orderBy('created_at','desc')->paginate(10);
        // dd($count);
        return view('admin.notice_board.index',compact('count','notice_boards'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::all();
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        return view('admin.notice_board.create',compact('positions','branches','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'notice_type'=>'required'
        ]);
        $destinationPath = public_path() . '/uploads/inquiryPhoto/';

        $data = [];
        
        if($request->hasfile('filename'))
         {
            foreach($request->file('filename') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move($destinationPath, $name);  
                $data[] = $name;  
            }
         }
        $notice_board = NoticeBoard::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'publish_date'=>date('Y-m-d',strtotime($request->publish_date)),
            'notice_type'=>$request->notice_type,
            'position_id'=>$request->rank,
            'dept_id'=>$request->department,
            'branch_id'=>$request->branch,
            'uploaded_by'=>auth()->user()->id,
            'image'=>json_encode($data)
        ]);
        return redirect()->route('notice_board.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function show(NoticeBoard $noticeBoard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function edit(NoticeBoard $noticeBoard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NoticeBoard $noticeBoard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function destroy(NoticeBoard $noticeBoard)
    {
        //
    }

    public function changestatuspost(Request $request)
    {
        $notice_board = NoticeBoard::find($request->post_id);
        $notice_board->status = $request->status;

        $notice_board->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
