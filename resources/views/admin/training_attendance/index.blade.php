@extends('adminlte::page')

@section('title', 'Training Attendance')

@section('content_header')

    <h5 style="color: blue;">Training Attendance Management</h5>
@stop
@section('content')

<?php
  $name = isset($_GET['name'])?$_GET['name']:''; 
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:''; 
  $dept_id = isset($_GET['dept_id'])?$_GET['dept_id']:'';
  ?>

   <form action="{{route('training_attendance.index')}}" method="get" accept-charset="utf-8" class="form-horizontal unicode" >
            <div class="row form-group" id="adv_filter">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="" class="unicode">Search by Keyword</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Search..." value="{{ old('name',$name) }}" style="font-size: 13px">
                        </div> 

                        <div class="col-md-2">
                            <label for="" class="unicode">Select Branch</label>
                            <select class="form-control" id="branch_id" name="branch_id" style="font-size: 13px">
                              <option value="">All</option>
                              @foreach($branches as $branch)
                              <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
                              @endforeach
                          </select>
                        </div> 

                        <div class="col-md-2">
                            <label for="" class="unicode">Select Department</label>
                            <select class="form-control" id="dept_id" name="dept_id" style="font-size: 13px">
                              <option value="">All</option>
                              @foreach($departments as $department)
                              <option value="{{$department->id}}" {{ (old('dept_id',$dept_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                              @endforeach
                          </select>
                        </div> 

                         <div class="col-md-6">
                         <a class="btn btn-success unicode" href="{{route('training_attendance.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Training Attendance</a>
                         </div>
                    </div>
                </div>
               
            </div>
</form>

 <p style="padding-top: 20px">Total record: {{$count}} </p>
  <div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>

                        <th>Training Name</th>
                        <th>Employee Name</th>
                        <th>Attendance Date</th>
                        <th>Status</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($trainings->count()>0)
                     @foreach($trainings as $training)
                    <tr>
                      <td>{{++$i}}</td>
                     
                      <td>{{$training->training_name}}</td>
                       <td>{{$training->employee_name}}</td>
                      <td>{{date('d-m-Y',strtotime($training->att_date))}}</td>
                      @if($training->status == 0)
                      <td>Present</td>
                      @elseif($training->status == 1)
                      <td>Absent</td>
                      @endif
                      <td>{{$training->remark}}</td>
                      <td>
                                <form action="{{route('training_attendance.destroy',$training->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-info" href="{{route('training_attendance.show',$training->id)}}"><i class="fa fa-fw fa-eye" /></i></a> 
                                    <a class="btn btn-sm btn-primary" href="{{route('training_attendance.edit',$training->id)}}"><i class="fa fa-fw fa-edit"></i></a>
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
 {!! $trainings->appends(request()->input())->links() !!}
       </div>   
@stop 
@section('css')

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

  $(function(){

     $('#name').on('change',function(e) {
                this.form.submit();
     }); 

      $('#branch_id').on('change',function(e) {
                this.form.submit();
     }); 

       $('#dept_id').on('change',function(e) {
                this.form.submit();
     }); 

     
  });
       
     </script>
@stop