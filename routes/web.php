<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    // return view('dashboard');
    return redirect()->route('dashboard');
})->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('dashboard','HomeController@index')->name('dashboard');
	Route::resource('branch','BranchController');
	Route::resource('department','DepartmentController');
	Route::resource('position','PositionController');
	Route::resource('employee','EmployeeController');
	Route::resource('nrccode','NRCCodeController');
	Route::resource('nrcstate','NRCStateController');
	Route::resource('salary','SalaryController');
	Route::post('select-ajax-code','EmployeeController@selectcode')->name('select-ajax-code');
	Route::get('get_department_data','EmployeeController@get_department_data')->name('get_department_data');
	Route::post('import',[App\Http\Controllers\EmployeeController::class, 'import'])->name('import');
	Route::post('salaryimport',[App\Http\Controllers\SalaryController::class, 'import'])->name('salaryimport');
});





