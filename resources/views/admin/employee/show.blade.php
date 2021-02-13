
@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')

@stop

@section('content')

<?php 
  $currentyear = date('Y');
  $currentday = date('m');
  $creentmonth = date('d');
  // dd($creentmonth);
  $joinday = date('m',strtotime($employees->join_date));
  $joinyear = date('Y',strtotime($employees->join_date));
  $joinmonth = date('d',strtotime($employees->join_date));
  // dd($joinmonth);
  if($currentday < $joinday || $creentmonth < $joinmonth) {
    $work = $currentyear - $joinyear;
    $workyear = $work - 1;
  }else {
    $workyear = $currentyear - $joinyear;
  }
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
    $workyearbirth = $workbirth - 1;
  }else {
    $workyearbirth = $currentyearbirth - $joinyearbirth;
  }
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
 <!--  <h6 style="color: gray;padding-top: 10px" class="unicode">{{$employees->name}}</h6> -->

<!--  <div style="text-align: center;">
   @if($employees->photo == '')
  <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="180px" height="180px">
  @else
   <img src="{{ asset('uploads/employeePhoto/'.$employees->photo) }}" alt="photo" width="150px" height="150px">
   @endif

</div><br> -->
<!--   
<div>
  @if($employees->photo == '')
  <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
  @else
 <img src="{{ asset('uploads/employeePhoto/'.$employees->photo) }}" alt="photo" width="80px" height="80px">
 @endif
</div><br> -->

<div class="row">
 
    <div class="col-md-6">
    <div class="table-responsive">
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
                     <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="115px" height="115px">
                  </td>
                   
                    @else
                    <td style="text-align: center;" colspan ="2">
                       <img src="{{ asset('uploads/employeePhoto/'.$employees->photo) }}" alt="photo" width="115px" height="115px">
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
                    <td>Date of birth<span style="padding-left: 125px">{{date('d-m-Y',strtotime($employees->date_of_birth))}}</span> <span>({{$workyearbirth}}) years</span></td>
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
      <div class="table-responsive">
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
   
        <!--   <div class="table-responsive">
         <table class="table table-bordered styled-table">
            <thead>
                <tr>
                    <th style="font-size: 16px"><i class="fa fa-deaf"> </i> Skill</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Skill<span style="padding-left: 200px">{{$employees->skills}}</span></td>
                    
                </tr>
                <tr>
                    <td>Skill proficiency<span style="padding-left: 130px">{{$employees->proficiency}}</span></td>
                </tr>
               
            </tbody>
         </table>
         </div> -->
           <div class="table-responsive">
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
  </div>

    <div class="col-md-6">

        <div class="table-responsive">
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
                    <td>Join Date<span style="padding-left: 150px">{{  $employees->join_date}} ({{$workyear}})years </span></td>
                </tr>
                  <tr>
                    <td>isHostel<span style="padding-left: 160px">{{$employees->hostel ? $employees->hostel : "-"}}</span></td>
                </tr>
                <tr>
                    <td>Location<span style="padding-left: 155px">{{  $employees->hostel_location ? $employees->hostel_location : "-"}} </span></td>
                </tr>
                 <tr>
                    <td>Room No<span style="padding-left: 150px">{{  $employees->room_no ? $employees->room_no : "-"}}</span></td>
                </tr>
                 <tr>
                    <td>Home No<span style="padding-left: 150px">{{  $employees->home_no ? $employees->home_no : "-"}} </span></td>
                </tr>
                 <tr>
                    <td>Start Date<span style="padding-left: 145px">{{  $employees->hostel_sdate ? $employees->hostel_sdate : "-"}} </span></td>
                </tr>
                
                <tr>
                    <td>Expected Salary<span style="padding-left: 110px">{{$employees->exp_salary ? $employees->exp_salary : "-"}}</span></td>
                </tr>
               
               
            </tbody>
         </table>
         </div>
   
        <div class="table-responsive">
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
          <div class="table-responsive">
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

