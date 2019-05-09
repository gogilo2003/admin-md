@extends('admin::web.layout.main')

@section('title')
	Profile
@stop

@section('sidebar_left')
	page sidebar_left
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="thumbnail">
					<img src="{{ url('public/images/profiles/'.$profile->picture) }}" class="img-responsive img-fluid" alt="{{ $profile->name }}">
				</div>
			</div>
			<div class="col-md-8">
				<h1>{{ $profile->name }} <small>{{ $profile->position }}</small></h1>
				<div class="text-justify"> {!! $profile->details !!}</div>
			</div>
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