
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
        <div class="col-lg-2">
            <div class="pull-right">
             <form action="{{route('jobapplication.update',$jobapplications->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <button type="submit" class="btn btn-sm btn-primary">Accept</button> 
           </form>
            </div>
        </div>
    </div><br>

    <div class="row form-group">
        <div class="col-md-4">
            <div class="header">
                @if($jobapplications->photo == '')
                <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="200px" height="200px">
                @else
                 <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->photo) }}" alt="photo" width="150px" height="150px">
                 @endif
            </div>
            <div class="header">
                <h6 style="color: gray;padding-top: 10px">{{$jobapplications->name}}</h6>
            </div>
          
        </div>
        <div class="col-md-7">
        <div class="table-responsive">
             <table class="table table-bordered styled-table">
                <thead>
                    <tr>
                        <th style="font-size: 16px"><i class="fa fa-address-book" ></i> Personal Data</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name<span style="padding-left: 200px">{{$jobapplications->name}}</span></td>
                        
                    </tr>
                     <tr>
                        <td>Education<span style="padding-left: 180px">{{$jobapplications->edu}}</span></td>
                        
                    </tr>
                    <tr>
                        <td>Father's Name<span style="padding-left: 155px">{{$jobapplications->fName}}</span></td>
                    </tr>
                    <tr>
                        <td>Date of birth<span style="padding-left: 165px">{{date('d-m-Y',strtotime($jobapplications->dob))}}</span></td>
                    </tr>
                    <tr>
                        <td>Full Nrc<span style="padding-left: 190px">{{$jobapplications->fullnrc}}</span></td>
                    </tr>
                    <tr>
                        <td>Gender<span style="padding-left: 195px">{{$jobapplications->marrical_status}}</span></td>
                    </tr>
                    <tr>
                        <td>Phone <span style="padding-left: 195px">{{$jobapplications->phone}}</span></td>
                    </tr>
                    <tr>
                        <td>Address<span style="padding-left: 190px">{{$jobapplications->address}}</span></td>
                    </tr>
                </tbody>
             </table>
         
        </div>

         <div class="table-responsive">
             <table class="table table-bordered styled-table">
                <thead>
                    <tr>
                        <th style="font-size: 16px"><i class="fa fa-briefcase"> </i> JobApplication Data</th>
                        
                    </tr>
                </thead>
                <tbody>
                   
                    <tr>
                        <td>Department<span style="padding-left: 165px">{{$jobapplications->department}}</span></td>
                    </tr>
                   
                    <tr>
                        <td>Designation<span style="padding-left: 165px">{{$jobapplications->job}}</span></td>
                    </tr>
                     <tr>
                        <td>
                        Job application date<span style="padding-left: 115px">{{date('d-m-Y',strtotime($jobapplications->created_at))}}</span></td>
                    </tr>
                     <tr>
                        <td>Expected Salary<span style="padding-left: 140px">{{$jobapplications->exp_salary}}</span></td>
                    </tr>
                     <tr>
                        <td>Work Experience<span style="padding-left: 140px">{{$jobapplications->experience}}</span></td>
                    </tr>
                  
                   
                </tbody>
             </table>
         
        </div>
        @stop 
     </div>

