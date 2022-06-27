@extends('admin::web.layout.main')

@section('title')
	Projects
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Projects</li>
@endsection

@section('content')
	@include('admin::web.inc.projects')
@endsection

@section('sidebar_right')
	page sidebar_right
@endsection

@section('styles')
	<style>

	</style>
@endsection

@section('scripts_top')
	<script type="text/javascript">

	</script>
@endsection

@section('scripts_bottom')
	<script type="text/javascript">

	</script>
@endsection
