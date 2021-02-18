<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use DB;
use Validator;


class BranchApiController extends Controller
{
    public function branch()
    {
    	$branches = Branch::with('employees')->get();
        $branches = DB::table('branch')
                     ->select('branch.id','branch.name','branch.branch_color','branch.created_at','branch.updated_at','branch.latitude','branch.longitude','branch.status',DB::raw('count(employee.id) as total'))
                     ->leftjoin('employee','employee.branch_id','branch.id')
                     ->where('employee.name','!=','')
                     ->groupBy('branch_id')
                     ->get();
        $branches = $branches->where('status',1);
        return response(['branches' => $branches,'message'=>"Successfully login",'status'=>1]);
    }

    public function branch_create(Request $request)
    {
        $input = $request->all();
        $rules=[
            'branch_name'=>'required',
            'branch_phone'=>'required',
            'branch_latitude'=>'required',
            'branch_longitude'=>'required',
            'branch_color'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            $branch = Branch::create([
                'name'=>$request->branch_name,
                'phone'=>$request->branch_phone,
                'latitude'=>$request->branch_latitude,
                'longitude'=>$request->branch_longitude,
                'branch_color'=>$request->branch_color,
                'status'=>1
            ]);
            return response(['message'=>"Successfully create",'status'=>1]);
        }
    }

    public function branch_edit($id,Request $request)
    {
        // dd($id);
        $input = $request->all();
        $rules=[
            'branch_name'=>'required',
            'branch_phone'=>'required',
            'branch_latitude'=>'required',
            'branch_longitude'=>'required',
            'branch_color'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{

            $branch = Branch::find($id);
            $branch = $branch->update([
                'name'=>$request->branch_name,
                'phone'=>$request->branch_phone,
                'latitude'=>$request->branch_latitude,
                'longitude'=>$request->branch_longitude,
                'branch_color'=>$request->branch_color
            ]);
            return response(['message'=>"Successfully update",'status'=>1]);
        }
    }

    public function branch_delete($id)
    {
        $branch = Branch::find($id);
        if ($branch != null) {
            $branch = $branch->delete();
            return response(['message'=>"Successfully delete",'status'=>1]);
        }else{
            return response(['message'=>"Delete id does not exit!!!",'status'=>0]);
        }
    }

    public function active_inactive($id,Request $request)
    {
        $input = $request->all();
        $rules=[
            'status'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Status Required",'status'=>0]);
        }else{
            $branch = Branch::find($id);
            $branch = $branch->update([
                'status'=>$request->status
            ]);
            return response(['message'=>"Successfully",'status'=>1]);
        }
    }


}
	