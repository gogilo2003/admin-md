@extends('admin::web.layout.main')

@section('title')
	Projects
@stop

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Projects</li>
@stop

@section('content')
	@include('admin::web.inc.projects')
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
