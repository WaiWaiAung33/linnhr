<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NoticeBoard;
use DB;
use Validator;
use App\Employee;


class NoticeBoardApiController extends Controller
{
	public function notice_board(Request $request)
	{
		$input = $request->all();
	     $rules=[
	        'page'=>'required',
	        'notice_type'=>'required'
	    ];

	    $validator = Validator::make($input, $rules);

	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{
	    	if ($request->page != 0) {
	    		if ($request->notice_type == "all") {
	    			$notice_boards = new NoticeBoard();
	    		}else{
	    			// dd("Here");
	    			$notice_boards = new NoticeBoard();
	    			$notice_boards = $notice_boards->where('position_id',$request->position_id)->orwhere('dept_id',$request->dept_id)->orwhere('branch_id',$request->branch_id);
	    		}

	    		$notice_boards = $notice_boards->orderBy('id','asc')->limit(10)->paginate(10);

		        return response(['message'=>"Success",'status'=>1,'notice_boards'=>$notice_boards]);
	    	}else{
		    		if ($request->notice_type == "all") {
		    			$notice_boards = new NoticeBoard();
		    		}else{
		    			$notice_boards = new NoticeBoard();
		    			$notice_boards = $notice_boards->where('position_id',$request->position_id)->orwhere('dept_id',$request->dept_id)->orwhere('branch_id',$request->branch_id);
		    		}

		    		$notice_boards = $notice_boards->orderBy('attendances.id','asc')->get();

			        return response(['message'=>"Success",'status'=>1,'notice_boards'=>$notice_boards]);
	    	}
	    }
	}
}