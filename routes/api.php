<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', 'Api\AuthApiController@login');
Route::get('/dashboard', 'Api\DashboardApiController@dashboard');
Route::get('/department', 'Api\DepartmentApiController@department');
Route::get('/branch', 'Api\BranchApiController@branch');
Route::get('/employee', 'Api\EmployeeApiController@employee');