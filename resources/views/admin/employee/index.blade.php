

@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')

<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">

 <h5 style="color: blue;" class="unicode">Employee Management</h5>
    <script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
@stop
@section('content')
 <?php
  $name = isset($_GET['name'])?$_GET['name']:''; 
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:''; 
  $dep_id = isset($_GET['dep_id'])?$_GET['dep_id']:''; 
  $position_id = isset($_GET['position_id'])?$_GET['position_id']:''; 
  $join_date = isset($_GET['join_date'])?$_GET['join_date']:'';
  $join_month = isset($_GET['join_month'])?$_GET['join_month']:'';
  ?>

<div class="row form-group">
  <div class="col-md-12">
                         
              <a class="btn btn-success unicode" href="{{route('employee.create')}}" style="float: right;" class="unicode"><i class="fas fa-plus"> Employee</i></a>
         </div>
</div>
          
         <form action="{{route('employee.index')}}" method="get" accept-charset="utf-8" class="form-horizontal unicode" >
            <div class="row form-group">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="" class="unicode">Search by Keyword</label>
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
                            <label>Join Month</label>
                             <input type="text" name="join_month" id="join_month"class="form-control unicode" placeholder="January" value="{{ old('join_month',$join_month) }}">
                        </div>
                       <!--  <div class="col-md-2">
                         
                             <a class="btn btn-success unicode" href="{{route('employee.create')}}" style="float: right;"><i class="fas fa-plus"> Employee</i></a>
                        </div> -->
                    </div>
                </div>
               
            </div>
        </form>

        <div class="row">
        <form class="form-horizontal unicode" action="{{route('import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-4">
                            <input type="file" name="file" class="form-control">
                            @if ($errors->has('file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <button class="btn btn-success btn-sm"><i class="fas fa-file-csv" style="margin-left: 10px "></i> Import CSV</button>
                       
                        <a class="btn btn-primary btn-sm"  href="{{ route('employees.download.csv') }}" style="margin-left: 10px "><i class="fa fa-fw fa-download" style="padding-top: 8px" ></i>Demo CSV File</a>
                       
                      
                        <a class="btn btn-warning btn-sm" id="export_btn" style="margin-left: 10px " ><i class="fa fa-fw fa-file-excel" style="padding-top: 8px"></i>Export</a>
                     
                    
                    </div>
        </form>
      </div>

         <form id="excel_form" action="{{ route('export') }}"  method="POST" class="unicode">
                @csrf
                @method('post')
                <input type="hidden" id="branch_id" name="branch_id" value="{{ $branch_id }}">
                <input type="hidden" id="dep_id" name="dep_id" value="{{ $dep_id }}">
                <input type="hidden" id="position_id" name="position_id" value="{{ $position_id }}">
         </form>

  <p style="padding-top: 20px" class="unicode">Total record: {{$count}}</p>
    <div class="table-responsive unicode" style="font-size:15px;">
                <table class="table table-bordered styled-table unicode">
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
                       <!--  <th>NRC</th>
                        <th>DOB</th> -->
                        <!-- <th>Action</th> -->
                    </tr>
                  </thead>
                    <tbody>
                    @if($employees->count()>0)
              		 @foreach($employees as $employee)
                        <tr class="table-tr" data-url="{{route('employee.show',$employee->id)}}">
                            <td>{{++$i}}</td>
                            <td>{{$employee->emp_id}}</td>
                            @if($employee->photo == '')
                            <td>
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td>
                             <img src="{{ asset('uploads/employeePhoto/'.$employee->photo) }}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
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
    </div>
         

@stop 
@section('css')
  
@stop

@section('js')
 <script src="{{ asset('jquery.js') }}"></script>

   <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
 <script type="text/javascript"> 
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
             $('#join_month').on('change',function(e) {
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


           $("#join_month").datepicker({  format: "mm",
          viewMode: "months", 
          minViewMode: "months" });

           $('#export_btn').click(function(){
                $('#excel_form').submit();
            });
         
        });
     </script>
@stop
