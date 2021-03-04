<?php

namespace App\Http\Controllers;

use App\NoticeBoard;
use App\Position;
use App\Branch;
use App\Department;
use File;

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

        $notice_boards = $notice_boards->leftjoin('users','users.id','=','notice_boards.uploaded_by')
                                        ->leftjoin('position','position.id','=','notice_boards.position_id')
                                        ->leftjoin('branch','branch.id','=','notice_boards.branch_id')
                                        ->leftjoin('department','department.id','=','notice_boards.dept_id')
                                        ->select(
                                            'notice_boards.*',
                                            'users.name',
                                            'position.name AS position',
                                            'branch.name AS branch',
                                            'department.name AS department'
                                        );
        if ($request->name != '') {
            $notice_boards = $notice_boards->where('notice_boards.title',$request->name);
        }
        $count=$notice_boards->get()->count();

        $notice_boards = $notice_boards->orderBy('notice_boards.created_at','desc')->paginate(10);
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
        $destinationPath = public_path() . '/uploads/postPhoto/';

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
    public function show($id)
    {
        $notice_boards = NoticeBoard::find($id);
        return view('admin.notice_board.show',compact('notice_boards'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $positions = Position::all();
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $notice_board = NoticeBoard::find($id);
        return view('admin.notice_board.edit',compact('positions','branches','departments','notice_board'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'notice_type'=>'required'
        ]);
        $notice_board = NoticeBoard::find($id);

        $destinationPath = public_path() . '/uploads/postPhoto/';

         $data = [];
        
        if($request->hasfile('filename'))
         {
            foreach($request->file('filename') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move($destinationPath, $name);  
                $data[] = $name;  
            }

            $arr = [
                        'title'=>$request->title,
                        'description'=>$request->description,
                        'publish_date'=>date('Y-m-d',strtotime($request->publish_date)),
                        'notice_type'=>$request->notice_type,
                        'position_id'=>$request->rank,
                        'dept_id'=>$request->department,
                        'branch_id'=>$request->branch,
                        'uploaded_by'=>auth()->user()->id,
                        'image'=>json_encode($data)
                    ];
         }else{
            $arr = [
                        'title'=>$request->title,
                        'description'=>$request->description,
                        'publish_date'=>date('Y-m-d',strtotime($request->publish_date)),
                        'notice_type'=>$request->notice_type,
                        'position_id'=>$request->rank,
                        'dept_id'=>$request->department,
                        'branch_id'=>$request->branch,
                        'uploaded_by'=>auth()->user()->id,
                    ];
         }

        $notice_board = $notice_board->update($arr);
        return redirect()->route('notice_board.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storagePath = public_path() . '/uploads/postPhoto/';

        $notice_board = NoticeBoard::findorfail($id);
        if (File::exists($storagePath . $notice_board->image)) {
            File::delete($storagePath . $notice_board->image);
        };

        $notice_board->delete();
        return redirect()->route('notice_board.index')->with('success','Successfully');
    }

    public function changestatuspost(Request $request)
    {
        $notice_board = NoticeBoard::find($request->post_id);
        $notice_board->status = $request->status;

        $notice_board->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
