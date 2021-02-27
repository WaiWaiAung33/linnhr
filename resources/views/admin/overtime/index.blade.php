
@extends('adminlte::page')

@section('title', 'Overtime')

@section('content_header')
<h5 style="color: blue;">Overtime Management</h5>
@stop
@section('content')

<div>

     <a class="btn btn-success unicode" href="{{route('overtime.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Overtime</a>
  
      {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

    
    <p>Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Employee Name</th>
                        <th>Apply Date</th>
                        <th>Reason</th>
                      
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                  @if($overtimes->count()>0)
                   @foreach($overtimes as $overtime)
                        <tr class="table-tr" >
                            <td>{{++$i}}</td>
                            <td>{{$overtime->viewEmployee->name}}</td>
                            <td>{{date('d-m-Y',strtotime($overtime->apply_date))}}</td>
                            <td>{{$overtime->reason}}</td>
                            
                           
                           
                            <td>
                                <form action="{{route('overtime.destroy',$overtime->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('overtime.edit',$overtime->id)}}"><i class="fa fa-fw fa-edit"></i></a>
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
            {!! $overtimes->appends(request()->input())->links() !!}
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