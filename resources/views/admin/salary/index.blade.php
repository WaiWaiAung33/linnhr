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
        // dd($name);
        $dep_id = isset($_GET['dep_id'])?$_GET['dep_id']:''; 
        // $brand_id = isset($_GET['brand_id'])?$_GET['brand_id']:''; 
?>

<h5 style="color:#1179C2 ">Salary Management</h5>

 {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif --}}

   <form action="{{route('salary.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
            <div class="row form-group">
               <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                           <label for="">Search by Keyword</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Search..." value="{{ old('name',$name) }}">
                        </div>
                        <div class="col-md-3">
                            
                            <label for="">Select Department</label>
                            <select class="form-control" id="dep_id" name="dep_id">
                                <option value="">All</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}" {{ (old('dep_id',$dep_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
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
          </div>
        </div>
        </form>

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
           
 <p style="padding-top: 20px">Total record: {{$count}}</p>
<div class="table-responsive" style="font-size:15px;">
	<table class="table table-bordered styled-table">


		<thead>
			<tr>
				<th style="width: 300px">Employee Information</th>
				<th style="width: 350px">Photo</th>
				<th colspan="12" style="text-align: center;" style="width: 250px">Month</th>
			</tr>
		</thead>

		<tbody>
     @if($employees->count()>0)
      @foreach($employees as $employee)
    
		  <tr class="table-tr" data-url="{{route('salary.show',$employee->id)}}">
        <td>
          Employee ID : {{$employee->emp_id}} <br>
          Name : {{$employee->name}}
        </td>  
        <td>
          <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
        </td>

        <!-- @foreach($employee->viewSalary as $salary)
          <td>{{$salary->pay_date}}</td>
          @endforeach -->

          <td>
           

            @if($employee->viewSalary->first())
             {{$employee->viewSalary->first()->pay_date}} <br>
              Salary : {{
                $employee->viewSalary->first()->salary_amt
              }}<br>
              Bonus : {{
              $employee->viewSalary->first()->bonus
            }}
             @endif
          </td>
      </tr>	
      @endforeach
        @else
          <tr align="center">
            <td colspan="10">No Data!</td>
          </tr>
      @endif   
		</tbody>
	</table>

</div>
{{ $employees->appends(['sort' => 'votes'])->links() }}
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
              $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
            // alert("hello");
          });
              
        });

         
        
         });
</script>
        
@stop