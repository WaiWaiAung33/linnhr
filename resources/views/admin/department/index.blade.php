

@extends('adminlte::page')

@section('title', 'Department')

@section('content_header')
    <h5 style="color: blue;">Department Management</h5>
@stop
@section('content')

<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
?>

<div >

   <a class="btn btn-success unicode" href="{{route('department.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Department</a>

      {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

    <form action="{{route('department.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
      
       <div class="col-md-3">                 
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
        </div>
     </div>
    </form>

     <p style="padding-left: 10px">Total record:{{$count}}</p>
    <div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Department Name</th>
                        <th>Employees</th>
                        <!-- <th>In Time</th>
                        <th>Out Time</th> -->
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                  @if($departments->count()>0)
              		@foreach($departments as $department)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$department->name}}</td>
                            <td>{{ $department->employees()->count() }}</td>
                           <!--  <td>{{date('d/m/Y',strtotime($department->in_time))}}</td>
                            <td>{{date('d/m/Y',strtotime($department->out_time))}}</td> -->
                            <td>
                                <form action="{{route('department.destroy',$department->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('department.edit',$department->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger btn-sm" type="submit">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>
                                </form>
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
             {!! $departments->appends(request()->input())->links() !!}
       </div>  
@stop 
@section('css')

@stop

@section('js')
 <script> 
   @if(Session::has('success'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('success') }}");
        @endif
        $(document).ready(function(){
            setTimeout(function(){
            $("div.alert").remove();
            }, 1000 ); 
            $(function() {
                $('#name').on('change',function(e) {
                this.form.submit();
            }); 
   
        });
          $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
        });
         
        });
     </script>
@stop
