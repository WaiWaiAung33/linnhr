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
<div style="position: absolute;bottom: 15px;right: 15px">
        <a class="btn btn-primary unicode" href="{{route('salary.create')}}" style="width: 50px;height: 50px;border-radius: 25px"><i class="fa fa-plus" style="padding-top: 10px" /></i></a>
</div>

 {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif --}}

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
</script>
        
@stop