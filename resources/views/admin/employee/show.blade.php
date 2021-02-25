
@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<style type="text/css">
  .active{background-color:green;}
</style>
@stop

@section('content')

<?php 
  $current_year = date('Y');
  $current_month = date('m');
  $current_day = date('d');
  // dd($creentmonth);
  $joinday = date('d',strtotime($employees->join_date));
  $joinmonth = date('m',strtotime($employees->join_date));
  $joinyear = date('Y',strtotime($employees->join_date));

  if($current_day < $joinday || $current_month < $joinmonth) {
    $work = $current_year - $joinyear;
    $workyear = $work;
  }else {
    $workyear = $current_year - $joinyear;
  }

  $date1 =date('Y-d-m',strtotime($employees->join_date));

  $date2 = date('Y-m-d');

  $diff = abs(strtotime($date2) - strtotime($date1));

  $years = floor($diff / (365*60*60*24));
  $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
  $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
?>

<?php 
  $currentyearbirth = date('Y');
  $currentdaybitrh = date('m');
  $currentmonthbirth = date('d');
  $joindaybirth = date('m',strtotime($employees->date_of_birth));
  $joinyearbirth = date('Y',strtotime($employees->date_of_birth));
  $joinmonthbirth = date('d',strtotime($employees->date_of_birth));
  if($currentdaybitrh < $joindaybirth || $currentmonthbirth < $joinmonthbirth) {
    $workbirth = $currentyearbirth - $joinyearbirth;
    $workyearbirth = $workbirth ;
  }else {
    $workyearbirth = $currentyearbirth - $joinyearbirth;
  }
?>

 <?php
    $salary_total = 0;
    $bonus_total = 0;
 ?>

<div class="row">
    <div class="col-lg-10">
         <a class="btn btn-success unicode" href="{{route('employee.index')}}"> Back</a>
    </div>
    <div class="col-lg-2">
        <div class="pull-right">
          <form action="{{route('employee.destroy',$employees->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')

                            <a class="btn btn-sm btn-primary" href="{{route('employee.edit',$employees->id)}}"><i class="fa fa-fw fa-edit" /></i></a>

                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
          </form>
        </div>
    </div>
