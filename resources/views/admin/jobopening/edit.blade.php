@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
   
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
@stop

@section('content')
 
    <!-- <div class="row">
        <div class="col-lg-11">
            <a class="btn btn-success unicode" href="{{route('employee.index')}}"> Back</a>
        </div>
    </div><br> -->
  <form action="{{route('jobopening.update',$jobopenings->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Department</h6>
                                </div>

                                <div class="col-md-8 {{ $errors->first('dep_id', 'has-error') }}">

                                      <select class="form-control" name="dep_id" id="department">
                                        <option value="">Department</option>
                                        
                                        @foreach($departments as $department)
                                         <option value="{{$department->id}}" {{ (old('department',$jobopenings->dep_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
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
                                    <h6 style="font-weight:bold;font-size:15px;">Rank</h6>
                                </div>

                                <div class="col-md-8 ">

                                      <select class="form-control" name="position_id" id="position_id">
                                        <option value="">Rank</option>
                                        
                                        @foreach($positions as $position)
                                         <option value="{{$position->id}}" {{ (old('position',$jobopenings->position_id)==$position->id)?'selected':'' }}>{{$position->name}}</option>
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
                                    <h6 style="font-weight:bold;font-size:15px;">Title</h6>
                                </div>

                                <div class="col-md-8 $errors->first('title', 'has-error')">

                                       <input type="text" name="title" class="form-control unicode" id="title" value="{{$jobopenings->title}}"> 
                                       
                                </div>
                            </div>
              </div>
        </div>

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Description</h6>
                                </div>

                                <div class="col-md-8 $errors->first('description', 'has-error')">

                                       <input type="text" name="description" class="form-control unicode" id="description" value="{{$jobopenings->description}}"> 
                                       
                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Photo</h6>
                                </div>

                                <div class="col-md-8">
                                <input type="file" name="photo" class="form-control unicode">

                                </div>
                            </div>
              </div>
        </div>

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Posted Date</h6>
                                </div>

                                <div class="col-md-8 $errors->first('posted_date', 'has-error')">

                                       <input type="text" name="posted_date" class="form-control unicode" id="posted_date" placeholder="01-10-2021" value="{{$jobopenings->posted_date}}"> 
                                

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Last Date</h6>
                                </div>

                                <div class="col-md-8 $errors->first('last_date', 'has-error')">

                                    <input type="text" name="last_date" class="form-control unicode" placeholder="01-10-2021" id="last_date" value="{{$jobopenings->last_date}}"> 
                                    

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row salary">
                                <div class="col-md-3">
                                    <h6 style="font-weight:bold;font-size:15px;">Close Date</h6>
                                </div>

                                <div class="col-md-8 $errors->first('close_date', 'has-error')">

                                    <input type="text" name="close_date" class="form-control unicode" placeholder="01-01-2021" id="close_date" value="{{$jobopenings->close_date}}">

                                </div>
                            </div>
              </div>
        </div>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('jobopening.index')}}"> Back</a>
                        <button type="submit" class="btn btn-success unicode" onClick="javascript:p=true;" style="height: 34px;font-size: 13px">Save</button>
                    </div>
            </div><br>
        	 
                        
        </div>
  </form>
@stop 



@section('css')
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"rel = "stylesheet">
    <style type="text/css" media="screen">
      .error_msg{
        color: #DD4B39;
      }
      .has-error input{
        border-color: #DD4B39;
      }
      .help-block{
        color: #DD4B39;
      }

  </style>
@stop



@section('js')
 <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		 $("#posted_date").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#last_date").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#close_date").datepicker({ dateFormat: 'dd-mm-yy' });

	});
</script>
@stop