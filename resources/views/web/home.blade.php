@extends('admin::web.layout.main')

@section('title')
	Home Page
@endsection

@section('breadcrumbs')
	@parent
@endsection

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

    @include('admin::web.inc.blogs')

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
