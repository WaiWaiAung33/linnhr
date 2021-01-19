@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<style type="text/css">
  
   .styled-table {
          border-collapse: collapse;
          /*margin: 25px 0;*/
          font-size: 0.9em;
          font-family: sans-serif;
          min-width: 400px;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
          }
          .styled-table thead tr {
              background-color: #1179C2;
              color: #ffffff;
              text-align: left;
          }
          .styled-table th,
          .styled-table td {
              padding: 12px 15px;
          }

          .styled-table tbody tr {
              border-bottom: 1px solid #dddddd;
          }

          /*.styled-table tbody tr:nth-of-type(even) {
              background-color: #c7d4dd;
          }*/

         

</style>
@stop

@section('content')
<!-- <div style="position: absolute;bottom: 15px;right: 15px">
        <a class="btn btn-primary unicode" href="{{route('salary.create')}}" style="width: 50px;height: 50px;border-radius: 25px"><i class="fa fa-plus" style="padding-top: 10px" /></i></a>
</div> -->

<?php
        $name = isset($_GET['name'])?$_GET['name']:'';  
        $dep_id = isset($_GET['dep_id'])?$_GET['dep_id']:''; 
        // $brand_id = isset($_GET['brand_id'])?$_GET['brand_id']:''; 
?>

 {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif --}}

   <form action="{{route('salary.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
            <div class="row">
                        <div class="col-md-3">
                           
                            <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search...">
                        </div>
                        <div class="col-md-3">
                            
                           
                            <select class="form-control" id="dep_id" name="dep_id">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                <option value="{{$department->name}}" {{ (old('dep_id',$dep_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                                @endforeach
                            </select>
                           
                        </div>
                        <div class="col-md-3">
                          
                            <!-- <select class="form-control" id="brand_id" name="brand_id">
                             
                            </select> -->
                        </div>
                        <div class="col-md-3">
                             <a class="btn btn-success unicode" href="{{route('salary.create')}}" style="float: right;"><i class="fas fa-plus"> Salary</i></a>
                        </div>
               
            </div>
        </form><br>

          <form class="form-horizontal" action="{{route('salaryimport')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-3">
                            <input type="file" name="file" class="form-control">
                            @if ($errors->has('file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                        <button class="btn btn-success btn-sm"><i class="fas fa-file-csv" style="padding-left: 6px;padding-right: 6px;padding-top: 6px;padding-bottom: 6px"></i> Import CSV</button>
                        </div>
                       <div class="col-md-5"></div>
                       <!-- <div class="col-md-1">
                        <a class="btn btn-warning btn-sm" id="export_btn" style="float: right;" ><i class="fa fa-fw fa-file-excel"></i>Export</a>
                       </div> -->
                       
                    
                    </div>
        </form>
           

<div class="table-responsive" style="font-size:15px;">
	<table class="table table-bordered styled-table">


		<thead>
			<tr>
				<th style="width: 200px">No</th>
				<th style="width: 100px">Photo</th>
				

				<th colspan="2" style="text-align: center;">January</th>
			
				<!-- <th>Febuary</th>
				<th>March</th>
				<th>April</th>
				<th>May</th>
				<th>June</th>
				<th>July</th>
				<th>Augest</th>
				<th>September</th>
				<th>October</th>
				<th>November</th>
				<th>December</th> -->
			</tr>
		</thead>
		<tbody>
			@foreach($salarys as $salary)
				@if($salary->emp_id)
			  <tr> 
			  	<td><b>Name:</b> <span style="padding-left: 10px"><b>{{$salary->viewEmployee->name}}</b></span></td>
			  	<td rowspan = "3"><img src="{{ asset('uploads/employeePhoto/'.$salary->viewEmployee->photo) }}" alt="photo" width="80px" height="80px"></td>
			  	<td rowspan = "1">Salary</td>
			  	<td rowspan = "1">Bonus</td>
			  	<!-- <td rowspan = "3">nar</td>
			  	<td rowspan = "3">apy</td>
			  	<td rowspan = "3">may</td>
			  	<td rowspan = "3">june</td>
			  	<td rowspan = "3">july</td>
			  	<td rowspan = "3">augest</td>
			  	<td rowspan = "3">sep</td>
			  	<td rowspan = "3">oct</td>
			  	<td rowspan = "3">nov</td>
			  	<td rowspan = "3">dec </td>
			  	<td rowspan = "3">dec </td> -->
			  </tr>
			  <tr>
			  	<td>ID: <span style="padding-left: 25px">{{$salary->viewEmployee->emp_id}}</span></td>
			  	<td rowspan="2">{{$salary->salary_amt}}</td>
			  	<td rowspan="2">{{$salary->bonus}}</td>
			  </tr>
			  <tr>
			  	<td>DOB: <span style="padding-left: 10px">{{date('d-m-Y',strtotime($salary->viewEmployee->date_of_birth))}}</span></td>
			  	
			  </tr>
			  @endif
			@endforeach
		</tbody>
	</table>
</div>
@stop 



@section('css')
 <link rel="stylesheet" href="/css/admin_custom.css">
@stop



@section('js')
<script type="text/javascript">
	  @if(Session::has('success'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('success') }}");
        @endif

         $(document).ready(function(){
         	 $(function() {
                $('#name').on('change',function(e) {
                this.form.submit();
               // $( "#form_id" )[0].submit();   
            }); 
                $('#dep_id').on('change',function(e){
                this.form.submit();
              });
              //    $('#brand_id').on('change',function(e){
              //   this.form.submit();
              // });
        });
         });
</script>
        
@stop