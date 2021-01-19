<?php

namespace App\Exports;

use App\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EmployeeExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    { 
        $employee = new Employee();
       
    	$branch_id = (!empty($_POST['branch_id']))?$_POST['branch_id']:'';
        $dep_id = (!empty($_POST['dep_id']))?$_POST['dep_id']:'';
        $position_id = (!empty($_POST['position_id']))?$_POST['position_id']:'';

        $employee = $employee->leftjoin('department','department.id','=','employee.dep_id')->leftjoin('branch','branch.id','=','employee.branch_id')->leftjoin('position','position.id','=','employee.position_id');

        if($branch_id!=''){
            $employee = $employee->where('employee.branch_id',$branch_id);
        }

        if($dep_id!=''){
            $employee = $employee->where('employee.dep_id',$dep_id);
        }

        if($position_id!=''){
            $employee = $employee->where('employee.position_id',$position_id);
        }

        $employees =$employee->select(
                           'employee.emp_id',
                           'employee.name',
                           'employee.father_name',
                           'employee.date_of_birth',
                           'position.name AS positon_name',
                           'department.name AS department_name',
                           'branch.name AS branch_name',
                           'employee.join_date',
                           'employee.phone_no',
                           'employee.address'
                           )->get();
        // dd($items->get());
        return $employees;
    }

    public function headings(): array
    {
        return [
            "Employee Id",
            'Name',
            'Father Name',
            'DOB',
            'Rank',
            'Department',
            'Branch',
            'Join_Date',
            'Phone',
            'Address'
           
        ];
    }
}