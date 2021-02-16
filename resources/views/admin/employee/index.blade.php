

@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
 <h5 style="color: blue;" class="unicode">Employee Management</h5>
 <style type="text/css">
     .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 35px;
    user-select: none;
    -webkit-user-select: none; }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 30px;
    position: absolute;
    top: 2px;
    right: 0px;
    left: 270px;
    width: 100px; }
</style>

@stop
@section('content')
 <?php
  $name = isset($_GET['name'])?$_GET['name']:''; 
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:''; 
  $dep_id = isset($_GET['dep_id'])?$_GET['dep_id']:''; 
  $position_id = isset($_GET['position_id'])?$_GET['position_id']:'';
  $gender = isset($_GET['gender'])?$_GET['gender']:''; 
  $hostel = isset($_GET['hostel'])?$_GET['hostel']:''; 
  $join_date = isset($_GET['join_date'])?$_GET['join_date']:'';
  $join_month = isset($_GET['join_month'])?$_GET['join_month']:'';
  ?>

        <form class="form-horizontal unicode" action="{{route('import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <input type="file" name="file" class="form-control" style="font-size: 13px">
                           <!--  @if ($errors->has('file'))
                                <span style="border-color: red">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif -->
                        </div>
                        
                        <button class="btn btn-success btn-sm" style="margin-right: 10px;font-size: 13px"><i class="fas fa-file-csv" ></i> Import CSV</button>
                       
                        <a class="btn btn-primary btn-sm"  href="{{ route('employees.download.csv') }}" style="margin-right: 10px;font-size: 13px"><i class="fa fa-fw fa-download" style="padding-top: 8px" ></i>Demo CSV File</a>
                       
                      
                        <a class="btn btn-warning btn-sm" id="export_btn" style="margin-right: 10px;font-size: 13px"><i class="fa fa-fw fa-file-excel" style="padding-top: 8px"></i>Export</a>

                         <button type="button" class="btn btn-warning " id="morefilter" style="font-size: 13px"><i class="fa fa-filter" aria-hidden="true"></i></button>
                       <div class="col-md-6">
                        <a class="btn btn-success unicode" href="{{route('employee.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Employee</a>
                        </div>
                     
                    
                    </div>
        </form><br>
   


         <form action="{{route('employee.index')}}" method="get" accept-charset="utf-8" class="form-horizontal unicode" >
            <div class="row form-group" id="adv_filter">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="" class="unicode">Search by Keyword</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Search..." value="{{ old('name',$name) }}" style="font-size: 13px">
                        </div> 
                        <div class="col-md-2">
                            <label for="">Select Branch</label>
                          <select class="form-control" id="branch_id" name="branch_id" style="font-size: 13px">
                                <option value="">All</option>
                                @foreach($branchs as $branch)
                                <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                           <label for="">Select Department</label>
                           
                          <!--   <select class="livesearch form-control" name="dep_id"  id="dep_id">
                              @foreach($departments as $department)
                                  <option value="{{$department->id}}">{{$department->name}}</option>
                              @endforeach
                            </select> -->
                            <select class="form-control" id="dep_id" name="dep_id" style="font-size: 13px">
                              <option value="">All</option>
                                    @foreach($departments as $department)
                                              <option value="{{$department->id}}" {{ (old('dep_id',$dep_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                                    @endforeach
                          </select>
                        </div>
                        <div class="col-md-2">
                             <label for="">Select Rank</label>
                            <select class="form-control" id="position_id" name="position_id" style="font-size: 13px">
                            <option value="">All</option>
                               @foreach($positions as $position)
                                                <option value="{{$position->id}}" {{ (old('position_id',$position_id)==$position->id)?'selected':'' }}>{{$position->name}}</option>
                                @endforeach
                       
                             </select>
                        </div>

                        <div class="col-md-2">
                             <label for="">Select Gender</label>
                            <select class="form-control" id="gender" name="gender" style="font-size: 13px">
                              <option value="">All</option>  
                              <option value="Male" {{ (old('gender',$gender)=="Male")?'selected':'' }}>Male</option>
                              <option value="Female" {{ (old('gender',$gender)=="Female")?'selected':'' }}>Female</option>
                             </select>
                        </div>

                        <div class="col-md-2">
                             <label for="">Hostel/No Hostel</label>
                            <select class="form-control" id="hostel" name="hostel" style="font-size: 13px">
                              <option value="">All</option>  
                              <option value="No" {{ (old('hostel',$hostel)=="No")?'selected':'' }}>No Hostel</option>
                              <option value="Yes" {{ (old('hostel',$hostel)=="Yes")?'selected':'' }}>Hostel</option>
                             </select>
                        </div>
                        

                       {{--  <div class="col-md-2">
                            <label>Join Date</label>
                             <input type="text" name="join_date" id="join_date"class="form-control unicode" placeholder="01-08-2020" value="{{ old('join_date',$join_date) }}" style="font-size: 13px">
                        </div>

                         <div class="col-md-2">
                            <label>Join Month</label>
                             <input type="text" name="join_month" id="join_month"class="form-control unicode" placeholder="January" value="{{ old('join_month',$join_month) }}" style="font-size: 13px">
                        </div> --}}
                      
                    </div>
                </div>
               
            </div>
        </form>
        <br>

         <form id="excel_form" action="{{ route('export') }}"  method="POST" class="unicode">
                @csrf
                @method('post')
                <input type="hidden" id="branch_id" name="branch_id" value="{{ $branch_id }}">
                <input type="hidden" id="dep_id" name="dep_id" value="{{ $dep_id }}">
                <input type="hidden" id="position_id" name="position_id" value="{{ $position_id }}">
         </form>

  <p style="padding-top: 20px" class="unicode">Total record: {{$count}}</p>
    <div class="table-responsive unicode" style="font-size:14px;">
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
                        <th>Phone No</th>
                        <th>Status</th>
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
                             
                            <td>{{date('d-m-Y',strtotime($employee->join_date))}} <br>
                              ({{$workyear}}) years
                            </td>
                            <td>{{$employee->phone_no}}</td>

                            <td>
                              <label class="switch">
                              <input data-id="{{$employee->id}}" data-size ="small" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $employee->active? 'checked' : '' }}>
                               <span class="slider round"></span>
                           </label>
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
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}"/>
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="{{ asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toastermin.css')}}"> 
  <style type="text/css">
     th{
        background-color: rgba(0,0,0,.03);
    }
    .page_body{
        margin: 10px;
    }
      .switch {
        position: relative;
        display: inline-block;
        width: 45px;
        height: 22px;
    }

    .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 2px;
        bottom: 0px;
        top:3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

/* Rounded sliders */
    .slider.round {
        border-radius: 36px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
  </style>


@stop

@section('js')
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jquery-ui.js') }}"></script>

{{--   <script type="text/javascript" src="{{ asset('toastermin.js')}}"></script>
  <script src=" {{ asset('toasterjquery.js') }}" ></script> --}}

   <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
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

           $(function() {
            $('.livesearch').select2({
            
            placeholder: 'All',
            allowClear: true,
            ajax: {
                url: "<?php echo(route("ajax-autocomplete-department")) ?>",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        });
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

              $('#gender').on('change',function(e){
                this.form.submit();
              });

              $('#hostel').on('change',function(e){
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

               $( "#morefilter" ).click(function(e) {
              e.preventDefault();
              if($('#adv_filter:visible').length)
                  $('#adv_filter').hide("slide", { direction: "right" }, 1000);
              else
              $('#adv_filter').show("slide", { direction: "right" }, 1000);
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


        $(function() {
                $('.toggle-class').change(function() {
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var file_id = $(this).data('id');
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "<?php echo route('change-status-employee') ?>",
                        data: {'active': status, 'file_id': file_id},
                        success: function(data){
                         console.log(data.success);
                        }
                    });
                })
              });

         $(function() {
            $('.livesearch').select2({
            placeholder: 'Select Department',
            ajax: {
                url: "<?php echo(route("ajax-autocomplete-department")) ?>",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        });

     </script>
@stop
