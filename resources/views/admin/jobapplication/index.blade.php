

@extends('adminlte::page')

@section('title', 'jobapplication')

@section('content_header')

<style type="text/css">
   .styled-table {
          border-collapse: collapse;
          /*margin: 25px 0;*/
          font-size: 0.9em;
          font-family: sans-serif;
          min-width: 400px;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
          }
          .styled-table thead tr {
              background-color: #1179C2;
              color: #ffffff;
              text-align: left;
          }
          .styled-table th,
          .styled-table td {
              padding: 12px 15px;
          }

          .styled-table tbody tr {
              border-bottom: 1px solid #dddddd;
          }

         /* .styled-table tbody tr:nth-of-type(even) {
              background-color: #c7d4dd;
          }*/

          .styled-table tbody tr:last-of-type {
              border-bottom: 2px solid #1179C2;
          }
</style>
<h5 style="color:#1179C2 ">Jobapplication Management</h5><br>
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
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search...">
        </div>
     </div>
    </form>

     <p style="padding-top: 15px">Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:15px">
            <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Branch</th>
                      <th>Education</th>
                      <th>Expected Salary</th>
                      <th>Experience</th>
                    </tr>
                  </thead>
                    <tbody>
                   @if($jobapplications->count()>0)
                   @foreach($jobapplications as $jobapplication)
                        <tr class="table-tr" data-url="{{route('jobapplication.show',$jobapplication->id)}}">
                            <td>{{++$i}}</td>
                             @if($jobapplication->photo == '')
                            <td>
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td>
                             <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplication->photo) }}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
                            <td>{{$jobapplication->name}}</td>
                           
                             <?php 
                              foreach ($departments as $key => $value) {
                               if($value->id == $jobapplication->dep_id);
                               $depname = $value->name;
                              
                              }
                              ?>
                           <td>{{$depname}}</td>
                            <?php 
                          foreach ($positions as $key => $value) {
                           if($value->id == $jobapplication->position_id);
                           $name = $value->name;
                          }
                          ?>
                           <td>{{ $name}}</td>
                           <td>{{$jobapplication->edu}}</td>
                           <td>{{$jobapplication->exp_salary}}</td>
                           <td>{{$jobapplication->experience}}</td>
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