</div><br>
 
 <div class="row">
   <div class="col-md-3">
                @if($employees->photo == '')
                  <div style="text-align: center;">
                     <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" style="width: 20% !important">
                  </div>
                   
                    @else
                    <div style="text-align: center;">
                       <img src="{{ asset('uploads/employeePhoto/'.$employees->photo) }}" alt="photo" width="100px" height="100px">
                    </div>
                  
                   @endif
                  <div style="text-align: center;">
                   <h6 style="margin-top: 10px">{{$employees->emp_id ? $employees->emp_id : "-"}}</h6>
                   <h6>{{$employees->name ? $employees->name : "-" }}</h6>
                   </div>
                   <div style="text-align: center;margin-top:20px">
                    <a id="personal" style="color: white;padding-left: 65px;padding-right: 65px;border-width: 1px solid;padding-top: 5px;padding-bottom: 5px;border-radius: 5px">Personal Data</a>

                    <!--  <p style="margin-left: 100px;padding: 10px;margin-right: 100px;">Personal Data</p> -->
                   </div>
                    <div style="text-align: center;margin-top: 20px">
                    <a id="contact" style="color: white;padding-left: 85px;padding-right: 85px;padding-top: 5px;padding-bottom: 5px;border-radius: 5px">Contact</a>
                    
                    <!--  <p style="margin-left: 100px;padding: 10px;margin-right: 100px;">Personal Data</p> -->
                   </div>

                   

                    <div style="text-align: center;margin-top: 20px">
                    <a id="employement" style="color: white;padding-left: 65px;padding-right: 65px;padding-top: 5px;padding-bottom: 5px;border-radius: 5px">Employement</a>
                    
                    <!--  <p style="margin-left: 100px;padding: 20px;margin-right: 100px;">Personal Data</p> -->
                   </div>

                    <div style="text-align: center;margin-top: 20px">
                    <a id="salary" style="color: white;padding-left: 90px;padding-right: 90px;padding-top: 5px;padding-bottom: 5px;border-radius: 5px">Salary</a>
                    
                    <!--  <p style="margin-left: 100px;padding: 20px;margin-right: 100px;">Personal Data</p> -->
                   </div>

                    <div style="text-align: center;margin-top: 20px">
                    <a id="education" style="color: white;padding-left: 53px;padding-right: 53px;padding-top: 5px;padding-bottom: 5px;border-radius: 5px">Education Details</a>
                    
                    <!--  <p style="margin-left: 100px;padding: 20px;margin-right: 100px;">Personal Data</p> -->
                   </div>

                   <div style="text-align: center;margin-top: 20px">
                    <a id="work" style="color: white;padding-left: 58px;padding-right: 58px;padding-top: 5px;padding-bottom: 5px;border-radius: 5px">Work Experience</a>
                    
                    <!--  <p style="margin-left: 100px;padding: 20px;margin-right: 100px;">Personal Data</p> -->
                   </div>

                   <div style="text-align: center;margin-top: 20px">
                    <a id="attach" style="color: white;padding-left: 77px;padding-right: 77px;padding-top: 5px;padding-bottom: 5px;border-radius: 5px">Attach File</a>
                    
                    <!--  <p style="margin-left: 100px;padding: 10px;margin-right: 100px;">Personal Data</p> -->
                   </div>
   </div>

   <div class="col-md-9">
   
        <div class="table-responsive" id="personal_table">
         <table class="table table-bordered styled-table unicode">
            <thead>
                <tr>
                    <th style="font-size: 16px"><i class="fa fa-address-book" ></i> Personal Data</th>
                    
                </tr>
            </thead>
            <tbody>
              <tr>
                  @if($employees->photo == '')
                  <td style="text-align: center;" colspan ="2">
                     <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" style="width: 20% !important">
                  </td>
                   
                    @else
                    <td style="text-align: center;" colspan ="2">
                       <img src="{{ asset('uploads/employeePhoto/'.$employees->photo) }}" alt="photo" style="width: 20% !important">
                    </td>
                  
                   @endif
              </tr>
               
                <tr>
                    <td>Name<span style="padding-left: 165px">{{$employees->name ? $employees->name : "-" }}</span></td>
                    
                </tr>
                <tr>
                    <td>Parent's Name<span style="padding-left: 115px">{{$employees->father_name ? $employees->father_name : "-"}}</span></td>
                </tr>
                <tr>
                    <td>Date of birth<span style="padding-left: 125px">{{date('d-m-Y',strtotime($employees->date_of_birth))}}</span> <span>({{ Carbon\Carbon::parse($employees->date_of_birth)->age + 1 }}) years</span></td>
                </tr>
                <tr>
                    <td>Full Nrc<span style="padding-left: 155px">{{$employees->fullnrc ? $employees->fullnrc : "-"}}</span></td>
                </tr>
                <tr>
                    <td>Gender<span style="padding-left: 160px">{{$employees->gender ? $employees->gender : "-"}}</span></td>
                </tr>
                  <tr>
                    <td>Marital Status<span style="padding-left: 120px">{{$employees->marrical_status ? $employees->marrical_status : "-"}}</span></td>
                </tr>
                 <tr>
                    <td>Race<span style="padding-left: 175px">{{$employees->race ? $employees->race : "-"}}</span></td>
                </tr>
                 <tr>
                    <td>Religion<span style="padding-left: 155px">{{$employees->religion ? $employees->religion : "-"}}</span></td>
                </tr>
               <!--  <tr>
                    <td>Phone <span style="padding-left: 195px">{{$employees->phone_no}}</span></td>
                </tr> -->
               <!--  <tr>
                    <td>Address<span style="padding-left: 190px">{{$employees->address}}</span></td>
                </tr> -->
            </tbody>
         </table>
      </div>

        <div class="table-responsive" id="contact_table">
         <table class="table table-bordered styled-table">
            <thead>
                <tr>
                    <th style="font-size: 16px"><i class="fa fa-address-card"> </i> Contact Information</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Phone<span style="padding-left: 165px">{{$employees->phone_no ? $employees->phone_no : "-"}}</span></td>
                    
                </tr>
                <tr>
                    <td>Parent's Phone<span style="padding-left: 110px">{{$employees->fPhone ? $employees->fPhone : "-"}}</span></td>
                </tr>
                 <tr>
                    <td>Email <span style="padding-left: 165px">{{  $employees->email ? $employees->email : "-"}} </span></td>
                </tr>
                <tr>
                    <td>City<span style="padding-left: 180px">{{$employees->city ? $employees->city : "-"}}</span></td>
                </tr>
                <tr>
                    <td>Township<span style="padding-left: 145px">{{$employees->township ? $employees->township : "-"}}</span></td>
                </tr>
                <tr>
                    <td>Address <span style="padding-left: 155px">{{  $employees->address ? $employees->address : "-"}} </span></td>
                </tr>
               
            </tbody>
         </table>
         </div>

         <div class="table-responsive" style="font-size:15px;" id="salary_table">
          <table class="table table-bordered styled-table">


            <thead>
              <tr>
                <th>Year</th>
                <th>Month</th>
                <th >Salary</th>
                <th style="width: 250px">Bonus</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if($salary_count > 0)
              @foreach($salarys as $salary)
              @if($salary->emp_id == $employees->id)
              <tr>
                <td>{{$salary->year}}</td>
                <td>{{$salary->pay_date}}</td>
                <td>{{number_format($salary->salary_amt)}}</td>
                <td>{{number_format($salary->bonus)}}</td>
                <td>{{number_format($salary->month_total)}}</td>
                <?php
                  $salary_total+= $salary->salary_amt;
                  $bonus_total+= $salary->bonus;
                ?>
                
                   <td>
                          <form action="{{route('salary.destroy',$salary->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-sm btn-primary" href="{{route('salary.edit',$salary->id)}}" ><i class="fa fa-fw fa-edit" style="padding-top: 5px;padding-bottom: 5px;padding-left: 2px;padding-right: 5px"/></i></a> 
                             <button type="submit" class="btn btn-sm btn-danger" style="margin-left: 10px"><i class="fa fa-fw fa-trash" /></i></button> 
                           </form>
                        </td>
               
              </tr>
             
              @endif
              @endforeach
              @endif
               <tr style=" background-color: #c7d4dd;">
                <td colspan="2">Month Total</td>
                <td>{{number_format($salary_total)}}</td>
                <td>{{number_format($bonus_total)}}</td>
                <?php
                $total = 0;
                $total = $salary_total + $bonus_total;
                ?>
                <td colspan="2">{{number_format($total)}}</td>
              </tr>
            </tbody>

          
          </table>

        </div>


          <div class="table-responsive" id="employement_table">
         <table class="table table-bordered styled-table">
            <thead>
                <tr>
                    <th style="font-size: 16px"><i class="fa fa-briefcase"> </i> Employement</th>
                    
                </tr>
            </thead>
            <tbody>
               <tr>
                    <td>Employee Id<span style="padding-left: 130px">{{$employees->emp_id ? $employees->emp_id : "-"}}</span></td>
                    
                </tr>
                <tr>
                    <td>Rank<span style="padding-left: 175px">{{$employees->viewPosition->name ? $employees->viewPosition->name : "-"}}</span></td>
                    
                </tr>
                <tr>
                    <td>Department<span style="padding-left: 135px">{{$employees->viewDepartment->name ? $employees->viewDepartment->name : "-"}}</span></td>
                </tr>
                 <tr>
                    <td>Branch<span style="padding-left: 165px">{{$employees->ViewBranch->name ? $employees->ViewBranch->name : "-"}}</span></td>
                </tr>
                 <tr>
                     @php  
                      $d1 = new DateTime(date('Y-m-d',strtotime($employees->join_date)));
                      $d2 = new DateTime(date("Y-m-d"));
                      $interval = $d1->diff($d2);
                      $format = $interval->format('%yY, %mM,%d D');

                    @endphp
                              <!--  ({{ $format }}) -->
                    <td>Join Date<span style="padding-left: 150px">{{ date("d-m-Y",strtotime($employees->join_date)) }} ({{ $format }})</td>
                </tr>
                  <tr>
                    <td>isHostel<span style="padding-left: 160px">{{$employees->hostel ? $employees->hostel : "-"}}</span></td>
                </tr>
                
                 <tr>
                    <td>Hostel Home<span style="padding-left: 130px">{{$employees->viewHostel ? $employees->viewHostel->name : '-' }} </span></td>
                </tr>
                <tr>
                    <td>Full Address<span style="padding-left: 135px">{{  $employees->hostel_location ? $employees->hostel_location : "-"}} </span></td>
                </tr>
                 <tr>
                    <td>Room No<span style="padding-left: 150px">{{  $employees->viewRoom ? $employees->viewRoom->room_no : "-"}}</span></td>
                </tr>
                 <tr>
                    <td>Start Date<span style="padding-left: 145px">{{  $employees->hostel_sdate ? $employees->hostel_sdate : "-"}} </span></td>
                </tr>
                
                <tr>
                    <td>Expected Salary<span style="padding-left: 110px">{{$employees->exp_salary ? $employees->exp_salary : "-"}}</span></td>
                </tr>

                 <tr>
                    <td>Employment Type<span style="padding-left: 90px">
                      @if($employees->employment_type == '1')
                      New
                      @elseif($employees->employment_type == '2')
                      Rejoin
                      @elseif($employees->employment_type == '3')
                      On Join Training
                      @elseif($employees->employment_type == '4')
                      Probation
                      @elseif($employees->employment_type == '5')
                      Permanent
                      @endif
                    </span></td>
                </tr>
               
               
            </tbody>
         </table>
         </div>

          <div class="table-responsive" id="education_table">
         <table class="table table-bordered styled-table">
            <thead>
                <tr>
                    <th style="font-size: 16px"><i class="fa fa-university"> </i> Education Details</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Graduation<span style="padding-left: 145px">{{$employees->graduation ? $employees->graduation : "-"}}</span></td>
                    
                </tr>
                <tr>
                    <td>University/College<span style="padding-left: 100px">{{$employees->qualification ? $employees->qualification : "-"}}</span></td>
                </tr>
                 <tr>
                    <td>Course Title <span style="padding-left: 135px">{{  $employees->course_title ? $employees->course_title : "-"}} </span></td>
                </tr>
                <tr>
                    <td>Level<span style="padding-left: 180px">{{$employees->level ? $employees->level : "-"}}</span></td>
                </tr>
                 <tr>
                    <td>Skill<span style="padding-left: 190px">{{$employees->skills ? $employees->skills : "-"}}</span></td>
                    
                </tr>
                <tr>
                    <td>Skill proficiency<span style="padding-left: 120px">{{$employees->proficiency ? $employees->proficiency : "-"}}</span></td>
                </tr>
               
            </tbody>
         </table>
         </div>
        

         <div class="table-responsive" id="work_table">
         <table class="table table-bordered styled-table">
            <thead>
                <tr>
                    <th style="font-size: 16px"><i class="fa fa-briefcase"> </i> Work Experience</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Company Name<span style="padding-left: 110px">{{$employees->exp_company ? $employees->exp_company : "-"}}</span></td>
                    
                </tr>
                <tr>
                    <td>Job Position<span style="padding-left: 130px">{{$employees->exp_position ? $employees->exp_position : "-"}}</span></td>
                </tr>
                 <tr>
                    <td>Location<span style="padding-left: 155px">{{$employees->exp_location ? $employees->exp_location : "-"}}</span></td>
                </tr>
                 <tr>
                    <td>Date<span style="padding-left: 178px">{{$employees->exp_date_from ? date('d-m-Y',strtotime($employees->exp_date_from)) : "-"}} to {{$employees->exp_date_to ? date('d-m-Y',strtotime($employees->exp_date_to)) : ""}}</span></td>
                </tr>
               
            </tbody>
         </table>
   </div>


    <div class="table-responsive" id="attachfile_table">
         <table class="table table-bordered styled-table">
            <thead>
                <tr>
                    <th style="font-size: 16px"><i class="fa fa-file"> </i> Attach File</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="{{ url('uploads/attachfile/'.$employees->cvfile) }}" target="_blank">{{$employees->cvfile}}</a><span style="padding-left: 165px">   

                       <img src="{{asset('uploads/wardrecoPhoto/'.$employees->ward_reco) }}" alt="photo" width="130px" height="130px">
                     </span></td>
                     </tr>
                     <tr>
                       <td style="width: 100%"> <span ><img src="{{ asset('uploads/policestationrecomPhoto/'.$employees->police_reco) }}" alt="photo" width="130px" height="130px"></span> <span style="padding-left: 100px">   

                       <img src="{{ asset('uploads/attachfile/'.$employees->otherfile) }}" alt="photo" width="130px" height="130px">
                     </span></td>
                    </tr>
               
               
            </tbody>
         </table>
         </div>
   

   </div>
 </div>

 @stop 

