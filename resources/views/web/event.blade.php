@extends('admin::web.layout.main')

@section('title')
	{{ $event->title }}
@stop

@section('sidebar_left')
	{{ $event->title }}
@stop

@section('content')
	<div class="container"> {{ $event->title }}</div>
@stop

@section('sidebar_right')
	{{ $event->title }}
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