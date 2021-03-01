@extends('adminlte::page')

@section('title', 'KPI')

@section('content_header')
<h5 style="color: blue;">KPI</h5>
@stop
@section('content')



   <a class="btn btn-success unicode" href="{{route('kpi.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i>Add KPI</a><br>
  @php
    $kpiArr = ['Poor','Bad','Average','Good','Excellent'];
    $colorArr = ['#FC0107','#FD8008','#0576f4','#00A825','#21FF06'];
  @endphp

    <div class="row">
    @foreach($kpiArr as $i=>$label)

      <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;"> {{++$i}} = {{ $label }}</button>&nbsp;&nbsp;&nbsp;
    @endforeach
    </div>
    <br>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Date</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Knowledge</th>
                      <th>Discipline</th>
                      <th>Skill Set</th>
                      <th>Team Work</th>
                      <th>Social</th>
                      <th>Motivation</th>
                      <th>Total Point</th>
                      <td>Action</td>
                    </tr>
                  </thead>
                    <tbody>
                    @if($kpis->count()>0)
              		    @foreach($kpis as $kpi)

                        @php
                          $totalpoint = 0;
                          $totalpoint = $kpi->knowledge + $kpi->descipline + $kpi->skill_set + $kpi->team_work + $kpi->social + $kpi->motivation; 
                        @endphp

                        <tr class="table-tr" data-url="{{route('kpi.show',$kpi->id)}}">
                          <td>{{++$no}}</td>
                          @php 
                            $date = $kpi->year .'-'. $kpi->month;
                          @endphp
                          <td>{{ date('M Y',strtotime($date)) }}</td>
                            <td align="center">
                              @if($kpi->employee->photo == '')
                                <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="60px" height="60px">
                              @else
                                <img src="{{ asset('uploads/employeePhoto/'.$kpi->employee->photo) }}" alt="photo" width="60px" height="60px">
                              @endif
                            </td>
                            <td>
                              {{ $kpi->employee->name}} <br>
                              {{ $kpi->employee->viewDepartment->name}} <br>
                              {{ $kpi->employee->viewPosition->name}}
                            </td>
                            <td> 
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->knowledge)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->descipline)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->skill_set)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->team_work)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->social)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->motivation)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td style="text-align: right;">{{ $totalpoint }}</td>
                            <td>
                              <form action="{{route('kpi.destroy',$kpi->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('kpi.edit',$kpi->id)}}"><i class="fa fa-fw fa-edit"></i></a>
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
          <p style="padding-left: 10px">Total record:{{$count}}</p>
           {!! $kpis->appends(request()->input())->links() !!}
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

        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var branch_id = $(this).data('id'); 
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo(route("change-status-active")) ?>",
                    data: {'status': status, 'branch_id': branch_id},
                    success: function(data){
                     console.log(data.success);
                    }
                });
            })
          });

     </script>
@stop