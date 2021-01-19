
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
    .header{
        text-align: center;
    }
</style>
@stop

@section('content')
    <div class="row">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
 <?php 
      $currentyear = date('Y');
      $currentday = date('m');
      $creentmonth = date('d');
      // dd($creentmonth);
      $joinday = date('m',strtotime($employees->join_date));
      $joinyear = date('Y',strtotime($employees->join_date));
      $joinmonth = date('d',strtotime($employees->join_date));
      // dd($joinmonth);
      if($currentday < $joinday || $creentmonth < $joinmonth) {
        $work = $currentyear - $joinyear;
        $workyear = $work - 1;
      }else {
        $workyear = $currentyear - $joinyear;
      }
  ?>

  <?php 
      $currentyearbirth = date('Y');
      $currentdaybitrh = date('m');
      $currentmonthbirth = date('d');
      $joindaybirth = date('m',strtotime($employees->date_of_birth));
      $joinyearbirth = date('Y',strtotime($employees->date_of_birth));
      $joinmonthbirth = date('d',strtotime($employees->date_of_birth));
      if($currentdaybitrh < $joindaybirth || $currentmonthbirth < $joinmonthbirth) {
        $workbirth = $currentyearbirth - $joinyearbirth;
        $workyearbirth = $workbirth - 1;
      }else {
        $workyearbirth = $currentyearbirth - $joinyearbirth;
      }
  ?>

<div class="row">
        <div class="col-lg-10">
             <a class="btn btn-success unicode" href="{{route('employee.index')}}"> Back</a>
        </div>
        <div class="col-lg-2">
            <div class="pull-right">
              <form action="{{route('employee.destroy',$employees->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                @csrf
                                @method('DELETE')

                                <a class="btn btn-sm btn-primary" href="{{route('employee.edit',$employees->id)}}"><i class="fa fa-fw fa-edit" /></i></a>

                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
                            </form>
            </div>
        </div>
    </div><br>

    <div class="row form-group">
        <div class="col-md-4">
            <div class="header">
                @if($employees->photo == '')
                <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="200px" height="200px">
                @else
                 <img src="{{ asset('uploads/employeePhoto/'.$employees->photo) }}" alt="photo" width="200px" height="200px">
                 @endif
            </div>
            <div class="header">
                <h6 style="color: gray;padding-top: 10px">{{$employees->name}}</h6>
            </div>
            <!-- <div class="header">
                <h8 style="color: gray">{{$employees->viewPosition->name}}</h8>
            </div> -->
           <!--  <div style="text-align: center;background-color: #5a4080;color: white;padding-top: 5px;padding-bottom: 5px;margin-top: 10px;width: 200px;margin-left:130px">
                <h9>At work for :<h9> <span style="font-size: 14px">({{$workyear}}) years</span></h8>
            </div> -->
        </div>
        <div class="col-md-7">
        <div class="table-responsive">
             <table class="table table-bordered styled-table">
                <thead>
                    <tr>
                        <th style="font-size: 16px"><i class="fa fa-address-book" ></i> Personal Detail</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name<span style="padding-left: 200px">{{$employees->name}}</span></td>
                        
                    </tr>
                    <tr>
                        <td>Father's Name<span style="padding-left: 155px">{{$employees->father_name}}</span></td>
                    </tr>
                    <tr>
                        <td>Date of birth<span style="padding-left: 165px">{{date('d-m-Y',strtotime($employees->date_of_birth))}}</span> <span>({{$workyearbirth}}) years</span></td>
                    </tr>
                    <tr>
                        <td>Full Nrc<span style="padding-left: 190px">{{$employees->fullnrc}}</span></td>
                    </tr>
                    <tr>
                        <td>Gender<span style="padding-left: 195px">{{$employees->gender}}</span></td>
                    </tr>
                    <tr>
                        <td>Phone <span style="padding-left: 195px">{{$employees->phone_no}}</span></td>
                    </tr>
                    <tr>
                        <td>Address<span style="padding-left: 190px">{{$employees->address}}</span></td>
                    </tr>
                </tbody>
             </table>
         
        </div>

         <div class="table-responsive">
             <table class="table table-bordered styled-table">
                <thead>
                    <tr>
                        <th style="font-size: 16px"><i class="fa fa-briefcase"></i> Company Detail</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Employee Id<span style="padding-left: 165px">{{$employees->emp_id}}</span></td>
                        
                    </tr>
                    <tr>
                        <td>Department<span style="padding-left: 165px">{{$employees->viewDepartment->name}}</span></td>
                    </tr>
                    <tr>
                        <td>Designation<span style="padding-left: 165px">{{$employees->viewPosition->name}}</span></td>
                    </tr>
                    <tr>
                        <td>Branch<span style="padding-left: 195px">{{$employees->viewBranch->name}}</span></td>
                    </tr>
                    <tr>
                        <td>Join Ddate <span style="padding-left: 170px">{{date('d-m-Y',strtotime($employees->join_date))}} </span><span>({{$workyear}}) years</span></td>
                    </tr>
                   
                </tbody>
             </table>
         
        </div>


        </div>



    </div>


@stop 



@section('css')

@stop



@section('js')

        
@stop