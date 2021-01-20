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
           
<div class="row">
        <div class="col-lg-10">
             <a class="btn btn-success unicode" href="{{route('salary.index')}}"> Back</a>
        </div>
        <div class="col-lg-2">
            <div class="pull-right">
              <form action="#" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                @csrf
                                @method('DELETE')

                                <a class="btn btn-sm btn-primary" href="#"><i class="fa fa-fw fa-edit" /></i></a>

                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
                            </form>
            </div>
        </div>
    </div><br>
  <div class="row">
        <div class="col-lg-12">
            <div>
                <h6 class="text-center text-dark text-md"><b>{{$employees->name}} 's Information</b></h6>
            </div>
        </div>
    </div>
    <br>
<div class="table-responsive" style="font-size:15px;">
	<table class="table table-bordered styled-table">


		<thead>
			<tr>
				<th style="width: 300px">Month</th>
				<th style="width: 350px">Salary</th>
				<th style="text-align: center;" style="width: 250px">Bonus</th>
			</tr>
		</thead>
    <tbody>
      @foreach($salarys as $salary)
      @if($salary->emp_id == $employees->id)
      <tr>
        <td>{{$salary->pay_date}}</td>
        <td>{{$salary->salary_amt}}</td>
        <td>{{$salary->bonus}}</td>
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

        
@stop