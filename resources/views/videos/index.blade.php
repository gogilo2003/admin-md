@extends('admin::layout.main')

@section('title')
	Videos
@stop

@section('page_title')
	Videos
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-video_categories') }}"><i class="fa fa-folder-open-o"></i> Video Categories</a>
	</li>
	<li class="active"><span><i class="fa fa-film"></i> Videos</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::video_categories.sidebar')
	
@stop

@section('content')
	<a href="{{route('admin-videos-add')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp; Add Video</a>
	<hr>
	<div class="row">
		@foreach ($videos as $video)
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<div class="thumbnail text-center">
					<i class="fa fa-file-video-o fa-5x"></i><br>
					<div style="height:150px; margin: 15px auto">
						<h3>{{ $video->title }}</h3>
						<em>{{ $video->caption }}</em> <br>
						<h4 class="text-info"><hr>{{ $video->category->title }}<hr></h4>
					</div>
					
					<p>
						<a href="{{route('admin-videos-edit',$video->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
					</p>
				</div>
			</div>
		@endforeach
	</div>
@stop

@section('styles')
	<style type="text/css">
		
	</style>
@stop
@section('scripts_top')
	<script type="text/javascript">
		
	</script>
@stop

@section('scripts_bottom')
	<script type="text/javascript">
		
	</script>
@stop