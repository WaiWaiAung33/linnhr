 @extends('adminlte::page')

@section('title', 'Notice Board')

@section('content_header')
<style>
.add {
  background-color:#AA55AA;
  border: none;
  color: white;
  padding: 2px 20px;
  font-size: 30px;
  cursor: pointer;
}

/* Darker background on mouse-over */
.add:hover {
  background-color: #FF55FF;
}
.input-group.md-form.form-sm.form-1 input{
border: 1px solid purple;
border-top-right-radius: 0.25rem;
border-bottom-right-radius: 0.25rem;
}
.input-group-text{
background-color:#AA55AA;
color:white;
}
.switch {
  position: relative;
  display: inline-block;
  width: 45px;
  height: 22px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 15px;
  width: 15px;
  left: 2px;
  bottom: 0px;
  top:3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 36px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<h5 style="color: blue;">Notice Board Management</h5>
@stop
@section('content')
<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
?>
<div>

   <a class="btn btn-success unicode" href="{{route('notice_board.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Notice Board</a>

      <form action="{{route('notice_board.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
     
       <div class="col-md-3">                 
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
        </div>
     </div>
      </form>

      <p style="padding-left: 10px">Total record:{{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Publish Date</th>
                        <th>Active/Inactive</th>
                        <th>Uploaded by</th>  
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($notice_boards->count()>0)
              		 @foreach($notice_boards as $notice_board)

                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$notice_board->title}}</td>
                            <td>{{$notice_board->description}}</td>
                            <td>{{date('d-m-Y',strtotime($notice_board->publish_date))}}</td>
                            <td>
                              <label class="switch">
                                  <input data-id="{{$notice_board->id}}" data-size ="small" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $notice_board->status ? 'checked' : '' }}>
                                  <span class="slider round"></span>
                              </label>
                            </td>
                           
                            @if($notice_board->name != null)
                            <td>{{$notice_board->name}}</td>
                            @else
                            <td></td>
                            @endif
                            <td>
                                <form action="{{route('notice_board.destroy',$notice_board->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-info" href="{{route('notice_board.show',$notice_board->id)}}"><i class="fa fa-fw fa-eye" /></i></a> 
                                    <a class="btn btn-sm btn-primary" href="{{route('notice_board.edit',$notice_board->id)}}"><i class="fa fa-fw fa-edit"></i></a>
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
           {!! $notice_boards->appends(request()->input())->links() !!}
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
                var post_id = $(this).data('id'); 
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo(route("change-status-post")) ?>",
                    data: {'status': status, 'post_id': post_id},
                    success: function(data){
                     console.log(data.success);
                    }
                });
            })
          });

     </script>
@stop