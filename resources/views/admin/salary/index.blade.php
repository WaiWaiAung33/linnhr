@extends('adminlte::page')

@section('title', 'Payment')

@section('content_header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<h5 style="color: blue;">Salary Management</h5>
@stop

@section('content')

<?php
        $name = isset($_GET['name'])?$_GET['name']:''; 
        // dd($name);
        $dep_id = isset($_GET['dep_id'])?$_GET['dep_id']:''; 
        $year = isset($_GET['year'])?$_GET['year']:''; 
        // dd($year);
        // $brand_id = isset($_GET['brand_id'])?$_GET['brand_id']:''; 
?>


 {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif --}}



          <div class="row">
          <form class="form-horizontal" action="{{route('salaryimport')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-3">
                            <input type="file" name="file" class="form-control" style="font-size: 13px">
                            @if ($errors->has('file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                       
                        <button class="btn btn-success btn-sm"><i class="fas fa-file-csv" style="margin-left: 10px;font-size: 13px "></i> Import CSV</button>
                        
                       <a class="btn btn-primary btn-sm"  href="{{route('salarys.download.csv')}}" style="margin-left: 10px;font-size: 13px "><i class="fa fa-fw fa-download" style="padding-top: 8px" ></i>Demo CSV File</a>

                      {{--  <a class="btn btn-warning btn-sm" id="export_btn" style="font-size: 13px;margin-left: 10px"><i class="fa fa-fw fa-file-excel" style="padding-top: 8px"></i>Export</a>
 --}}
                     <!--   <button type="button" class="btn btn-warning " id="morefilter" style="margin-left: 10px;font-size: 13px"><i class="fa fa-filter" aria-hidden="true"></i></button> -->

                         <a class="btn btn-success unicode" href="{{route('salary.create')}}" style="margin-left: 10px;font-size: 13px"><i class="fas fa-plus"></i> Salary</a>
                       
                    
                    </div>
        </form>
      </div>

      {{-- <form id="excel_form" action="{{ route('salaryexport') }}"  method="POST" class="unicode">
                @csrf
                @method('post')
                
                <input type="hidden" name="dep_id" value="{{ $dep_id }}">
               
     </form> --}}

         <form action="{{route('salary.index')}}" method="get" accept-charset="utf-8" class="form-horizontal" >
            <div class="row form-group" id="adv_filter">
               <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                           <label for="">Search by Keyword</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Search..." value="{{ old('name',$name) }}" style="font-size: 13px">
                        </div>
                        <div class="col-md-3">
                            
                            <label for="">Select Department</label>
                            <select class="form-control" id="dep_id" name="dep_id" style="font-size: 13px">
                                <option value="">All</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}" {{ (old('dep_id',$dep_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                                @endforeach
                            </select>
                           
                        </div>
                        <div class="col-md-3">
                          
                            <label for="">Payment year</label>
                             <input type="text" name="year" id="year"class="form-control unicode" placeholder="2021" value="{{ old('year',$year) }}" style="font-size: 13px">
                        </div>
                      <!--   <div class="col-md-3">
                             <a class="btn btn-success unicode" href="{{route('salary.create')}}" style="float: right;"><i class="fas fa-plus"></i> Salary</a>
                        </div> -->
               
            </div>
          </div>
        </div>
        </form>
           
 <p style="padding-top: 20px">Total record: {{$count}}</p>
<div class="table-responsive" style="font-size:14px;overflow-x:auto;">
	<table class="table table-bordered styled-table ">
		<thead>
			<tr>
				<th>No</th>
				<th>Photo</th>
        <th colspan="2">January</th>
        <th colspan="2">February</th>
        <th colspan="2">March</th>
        <th colspan="2">April</th>
        <th colspan="2">May</th>
        <th colspan="2">June</th>
        <th colspan="2">July</th>
        <th colspan="2">August</th>
        <th colspan="2">September</th>
        <th colspan="2">October</th>
        <th colspan="2">November</th>
        <th colspan="2">December</th>
				<!-- <th colspan="12" style="text-align: center;" style="width: 250px">Month</th> -->
			</tr>
		</thead>
     <?php
     $now_year =  now()->year;
     ?>
		<tbody>
     @if($employees->count()>0)
      @foreach($employees as $employee)
    
		  <tr class="table-tr" data-url="{{route('salary.show',$employee->id)}}">
         <td><p style="width: 100px;font-weight: bold;"> {{$employee->emp_id}} </p>
          <p style="width: 100px;font-weight: bold;"> {{$employee->name}}</p>
        </td>  

        @if($employee->photo == '')
        <td>
        <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
        </td>
        @else
        <td>
         <img src="{{ asset('uploads/employeePhoto/'.$employee->photo) }}" alt="photo" width="80px" height="80px">
         </td>
         @endif

        <td> <p style="font-weight: bold">Salary</p>  
           @foreach($employee->viewSalary as $salary)
           @if($year != "")
                 @if($salary->pay_date == "January" && $salary->year == $year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                 @endif
            @else
                 @if($salary->pay_date == "January" && $salary->year == $now_year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                  @endif
            @endif
            @endforeach
        </td>
        <td> <p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "January" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
             @else
                 @if($salary->pay_date == "January" && $salary->year == $now_year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @endif
          @endforeach
        </td>

        <td> <p style="font-weight: bold">Salary</p>
          @foreach($employee->viewSalary as $salary)
           @if($year != "")
                 @if($salary->pay_date == "February" && $salary->year == $year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "February" && $salary->year == $now_year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "February" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "February" && $salary->year == $now_year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @endif
          @endforeach
        </td>

        <td> <p style="font-weight: bold">Salary</p>
           @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "March" && $salary->year == $year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "March" && $salary->year == $now_year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "March" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "March" && $salary->year == $now_year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @endif
          @endforeach
        </td>

        <td> <p style="font-weight: bold">Salary</p>
          @foreach($employee->viewSalary as $salary)
          @if($year != "")
               @if($salary->pay_date == "April" && $salary->year == $year)
                {{
                 number_format($salary->salary_amt)
                }}
              @endif
          @else
              @if($salary->pay_date == "April" && $salary->year == $now_year)
              {{
               number_format($salary->salary_amt)
              }}
               @endif
          @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "April" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @else
               @if($salary->pay_date == "April" && $salary->year == $now_year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @endif
          @endforeach
        </td>

        <td> <p style="font-weight: bold">Salary</p>
           @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "May" && $salary->year == $year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "May" && $salary->year == $now_year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "May" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @else
                   @if($salary->pay_date == "May" && $salary->year == $now_year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
            @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "June" && $salary->year == $year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "June" && $salary->year == $now_year)
                {{
                 number_format($salary->salary_amt)
                }}
              @endif
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "June" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @else
                  @if($salary->pay_date == "June" && $salary->year == $now_year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
            @foreach($employee->viewSalary as $salary)
             @if($year != "")
                 @if($salary->pay_date == "July" && $salary->year == $year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @else
                  @if($salary->pay_date == "July" && $salary->year == $now_year)
                    {{
                     number_format($salary->salary_amt)
                    }}
                  @endif
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
            @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "July" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "July" && $salary->year == $now_year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
           @foreach($employee->viewSalary as $salary)
           @if($year != "")
                 @if($salary->pay_date == "August" && $salary->year == $year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
          @else
                 @if($salary->pay_date == "August" && $salary->year == $now_year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
          @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
          @foreach($employee->viewSalary as $salary)
           @if($year != "")
                 @if($salary->pay_date == "August" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
          @else
                 @if($salary->pay_date == "August" && $salary->year == $now_year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
          @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
           @foreach($employee->viewSalary as $salary)
           @if($year != "")
                 @if($salary->pay_date == "September" && $salary->year == $year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "September" && $salary->year == $now_year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
           @if($year != "")
                 @if($salary->pay_date == "September" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "September" && $salary->year == $now_year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
            @foreach($employee->viewSalary as $salary)
             @if($year != "")
                 @if($salary->pay_date == "October" && $salary->year == $year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "October" && $salary->year == $now_year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
            @foreach($employee->viewSalary as $salary)
             @if($year != "")
                 @if($salary->pay_date == "October" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "October" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
           @foreach($employee->viewSalary as $salary)
           @if($year != "")
               @if($salary->pay_date == "November" && $salary->year == $year)
                {{
                 number_format($salary->salary_amt)
                }}
              @endif
            @else
               @if($salary->pay_date == "November" && $salary->year == $now_year)
              {{
               number_format($salary->salary_amt)
              }}
              @endif
          @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "November" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @else
                  @if($salary->pay_date == "November" && $salary->year == $now_year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
            @foreach($employee->viewSalary as $salary)
             @if($year != "")
                 @if($salary->pay_date == "December" && $salary->year == $year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "December" && $salary->year == $now_year)
                  {{
                   number_format($salary->salary_amt)
                  }}
                @endif
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
            @if($year != "")
                 @if($salary->pay_date == "December" && $salary->year == $year)
                  {{
                   number_format($salary->bonus)
                  }}
                @endif
            @else
                 @if($salary->pay_date == "December" && $salary->year == $now_year)
                {{
                 number_format($salary->bonus)
                }}
              @endif
            @endif
          @endforeach
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
{{ $employees->appends(['sort' => 'votes'])->links() }}
</div>

@stop 



@section('css')

@stop



@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<!-- <script src="{{ asset('jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('jquery-ui.js') }}"></script> -->
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
    
             $("#year").datepicker({  format: "yyyy",
            viewMode: "years", 
            minViewMode: "years" });
               
           });

         	 $(function() {
                    $('#name').on('change',function(e) {
                    this.form.submit();
                   // $( "#form_id" )[0].submit();   
                    }); 
                    $('#dep_id').on('change',function(e){
                    this.form.submit();
                    });

                    $('#year').on('change',function(e) {
                      this.form.submit();
                             // $( "#form_id" )[0].submit();   
                    });
                      $('#export_btn').click(function(){
                        $('#excel_form').submit();
                    });

                     $( "#morefilter" ).click(function(e) {
                      e.preventDefault();
                      if($('#adv_filter:visible').length)
                          $('#adv_filter').hide("slide", { direction: "right" }, 1000);
                      else
                      $('#adv_filter').show("slide", { direction: "right" }, 1000);
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