@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<meta name="viewport" content="width=device-width, initial-scale=1">
<h5 style="color: blue;">Salary Management</h5>
    <script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
@stop

@section('content')

<?php
        $name = isset($_GET['name'])?$_GET['name']:''; 
        // dd($name);
        $dep_id = isset($_GET['dep_id'])?$_GET['dep_id']:''; 
        // $brand_id = isset($_GET['brand_id'])?$_GET['brand_id']:''; 
?>


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
<div class="table-responsive" style="font-size:15px;overflow-x:auto;">
	<table class="table table-bordered styled-table ">
		<thead>
			<tr>
				<th colspan="2">No</th>
				<th>Photo</th>
        <th colspan="2">January</th>
        <th colspan="2">Febuary</th>
        <th colspan="2">March</th>
        <th colspan="2">April</th>
        <th colspan="2">May</th>
        <th colspan="2">June</th>
        <th colspan="2">July</th>
        <th colspan="2">Augest</th>
        <th colspan="2">September</th>
        <th colspan="2">October</th>
        <th colspan="2">November</th>
        <th colspan="2">December</th>
				<!-- <th colspan="12" style="text-align: center;" style="width: 250px">Month</th> -->
			</tr>
		</thead>

		<tbody>
     @if($employees->count()>0)
      @foreach($employees as $employee)
    
		  <tr class="table-tr" data-url="{{route('salary.show',$employee->id)}}">
         <td><p style="width: 100px;font-weight: bold;">Employee ID </p>
           
          {{$employee->emp_id}} 
        </td>  
        <td><p style="font-weight: bold;width: 100px">Name</p>
           {{$employee->name}}
        </td>  
        <td>
          <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
        </td>

        <td> <p style="font-weight: bold">Salary</p>  
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "January")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
            @endforeach
        </td>
        <td> <p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "January")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <td> <p style="font-weight: bold">Salary</p>
          @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "Febuary")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "Febuary")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <td> <p style="font-weight: bold">Salary</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "March")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "March")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <td> <p style="font-weight: bold">Salary</p>
          @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "April")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "April")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <td> <p style="font-weight: bold">Salary</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "May")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "May")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "June")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "June")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "July")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "July")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "Augest")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
          @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "Augest")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "September")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "September")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "October")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "October")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "November")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "November")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <td><p style="font-weight: bold">Salary</p>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "December")
              {{
               number_format($salary->salary_amt)
              }}
            @endif
          @endforeach
        </td>
        <td><p style="font-weight: bold;">Bonus</p>
           @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "December")
              {{
               number_format($salary->bonus)
              }}
            @endif
          @endforeach
        </td>

        <!-- @foreach($employee->viewSalary as $salary)
          <td>{{$salary->pay_date}}</td>
          @endforeach -->
          
        <!--   <td>
            
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "January")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
           
          </td>
          <td>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "Febuary")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
          </td>
          <td>
             @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "March")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
          </td>
          <td>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "April")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
          </td>
          <td>
             @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "May")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
          </td>
          <td>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "June")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
          </td>
          <td>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "July")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
          </td>
          <td>
             @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "Augest")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
          </td>
          <td>
             @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "September")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
          </td>
          <td>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "October")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
          </td>
          <td>
            @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "November")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
          </td>
          <td>
             @foreach($employee->viewSalary as $salary)
             @if($salary->pay_date == "December")
              Salary : {{
               number_format($salary->salary_amt)
              }}<br>
              Bonus : {{
              number_format($salary->bonus)
            }}
            @endif
            @endforeach
          </td> -->
        <!--   <td>
           

            @if($employee->viewSalary->first())
             {{$employee->viewSalary->first()->pay_date}} <br>
              Salary : {{
               number_format($employee->viewSalary->first()->salary_amt)
              }}<br>
              Bonus : {{
              number_format($employee->viewSalary->first()->bonus)
            }}
             @endif
          </td> -->
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