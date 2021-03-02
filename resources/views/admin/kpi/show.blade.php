@extends('adminlte::page')
@section('title', 'KPI Detail')
@section('content_header')
<div class="row">
  <a class="btn btn-primary unicode" href="{{route('kpi.index')}}"> Back</a>
</div>
@stop
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-8 text-center">
          @if($kpi->employee->photo == '')
            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="100px" height="120px">
          @else
            <img src="{{ asset('uploads/employeePhoto/'.$kpi->employee->photo) }}" alt="photo" width="100px" height="120px">
          @endif
        </div>
      </div>
      <br>
      <div class="row">
            <div class="col-md-4">
              <b>Name : </b>
            </div>
            <div class="col-md-6">
              {{ $kpi->employee->name }}
            </div>
      </div>
          <div class="row">
            <div class="col-md-4">
              <b>Department : </b>
            </div>
            <div class="col-md-6">
              {{ $kpi->employee->viewDepartment->name }}
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <b>Position : </b>
            </div>
            <div class="col-md-6">
              {{ $kpi->employee->viewPosition->name }}
            </div>
          </div>
           <div class="row">
            <div class="col-md-4">
              <b>Branch : </b>
            </div>
            <div class="col-md-6">
              {{ $kpi->employee->viewBranch->name }}
            </div>
          </div>
        </div>

        <div class="col-md-8">
          @php
            $kpiArr = ['Poor','Bad','Average','Good','Excellent'];
            $colorArr = ['#FC0107','#FD8008','#0576f4','#00A825','#21FF06'];

            $totalpoint = 0;
            $totalpoint = $kpi->knowledge + $kpi->descipline + $kpi->skill_set + $kpi->team_work + $kpi->social + $kpi->motivation; 
          @endphp

            <div class="row">
            @foreach($kpiArr as $i=>$label)

              <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;"> {{++$i}} = {{ $label }}</button>&nbsp;&nbsp;&nbsp;
            @endforeach
            </div>
            <br>
          <div class="table-responsive" style="font-size:14px">
            <table class="table table-bordered styled-table">
              @php 
                $date = $kpi->year .'-'. $kpi->month;
              @endphp
              <tr>
                <th>Date</th>
                <td>{{ date('F Y',strtotime($date)) }}</td>
              </tr>
              <tr>
                <th>Knowledge</th>
                <td>
                  @foreach($kpiArr as $i=>$label) 
                    @php $j = $i +1; @endphp
                    @if($j==$kpi->knowledge)
                      <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                    @endif
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Discipline</th>
                <td>
                  @foreach($kpiArr as $i=>$label) 
                    @php $j = $i +1; @endphp
                    @if($j==$kpi->descipline)
                      <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                    @endif
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Skill Set</th>
                <td>
                  @foreach($kpiArr as $i=>$label) 
                    @php $j = $i +1; @endphp
                    @if($j==$kpi->skill_set)
                      <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                    @endif
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Team Work</th>
                <td>
                  @foreach($kpiArr as $i=>$label) 
                    @php $j = $i +1; @endphp
                    @if($j==$kpi->team_work)
                      <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                    @endif
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Social</th>
                <td>@foreach($kpiArr as $i=>$label) 
                    @php $j = $i +1; @endphp
                    @if($j==$kpi->social)
                      <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                    @endif
                  @endforeach</td>
              </tr>
              <tr>
                <th>Motivation</th>
                <td>
                  @foreach($kpiArr as $i=>$label) 
                    @php $j = $i +1; @endphp
                    @if($j==$kpi->motivation)
                      <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                    @endif
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>Total Point</th>
                <td>{{$totalpoint }}</td>
              </tr>
              <tr>
                <th>Comment</th>
                <td>{{ $kpi->comment }}</td>
              </tr>
            </table>
        </div>
      </div>
  </div>
</div>


@stop 
@section('css')
<style>
  th {
    font-weight: bold;
    color: black;
    font-size: 14px;
  }
</style>
@stop
@section('js')

@stop
