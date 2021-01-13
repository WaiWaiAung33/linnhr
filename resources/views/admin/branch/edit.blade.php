
@extends('adminlte::page')

@section('title', 'Branch')

@section('content_header')
@stop
@section('content')
 <div class="container" style="margin-top: 50px; ">
        <form action="{{route('branch.update',$branchs->id)}}" method="POST" >
        @csrf
       @method('PUT')

       <div class="row">
               
        <label class="col-md-2 unicode">Branch Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <input type="text" name="name" id="name" value="{{$branchs->name}}" class="form-control unicode">
         
        </div>    
    </div><br>

         <div class="row">
               
        <label class="col-md-2 unicode">Latitude</label>
        <div class="col-md-5">
            
            <input type="text" name="latitude" id="latitude" value="{{$branchs->latitude}}" class="form-control unicode">
         
        </div>    
               
        </div><br>

          <div class="row">
               
        <label class="col-md-2 unicode">Logitude</label>
        <div class="col-md-5">
            
            <input type="text" name="longitude" id="longitude" value="{{$branchs->longitude}}" class="form-control unicode">
         
        </div>    
               
        </div><br>
        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('branch.index')}}"> Back</a>
                        <button type="submit" class="btn btn-success unicode">Update</button>
                    </div>
            </div>

        </form>
    </div>
@stop 