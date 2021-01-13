@extends('adminlte::page')

@section('title', 'Department')

@section('content_header')
@stop
@section('content')

 <div class="container" style="margin-top: 50px; ">
        <form action="{{route('department.update',$departments->id)}}" method="POST" >
        @csrf
       @method('PUT')

       <div class="row">
               
        <label class="col-md-2 unicode">Department Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <input type="text" name="name" id="name" value="{{$departments->name}}" class="form-control unicode">
         
        </div>    
    </div><br>

       <!--   <div class="row">
               
        <label class="col-md-2 unicode">In Time</label>
        <div class="col-md-5">
            
            <input type="date" name="in_time" id="in_time" value="{{$departments->in_time}}" class="form-control unicode">
         
        </div>    
               
        </div><br>

          <div class="row">
               
        <label class="col-md-2 unicode">Out Time</label>
        <div class="col-md-5">
            
            <input type="date" name="out_time" id="out_time" value="{{$departments->out_time}}" class="form-control unicode">
         
        </div>    
               
        </div><br> -->
        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('department.index')}}"> Back</a>
                        <button type="submit" class="btn btn-success unicode">Update</button>
                    </div>
            </div>

        </form>
    </div>

@stop