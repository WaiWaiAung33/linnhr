<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthApiController extends Controller
{

    public function login(Request $request)
    {
        
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        // dd($loginData);
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'User name or password is invalid','status'=>0]);
        }else{
             // $accessToken = auth()->user()->createToken('authToken')->accessToken;
             $user = auth()->user();
             $user->user_role = $user->roles[0]->name;
             // dd($user->roles->pluck('name'));
             return response(['user' => $user,'message'=>"Successfully login",'status'=>1]);
        } 
    }
}