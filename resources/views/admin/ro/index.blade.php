
@extends('adminlte::page')

@section('title', 'ro')

@section('content_header')
<h5 style="color: blue;">Ro Management</h5>
@stop
@section('content')
<a class="btn btn-success unicode" href="{{route('ro.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Ro</a><br><br>
<div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                       <!-- <th>Branch</th> -->
                      <th>Department</th>
                      <th>Ro</th>
                      <th>Member</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                     <tbody>
                    @if($departments->count()>0)
                      @foreach($departments as $i=>$dept)


                        @if($dept->group()->count()>0)
                        <tr class="table-tr" data-url="#">
                          
                            <td>{{ $dept->name }}</td>

                           
                             
                              <td>
                                 @foreach($dept->group as $gp)
                                 @if($gp->group == 'ro')
                                    <table>
                                        <tbody>
                                             @foreach($gp->employees as $i=>$emp)
                                                <tr >
                                                  <td style="border: none;">
                                                     @if($emp->photo == '')
                                                      <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="40px" height="40px">
                                                      </td>
                                                      @else
                                                       <img src="{{ asset('uploads/employeePhoto/'.$emp->photo)}}" alt="photo" width="40px" height="40px">
                                                       @endif
                                                  </td>
                                                  <td style="border: none;">{{ $emp['name'] }}</td>
                                                </tr>
                                                
                                              @endforeach
                                        </tbody>
                                      </table>
                                  @endif
                                @endforeach
                              </td>

                              <td>
                                @foreach($dept->group as $gp)
                                   @if($gp->group == 'member')
                                      <table>
                                        <tbody>
                                             @foreach($gp->employees as $i=>$emp)
                                                <tr >
                                                  <td style="border: none;">
                                                     @if($emp->photo == '')
                                                      <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="40px" height="40px">
                                                      </td>
                                                      @else
                                                       <img src="{{ asset('uploads/employeePhoto/'.$emp->photo)}}" alt="photo" width="40px" height="40px">
                                                       @endif
                                                  </td>
                                                  <td style="border: none;">{{ $emp['name'] }}</td>
                                                </tr>
                                                
                                              @endforeach
                                        </tbody>
                                      </table>
                                       
                                      
                                    @endif
                                @endforeach
                              </td>

                           
                            <td>
                                <form action="{{route('ro.destroy',$dept->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('ro.edit',$dept->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger btn-sm" type="submit">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endif
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