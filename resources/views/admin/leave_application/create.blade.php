@extends('adminlte::page')

@section('title', 'Hostel')

@section('content_header')
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<style type="text/css">
    .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 35px;
    user-select: none;
    -webkit-user-select: none; }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 30px;
    position: absolute;
    top: 2px;
    right: 0px;
    left: 365px;
    width: 100px; }
</style>
@stop
@section('content')
 <div class="container" >
        <form action="{{route('leave_application.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
       <div class="row">
               
        <label class="col-md-2 unicode">Employee Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <select class="livesearch form-control" name="emp_id"></select>
         
        </div>    
    </div><br>
      <div class="row">
               
        <label class="col-md-2 unicode">Leave Type</label>
        <div class="col-md-5 {{ $errors->first('leave_type', 'has-error') }}">
            
         <select class="form-control" id="leave_type" name="leave_type" style="font-size: 13px">
            <option value="">All</option>
            @foreach($leave_types as $leave_type)
            <option value="{{$leave_type->id}}">{{$leave_type->leave_type}}</option>
            @endforeach
         </select>
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Half_day Type</label>
        <div class="col-md-5 {{ $errors->first('half_day', 'has-error') }}">
            
            <input type="text" name="half_day" id="half_day" class="form-control">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Start Date</label>
        <div class="col-md-5 {{ $errors->first('start_date', 'has-error') }}">
            
            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="12/02/2021">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">End Date</label>
        <div class="col-md-5 {{ $errors->first('end_date', 'has-error') }}">
            
            <input type="text" name="end_date" id="end_date" class="form-control" placeholder="12/03/2021">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Days</label>
        <div class="col-md-5 {{ $errors->first('day', 'has-error') }}">
            
            <input type="text" name="day" id="day" class="form-control" placeholder="1">
         
        </div>    
    </div><br>
     <div class="row">
               
        <label class="col-md-2 unicode">Apply Date</label>
        <div class="col-md-5 {{ $errors->first('apply_date', 'has-error') }}">
            
            <input type="text" name="apply_date" id="apply_date" class="form-control" placeholder="12/01/2021">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Reason</label>
        <div class="col-md-5 {{ $errors->first('reason', 'has-error') }}">
            
            <input type="text" name="reason" id="reason" class="form-control" placeholder="--">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Application Status</label>
        <div class="col-md-5 {{ $errors->first('apply_status', 'has-error') }}">
            
            <select class="form-control" id="application_status" name="application_status" style="font-size: 13px">
                <option value="">All</option>  
                <option value="0">Pending</option>
                <option value="1">Approved</option>
                <option value="2">Rejected</option>
               </select>
         
        </div>    
    </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('leave_application.index')}}"> Back</a>
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
<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
     $(document).ready(function(){

        $(function() {
            $('.livesearch').select2({
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

         $(function(){
        $('.livesearch').change(function(){
          var is_employee = $(this).find(':selected').val();
          // alert(is_employee);
            // alert(is_employee);$('#first').find(':selected').val();
             $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo route('get_hostelemployee_data') ?>",
                    data: {'emp_id': is_employee},
                    success: function(data){
                        // console.log(data.branch_id);
                        $("#department").val(data.department_id);
                        $("#branch").val(data.branch_id);
                        $("#name").val(data.employee_name);
                        $("#position").val(data.position_id);

                        console.log(data.name);
                    }
                });
        });
    });


        $("#start_date").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#end_date").datepicker({ dateFormat: 'dd-mm-yy' });
          $("#apply_date").datepicker({ dateFormat: 'dd-mm-yy' });

});

</script>
@stop