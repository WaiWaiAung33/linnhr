
@extends('adminlte::page')

@section('title', 'jobapplication')

@section('content_header')
<script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>

@stop

@section('content')
   


<div class="row">
        <div class="col-lg-10">
             <a class="btn btn-success unicode" href="{{route('jobapplication.index')}}"> Back</a>
        </div>
        
    </div>

      <form action="{{route('jobapplication.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
         @csrf
        @method('post')
        @if($jobapplications->status == 0)
         <div class="pull-right">
           
              <button type="submit" class="btn btn-sm btn-primary" style="float: right;">Accept</button>
         </div><br>
        @endif

    <input type="hidden" name="nrc_code" value="{{$jobapplications->nrc_code}}">
     <input type="hidden" name="nrc_state" value="{{$jobapplications->nrc_state}}">
    <input type="hidden" name="nrc_status" value="{{$jobapplications->nrc_status}}">
    <input type="hidden" name="nrc" value="{{$jobapplications->nrc}}">
     <input type="hidden" name="fullnrc" value="{{$jobapplications->fullnrc}}">

   
          <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="text-dark">General Information :</h5>
                </div>
 
                <div class="col-12 mt-3">
                    <div class="custom-form p-4 border rounded" style="background-color: white">
                         <div style="text-align: center;">
                           @if($jobapplications->photo == '')
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="180px" height="180px">
                            @else
                             <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->photo) }}" alt="photo" width="130px" height="130px">
                             @endif
                          </div>
                        
                      
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Name :</label>
                                        <input id="first-name" type="text" name="name" class="form-control resume" placeholder="Name :" value="{{$jobapplications->name}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Parent Name :</label>
                                        <input type="text" class="form-control resume" placeholder="Parent Name :" name="fName" value="{{$jobapplications->fName}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Date of birth :</label>
                                        <input type="text" class="form-control resume" placeholder="01-01-2021 :" name="dob" value="{{date('d-m-Y',strtotime($jobapplications->dob))}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Religion :</label>
                                        <input type="text" class="form-control resume" name="religion" value="{{$jobapplications->religion}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Sex :</label>
                                       <input type="text" class="form-control resume" name="gender" value="{{$jobapplications->gender}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Marital Status</label>
                                        <input type="text" class="form-control resume" name="marrical_status" value="{{$jobapplications->marrical_status}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                   <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Email :</label>
                                        <input type="email" class="form-control resume" placeholder="email :" name="email" value="{{$jobapplications->email}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                   <div class="col-md-4">
                                    <div>
                                        <label class="text-muted">NRC<span class="text-danger">*</span> :</label>
                                       <input type="text" class="form-control resume" value="{{$jobapplications->fullnrc}}" readonly style="background-color: white">
                                    </div>
                                </div>


                            </div>
                       
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <h5 class="text-dark">Contact Information :</h5>
                </div>

                <div class="col-12 mt-3">
                    <div class="custom-form p-4 border rounded" style="background-color: white">
                       
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Phone</label>
                                        <input id="phone" type="number" class="form-control resume" name="phone" value="{{$jobapplications->phone}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Parent Phone</label>
                                         <input type="number" class="form-control resume" name="fPhone" value="{{$jobapplications->fPhone}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">City</label>
                                        <input type="text" class="form-control resume" placeholder="City :" name="city" value="{{$jobapplications->city}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Township</label>
                                        <input type="text" class="form-control resume" placeholder="Township :" name="township" value="{{$jobapplications->township}}" readonly style="background-color: white">
                                    </div>
                                </div>

                             

                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label>Address </label>
                                        <textarea id="address" rows="4" class="form-control resume" placeholder="" name="address" readonly style="background-color: white">{{$jobapplications->address}}</textarea>
                                    </div>
                                </div>
                            </div>
                       
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h5 class="text-dark mt-5">Education Details :</h5>
                </div>

                <div class="col-12 mt-3">
                    <div class="custom-form p-4 border rounded" style="background-color: white">
                      
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Graduation</label>
                                        <input id="graduation" type="text" class="form-control resume" placeholder="" name="graduation" value="{{$jobapplications->graduation}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">University/College</label>
                                        <input id="university/college" type="text" class="form-control resume" placeholder="" name="education" value="{{$jobapplications->edu}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Degree/Certification</label>
                                        <input id="degree/certification" type="file" class="form-control resume" placeholder="" name="degree">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group app-label">
                                                <label class="text-muted">Level</label>
                                                 <input type="text" class="form-control resume" placeholder="" name="level" value="{{$jobapplications->level}}" readonly style="background-color: white"> 
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group app-label">
                                                <label class="text-muted">Course Title</label>
                                                <input id="course-title" type="text" class="form-control resume" placeholder="" name="course_title" value="{{$jobapplications->course_title}}" readonly style="background-color: white">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        
                            </div>
                      
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-5">
                    <h5 class="text-dark">Work Experience :</h5>
                </div>

                <div class="col-12 mt-3">
                    <div class="custom-form p-4 border rounded" style="background-color: white">
                      
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Company Name</label>
                                        <input id="company-name" type="text" class="form-control resume" placeholder="" name="exp_company" value="{{$jobapplications->exp_company}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Job Position</label>
                                        <input id="job-position" type="text" class="form-control resume" placeholder="" name="exp_position" value="{{$jobapplications->exp_position}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Location</label>
                                        <input id="job-position" type="text" class="form-control resume" placeholder="" name="exp_location" value="{{$jobapplications->exp_location}}" readonly style="background-color: white">
                                        
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group app-label">
                                                <label class="text-muted">Date From</label>
                                                <input id="exp_date_from" type="text" class="form-control resume" placeholder="01-01-2021" name="exp_date_from" value="{{date('d-m-Y',strtotime($jobapplications->exp_date_from))}}" readonly style="background-color: white">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group app-label">
                                                <label class="text-muted">Date To</label>
                                                <input id="exp_date_to" type="text" class="form-control resume" placeholder="01-01-2021" name="exp_date_to" value="{{date('d-m-Y',strtotime($jobapplications->exp_date_to))}}" readonly style="background-color: white">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                       
                    </div>
                </div>
            </div>

              <div class="row">
                <div class="col-12 mt-5">
                    <h5 class="text-dark">Employement :</h5>
                </div>

                <div class="col-12 mt-3">
                    <div class="custom-form p-4 border rounded" style="background-color: white">
                       
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Department</label>
                                        <input id="company-name" type="text" class="form-control resume"  readonly name="department" value="{{$jobapplications->department}}" style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Position</label>
                                        <input id="job-position" type="text" class="form-control resume" readonly name="location" value="{{$jobapplications->job}}" style="background-color: white">
                                    </div>
                                </div>

                                   <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Applied Date</label>
                                        <input id="company-name" type="text" class="form-control resume" name="appliedDate" value="{{date('d-m-Y')}}" readonly style="background-color: white">
                                    </div>
                                </div>

                               <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Expected Salary</label>
                                        <input id="company-name" type="text" class="form-control resume" placeholder="" name="salary" value="{{$jobapplications->exp_salary}}" readonly style="background-color: white">
                                    </div>
                                </div>

                              

                                <div class="col-md-6">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Hostel</label>
                                       <div class="row">
                                            <div class="col-md-1">
                                                  <input type="radio" name="hostel" value="နေ" {{ $jobapplications->hostel == 'နေ' ? 'checked' : '' }}> 
                                                  
                                              </div> 
                                              <div class="col-md-3"><label class="unicode">Yes</label></div>  
                                              <div class="col-md-1">
                                                  <input type="radio" name="hostel" value="မနေ" {{ $jobapplications->hostel == 'မနေ' ? 'checked' : '' }}> 
                                              </div> 
                                              <div class="col-md-3">
                                                <label class="unicode">No</label>
                                              </div>
                                       </div>
                                    </div>
                                </div>

                            </div>
                      
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col-12 mt-5">
                    <h5 class="text-dark">Skills :</h5>
                </div>
                
                <div class="col-12 mt-3">
                    <div class="custom-form p-4 border rounded" style="background-color: white">
                       
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Skills</label>
                                        <input id="skills" type="text" class="form-control resume" placeholder="HTML, CSS, PHP, javascript, ..." name="skills" value="{{$jobapplications->skills}}" readonly style="background-color: white">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Skill proficiency</label>
                                        <input id="skill_proficiency" type="text" class="form-control resume" placeholder="75%" name="proficiency" value="{{$jobapplications->proficiency}}" readonly style="background-color: white">
                                    </div>
                                </div>
                            </div>
                      
                    </div>
                </div>
              </div>

               <div class="row">
                <div class="col-12 mt-5">
                    <h5 class="text-dark">File Attachment :</h5>
                </div>
                
                <div class="col-12 mt-3">
                    <div class="custom-form p-4 border rounded" style="background-color: white">
                       
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">CV File</label>
                                        <div>
                                           <a href="{{ url('uploads/jobapplicationPhoto/'.$jobapplications->cvfile) }}" target="_blank">{{$jobapplications->cvfile}}</a>
                                        </div>
                                       
                                    </div>
                                </div>

                                 <div class="col-md-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Ward recommendation letter Photo</label>
                                        <div>
                                         @if($jobapplications->photo == '')
                                        <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="180px" height="180px">
                                        @else
                                         <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->ward_reco) }}" alt="photo" width="130px" height="130px">
                                         @endif
                                         </div>
                                       
                                    </div>
                                </div>

                                 <div class="col-lg-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Police station recommendation Photo</label>
                                         <div>
                                         @if($jobapplications->photo == '')
                                        <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="180px" height="180px">
                                        @else
                                         <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->police_reco) }}" alt="photo" width="130px" height="130px">
                                         @endif
                                         </div>
                                    </div>
                                </div>

                                 <div class="col-lg-4">
                                    <div class="form-group app-label">
                                        <label class="text-muted">Other file</label>
                                        <div>
                                        @if($jobapplications->photo == '')
                                        <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="180px" height="180px">
                                        @else
                                         <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->otherfile) }}" alt="photo" width="130px" height="130px">
                                         @endif
                                         </div>

                                    </div>
                                </div>
                            </div>
                      
                    </div>
                </div>

                @stop
            </div>

     </div>
    </form>

