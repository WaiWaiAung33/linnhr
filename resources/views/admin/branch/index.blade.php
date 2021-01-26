

@extends('adminlte::page')

@section('title', 'Branch')

@section('content_header')
<h5 style="color: blue;">Branch Management</h5>
    <script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
@stop
@section('content')
<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
?>
<div>
  
 <form action="{{route('branch.store')}}" method="post" enctype="multipart/form-data" style="padding-top: 10px">
        @csrf
        <div class="row form-group">
          
            <div class="col-md-3">
               <input type="text" name="name" placeholder="Enter branch name" class="form-control"> 
            </div>
            
          <div class="col-md-3">
            <input type="text" name="latitude" placeholder="Enter latitude name" class="form-control">
              
            </div>
            
            <div class="col-md-3">
                <input type="text" name="longitude" placeholder="Enter longitude name" class="form-control">
            </div>
            <div class="col-md-1">
              <button class="btn btn-success" type="submit">
                    Save
            </button>
            </div>
        </div>
      <!--   <div class="row form-group">
          
        </div> -->
        
       <!--  <div class="row">
          <div class="col-md-2"></div>
          <button class="btn btn-success" type="submit">
                    Save
          </button>
        </div> -->
    </form>

     {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

      <form action="{{route('branch.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
     
       <div class="col-md-3">                 
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search...">
        </div>
     </div>
      </form>

      <p style="padding-left: 10px">Total record:{{$count}}</p>
    <div class="table-responsive" style="font-size:15px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Branch Name</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($branchs->count()>0)
              		 @foreach($branchs as $branch)

                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$branch->name}}</td>
                            <td>
                                <form action="{{route('branch.destroy',$branch->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('branch.edit',$branch->id)}}"><i class="fa fa-fw fa-edit"></i></a>
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
           {!! $branchs->appends(request()->input())->links() !!}
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