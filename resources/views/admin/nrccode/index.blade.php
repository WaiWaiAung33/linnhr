
@extends('adminlte::page')

@section('title', 'NRC Code')

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

          .styled-table tbody tr {
              border-bottom: 1px solid #dddddd;
          }

          .styled-table tbody tr:nth-of-type(even) {
              background-color: #c7d4dd;
          }

          .styled-table tbody tr:last-of-type {
              border-bottom: 2px solid #1179C2;
          }
</style>
@stop
@section('content')
<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
?>
<div>
  <p style="font-size: 20px">NRC Code Management</p>
 <form action="{{route('nrccode.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row form-group">
          
            <div class="col-md-3">
               <input type="text" name="name" placeholder="Enter nrccode name" class="form-control" value="{{old('name',$name)}}"> 
            </div>
            <div class="col-md-2">
              <button class="btn btn-success unicode" type="submit">
                    Save
          </button>
            </div>
        </div>

</form>
     @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
     @endif

      <form action="{{route('nrccode.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
     
       <div class="col-md-3">                 
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search...">
        </div>
     </div>
    </form>
    <p>Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:15px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>NRCCode Name</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($nrccodes->count()>0)
              		 @foreach($nrccodes as $nrccode)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$nrccode->name}}</td>
                            <td>
                                <form action="{{route('nrccode.destroy',$nrccode->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('nrccode.edit',$nrccode->id)}}"><i class="fa fa-fw fa-edit"></i></a>
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
           {!! $nrccodes->appends(request()->input())->links() !!}
       </div>   
@stop 
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
 <script> 
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