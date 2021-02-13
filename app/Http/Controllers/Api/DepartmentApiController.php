<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;

class DepartmentApiController extends Controller
{
    public function department()
    {
        $departments = Department::where('status',1)->get();

        return response(['departments' => $departments,'message'=>"Successfully login",'status'=>1]);
    }
}
