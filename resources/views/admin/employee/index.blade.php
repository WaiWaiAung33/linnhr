

@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')

<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />
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

          /*.styled-table tbody tr:nth-of-type(even) {
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
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:''; 
  $dep_id = isset($_GET['dep_id'])?$_GET['dep_id']:''; 
  $position_id = isset($_GET['position_id'])?$_GET['position_id']:''; 
  $join_date = isset($_GET['join_date'])?$_GET['join_date']:'';
  ?>

  <div>
    <h5 style="color:#1179C2 ">Employee Management</h5><br>
     {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}
   

         <form action="{{route('employee.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
            <div class="row form-group">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Search by Keyword</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Search..." value="{{ old('name',$name) }}">
                        </div> 
                        <div class="col-md-2">
                            <label for="">Select Branch</label>
                          <select class="form-control" id="branch_id" name="branch_id">
                                <option value="">All</option>
                                @foreach($branchs as $branch)
                                <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                           <label for="">Select Department</label>
                            <select class="form-control" id="dep_id" name="dep_id">
                              <option value="">All</option>
                                    @foreach($departments as $department)
                                              <option value="{{$department->id}}" {{ (old('dep_id',$dep_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                                    @endforeach
                          </select>
                        </div>
                        <div class="col-md-2">
                             <label for="">Select Rank</label>
                            <select class="form-control" id="position_id" name="position_id">
                            <option value="">All</option>
                               @foreach($positions as $position)
                                                <option value="{{$position->id}}" {{ (old('position_id',$position_id)==$position->id)?'selected':'' }}>{{$position->name}}</option>
                                @endforeach
                       
                             </select>
                        </div>
                        <div class="col-md-2">
                            <label>Join Date</label>
                             <input type="text" name="join_date" id="join_date"class="form-control unicode" placeholder="01-08-2020" value="{{ old('join_date',$join_date) }}">
                        </div>
                        <div class="col-md-2">
                         
                             <a class="btn btn-success unicode" href="{{route('employee.create')}}" style="float: right;"><i class="fas fa-plus"> Employee</i></a>
                        </div>
                    </div>
                </div>
               
            </div>
        </form>

        <form class="form-horizontal" action="{{route('import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-3">
                            <input type="file" name="file" class="form-control">
                            @if ($errors->has('file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                        <button class="btn btn-success btn-sm"><i class="fas fa-file-csv" style="padding-left: 6px;padding-right: 6px;padding-top: 6px;padding-bottom: 6px"></i> Import CSV</button>
                        </div>
                       <div class="col-md-5"></div>
                       <!-- <div class="col-md-1">
                        <a class="btn btn-warning btn-sm" id="export_btn" style="float: right;" ><i class="fa fa-fw fa-file-excel"></i>Export</a>
                       </div> -->
                       
                    
                    </div>
        </form>


  </div>
  <!-- <p style="font-size: 18px" class="col-md-3">Employee Management</p> -->
  <!-- <div style="position: absolute;bottom: 15px;right: 15px">
                    <a class="btn btn-primary unicode" href="{{route('employee.create')}}" style="width: 50px;height: 50px;border-radius: 25px"><i class="fa fa-plus" style="padding-top: 10px" /></i></a>
  </div> -->
  <p style="padding-top: 20px">Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:15px;">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Employee Id</th>
                      <th>Image</th>
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
                            <td>{{$employee->emp_id}}</td>
                            <td> <img src="{{ asset('uploads/employeePhoto/'.$employee->photo) }}" alt="photo" width="80px" height="80px"></td>
                            <td>{{$employee->name}}</td>
                             <td>{{$employee->viewPosition->name}}</td>
                            <td>{{$employee->viewDepartment->name}}</td>
                            <td>{{$employee->viewBranch->name}}</td>
                            <?php 
                                  $currentyear = date('Y');
                                  $currentday = date('m');
                                  $creentmonth = date('d');
                                  // dd($creentmonth);
                                  $joinday = date('m',strtotime($employee->join_date));
                                  $joinyear = date('Y',strtotime($employee->join_date));
                                  $joinmonth = date('d',strtotime($employee->join_date));
                                  // dd($joinmonth);
                                  if($currentday < $joinday || $creentmonth < $joinmonth) {
                                    $work = $currentyear - $joinyear;
                                    $workyear = $work - 1;
                                  }else {
                                    $workyear = $currentyear - $joinyear;
                                  }
                              ?>
                             
                            <td>{{date('d-m-Y',strtotime($employee->join_date))}} ({{$workyear}}) years
                            </td>
                            <td>{{$employee->fullnrc}}</td>
                            <?php 
                                  $currentyearbirth = date('Y');
                                  $currentdaybitrh = date('m');
                                  $currentmonthbirth = date('d');
                                  $joindaybirth = date('m',strtotime($employee->date_of_birth));
                                  $joinyearbirth = date('Y',strtotime($employee->date_of_birth));
                                  $joinmonthbirth = date('d',strtotime($employee->date_of_birth));
                                  if($currentdaybitrh < $joindaybirth || $currentmonthbirth < $joinmonthbirth) {
                                    $workbirth = $currentyearbirth - $joinyearbirth;
                                    $workyearbirth = $workbirth - 1;
                                  }else {
                                    $workyearbirth = $currentyearbirth - $joinyearbirth;
                                  }
                              ?>
                            <td>{{date('d-m-Y',strtotime($employee->date_of_birth))}} ({{$workyearbirth}}) years</td>
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
 <script src="{{ asset('jquery.js') }}"></script>

    <script type="text/javascript" src="{{ asset('jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
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
              $('#branch_id').on('change',function(e){
                this.form.submit();
              });
              $('#dep_id').on('change',function(e){
                this.form.submit();
              });
               $('#position_id').on('change',function(e){
                this.form.submit();
              });
                $('#join_date').on('change',function(e) {
                this.form.submit();
               // $( "#form_id" )[0].submit();   
            });
   
        });
          $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
        });
          $("#join_date").datepicker({ dateFormat: 'dd-mm-yy' });
         
        });
     </script>
@stop
