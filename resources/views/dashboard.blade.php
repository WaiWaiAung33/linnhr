@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ $total_employees}}</h3>

              <p>ဝန်ထမ်းစုစုပေါင်း</p>
            </div>
            <div class="icon">
             <i class="fa fa-users "></i>
            </div>
            <a href="{{ url("/employee") }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$total_departments}}</h3>

              <p>ဌာန</p>
            </div>
            <div class="icon">
               <i class="fa fa-users "></i>
            </div>
            <a href="{{ url('department') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow" style="color: white !important">
            <div class="inner">
              <h3>{{$total_branches}}</h3>

              <p>ဆိုင်ခွဲ</p>
            </div>
            <div class="icon">
               <i class="fa fa-users "></i>
            </div>
            <a href="{{ url('branch') }}" class="small-box-footer"  style="color: white !important">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$new_empoyee}}</h3>

              <p>ဝန်ထမ်းအသစ်</p>
            </div>
            <div class="icon">
               <i class="fa fa-users "></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

 	<div class="row justify-content-center">
 		<div class="col-md-6" align="center">
 			<div id="chart1" style="height: 300px;"></div>
 		</div>
 		<div class="col-md-6"  align="center">
 			{{-- <div id="piechart" style="height: 300px;"></div> --}}
 			<div id="fmpie" style="height: 300px;"></div>
 		</div>
 	</div>
 	<br>
 	<hr>
 	<div class="row">
        <div class="col-md-6"  align="center">
	        <div id="pconchart" style="height: 300px;"></div>
        </div>
        	
 		<div class="col-md-6"  align="center">
	 		<div id="pconpie" style="height: 300px;"></div>
 		</div>

 	</div>

 	<br><br>

 	
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <!-- Charting library -->
 	<script src="{{ asset('js/chart.min.js') }}"></script>
    <!-- Chartisan -->
    <script src="{{ asset('js/chartisan_chartjs.umd.js') }}"></script>
    <!-- Your application script -->
     <script>

     	var deptsArr = <?php echo '["' . implode('", "', $deptArr) . '"]' ?>;
     	var deptEmpArr = <?php echo '["' . implode('", "', $deptEmpArr) . '"]' ?>;

     	var branchArr = <?php echo '["' . implode('", "', $branchArr) . '"]' ?>;
     	var branchEmpArr = <?php echo '["' . implode('", "', $branchEmpArr) . '"]' ?>;


    	var male_total = <?php echo json_encode($maleTotal) ?>;
    	var female_total = <?php echo json_encode($femaleTotal) ?>;
    	
    	var hostelNotStay = <?php echo json_encode($hostelNotStay) ?> ;
    	var hostelStay = <?php echo json_encode($hostelStay) ?> ;


    	const chart = new Chartisan({
		  el: '#chart1',
		  // url: 'https://chartisan.dev/chart/example.json',
		  data: {
			  "chart": { "labels": deptsArr },
			  "datasets": [
			     { "name": "Total ", "values":deptEmpArr }
			   
			  ]
			},
		  hooks: new ChartisanHooks()
		    .beginAtZero()
		    .colors()
		    .title('ဌာနအလိုက်ပြသခြင်း')
		})

		// const piechart = new Chartisan({
		//   el: '#piechart',
		//   data: {
		// 	  "chart": { "labels": deptsArr },
		// 	  "datasets": [
		// 	    { "name": "Total", "values": deptEmpArr }
		// 	  ]
		// 	},
		//   hooks: new ChartisanHooks()
		//     .datasets('doughnut')
		//     .pieColors(),
		// })



    	const fmpie = new Chartisan({
		  el: '#fmpie',
		  data: {
			  "chart": { "labels": ["ကျား", "မ"] },
			  "datasets": [
			    { "name": "စုစုပေါင်း", "values": [male_total,female_total] }
			  ]
			},
		  hooks: new ChartisanHooks()
		    .datasets('doughnut')
		    .pieColors()
		    .title('ကျား/မ အလိုက် ခွဲခြားပြသခြင်း')
		})

		var recovered_count = 4; 
    	var inpatient_count = 4; 
    	var dead_count = 5; 


    	const pconchart = new Chartisan({
		  el: '#pconchart',
		  // url: 'https://chartisan.dev/chart/example.json',
		  data: {
			  "chart": { "labels": branchArr },
			  "datasets": [
			    { "name": "စုစုပေါင်း", "values": branchEmpArr }
			  ]
			},
		  hooks: new ChartisanHooks()
		    // .colors(['#20FFFF', '#FD8008','#1F85DE','#DE781F'])
		    .colors()
		    .responsive()
		    .beginAtZero()
		    .legend({ position: 'bottom' })
		    .title('Employes at each Branches')
		})

		const pconpie = new Chartisan({
		  el: '#pconpie',
		  data: {
			   "chart": { "labels": ["အဆောင်မနေ","အဆောင်နေ"] },
			   "datasets": [
			    { "name": "", "values": [hostelNotStay,hostelStay] }
			   ]
			},
		  hooks: new ChartisanHooks()
		    .datasets('doughnut')
		    .pieColors()
		    .title('အဆောင်နေ/မနေ')
		   
		})

    </script>
@stop