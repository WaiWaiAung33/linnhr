@extends('adminlte::page')

@section('title', 'Actual Time In')

@section('content_header')
@stop
@section('content')

 <div class="container" style="margin-top: 50px; ">
        <form action="{{route('actual_timein.store')}}" method="post" enctype="multipart/form-data" style="padding-top: 10px">
        @csrf

       <div class="row">
               
        <label class="col-md-2 unicode">Actual Time In</label>
        <div class="col-md-5 {{ $errors->first('actual_timein', 'has-error') }}">
            
            <input type="text" name="actual_timein" id="actual_timein" class="form-control unicode">
         
        </div>    
    </div><br>
    
        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('actual_timein.index')}}"> Back</a>
                        <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
                         Save
                     </button>
                    </div>
            </div>

        </form>
    </div>

@stop
@section('css')
   <style type="text/css" media="screen">
        .error_msg{
            color: #DD4B39;
        }
        .has-error input{
            border-color: #DD4B39;
        }
        .jQWCP-wWidget{
            width: 300px !important;
            height: 200px !important;
        }
  </style>
    <link type="text/css" rel="stylesheet" href="{{ asset('colorpicker/css/wheelcolorpicker.css')}} " />
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@stop



@section('js')
    <script type="text/javascript" src="{{ asset('colorpicker/js/jquery-2.0.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('colorpicker/js/jquery.wheelcolorpicker-3.0.5.min.js') }} "></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
          $('#color-css').wheelColorPicker();
        });
        $(function(){
            $('.timepicker').datetimepicker({

        format: 'HH:mm:ss'

    }); 
        });
    </script>
@stop