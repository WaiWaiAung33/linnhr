@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

 <script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
@stop

@section('content')
           
 <?php
  $year = isset($_GET['year'])?$_GET['year']:''; 
  // dd($year);
  ?>

<div class="row">
        <div class="col-lg-10">
             <a class="btn btn-success unicode" href="{{route('salary.index')}}"> Back</a>
        </div>
        
 </div><br>

  <form action="{{route('salary.show',$employees->id)}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
          <div class="col-md-12">
          <div class="row payyear">
          <div class="col-md-2">
             <label for="">Payment year</label>
             <input type="text" name="year" id="year"class="form-control unicode" placeholder="2020" value="{{ old('year',$year) }}">
          </div>
        </div>
      </div>
    </div>
  </form>

  <div class="row">
        <div class="col-lg-12">
            <div>
                <h6 class="text-center text-dark text-md"><b>{{$employees->name}} 's Salary Information</b></h6>
            </div>
        </div>
    </div>
    <br>
    <?php
    $salary_total = 0;
    $bonus_total = 0;
    ?>
<p >Total record: {{$count}}</p>
<div class="table-responsive" style="font-size:15px;">
	<table class="table table-bordered styled-table">


		<thead>
			<tr>
				<th>Month</th>
				<th >Salary</th>
				<th style="width: 250px">Bonus</th>
        <th>Total</th>
        <th>Action</th>
			</tr>
		</thead>
    <tbody>
      @foreach($salarys as $salary)
      @if($salary->emp_id == $employees->id)
      <tr>
        <td>{{$salary->pay_date}}</td>
        <td>{{number_format($salary->salary_amt)}}</td>
        <td>{{number_format($salary->bonus)}}</td>
        <td>{{number_format($salary->month_total)}}</td>
        <?php
          $salary_total+= $salary->salary_amt;
          $bonus_total+= $salary->bonus;
        ?>
        
           <td>
                  <form action="{{route('salary.destroy',$salary->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-sm btn-primary" href="{{route('salary.edit',$salary->id)}}" ><i class="fa fa-fw fa-edit" style="padding-top: 5px;padding-bottom: 5px;padding-left: 2px;padding-right: 5px"/></i></a> 
                     <button type="submit" class="btn btn-sm btn-danger" style="margin-left: 10px"><i class="fa fa-fw fa-trash" /></i></button> 
                   </form>
                </td>
       
      </tr>
     
      @endif
      @endforeach
       <tr style=" background-color: #c7d4dd;">
        <td>Month Total</td>
        <td>{{number_format($salary_total)}}</td>
        <td>{{number_format($bonus_total)}}</td>
        <?php
        $total = 0;
        $total = $salary_total + $bonus_total;
        ?>
        <td colspan="2">{{number_format($total)}}</td>
      </tr>
    </tbody>

	
	</table>

</div>

@stop 



@section('css')
 <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
 $(document).ready(function(){
   $(function() {
    
     $("#year").datepicker({  format: "yyyy",
    viewMode: "years", 
    minViewMode: "years" });
       
   });
   $(function() {
     $('#year').on('change',function(e) {
        this.form.submit();
               // $( "#form_id" )[0].submit();   
      });
   });
});
 </script>
        
@stop