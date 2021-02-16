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
use Validator;


class EmployeeApiController extends Controller
{
    public function employee(Request $request)
    {
        $input = $request->all();
        // dd($input);
             $rules=[
                'page'=>'required'
            ];

            $validator = Validator::make($input, $rules);

             if ($validator->fails()) {
                $messages = $validator->messages();
                   return response()->json(['message'=>"Error",'status'=>0]);
            }else{
                if ($request->page != 0) {
                    $employee = new Employee();

                            $employee = $employee->leftJoin('branch','branch.id','=','employee.branch_id')
                                                 ->leftJoin('department','department.id','=','employee.dep_id')
                                                 ->leftJoin('position','position.id','=','employee.position_id')
                                                 ->leftJoin('nrccode','nrccode.id','=','employee.nrc_code')
                                                 ->leftJoin('nrcstate','nrcstate.id','=','employee.nrc_state')
                                                 ->leftJoin('hostel','hostel.id','=','employee.home_no')
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
                                                    'hostel.name AS hostel_name',
                                                    'employee.join_date'
                                                 );
                            if ($request->keyword != '') {
                                $employee = $employee->where('employee.name','like','%'.$request->keyword.'%')->orwhere('employee.phone_no','like','%'.$request->keyword.'%')->orwhere('emp_id','like','%'.$request->keyword.'%');
                            }
                            if ($request->branch_id != '') {
                                $employee = $employee->where('employee.branch_id',$request->branch_id);
                            }
                            if ($request->dept_id != '') {
                                
                                $employee = $employee->where('employee.dep_id',$request->dept_id);
                            }
                            if ($request->position_id != '') {
                                $employee = $employee->where('position_id',$request->position_id);
                            }

                            if ($request->gender != '') {
                                $employee = $employee->where('gender',$request->gender);
                            }

                            if ($request->ishostel != '') {
                                $employee = $employee->where('hostel',$request->ishostel);
                            }

                            $employee = $employee->orderBy('employee.emp_id','asc')->limit(10)->paginate(10);
                            return response(['employees' => $employee,'message'=>"Successfully login",'status'=>1]); 
                        }else{
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
                                                 );
                            if ($request->keyword != '') {
                                $employee = $employee->where('employee.name','like','%'.$request->keyword.'%')->orwhere('employee.phone_no','like','%'.$request->keyword.'%')->orwhere('emp_id','like','%'.$request->keyword.'%');
                            }
                            if ($request->branch_id != '') {
                                $employee = $employee->where('employee.branch_id',$request->branch_id);
                            }
                            if ($request->dept_id != '') {
                                $employee = $employee->where('employee.dep_id',$request->dept_id);
                            }
                            if ($request->position_id != '') {
                                $employee = $employee->where('position_id',$request->position_id);
                            }

                            if ($request->gender != '') {
                                $employee = $employee->where('gender',$request->gender);
                            }

                            if ($request->ishostel != '') {
                                $employee = $employee->where('hostel',$request->ishostel);
                            }
                            $employee = $employee->orderBy('employee.emp_id','asc')->get();
                            return response(['employees' => $employee,'message'=>"Successfully login",'status'=>1]); 
                }
            }

    }
}
