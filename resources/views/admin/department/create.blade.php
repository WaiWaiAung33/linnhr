@extends('adminlte::page')

@section('title', 'Department')

@section('content_header')
@stop
@section('content')

 <div class="container" style="margin-top: 50px; ">
        <form action="{{route('department.store')}}" method="post" enctype="multipart/form-data" style="padding-top: 10px">
        @csrf

       <div class="row">
               
        <label class="col-md-2 unicode">Department Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <input type="text" name="name" id="name" class="form-control unicode">
         
        </div>    
    </div><br>

      
        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('department.index')}}"> Back</a>
                        <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
                         Save
                     </button>
                    </div>
            </div>

        </form>
    </div>

@stop