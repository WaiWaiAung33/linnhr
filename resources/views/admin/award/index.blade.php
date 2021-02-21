@extends('adminlte::page')

@section('title', 'Branch')

@section('content_header')
<h5 style="color: blue;">Award</h5>
@stop
@section('content')



   <a class="btn btn-success unicode" href="{{route('award.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i>Add New!!!</a><br>


      <p style="padding-left: 10px">Total record:{{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Employee Name</th>
                        <th>Award Name</th>
                        <th>Gift</th>
                        <th>Cash Price</th>
                        <th>Month</th>
                        <th>Year</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($awards->count()>0)
              		 @foreach($awards as $award)

                        <tr class="table-tr" data-url="{{route('award.show',$award->id)}}">
                          <td>{{++$i}}</td>
                            <td>{{$award->employee->name}}</td>
                            <td>{{$award->award_name}}</td> 
                            <td>{{$award->gift}}</td>
                            <td>{{$award->cash_price}}</td>
                            <td>{{$award->month}}</td>
                            <td>{{$award->year}}</td>
                        </tr>
                         @endforeach
                          @else
                          <tr align="center">
                            <td colspan="10">No Data!</td>
                          </tr>
                        @endif
			            
                    </tbody>
           </table> 
           {!! $awards->appends(request()->input())->links() !!}
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