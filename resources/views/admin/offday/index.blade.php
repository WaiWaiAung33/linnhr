
@extends('adminlte::page')

@section('title', 'Offday')

@section('content_header')
<h5 style="color: blue;">Offday Management</h5>
@stop
@section('content')
<?php
  $name = isset($_GET['name'])?$_GET['name']:'';
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:'';
  $dept_id = isset($_GET['dept_id'])?$_GET['dept_id']:'';
  $date = isset($_GET['date'])?$_GET['date']:''; 
  if ($date == '') {
    $date = date('d-m-Y');
  }
?>
<div>

     <a class="btn btn-success unicode" href="{{route('offday.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Offday</a>
  
      {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

      <form action="{{route('offday.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
     
       <div class="col-md-2">                 
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
        </div>
        <div class="col-md-2">
            <select class="form-control" id="branch_id" name="branch_id" style="font-size: 13px">
              <option value="">Select Branch</option>
              @foreach($branches as $branch)
              <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
              @endforeach
          </select>
        </div>
        <div class="col-md-2">
           <select class="form-control" id="dept_id" name="dept_id" style="font-size: 13px">
              <option value="">Select Department</option>
              @foreach($departments as $department)
              <option value="{{$department->id}}" {{ (old('dept_id',$dept_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
              @endforeach
          </select>
        </div>
        <div class="col-md-2">               
            <input type="text" name="date" id="date" value="{{ old('date',$date) }}" class="form-control" style="font-size: 13px">
       </div>
     </div>
    </form>
    <p>Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Image</th>
                        <th>Employee Name</th>
                        <th>Off day 1</th>
                        <th>Off day 2</th>
                        <th>Off day 3</th>
                        <th>Off day 4</th>
                         <th>Last Updated by</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                  	 @if($offdays->count()>0)
              		 @foreach($offdays as $offday)
                        <tr class="table-tr" >
                            <td>{{++$i}}</td>
                             @if($offday->photo == '')
                            <td>
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td>
                             <img src="{{ asset('uploads/employeePhoto/'.$offday->photo) }}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
                            <td>{{$offday->viewEmployee->name}}<br>
                              {{$offday->department_name}}<br>
                              {{$offday->branch_name}}</td>
                            <td>@if($offday->off_day_1!='') {{date('d-m-Y',strtotime($offday->off_day_1))}} @endif</td>
                            <td>@if($offday->off_day_2!='') {{date('d-m-Y',strtotime($offday->off_day_2))}} @endif</td>
                            <td>@if($offday->off_day_3!='') {{date('d-m-Y',strtotime($offday->off_day_3))}} @endif</td>
                            <td>@if($offday->off_day_4!='') {{date('d-m-Y',strtotime($offday->off_day_4))}} @endif</td>
                            <td>{{$offday->name}}</td>
                            <td>
                                <form action="{{route('offday.destroy',$offday->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('offday.edit',$offday->id)}}"><i class="fa fa-fw fa-edit"></i></a>
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
           {!! $offdays->appends(request()->input())->links() !!}
       </div>   
@stop 
@section('css')
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('/js/bootstrap-datepicker.min.js')}}"></script>
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
            $('#branch_id').on('change',function(e) {

                this.form.submit();
            });
            $('#dept_id').on('change',function(e) {

                this.form.submit();
            });

            $('#date').on('change',function(e) {

                this.form.submit();
            });
   
        });
        $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
        });

        $("#date").datepicker({ format: 'dd-mm-yyyy' });

         
        });
     </script>
@stop