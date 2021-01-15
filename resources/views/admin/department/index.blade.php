

@extends('adminlte::page')

@section('title', 'Department')

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
@stop
@section('content')

<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
?>

<div >
   <h5 style="color: #1179C2">Department Management</h5>
 <form action="{{route('department.store')}}" method="post" enctype="multipart/form-data" style="padding-top: 10px">
       @csrf

       <div class="row form-group">
         
            <div class="col-md-3">
               <input type="text" name="name" placeholder="Enter department name" class="form-control unicode"> 
            </div>
            <div class="col-md-2">
              <button class="btn btn-success unicode" type="submit">
                    Save
              </button>
            </div>
        </div>
       <!--  <div class="row form-group">
          <div class="col-md-2">
            <label class="unicode">Time In</label>
          </div>
          <div class="col-md-4 ">
           <input type="date" class="form-control unicode" placeholder="01-01-2021" name="in_time" id="in_time">
              
            </div>
        </div>
        <div class="row form-group">
          <div class="col-md-2">
            <label class="unicode">Time Out</label>
          </div>
            <div class="col-md-4">
                 <input type="date" class="form-control unicode" placeholder="01-01-2021" name="out_time" id="out_time">
            </div>
        </div> -->
        
      
    </form>
      {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

    <form action="{{route('department.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
      
       <div class="col-md-3">                 
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search...">
        </div>
     </div>
    </form>

     <p style="padding-left: 10px">Total record:{{$count}}</p>
    <div class="table-responsive" style="font-size:15px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Department Name</th>
                        <!-- <th>In Time</th>
                        <th>Out Time</th> -->
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                  @if($departments->count()>0)
              		@foreach($departments as $department)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$department->name}}</td>
                           <!--  <td>{{date('d/m/Y',strtotime($department->in_time))}}</td>
                            <td>{{date('d/m/Y',strtotime($department->out_time))}}</td> -->
                            <td>
                                <form action="{{route('department.destroy',$department->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('department.edit',$department->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger btn-sm" type="submit">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        
			            @endforeach
                  @else
                          <tr align="center">
                            <td colspan="10">No Data!</td>
                          </tr>
                  @endif
                    </tbody>
           </table> 
             {!! $departments->appends(request()->input())->links() !!}
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
