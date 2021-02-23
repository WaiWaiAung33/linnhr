@extends('adminlte::page')

@section('title', 'Hostel')

@section('content_header')

@stop
@section('content')
<div class="row">
    <div class="col-lg-10">
         <a class="btn btn-success unicode" href="{{route('leave_application.index')}}"> Back</a>
    </div>
    <div class="col-lg-2">
        <div class="pull-right">
          <form action="{{route('leave_application.destroy',$leave_application->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')

                            <a class="btn btn-sm btn-primary" href="{{route('leave_application.edit',$leave_application->id)}}"><i class="fa fa-fw fa-edit" /></i></a>

                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
          </form>
        </div>
    </div>
</div><br>
 <div class="container" >
        <form action="{{route('leave_application.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
       <div class="row">
               
        <label class="col-md-2 unicode">Employee Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            <input type="text" name="emp_id" value="{{$leave_application->employee->name}}" class="form-control" readonly="readonly">
        </div>    
    </div><br>
      <div class="row">
               
        <label class="col-md-2 unicode">Leave Type</label>
        <div class="col-md-5 {{ $errors->first('leave_type', 'has-error') }}">
         <input type="text" name="leave_type" value="{{$leave_application->leave_type->leave_type}}" class="form-control" readonly="readonly">
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Half_day Type</label>
        <div class="col-md-5 {{ $errors->first('half_day', 'has-error') }}">
            
            <input type="text" name="half_day" id="half_day" class="form-control" value="{{$leave_application->halfDayType}}" readonly="readonly">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Start Date</label>
        <div class="col-md-5 {{ $errors->first('start_date', 'has-error') }}">
            
            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="12/02/2021" value="{{$leave_application->start_date}}" readonly="readonly">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">End Date</label>
        <div class="col-md-5 {{ $errors->first('end_date', 'has-error') }}">
            
            <input type="text" name="end_date" id="end_date" class="form-control" placeholder="12/03/2021" value="{{$leave_application->end_date}}" readonly="readonly">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Days</label>
        <div class="col-md-5 {{ $errors->first('day', 'has-error') }}">
            
            <input type="text" name="day" id="day" class="form-control" placeholder="1" value="{{$leave_application->days}}" readonly="readonly">
         
        </div>    
    </div><br>
     <div class="row">
               
        <label class="col-md-2 unicode">Apply Date</label>
        <div class="col-md-5 {{ $errors->first('apply_date', 'has-error') }}">
            
            <input type="text" name="apply_date" id="apply_date" class="form-control" placeholder="12/01/2021" value="{{$leave_application->apply_date}}" readonly="readonly">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Reason</label>
        <div class="col-md-5 {{ $errors->first('reason', 'has-error') }}">
            
            <!-- <input type="text" name="reason" id="reason" class="form-control" placeholder="--"> -->
            <textarea class="form-control" readonly="readonly">{{$leave_application->reason}}</textarea>
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Application Status</label>
        <div class="col-md-5 {{ $errors->first('apply_status', 'has-error') }}">
            @if($leave_application->application_status == 0)
           <input type="text" name="application_status" class="form-control" value="Pending" readonly="readonly">
           @elseif($leave_application->application_status == 1)
           <input type="text" name="application_status" class="form-control" value="Approved" readonly="readonly">
           @else
            <input type="text" name="application_status" class="form-control" value="Rejected" readonly="readonly">
           @endif
        </div>    
    </div><br>
        </form>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop