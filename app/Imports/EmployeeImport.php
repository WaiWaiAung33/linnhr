<?php

namespace App\Imports;

use App\Employee;
use App\NRCCode;
use App\NRCState;
use App\Branch;
use App\Department;
use App\Position;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
class EmployeeImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new Employee([
    //         'emp_id'     => $row[1],
    //         'emp_name'    => $row[2], 
    //         'branch' => $row[3],
    //         'dept' => $row[4]
    //     ]);
    // }
    public function collection(Collection $rows)
    {
      
        DB::beginTransaction();
        try {
                
                foreach ($rows as $row) 
                {
                     // dd($row);
                        $nrccodes = NRCCode::all();
                        foreach ($nrccodes as $key => $value) {
                            if($row['nrc_code'] == $value->name){
                                $nrcodeid = $value->id;
                                // dd($nrcodeid);
                            }
                        }
                        $nrcstates = NRCState::all();
                        foreach ($nrcstates as $key => $value) {
                           if ($row['nrc_state'] == $value->name) {
                               $nrcstateid = $value->id;
                           }
                        }

                        $branchs = Branch::all();
                        foreach ($branchs as $key => $value) {
                            if($row['branch'] == $value->name){
                                $branchid = $value->id;
                            }
                        }

                        $departments = Department::all();
                        foreach ($departments as $key => $value) {
                            if ($row['department'] == $value->name) {
                               $departmentid = $value->id;
                            }
                        }

                        $positions = Position::all();
                        foreach ($positions as $key => $value) {
                           if ($row['position'] == $value->name) {
                              $positionid = $value->id;
                           }
                        }


                        // dd($nrccodes);
                        // $nrccode = NRCCode::find($row['nrc_code']);
                        // dd($nrccode);
                        // $nrcstate = NRCState::find($row['nrc_state']);
                        $fullnrc = $row['nrc_code'].'/'.$row['nrc_state']."(".$row['nrc_status'].')'.$row['nrc'];
                    
                         $arr=[
                        'emp_id'=>$row['emp_id'],
                        'branch_id'=>$branchid,
                        'dep_id'=>$departmentid,
                        'position_id'=>$positionid,
                        'name'=> $row['name'],
                        'gender'=>$row['gender'],
                        'father_name'=>$row['father_name'],
                        'phone_no'=>$row['phone'],
                        'nrc_code'=>$nrcodeid,
                        'nrc_state'=>$nrcstateid,
                        'nrc_status'=>$row['nrc_status'],
                        'nrc'=>$row['nrc'],
                        'fullnrc'=>$fullnrc,
                        'date_of_birth'=>$row['dob'],
                        'join_date'=>$row['join_date'],
                        'address'=>$row['address'],
                        'city'=>$row['city'],
                        'township'=>$row['township'],
                        'qualification'=>$row['qualification']
                        ];
                       
                        Employee::create($arr);

                }
            DB::commit();
        }

        catch (Exception $e) {
              DB::rollback();
                return redirect()->route('employee.index')
                            ->with('error','Something wrong!');
         }
    }
}