<?php

namespace App\Http\Controllers;

use App\NoticeBoard;
use App\Position;
use App\Branch;
use App\Department;
use App\Employee;
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
        $employees = Employee::where('active',1)->get();

        // foreach ($employees as $key => $employee) {

        //     $this->notification($employee->noti_token,$request->title,$employee->id);
        // }
        $this->notification("fnEky0MyT7yF3IVADpzrLi:APA91bFeuH5zM7N_ddnlMWu5PTkGK5vLojhPmUpc5s__0FpkhhLELoFjPhrkTXPl0GRtlFPhU-P5flHXRRShejYRQ_FvwnTz09cBCwOAhdREWJ74wdW6CXYCBM9pAMi6mr3j-4vCP4zr",$request->title,619);

        return redirect()->route('notice_board.index')->with('success','Success');
    }

    public function notification($token, $body,$userId) 
    {
        // dd($token);
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token=$token;

        $notification = [
            'title' => "Linn HR",
            'sound' => true,
            'body' => $body,
            'userId'=>$userId,
        ];

        $extraNotificationData = ["message" => $notification,"moredata" =>$body];
        
        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => "fnEky0MyT7yF3IVADpzrLi:APA91bFeuH5zM7N_ddnlMWu5PTkGK5vLojhPmUpc5s__0FpkhhLELoFjPhrkTXPl0GRtlFPhU-P5flHXRRShejYRQ_FvwnTz09cBCwOAhdREWJ74wdW6CXYCBM9pAMi6mr3j-4vCP4zr", //single token
            'notification' => $notification,
            'body' => $body
        ];
        // dd($fcmNotification);
        $headers = [
            'Authorization: key=AAAAt_TS_4s:APA91bE32l2lZ8VOiCqX_nZKcppXNP_rEbYURKwPQqTtTY99MZ15oiFy-s46SGtCGT3rAr-qNbNBsCsCyNrDP3FjdpsdMHrXcsAU0F7zMukBBImaEWQDZVpbQJ8dBkTJv0bfsn2IE7Wa',
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        // dd($result);
        curl_close($ch);

        return true;
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
        $back_route = 0;
        return view('admin.notice_board.show',compact('notice_boards','back_route'));
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
        $redirect_route = 0;
        return view('admin.notice_board.edit',compact('positions','branches','departments','notice_board','redirect_route'));
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

    public function notice_board_show($id)
    {
        $notice_boards = NoticeBoard::find($id);
        $back_route = 1;
        return view('admin.notice_board.show',compact('notice_boards','back_route'));
    }

    public function notice_board_edit($id)
    {
        $positions = Position::all();
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $notice_board = NoticeBoard::find($id);
        $redirect_route = 1;
        return view('admin.notice_board.edit',compact('positions','branches','departments','notice_board','redirect_route'));
    }

    public function notice_board_update($id,Request $request)
    {
        // dd("Here");
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
        return redirect()->route('dashboard')->with('success','Success');
    }

    public function notice_board_delete($id)
    {
        $storagePath = public_path() . '/uploads/postPhoto/';

        $notice_board = NoticeBoard::findorfail($id);
        if (File::exists($storagePath . $notice_board->image)) {
            File::delete($storagePath . $notice_board->image);
        };

        $notice_board->delete();
        return redirect()->route('dashboard')->with('success','Successfully');
    }
}
