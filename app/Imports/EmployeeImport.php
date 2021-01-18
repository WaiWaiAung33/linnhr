<?php

namespace App\Imports;

use App\Employee;
use App\NRCCode;
use App\NRCState;

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
                        $nrccode = NRCCode::find($row['nrc_code']);
                        $nrcstate = NRCState::find($row['nrc_state']);
                        $fullnrc = $nrccode->name.'/'.$nrcstate->name."(".$row['nrc_status'].')'.$row['nrc'];
                    
                         $arr=[
                        'emp_id'=>$row['emp_id'],
                        'branch_id'=>$row['branch'],
                        'dep_id'=>$row['department'],
                        'position_id'=>$row['position'],
                        'name'=> $row['name'],
                        'gender'=>$row['gender'],
                        'father_name'=>$row['father_name'],
                        'phone_no'=>$row['phone'],
                        'nrc_code'=>$row['nrc_code'],
                        'nrc_state'=>$row['nrc_state'],
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