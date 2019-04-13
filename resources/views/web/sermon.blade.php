@extends('admin::web.layout.main')

@section('title')
	{{ $sermon->title }}
@stop

@section('sidebar_left')
	page sidebar_left
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ $sermon->title }} <small>By {{ $sermon->sermon_by }}</small></h1>
				<p>Date: {!! date_create($sermon->sermon_at)->format('j\<\s\u\p\>S\<\/\s\u\p\> F, Y h:i:s A') !!}</p>
				<hr>
			</div>
			<div class="col-md-4">
				@if($sermon->audio)
					<h3>Listen to the recorded sermon</h3>
					<audio src="{{ url('public/audio/sermons/'.$sermon->audio) }}" class="img-responsive" controls="true"></audio>
				@endif
				@if($sermon->video)
					<h3>Watch the sermon here</h3>
					<video src="{{ url('public/video/sermons/'.$sermon->video) }}" class="img-responsive" controls="true"></video>
				@endif
			</div>
			<div class="col-md-8">
				<div class="thumbnail">
					<img src="{{ url('public/images/sermons/'.$sermon->picture) }}" class="img-responsive" alt="{{ $sermon->title }}">
				</div>
			</div>
			<div class="col-md-12">
				<div class="text-justify"> {!! $sermon->content !!}</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ url('/'.$page->link->url) }}">{{ $page->title }}</a></p>
			</div>
		</div>
	</div>
@stop

@section('sidebar_right')
	page sidebar_right
@stop

@section('styles')
	<style>
		
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