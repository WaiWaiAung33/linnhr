
@extends('adminlte::page')

@section('title', 'Hostel Employee')

@section('content_header')
<h5 style="color: blue;">Hostel Employee Management</h5>
    <script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
@stop
@section('content')

<div>

 <a class="btn btn-success unicode" href="{{route('hostelemployee.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Hostel Employee</a>
 
     {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

     <!--  -->
    <p>Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Employee Name</th>
                        <th>Hostel Name</th>
                        <th>Room No</th>
                        <th>Start Date</th>
                        <th>Full Address</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($hostelemployees->count()>0)
                     @foreach($hostelemployees as $hostelemployee)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$hostelemployee->viewEmployee->name}}</td>
                            <td>{{$hostelemployee->viewHostel->name}}</td>
                            <td>{{$hostelemployee->viewRoom->room_no}}</td>
                            <td>{{date('d-m-Y',strtotime($hostelemployee->start_date))}}</td>
                            <td>{{$hostelemployee->full_address}}</td>
                            <td>
                                <form action="#" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('hostelemployee.edit',$hostelemployee->id)}}"><i class="fa fa-fw fa-edit"></i></a>
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
           {!! $hostelemployees->appends(request()->input())->links() !!}
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
        });
         
        });
     </script>
@stop