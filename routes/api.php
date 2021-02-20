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


Route::post('login', 'Api\AuthApiController@login'); 

Route::post('/sendOtp','Api\SMSApiController@sendOtp');

Route::post('/verifyOtp','Api\SMSApiController@verifyOtp');

Route::post('/adminlogin','Api\AuthApiController@adminlogin');

Route::get('/dashboard', 'Api\DashboardApiController@dashboard');

Route::post('/emp_data/{id}','Api\EmployeeApiController@get_emp_data');

Route::post('/emp_salary','Api\EmployeeApiController@get_emp_salary');

Route::get('/department', 'Api\DepartmentApiController@department');
Route::post('/department_create','Api\DepartmentApiController@department_create');
Route::post('/department_edit/{id}','Api\DepartmentApiController@department_edit');
Route::post('/department_delete/{id}','Api\DepartmentApiController@department_delete');
Route::post('/department_activeInactive/{id}','Api\DepartmentApiController@department_activeInactive');

Route::get('/branch', 'Api\BranchApiController@branch');
Route::post('/branch_create','Api\BranchApiController@branch_create');
Route::post('/branch_edit/{id}','Api\BranchApiController@branch_edit');
Route::post('/branch_delete/{id}','Api\BranchApiController@branch_delete');
Route::post('/branch_activeInactive/{id}','Api\BranchApiController@active_inactive');

Route::post('/employee', 'Api\EmployeeApiController@employee'); 

Route::post('/job_list','Api\JobApplicationApiController@job_application_list');

Route::post('/job_detail/{id}','Api\JobApplicationApiController@job_application_detail')
