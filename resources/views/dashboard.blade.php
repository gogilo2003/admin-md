@extends('admin::layout.main')

@section('title')
	Dashboard
@endsection

@section('page_title')
	Dashboard
@endsection

@section('breadcrumbs')
	<li class="active"><span><i class="fa fa-dashboard"></i>&nbsp;Dashboard</span></li>
@endsection

@section('sidebar')
	@parent
@endsection

@section('content')
	<br>
	<div class="row">
		<div class="col-sm-12 col-md-6 col-lg-6">
			<canvas class="Chart" id="overalBrowsersStats"></canvas>
		</div>
		<div class="col-sm-12 col-md-6 col-lg-6">
			<canvas class="Chart" id="overalOsStats"></canvas>
		</div>
	</div>
	<hr style="margin-top: 0">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<canvas class="Chart" id="weeklyStats"></canvas>
		</div>
	</div>
@endsection

@section('styles')
	<style type="text/css">
		.Chart {
			background: #212733;
			border-radius: 15px;
			box-shadow: 0px 2px 15px rgba(25, 25, 25, 0.27);
			margin:  25px 0;
		}

		.Chart h2 {
			margin-top: 0;
			padding: 15px 0;
			color:  rgba(255, 0,0, 0.5);
			border-bottom: 1px solid #323d54;
		}
	</style>
@endsection

@section('scripts_top')
	
	<script type="text/javascript">
		// tinymce.init({selector:'textarea',menubar:false});
	</script>
@endsection

@section('scripts_bottom')
	<script type="text/javascript" src="{{ url('public/vendor/admin/js/Chart.min.js') }}"></script>
	<script type="text/javascript">
		
	
		$(document).ready(function(){
			$.post("{{ route('admin-hits-browsers') }}").then(function(response){
				
				var ctx = document.getElementById('overalBrowsersStats').getContext('2d');
				let data = {
				        labels: response.labels,
				        datasets: [{
				            backgroundColor: ['royalblue','green','orange','purple','yellow','beige','red'],
				            brderWidth: 0,
				            data: response.data,
				        }]
				    }

				var chart = new Chart(ctx, {
				    // The type of chart we want to create
				    type: 'pie',

				    // The data for our dataset
				    data,

				    // Configuration options go here
				    options: {
				    	cutoutPercentage: 75,
				    	legend: {
				    		position:'bottom',
				    		fullWidth: false,
				    		labels: {
				    			boxWidth: 12
				    		}
				    	},
				    	title:{
				    		display: true,
				    		position: 'top',
				    		text: 'Overal browsers Statistics'
				    	}
				    }
				});
			})

			$.post("{{ route('admin-hits-platforms') }}").then(function(response){
				
				var ctx = document.getElementById('overalOsStats').getContext('2d');
				let data = {
				        labels: response.labels,
				        datasets: [{
				            backgroundColor: ['royalblue','green','orange','purple','yellow','beige','red'],
				            brderWidth: 0,
				            data: response.data,
				        }]
				    }

				var chart = new Chart(ctx, {
				    // The type of chart we want to create
				    type: 'pie',

				    // The data for our dataset
				    data,

				    // Configuration options go here
				    options: {
				    	cutoutPercentage: 75,
				    	legend: {
				    		position:'bottom',
				    		fullWidth: false,
				    		labels: {
				    			boxWidth: 12
				    		}
				    	},
				    	title:{
				    		display: true,
				    		position: 'top',
				    		text: 'Overal Platforms Statistics'
				    	}
				    }
				});
			})

			$.post("{{ route('admin-hits-weekly-platforms') }}").then(function(response){
				
				var ctx = document.getElementById('weeklyStats').getContext('2d');
				let data = {
				        labels: response.labels,
				        datasets: response.datasets
				    }

				var chart = new Chart(ctx, {
				    // The type of chart we want to create
				    type: 'line',

				    // The data for our dataset
				    data,

				    // Configuration options go here
				    options: {
				    	cutoutPercentage: 75,
				    	responsive: true,
				    	legend: {
				    		position:'bottom',
				    		fullWidth: false,
				    		labels: {
				    			boxWidth: 12
				    		}
				    	},
				    	title:{
				    		display: true,
				    		position: 'top',
				    		text: 'Weekly Statistics'
				    	}
				    }
				});
			})
		})
	</script>
@endsection