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
Route::get('/home', function () {
    // return view('dashboard');
    return redirect()->route('dashboard');
})->middleware('auth');
Route::group(['middleware' => 'auth'], function () {

	Route::resource('roles','RoleController');
    Route::resource('users','UserController');


	Route::get('dashboard','HomeController@index')->name('dashboard');
	Route::resource('branch','BranchController');
	Route::resource('department','DepartmentController');
	Route::resource('position','PositionController');
	Route::resource('employee','EmployeeController');
	Route::resource('nrccode','NRCCodeController');
	Route::resource('nrcstate','NRCStateController');
	Route::resource('salary','SalaryController');
	Route::resource('jobopening','JobopeningController');
	Route::resource('jobapplication','JobapplicationController');
	Route::resource('hostel','HostelController');
	Route::resource('room','RoomController');
	Route::resource('hostelemployee','HostelEmployeeController');

	Route::post('select-ajax-code','EmployeeController@selectcode')->name('select-ajax-code');

	Route::get('change-status-active','BranchController@changestatusactive')->name('change-status-active');
	// change-status-dept
	Route::get('change-status-dept','DepartmentController@changestatusdept')->name('change-status-dept');
	Route::get('get_department_data','EmployeeController@get_department_data')->name('get_department_data');
	Route::post('import',[App\Http\Controllers\EmployeeController::class, 'import'])->name('import');
	Route::post('salaryimport',[App\Http\Controllers\SalaryController::class, 'import'])->name('salaryimport');
	Route::post('export', [App\Http\Controllers\EmployeeController::class, 'export'])->name('export');
	Route::get('/employees/csv/download', 'EmployeeController@downloadEmployeesCSV')->name('employees.download.csv');
	Route::get('/updateuser/{id}',[App\Http\Controllers\EmployeeController::class, 'updateuser'])->name('user.update');
	Route::get('/salarys/csv/download','SalaryController@downloadSalarysCSV')->name('salarys.download.csv');

	Route::get('setting','SettingController@setting')->name('setting.index');
	Route::post('setting/{id}/update/','SettingController@settingUpdate')->name('setting.update');
});

Route::get('/', [App\Http\Controllers\CvformController::class, 'index'])->name('frontend.home');
Route::get('cvform/show/{id}','CvformController@show')->name('cvform.show');
Route::post('cvform','CvformController@store')->name('cvform.store');
Route::post('select-ajax-codes','CvformController@selectcode')->name('select-ajax-codes');
Route::get('joblist', 'JobapplicationController@jobList')->name('joblist.jobList');
Route::get('frontend/joblistdetail/{id}', 'JobapplicationController@jobListdetail')->name('frontend.jobListdetail');
Route::get('frontend/about','JobapplicationController@jobabout')->name('frontend.jobabout');
Route::get('frontend/contactus','JobapplicationController@jobcontact')->name('frontend.jobcontact');

Route::get('ajax-autocomplete-search', 'SalaryController@selectSearch')->name('ajax-autocomplete-search');


Route::post('select-ajax-hostel','HostelEmployeeController@selecthostel')->name('select-ajax-hostel');
Route::get('get_department_address','HostelEmployeeController@get_department_address')->name('get_department_address');
Route::get('ajax-autocomplete-search', 'HostelEmployeeController@selectSearch')->name('ajax-autocomplete-search');

Route::get('ajax-autocomplete-department', 'EmployeeController@selectSearch')->name('ajax-autocomplete-department');

// Route::get('change-status-trainings', 'EmployeeController@changestatustrainings')->name('change-status-trainings');
// change-status-employee
Route::get('change-status-employee', 'EmployeeController@changestatus')->name('change-status-employee');

Route::get('ajax-autocomplete-department', 'EmployeeController@selectdepartment')->name('ajax-autocomplete-department');

Route::get('ajax-autocomplete-rank', 'EmployeeController@selectrank')->name('ajax-autocomplete-rank');

Route::get('get_hostelemployee_data','HostelEmployeeController@get_hostelemployee_data')->name('get_hostelemployee_data');








