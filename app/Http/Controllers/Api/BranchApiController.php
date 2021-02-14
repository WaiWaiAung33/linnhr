<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use DB;


class BranchApiController extends Controller
{
    public function branch()
    {
        // $branches = Branch::where('status',1)->get();
    	$branches = Branch::with('employees')->get();
        $branches = DB::table('branch')
                     ->select('branch.name','branch.branch_color','branch.created_at','branch.updated_at','branch.latitude','branch.longitude','branch.status',DB::raw('count(employee.id) as total'))
                     ->leftjoin('employee','employee.branch_id','branch.id')
                     ->where('employee.name','!=','')
                     ->groupBy('branch_id')
                     ->get();
        $branches = $branches->where('status',1);
        return response(['branches' => $branches,'message'=>"Successfully login",'status'=>1]);
    }
}
	