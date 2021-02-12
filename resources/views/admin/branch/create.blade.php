
@extends('adminlte::page')

@section('title', 'Branch')

@section('content_header')
@stop
@section('content')
 <div class="container" style="margin-top: 50px; ">
         <form action="{{route('branch.store')}}" method="post" enctype="multipart/form-data" style="padding-top: 10px">
        @csrf

       <div class="row">
               
        <label class="col-md-2 unicode">Branch Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
             <input type="text" name="name" placeholder="Enter branch name" class="form-control" style="font-size: 13px"> 
         
        </div>    
    </div><br>

         <div class="row">
               
        <label class="col-md-2 unicode">Latitude</label>
        <div class="col-md-5">
            
            <input type="text" name="latitude" placeholder="Enter latitude name" class="form-control" style="font-size: 13px">
         
        </div>    
               
        </div><br>

          <div class="row">
               
        <label class="col-md-2 unicode">Logitude</label>
        <div class="col-md-5">
            
          <input type="text" name="longitude" placeholder="Enter longitude name" class="form-control" style="font-size: 13px">
         
        </div>    
               
        </div><br>
        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('branch.index')}}"> Back</a>
                        <button class="btn btn-success" type="submit" style="font-size: 13px">
                    Save
                     </button>
                    </div>
            </div>

        </form>
    </div>
@stop 