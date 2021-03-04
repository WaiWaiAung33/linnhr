
@extends('adminlte::page')

@section('title', 'ro')

@section('content_header')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<style type="text/css">
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 35px;
        user-select: none;
        -webkit-user-select: none; 
    }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 30px;
        position: absolute;
        top: 2px;
        right: 0px;
        left: 365px;
        width: 100px; 
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black;
    }
</style>
@stop
@section('content')
<div class="container" >
        <form action="{{route('ro.update',$groups[0]->department_id)}}" method="post" enctype="multipart/form-data">
         @csrf
        @method('PUT')
     
        <div class="row">
               
        <label class="col-md-2 unicode">Branch</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
             <select class="form-control" name="branch_id" id="branch_id">
                <option value="">Branch</option>
                @foreach ($branches as $branch )
                  <option  value="{{$branch->id}}" @if($branch->id=== $groups[0]->branch_id) selected='selected' @endif>{{$branch->name}}</option>
                @endforeach
            </select>   
         
        </div>    
        </div><br>

        <div class="row">
               
        <label class="col-md-2 unicode">Department</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
             <select class="form-control" name="department_id" id="dep_id">
                <option value="">Department</option>
                @foreach ($departments as $department )
                  <option  value="{{$department->id}}" @if($department->id=== $groups[0]->department_id) selected='selected' @endif>{{$department->name}}</option>
                @endforeach
            </select>   
         
        </div>    
        </div><br>

         <div class="row">
               
        <label class="col-md-2 unicode">Ro</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
             <select class="livesearchs form-control" name="ro_id">
             @foreach($groups as $skey=>$group)
                @if($group->group == 'ro')                                   
                    <option value="{{$group->ro_id }}"}} selected>
                      {{ $group->employees[0]->name }}
                    </option>
                @endif
            @endforeach  
            </select>
         
        </div>    
        </div><br>

        <div class="row">
               
        <label class="col-md-2 unicode">Member</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
          <select multiple class="livesearch form-control" name="emp_id[]">
             @foreach($groups as $skey=>$group)
                @if($group->group == 'member')                                   
                    <option value="{{$group->ro_id }}"}} selected>
                    {{ $group->employees[0]->name }}
                    </option>
                @endif
            @endforeach
        </select>
         
        </div>    
        </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('ro.index')}}"> Back</a>
                         <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
                          Save
                    </button>
                    </div>
            </div>


        </form>
    </div>
@stop 
@section('css')
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}"/>

@stop

@section('js')
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script src="{{ asset('jquery-ui.js') }}"></script>
<script type="text/javascript"> 
    
         $(function() {

        var branch_id = $("#branch_id").val();
        var dep_id = $("#dep_id").val();
        $("#branch_id").change(function(){
            branch_id = $(this).val();
        });

        $("#dep_id").change(function(){
            dep_id = $(this).val();
            getEmployee(branch_id,dep_id)
        });


        getEmployee(branch_id,dep_id);
    });

    function getEmployee(branch_id,dep_id){
        var url = "<?php echo(route("ajax-get-emp-ro")) ?>";
        var fullurl = url + '?branch_id='+branch_id+"&dep_id="+dep_id;
        $('.livesearch').select2({
            placeholder: 'Select Employees',
            ajax: {
                url: fullurl,
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    }

      $(function() {
                $('.livesearchs').select2({
                placeholder: 'Employee Name',
                ajax: {
                    url: "<?php echo(route("ajax-autocomplete-search")) ?>",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            });

        
     </script>
@stop