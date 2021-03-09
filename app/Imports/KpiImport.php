<?php

namespace App\Imports;

use App\Employee;
use App\KPI;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
class KpiImport implements ToCollection,WithHeadingRow
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
                       $employees = Employee::all();
                        foreach ($employees as $key => $value) {
                            if($row['employee_id'] == $value->emp_id){
                               $employeeid = $value->id;
                                // dd( $value->id);
                            }
                        }

                        

                        $kpis = KPI::where('emp_id',$employeeid)->where('month',$row['month'])->where('year', $row['year'])->get();
                         $totalpoint = 0;
                         $totalpoint = $row['knowledge'] + $row['descipline'] + $row['skill_set'] + $row['teamwork'] + $row['social'] + $row['motivation']; 
                        // dd($kpis->count());


                        if ($kpis->count()>0) {
                             return redirect()->route('kpi.index')->with('success','KPI exist');
                        }else{

                              $arr=[
                                        'emp_id'=>$employeeid,
                                        'knowledge'=>$row['knowledge'],
                                        'descipline'=>$row['descipline'],
                                        'skill_set'=>$row['skill_set'],
                                        'team_work'=>$row['teamwork'],
                                        'social'=>$row['social'],
                                        'motivation'=>$row['motivation'],
                                        'total'=>$totalpoint,
                                        'month'=>$row['month'],
                                        'year'=>$row['year'],
                                        'comment'=>$row['comment']
                                        ];
                                       
                                KPI::create($arr);
                          
                        }
                }
            DB::commit();
        }

        catch (Exception $e) {
              DB::rollback();
                return redirect()->route('kpi.index')
                            ->with('error','Something wrong!');
         }
    }
}