<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;

class BranchApiController extends Controller
{
    public function branch()
    {
        $branches = Branch::where('status',1)->get();

        return response(['branches' => $branches,'message'=>"Successfully login",'status'=>1]);
    }
}
