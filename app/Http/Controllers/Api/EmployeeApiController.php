<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Branch;
use App\Position;
use App\NRCCode;
use App\NRCState;
use App\Salary;

class EmployeeApiController extends Controller
{
    public function employee()
    {
        $employee = new Employee();

        $employee = $employee->leftJoin('branch','branch.id','=','employee.branch_id')
        					 ->leftJoin('department','department.id','=','employee.dep_id')
        					 ->leftJoin('position','position.id','=','employee.position_id')
        					 ->leftJoin('nrccode','nrccode.id','=','employee.nrc_code')
        					 ->leftJoin('nrcstate','nrcstate.id','=','employee.nrc_state')
        					 ->select(
        					 	'employee.id',
        					 	'employee.name',
        					 	'employee.gender',
        					 	'employee.date_of_birth',
        					 	'nrccode.id AS nrccode_id',
        					 	'nrccode.name AS nrc_code',
        					 	'nrcstate.id AS nrcstate_id',
        					 	'nrcstate.name AS nrc_state',
        					 	'employee.nrc_status',
        					 	'employee.nrc',
        					 	'employee.fullnrc',
        					 	'employee.email',
        					 	'employee.father_name',
        					 	'employee.race',
        					 	'employee.religion',
        					 	'employee.marrical_status',
        					 	'employee.photo',
        					 	'employee.phone_no',
        					 	'employee.fPhone',
        					 	'employee.address',
        					 	'employee.city',
        					 	'employee.township',
        					 	'employee.graduation',
        					 	'employee.course_title',
        					 	'employee.qualification',
        					 	'employee.level',
        					 	'employee.degree',
        					 	'employee.exp_company',
        					 	'employee.exp_date_from',
        					 	'employee.exp_date_to',
        					 	'employee.exp_location',
        					 	'employee.exp_position',
        					 	'employee.emp_id',
        					 	'branch.id AS branch_id',
        					 	'branch.name AS branch_name',
        					 	'department.id AS department_id',
        					 	'department.name AS dept_name',
        					 	'position.name AS position',
        					 	'employee.hostel',
        					 	'employee.hostel_sdate',
        					 	'employee.hostel_location',
        					 	'employee.home_no',
        					 	'employee.room_no',
        					 	'employee.exp_salary',
        					 	'employee.skills',
        					 	'employee.proficiency',
        					 	'employee.cvfile',
        					 	'employee.ward_reco',
        					 	'employee.police_reco',
        					 	'employee.otherfile',
        					 )->get();

        return response(['employees' => $employee,'message'=>"Successfully login",'status'=>1]);
    }
}