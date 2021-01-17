@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />
@stop

@section('content')
 <div class="row">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
    </div>
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

                                      <select class="form-control" name="emp_id" id="catselect">
			                            <option value="">Select Category</option>
			                            @foreach ($employees as $employee )
			                              <option  value="{{$employee->id}}" id="catoption">{{$employee->name}}</option>
			                            @endforeach
			                        </select> 

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Pay Date</h6>
                                </div>

                                <div class="col-md-8">

                                    <input type="text" name="pay_date" class="form-control unicode" placeholder="01-10-2021" id="pay_date"> 

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

                                    <input type="text" name="salary_amt" class="form-control unicode" placeholder="100000" > 

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

                                    <input type="text" name="bonus" class="form-control unicode" placeholder="10000" > 

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
</script>
@stop