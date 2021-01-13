

@extends('adminlte::page')

@section('title', 'Employee')

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

          .styled-table tbody tr:nth-of-type(even) {
              background-color: #c7d4dd;
          }

          .styled-table tbody tr:last-of-type {
              border-bottom: 2px solid #1179C2;
          }

</style>
@stop
@section('content')
 <?php
  $name = isset($_GET['name'])?$_GET['name']:''; 
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:''; 
  $dep_id = isset($_GET['dep_id'])?$_GET['dep_id']:''; 
  $position_id = isset($_GET['position_id'])?$_GET['position_id']:''; 
  ?>

  <div>
    <h5 style="color:#1179C2 ">Employee Management</h5><br>
    <form action="{{route('employee.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
            <div class="row form-group" class="col-md-9">
                        <div class="col-md-3">
                           
                            <input type="text" name="name" id="name" class="form-control" placeholder="Search..." value="{{ old('name',$name) }}">
                        </div>
                      
                
            </div>
            <div class="row">
                <div class="col-md-3">
                            
                           <select class="form-control" id="branch_id" name="branch_id">
                                <option value="">Select Branch</option>
                                @foreach($branchs as $branch)
                                <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
                                @endforeach
                            </select>
                </div>
               <div class="col-md-3">
                          
                  <select class="form-control" id="dep_id" name="dep_id">
                          <option value="">Select Department</option>
                                @foreach($departments as $department)
                                          <option value="{{$department->id}}" {{ (old('dep_id',$dep_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                                @endforeach
                      </select>
                </div>

                 <div class="col-md-3">
                  
                    <select class="form-control" id="position_id" name="position_id">
                        <option value="">Select Rank</option>
                               @foreach($positions as $position)
                                                <option value="{{$position->id}}" {{ (old('position_id',$position_id)==$position->id)?'selected':'' }}>{{$position->name}}</option>
                                @endforeach
                       
                    </select>
                </div>
            </div>
        </form>
  </div>
  <!-- <p style="font-size: 18px" class="col-md-3">Employee Management</p> -->
  <div style="position: absolute;bottom: 15px;right: 15px">
                    <a class="btn btn-primary unicode" href="{{route('employee.create')}}" style="width: 50px;height: 50px;border-radius: 25px"><i class="fa fa-plus" style="padding-top: 10px" /></i></a>
  </div>
  <p style="padding-top: 35px">Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:15px;">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                       <th>Name</th>
                       <th>Rank</th>
                        <th>Department</th>
                        <th>Branch</th>
                        <th>Joined Date</th>
                        <th>NRC</th>
                        <th>DOB</th>
                        <!-- <th>Action</th> -->
                    </tr>
                  </thead>
                    <tbody>
                    @if($employees->count()>0)
              		 @foreach($employees as $employee)
                        <tr class="table-tr" data-url="{{route('employee.show',$employee->id)}}">
                            <td>{{++$i}}</td>
                            <td>{{$employee->name}}</td>
                             <td>{{$employee->viewPosition->name}}</td>
                            <td>{{$employee->viewDepartment->name}}</td>
                            <td>{{$employee->viewBranch->name}}</td>
                            <td>{{date('d-m-Y',strtotime($employee->join_date))}}
                            </td>
                            <td>{{$employee->fullnrc}}</td>
                            <td>{{date('d-m-Y',strtotime($employee->date_of_birth))}}</td>
                            <!-- <td>
                              <img src="{{ asset('uploads/employeePhoto/'.$employee->photo) }}" alt="photo" width="50px" height="35px">
                            </td> -->
                           <!--  <td>
                                <form action="{{route('employee.destroy',$employee->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-info" href="{{route('employee.show',$employee->id)}}"><i class="fa fa-fw fa-eye" /></i></a> 
                                    <a class="btn btn-sm btn-primary" href="{{route('employee.edit',$employee->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger btn-sm" type="submit">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>
                                </form>
                            </td> -->
                        </tr>
                        
			           @endforeach
                  @else
                      <tr align="center">
                        <td colspan="10">No Data!</td>
                      </tr>
                  @endif
                    </tbody>
           </table> 
           {!! $employees->appends(request()->input())->links() !!}

@stop 
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
 <script> 
        $(document).ready(function(){
            setTimeout(function(){
            $("div.alert").remove();
            }, 1000 ); 
            $(function() {
                $('#name').on('change',function(e) {
                this.form.submit();
            }); 
              $('#branch_id').on('change',function(e){
                this.form.submit();
              });
              $('#dep_id').on('change',function(e){
                this.form.submit();
              });
               $('#position_id').on('change',function(e){
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
