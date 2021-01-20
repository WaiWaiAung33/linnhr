@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />
@stop

@section('content')
 
  
  <form action="#" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Employee Name</h6>
                                </div>

                                <div class="col-md-8">

                                     <input type="text" name="department" class="form-control unicode" id="department" readonly value="{{$salarys->name}}"> 

                                </div>
                            </div>
              </div>
        </div>

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Department</h6>
                                </div>

                                <div class="col-md-8">

                                       <input type="text" name="department" class="form-control unicode" id="department" readonly value="{{$salarys->department}}" > 

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

                                       <input type="text" name="branch" class="form-control unicode" id="branch" readonly value="{{$salarys->branch}}" > 

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

                                    <input type="text" name="pay_date" class="form-control unicode"  readonly value="{{$salarys->pay_date}}"> 

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Salary Amout</h6>
                                </div>

                                <div class="col-md-8">

                                    <input type="text" name="salary_amt" class="form-control unicode" value="{{$salarys->salary_amt}}" > 

                                </div>
                            </div>
              </div>
        </div>

        <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Bonus</h6>
                                </div>

                                <div class="col-md-8">

                                    <input type="text" name="bonus" class="form-control unicode" placeholder="10000" value="{{$salarys->bonus}}" > 

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

@stop



@section('js')
<script type="text/javascript" src="{{ asset('jquery-ui.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		  $("#pay_date").datepicker({ dateFormat: 'dd-mm-yy' });
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
      
        // var branch_id =$(this).find(':selected').attr('data_branch_id');
        // $("#branch").val(branch_id);

    });
</script>
@stop