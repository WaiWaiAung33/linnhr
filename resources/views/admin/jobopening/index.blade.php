@extends('adminlte::page')

@section('title', 'Department')

@section('content_header')
<h5 style="color: blue;">Jobopening Management</h5>
    <script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
@stop
@section('content')

 <div>
 	 <a class="btn btn-success unicode" href="{{route('jobopening.create')}}" style="float: right;"><i class="fas fa-plus"></i> Jobopening</a>
 </div>

 <?php
      $dep_id = isset($_GET['dep_id'])?$_GET['dep_id']:'';
?>

<div >


      {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

    <form action="{{route('jobopening.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
      
       <div class="col-md-3">                 
           <select class="form-control" id="dep_id" name="dep_id">
                              <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                              <option value="{{$department->id}}" {{ (old('dep_id',$dep_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                                    @endforeach
            </select>
        </div>
     </div>
    </form>

     <p style="padding-left: 10px">Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:15px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Title</th>
                        <th>Department Name</th>
                        <th>Rank</th>
                        <th>Posted Date</th>
                        <th>Last Date</th>
                        <th>Close Date</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                  @if($jobopenings->count()>0)
              		@foreach($jobopenings as $jobopening)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$jobopening->title}}</td>
                            <td>{{$jobopening->viewDepartment->name}}</td>
                            <td>{{$jobopening->viewPosition->name}}</td>
                            <td>{{date('d/m/Y',strtotime($jobopening->posted_date))}}</td>
                            <td>{{date('d/m/Y',strtotime($jobopening->last_date))}}</td>
                            <td>{{date('d/m/Y',strtotime($jobopening->close_date))}}</td>
                          
                            <td>
                                <form action="{{route('jobopening.destroy',$jobopening->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('jobopening.edit',$jobopening->id)}}"><i class="fa fa-fw fa-edit"></i></a>
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
             {!! $jobopenings->appends(request()->input())->links() !!}
       </div>  

                        
@stop 
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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
           $('#dep_id').on('change',function(e){
                this.form.submit();
            });
        });
         
        });
     </script>
@stop