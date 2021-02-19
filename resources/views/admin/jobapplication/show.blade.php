
@extends('adminlte::page')

@section('title', 'jobapplication')

@section('content_header')
<script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>

@stop

@section('content')
   

<form action="#" method="POST" class="form-horizontal" enctype="multipart/form-data">
@csrf
@method('post')
<div class="row">
        <div class="col-lg-10">
             <a class="btn btn-success unicode" href="{{route('jobapplication.index')}}"> Back</a>
        </div>

        @if($jobapplications->status == 0)
         <div>
            <button type="submit" class="btn btn-sm btn-primary" style="'float: left;">Call Interview</button>
         </div>
        @endif
        
</div><br>


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
                           @if($jobapplications->photo == '')
                          <td style="text-align: center;" colspan ="2">
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="180px" height="180px">
                          </td>
                           
                            @else
                            <td style="text-align: center;" colspan ="2">
                                 <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->photo) }}" alt="photo" width="130px" height="130px">
                            </td>
                          
                           @endif
                        </tr>

                         <tr>
                            <td>Name<span style="padding-left: 165px">{{$jobapplications->name ? $jobapplications->name : "-" }}</span></td>
                            
                        </tr>
                         <tr>
                            <td>Parent's Name<span style="padding-left: 115px">{{$jobapplications->fName ? $jobapplications->fName : "-"}}</span></td>
                        </tr>
                         <tr>
                            <td>Date of birth<span style="padding-left: 125px">{{date('d-m-Y',strtotime($jobapplications->dob))}}</span> 
                            </td>
                        </tr>
                         <tr>
                            <td>Full Nrc<span style="padding-left: 155px">{{$jobapplications->fullnrc ? $jobapplications->fullnrc : "-"}}</span></td>
                        </tr>
                         <tr>
                            <td>Gender<span style="padding-left: 160px">{{$jobapplications->gender ? $jobapplications->gender : "-"}}</span></td>
                        </tr>
                         <tr>
                            <td>Marital Status<span style="padding-left: 120px">{{$jobapplications->marrical_status ? $jobapplications->marrical_status : "-"}}</span></td>
                        </tr>
                         <tr>
                            <td>Religion<span style="padding-left: 155px">{{$jobapplications->religion ? $jobapplications->religion : "-"}}</span></td>
                        </tr>
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
                            <td>Phone<span style="padding-left: 165px">{{$jobapplications->phone ? $jobapplications->phone : "-"}}</span></td>
                            
                        </tr>
                        <tr>
                            <td>Parent's Phone<span style="padding-left: 110px">{{$jobapplications->fPhone ? $jobapplications->fPhone : "-"}}</span></td>
                        </tr>
                         <tr>
                            <td>Email <span style="padding-left: 165px">{{  $jobapplications->email ? $jobapplications->email : "-"}} </span></td>
                        </tr>
                        <tr>
                            <td>City<span style="padding-left: 180px">{{$jobapplications->city ? $jobapplications->city : "-"}}</span></td>
                        </tr>
                        <tr>
                            <td>Township<span style="padding-left: 145px">{{$jobapplications->township ? $jobapplications->township : "-"}}</span></td>
                        </tr>
                        <tr>
                            <td>Address <span style="padding-left: 155px">{{  $jobapplications->address ? $jobapplications->address : "-"}} </span></td>
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
                                <td>Company Name<span style="padding-left: 110px">{{$jobapplications->exp_company ? $jobapplications->exp_company : "-"}}</span></td>
                                
                            </tr>
                            <tr>
                                <td>Job Position<span style="padding-left: 130px">{{$jobapplications->exp_position ? $jobapplications->exp_position : "-"}}</span></td>
                            </tr>
                             <tr>
                                <td>Location<span style="padding-left: 155px">{{$jobapplications->exp_location ? $jobapplications->exp_location : "-"}}</span></td>
                            </tr>
                             <tr>
                                <td>Date<span style="padding-left: 178px">{{$jobapplications->exp_date_from ? date('d-m-Y',strtotime($jobapplications->exp_date_from)) : "-"}} to {{$jobapplications->exp_date_to ? date('d-m-Y',strtotime($jobapplications->exp_date_to)) : ""}}</span></td>
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
                                <td>Rank<span style="padding-left: 175px">{{$jobapplications->job ? $jobapplications->job : "-"}}</span></td>
                                
                            </tr>
                            <tr>
                                <td>Department<span style="padding-left: 135px">{{$jobapplications->department ? $jobapplications->department : "-"}}</span></td>
                            </tr>
                           
                            
                              <tr>
                                <td>isHostel<span style="padding-left: 160px">{{$jobapplications->hostel ? $jobapplications->hostel : "-"}}</span></td>
                            </tr>

                             <tr>
                                <td>Applied Date<span style="padding-left: 130px">{{$jobapplications->applied_date ? date('d-m-Y',strtotime($jobapplications->applied_date)) : "-"}}</span></td>
                            </tr>

                             <tr>
                                <td>Expected Salary<span style="padding-left: 110px">{{$jobapplications->exp_salary ? $jobapplications->exp_salary : "-"}}</span></td>
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
                                <td>Graduation<span style="padding-left: 145px">{{$jobapplications->graduation ? $jobapplications->graduation : "-"}}</span></td>
                                
                            </tr>
                            <tr>
                                <td>University/College<span style="padding-left: 100px">{{$jobapplications->edu ? $jobapplications->edu : "-"}}</span></td>
                            </tr>
                             <tr>
                                <td>Course Title <span style="padding-left: 135px">{{  $jobapplications->course_title ? $jobapplications->course_title : "-"}} </span></td>
                            </tr>
                            <tr>
                                <td>Level<span style="padding-left: 180px">{{$jobapplications->level ? $jobapplications->level : "-"}}</span></td>
                            </tr>
                             <tr>
                                <td>Skill<span style="padding-left: 190px">{{$jobapplications->skills ? $jobapplications->skills : "-"}}</span></td>
                                
                            </tr>
                            <tr>
                                <td>Skill proficiency<span style="padding-left: 120px">{{$jobapplications->proficiency ? $jobapplications->proficiency : "-"}}</span></td>
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
                                <td><a href="{{ url('uploads/jobapplicationPhoto/'.$jobapplications->cvfile) }}" target="_blank">{{$jobapplications->cvfile}}</a><span style="padding-left: 165px">   

                                      
                                         <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->ward_reco) }}" alt="photo" width="130px" height="130px">
                                        
                                 </span></td>
                                 </tr>
                                 <tr>
                                   <td style="width: 100%"> <span > <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->police_reco) }}" alt="photo" width="130px" height="130px"></span> <span style="padding-left: 100px">   

                                  <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->otherfile) }}" alt="photo" width="130px" height="130px">
                                 </span></td>
                                </tr>
                           
                           
                        </tbody>
                     </table>
                     </div>

              </div>
        </div>
  
         @stop
    </form>

