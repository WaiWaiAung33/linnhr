
@extends('adminlte::page')

@section('title', 'Ro')

@section('content_header')
<h5 style="color: blue;">Ro Management</h5>
@stop
@section('content')
<a class="btn btn-success unicode" href="{{route('ro.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Ro</a><br><br>
<div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                       <th>Branch</th>
                      <th>Department</th>
                      <th>Ro</th>
                      <th>Member</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($office_reporters->count()>0)
                      @foreach($office_reporters as $office_reporter)
                        <tr>
                          <td>{{$office_reporter->branch_name}}</td>
                          <td>{{$office_reporter->department}}</td>
                          <td>
                             @if($office_reporter->photo == '')
                                <img src="{{ asset('uploads/employeePhoto/default.png') }}" width="40px" height="40px">
                                </td>
                                @else
                                 <img src="{{ asset('uploads/employeePhoto/'.$office_reporter->photo)}}" width="40px" height="40px">
                                 @endif 
                            {{$office_reporter->ro_name}}
                          </td>
                         
                          <td>
                            
                          @foreach($ro_members as $ro_member)
                          @if($ro_member->ro_id == $office_reporter->id)
                            @if($ro_member->members->photo == '')
                                <img src="{{ asset('uploads/employeePhoto/default.png') }}" width="40px" height="40px" style="margin-top: 10px">
                                </td>
                                @else
                                 <img src="{{ asset('uploads/employeePhoto/'.$ro_member->members->photo)}}" width="40px" height="40px" style="margin-top: 10px">
                                 @endif
                            {{$ro_member->members->name}}<br>
                           @endif
                          @endforeach
                          
                        </td>
                        <td>
                                <form action="{{route('ro.destroy',$office_reporter->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('ro.edit',$office_reporter->id)}}"><i class="fa fa-fw fa-edit"></i></a>
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
       </div>   
@stop 
@section('css')
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('/js/bootstrap-datepicker.min.js')}}"></script>
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
            $('#branch_id').on('change',function(e) {

                this.form.submit();
            });
            $('#dept_id').on('change',function(e) {

                this.form.submit();
            });

            $('#date').on('change',function(e) {

                this.form.submit();
            });
   
        });
        $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
        });

        $("#date").datepicker({ format: 'dd-mm-yyyy' });

         
        });
     </script>
@stop