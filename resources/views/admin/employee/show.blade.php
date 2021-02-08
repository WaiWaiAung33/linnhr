
@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
 <script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
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
                        <td>Name<span style="padding-left: 200px">{{$employees->name}}</span></td>
                        
                    </tr>
                    <tr>
                        <td>Parent's Name<span style="padding-left: 150px">{{$employees->father_name}}</span></td>
                    </tr>
                    <tr>
                        <td>Date of birth<span style="padding-left: 160px">{{date('d-m-Y',strtotime($employees->date_of_birth))}}</span> <span>({{$workyearbirth}}) years</span></td>
                    </tr>
                    <tr>
                        <td>Full Nrc<span style="padding-left: 190px">{{$employees->fullnrc}}</span></td>
                    </tr>
                    <tr>
                        <td>Gender<span style="padding-left: 195px">{{$employees->gender}}</span></td>
                    </tr>
                      <tr>
                        <td>Marital Status<span style="padding-left: 155px">{{$employees->marrical_status}}</span></td>
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
      </div>

        <div class="col-md-6">
         <div class="table-responsive">
             <table class="table table-bordered styled-table">
                <thead>
                    <tr>
                        <th style="font-size: 16px"><i class="fa fa-address-card"> </i> Contact Information</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Phone<span style="padding-left: 165px">{{$employees->phone_no}}</span></td>
                        
                    </tr>
                    <tr>
                        <td>Parent's Phone<span style="padding-left: 110px">{{$employees->fPhone}}</span></td>
                    </tr>
                     <tr>
                        <td>Email <span style="padding-left: 165px">{{  $employees->email}} </span></td>
                    </tr>
                    <tr>
                        <td>City<span style="padding-left: 180px">{{$employees->city}}</span></td>
                    </tr>
                    <tr>
                        <td>Township<span style="padding-left: 145px">{{$employees->township}}</span></td>
                    </tr>
                    <tr>
                        <td>Address <span style="padding-left: 155px">{{  $employees->address}} </span></td>
                    </tr>
                   
                </tbody>
             </table>
             </div>
         
        </div>
      
     </div>

     <div class="row">
       <div class="col-md-6">
          <div class="table-responsive">
             <table class="table table-bordered styled-table">
                <thead>
                    <tr>
                        <th style="font-size: 16px"><i class="fa fa-university"> </i> Education Details</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Graduation<span style="padding-left: 165px">{{$employees->graduation}}</span></td>
                        
                    </tr>
                    <tr>
                        <td>University/College<span style="padding-left: 120px">{{$employees->qualification}}</span></td>
                    </tr>
                     <tr>
                        <td>Course Title <span style="padding-left: 150px">{{  $employees->course_title}} </span></td>
                    </tr>
                    <tr>
                        <td>Level<span style="padding-left: 195px">{{$employees->level}}</span></td>
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
                        <td>Department/Position<span style="padding-left: 90px">{{$employees->viewDepartment->name}}/{{$employees->viewPosition->name}}</span></td>
                        
                    </tr>
                   <!--  <tr>
                        <td>Position<span style="padding-left: 165px">{{$employees->viewPosition->name}}</span></td>
                    </tr> -->
                     <tr>
                        <td>Applied Date<span style="padding-left: 140px">{{  $employees->join_date}} </span></td>
                    </tr>
                    <tr>
                        <td>Expected Salary<span style="padding-left: 125px">{{$employees->exp_salary}}</span></td>
                    </tr>
                     <tr>
                        <td>Hostel<span style="padding-left: 180px">{{$employees->hostel}}</span></td>
                    </tr>
                   
                </tbody>
             </table>
             </div>
       </div>
     </div>

     <div class="row">
       <div class="col-md-6">
          <div class="table-responsive">
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
             </div>
               <div class="table-responsive">
             <table class="table table-bordered styled-table">
                <thead>
                    <tr>
                        <th style="font-size: 16px"><i class="fa fa-briefcase"> </i> Work Experience</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Company Name<span style="padding-left: 130px">{{$employees->exp_company}}</span></td>
                        
                    </tr>
                    <tr>
                        <td>Job Position<span style="padding-left: 150px">{{$employees->exp_position}}</span></td>
                    </tr>
                     <tr>
                        <td>Location<span style="padding-left: 173px">{{$employees->exp_location}}</span></td>
                    </tr>
                     <tr>
                        <td>Date<span style="padding-left: 195px">{{date('d-m-Y',strtotime($employees->exp_date_from))}} to {{date('d-m-Y',strtotime($employees->exp_date_to))}}</span></td>
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

