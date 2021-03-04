@extends('adminlte::page')

@section('title', 'Branch')

@section('content_header')

@stop
@section('content')
 <div class="container" style="margin-top: 50px; ">
     <div class="col-md-6"  align="center">
        <h6>Off Day</h6> 
        <div id='calendar'></div>
    </div>
  </div>
@stop 


@section('css')
<link href='{{ asset("calender/fullcalendar.min.css") }}' rel='stylesheet' />
  <link href='{{ asset("calender/fullcalendar.print.min.css") }}' rel='stylesheet' media='print' />
  <style>
     #calendar {
        max-width: 95%;
        margin: 0 auto;
        font-family:Pyidaungsu,Yunghkio,'Masterpiece Uni Sans' !important;
        font-size: 13px;
    }
    .fc-content{
      color: white;
    }
  </style>
@stop

<?php
$arr1 = []; 
$arr0 = [];
foreach($emp_offday_arr as $emp_offday){

    $a = ['title'=>'Offday', 'start'=> date('Y-').date('m-d',strtotime($emp_offday)) ];

    array_push($arr1, $a);
    array_push($arr0,$a);
}
$date = date('Ymd')."";
?>

@section('js')
 <script src="{{ asset('js/jquery.min.js') }}"></script> 
<script src='{{ asset("calender/moment.min.js") }}'></script>
<script src='{{ asset("calender/fullcalendar.min.js") }}'></script>
<script>
  var bdEmployees = <?php echo json_encode($arr0); ?>;
    $(document).ready(function() {
        console.log(<?php echo json_encode($arr1); ?>);
        $('#calendar').fullCalendar({
            defaultDate: new Date(),
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: <?php echo json_encode($arr1); ?>
        });
        
        $('#calendar').delegate('.fc-day', 'mouseover', function(){
            if(bdEmployees.indexOf($(this).attr('data-date'))=="-1"){
                pointerdate = $(this).attr('data-date');
                curdate = <?php echo $date; ?>;
                // console.log(curdate);
                arr=pointerdate.split('-');
                pointerdate = arr[0]+arr[1]+arr[2];
                // console.log(" > "+pointerdate);
                if(pointerdate<=curdate){
                    return false;
                }
                // $(this).html('<center><a href="{{ route("employee.index") }}" style="text-decoration:none"><h2 style="margin-top:40px; width:150px"></h2></a></center>');
                // $(this).css('background', '#fdf');
                // $(this).css('cursor', 'pointer');
            }
        });

        $('#calendar').delegate('.fc-day a', 'mouseover', function(){
         // alert("a mouseover");
        });

        $('#calendar').delegate('.fc-day', 'mouseout', function(){
            $(this).html('');
            $(this).css('background', '#ffffff');
        });

        // $('#calendar').delegate('.fc-day', 'click', function(){
        //     href = $(this).find('a').attr('href');
        //     if(href==undefined){
        //         return false;
        //     }
        //     window.location.href=$(this).find('a').attr('href');
        // });
    });
</script>
@stop