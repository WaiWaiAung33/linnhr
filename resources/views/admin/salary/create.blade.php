@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />
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
    right: 1px;
    width: 20px; }
</style>
@stop

@section('content')
 
    <!-- <div class="row">
        <div class="col-lg-11">
            <a class="btn btn-success unicode" href="{{route('employee.index')}}"> Back</a>
        </div>
    </div><br> -->
  <form action="{{route('salary.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Employee Name</h6>
                                </div>

                                <div class="col-md-8">

                                      <select class="form-control ctr_item_option" name="emp_id" id="select_1" >
                                        <option value="">Select Emplyee</option>
                                        @foreach ($employees as $employee )
                                      
                                          <option  value="{{$employee->id}}" data_branch_id="{{ $employee->branch_id }}" id="catoption" data_is_employee={{$employee->id}}>{{$employee->name}}</option>
                                       
                                        @endforeach
                                    </select> 


                                </div>
                            </div>
              </div>
        </div>

         <input type="hidden" name="name" class="form-control unicode" id="name" value="{{$employee->viewDepartment->name}}">
         <input type="hidden" name="month_total" class="form-control unicode" id="month_total" value="">

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Department</h6>
                                </div>

                                <div class="col-md-8">

                                       <input type="text" name="department" class="form-control unicode" id="department" > 

                                </div>
                            </div>
              </div>
        </div>

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Branch</h6>
                                </div>

                                <div class="col-md-8">

                                       <input type="text" name="branch" class="form-control unicode" id="branch" > 

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Pay Month</h6>
                                </div>

                                <div class="col-md-8">

                                    <input type="month" name="pay_date" class="form-control unicode" placeholder="01-10-2021" > 

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
            <div class="col-md-6">
                            <div class="row salary">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Salary Amout</h6>
                                </div>

                                <div class="col-md-8">

                                    <input type="text" name="salary_amt" class="form-control unicode" placeholder="100000" id="salary"> 

                                </div>
                            </div>
              </div>
        </div>

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row salary">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Bonus</h6>
                                </div>

                                <div class="col-md-8">

                                    <input type="text" name="bonus" class="form-control unicode" placeholder="10000" id="bonus"> 

                                </div>
                            </div>
              </div>
        </div>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('salary.index')}}"> Back</a>
                        <button type="submit" class="btn btn-success unicode" onClick="javascript:p=true;" style="height: 34px;font-size: 13px">Save</button>
                    </div>
            </div><br>
             
                        
        </div>
  </form>
@stop 



@section('css')
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}"/>
@stop



@section('js')
<script type="text/javascript" src="{{ asset('jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
          $("#pay_date").datepicker({ dateFormat: 'dd-mm-yy' });
        

    });

    $(document).on("change",".salary", function (e) {
         var salary = $("#salary").val();
         var bonus = $("#bonus").val();
         var total =  parseInt(salary) +  parseInt(bonus);
          $("#month_total").val(total);
    });

    $(document).on("change",".ctr_item_option", function (e) {

        var is_employee =$(this).find(':selected').attr('data_is_employee');
        // alert(is_employee);
         $.ajax({
                type: "GET",
                dataType: "json",
                url: "<?php echo route('get_department_data') ?>",
                data: {'emp_id': is_employee},
                success: function(data){
                    $("#department").val(data.name);
                    $("#branch").val(data.branch_name);
                    $("#name").val(data.employee_name);
                    // console.log(data.name);
                }
            });
    
    });
</script>
@stop