@extends('adminlte::page')

@section('title', 'Training Employee')

@section('content_header')

    <h5 style="color: blue;">Training Employee Management</h5>
@stop
@section('content')
<a class="btn btn-success unicode" href="{{route('training_emp.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Training Employee</a><br>
 <p style="padding-top: 20px">Total record: {{$count}} </p>
  <div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Training Name</th>
                        <th>Employee Name</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($trainings->count()>0)
                     @foreach($trainings as $training)
                    <tr>
                      <td>{{++$i}}</td>
                      <td>{{$training->viewEmployee->name}}</td>
                      <td>{{$training->viewTraining->name}}</td>
                        <td>
                                <form action="{{route('training_emp.destroy',$training->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-info" href="{{route('training_emp.show',$training->id)}}"><i class="fa fa-fw fa-eye" /></i></a> 
                                    <a class="btn btn-sm btn-primary" href="{{route('training_emp.edit',$training->id)}}"><i class="fa fa-fw fa-edit"></i></a>
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
            {!! $trainings->appends(request()->input())->links() !!}
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
       
     </script>
@stop