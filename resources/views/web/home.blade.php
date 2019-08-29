@extends('admin::web.layout.main')

@section('title')
	Home Page
@stop

@section('breadcrumbs')
	@parent
@stop

@section('content')
    @include('admin::web.inc.carousel')

	<div class="container">
		{!! $page->content !!}
	</div>

    @include('admin::web.inc.services')

    @include('admin::web.inc.profiles')

    @include('admin::web.inc.sermons')

    @include('admin::web.inc.projects')

    @include('admin::web.inc.events')

    @include('admin::web.inc.gallery')

    @include('admin::web.inc.file')

@stop

@section('sidebar_right')
	Home Page sidebar_right
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
