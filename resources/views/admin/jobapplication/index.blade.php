

@extends('adminlte::page')

@section('title', 'jobapplication')

@section('content_header')

 <h5 style="color: blue;">Jobapplication Management</h5>
    <script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>

@stop
@section('content')

<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
?>


      {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

    <form action="{{route('jobapplication.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
      
       <div class="col-md-3">                 
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
        </div>
     </div>
    </form>

     <p style="padding-top: 15px">Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:13px">
            <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Branch</th>
                      <th>Education</th>
                      <th>Expected Salary</th>
                      <!-- <th>Experience</th> -->
                    </tr>
                  </thead>
                    <tbody>
                   @if($jobapplications->count()>0)
                   @foreach($jobapplications as $jobapplication)
                        <tr class="table-tr" data-url="{{route('jobapplication.show',$jobapplication->id)}}" >
                            <td style="{{ $jobapplication->status == 1 ? 'color: #2874A6 ' : '' }}">{{++$i}}</td>
                             @if($jobapplication->photo == '')
                            <td>
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td>
                             <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplication->photo) }}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
                            <td style="{{ $jobapplication->status == 1 ? 'color: #2874A6 ' : '' }}">{{$jobapplication->name}}</td>
                           
                           
                           <td style="{{ $jobapplication->status == 1 ? 'color: #2874A6 ' : '' }}">{{$jobapplication->department}}</td>
                          
                           <td style="{{ $jobapplication->status == 1 ? 'color: #2874A6 ' : '' }}">{{ $jobapplication->job}}</td>
                           <td style="{{ $jobapplication->status == 1 ? 'color: #2874A6 ' : '' }}">{{$jobapplication->edu}}</td>
                           <td style="{{ $jobapplication->status == 1 ? 'color: #2874A6 ' : '' }}">{{$jobapplication->exp_salary}}</td>
                           <!-- <td style="{{ $jobapplication->status == 1 ? 'color: #2874A6 ' : '' }}">{{$jobapplication->experience}}</td> -->
                        </tr>
                        
                 @endforeach
                 @else
                      <tr align="center">
                        <td colspan="10">No Data!</td>
                      </tr>
                  @endif
                    </tbody>
           </table> 
        {!! $jobapplications->appends(request()->input())->links() !!}
       </div>  
@stop 
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
 <script> 
   @if(Session::has('success'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('success') }}");
        @endif
        $(document).ready(function(){
            setTimeout(function(){
            $("div.alert").remove();
            }, 1000 ); 
            $(function() {
                $('#name').on('change',function(e) {
                this.form.submit();
            }); 
   
        });
          $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
        });
         
        });
     </script>
@stop