@section('js')
<script type="text/javascript">
  $("#contact_table").hide();
  $("#education_table").hide();
  $("#employement_table").hide();
  $("#work_table").hide();
  $("#attachfile_table").hide();
  $("#salary_table").hide();

  $("#personal").css('color', '#2a3c66'); 
  $("#personal").css('border', '1px solid'); 
  $("#personal").css('border-color', '#2a3c66');

  $("#contact").css('color', 'white'); 
  $("#contact").css('background-color', '#2a3c66'); 

  $("#education").css('color', 'white'); 
  $("#education").css('background-color', '#2a3c66'); 

  $("#work").css('color', 'white'); 
  $("#work").css('background-color', '#2a3c66'); 

  $("#attach").css('color', 'white'); 
  $("#attach").css('background-color', '#2a3c66'); 

  $("#employement").css('color', 'white'); 
  $("#employement").css('background-color', '#2a3c66'); 

  $("#salary").css('color', 'white'); 
  $("#salary").css('background-color', '#2a3c66'); 

  $("#contact").click(function(){
      $("#contact_table").show();
      $("#education_table").hide();
      $("#employement_table").hide();
      $("#work_table").hide();
      $("#attachfile_table").hide();
      $("#personal_table").hide();
      $("#salary_table").hide();

      $("#contact").css('color', '#2a3c66'); 
      $("#contact").css('border', '1px solid'); 
      $("#contact").css('border-color', '#2a3c66');
      $("#contact").css('background-color', 'white');

      $("#personal").css('color', 'white'); 
      $("#personal").css('background-color', '#2a3c66'); 

      $("#education").css('color', 'white'); 
      $("#education").css('background-color', '#2a3c66'); 

      $("#work").css('color', 'white'); 
      $("#work").css('background-color', '#2a3c66'); 

      $("#attach").css('color', 'white'); 
      $("#attach").css('background-color', '#2a3c66'); 

      $("#employement").css('color', 'white'); 
      $("#employement").css('background-color', '#2a3c66'); 

      $("#salary").css('color', 'white'); 
      $("#salary").css('background-color', '#2a3c66'); 
  });

   $("#personal").click(function(){
      $("#personal_table").show();
      $("#contact_table").hide();
      $("#education_table").hide();
      $("#employement_table").hide();
      $("#work_table").hide();
      $("#attachfile_table").hide();
      $("#salary_table").hide();

      $("#personal").css('color', '#2a3c66'); 
      $("#personal").css('border', '1px solid'); 
      $("#personal").css('border-color', '#2a3c66');
      $("#personal").css('background-color', 'white');

      $("#contact").css('color', 'white'); 
      $("#contact").css('background-color', '#2a3c66'); 

      $("#education").css('color', 'white'); 
      $("#education").css('background-color', '#2a3c66'); 

      $("#work").css('color', 'white'); 
      $("#work").css('background-color', '#2a3c66'); 

      $("#attach").css('color', 'white'); 
      $("#attach").css('background-color', '#2a3c66'); 

      $("#employement").css('color', 'white'); 
      $("#employement").css('background-color', '#2a3c66'); 

      $("#salary").css('color', 'white'); 
      $("#salary").css('background-color', '#2a3c66'); 
  });

   $("#education").click(function(){
      $("#personal_table").hide();
      $("#contact_table").hide();
      $("#education_table").show();
      $("#employement_table").hide();
      $("#work_table").hide();
      $("#attachfile_table").hide();
      $("#salary_table").hide();

      $("#education").css('color', '#2a3c66'); 
      $("#education").css('border', '1px solid'); 
      $("#education").css('border-color', '#2a3c66');
      $("#education").css('background-color', 'white');

      $("#contact").css('color', 'white'); 
      $("#contact").css('background-color', '#2a3c66'); 

      $("#personal").css('color', 'white'); 
      $("#personal").css('background-color', '#2a3c66'); 

      $("#work").css('color', 'white'); 
      $("#work").css('background-color', '#2a3c66'); 

      $("#attach").css('color', 'white'); 
      $("#attach").css('background-color', '#2a3c66'); 

      $("#employement").css('color', 'white'); 
      $("#employement").css('background-color', '#2a3c66'); 

      $("#salary").css('color', 'white'); 
      $("#salary").css('background-color', '#2a3c66'); 
  });

   $("#work").click(function(){
      $("#personal_table").hide();
      $("#contact_table").hide();
      $("#education_table").hide();
      $("#employement_table").hide();
      $("#work_table").show();
      $("#attachfile_table").hide();
      $("#salary_table").hide();

      $("#work").css('color', '#2a3c66'); 
      $("#work").css('border', '1px solid'); 
      $("#work").css('border-color', '#2a3c66');
      $("#work").css('background-color', 'white');

      $("#contact").css('color', 'white'); 
      $("#contact").css('background-color', '#2a3c66'); 

      $("#education").css('color', 'white'); 
      $("#education").css('background-color', '#2a3c66'); 

      $("#personal").css('color', 'white'); 
      $("#personal").css('background-color', '#2a3c66'); 

      $("#attach").css('color', 'white'); 
      $("#attach").css('background-color', '#2a3c66'); 

      $("#employement").css('color', 'white'); 
      $("#employement").css('background-color', '#2a3c66'); 

      $("#salary").css('color', 'white'); 
      $("#salary").css('background-color', '#2a3c66'); 
  });

    $("#employement").click(function(){
      $("#personal_table").hide();
      $("#contact_table").hide();
      $("#education_table").hide();
      $("#employement_table").show();
      $("#work_table").hide();
      $("#attachfile_table").hide();
      $("#salary_table").hide();

       $("#employement").css('color', '#2a3c66'); 
      $("#employement").css('border', '1px solid'); 
      $("#employement").css('border-color', '#2a3c66');
      $("#employement").css('background-color', 'white');

      $("#contact").css('color', 'white'); 
      $("#contact").css('background-color', '#2a3c66'); 

      $("#education").css('color', 'white'); 
      $("#education").css('background-color', '#2a3c66'); 

      $("#work").css('color', 'white'); 
      $("#work").css('background-color', '#2a3c66'); 

      $("#attach").css('color', 'white'); 
      $("#attach").css('background-color', '#2a3c66'); 

      $("#personal").css('color', 'white'); 
      $("#personal").css('background-color', '#2a3c66'); 

      $("#salary").css('color', 'white'); 
      $("#salary").css('background-color', '#2a3c66'); 
  });

     $("#attach").click(function(){
      $("#personal_table").hide();
      $("#contact_table").hide();
      $("#education_table").hide();
      $("#employement_table").hide();
      $("#work_table").hide();
      $("#attachfile_table").show();
      $("#salary_table").hide();

      $("#attach").css('color', '#2a3c66'); 
      $("#attach").css('border', '1px solid'); 
      $("#attach").css('border-color', '#2a3c66');
      $("#attach").css('background-color', 'white');

      $("#contact").css('color', 'white'); 
      $("#contact").css('background-color', '#2a3c66'); 

      $("#education").css('color', 'white'); 
      $("#education").css('background-color', '#2a3c66'); 

      $("#work").css('color', 'white'); 
      $("#work").css('background-color', '#2a3c66'); 

      $("#personal").css('color', 'white'); 
      $("#personal").css('background-color', '#2a3c66'); 

      $("#employement").css('color', 'white'); 
      $("#employement").css('background-color', '#2a3c66'); 

      $("#salary").css('color', 'white'); 
      $("#salary").css('background-color', '#2a3c66'); 
  });

      $("#salary").click(function(){
      $("#personal_table").hide();
      $("#contact_table").hide();
      $("#education_table").hide();
      $("#employement_table").hide();
      $("#work_table").hide();
      $("#attachfile_table").hide();
      $("#salary_table").show();

      $("#salary").css('color', '#2a3c66'); 
      $("#salary").css('border', '1px solid'); 
      $("#salary").css('border-color', '#2a3c66');
      $("#salary").css('background-color', 'white');

      $("#contact").css('color', 'white'); 
      $("#contact").css('background-color', '#2a3c66'); 

      $("#education").css('color', 'white'); 
      $("#education").css('background-color', '#2a3c66'); 

      $("#work").css('color', 'white'); 
      $("#work").css('background-color', '#2a3c66'); 

      $("#personal").css('color', 'white'); 
      $("#personal").css('background-color', '#2a3c66'); 

      $("#employement").css('color', 'white'); 
      $("#employement").css('background-color', '#2a3c66'); 

      $("#attach").css('color', 'white'); 
      $("#attach").css('background-color', '#2a3c66'); 
  });


</script>
@stop

