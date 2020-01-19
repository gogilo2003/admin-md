@extends('admin::web.layout.main')

@section('title')
	Home Page
@endsection

@section('breadcrumbs')
	@parent
@endsection

@section('content')
    @include('admin::web.inc.carousel')
    <div class="container form-group">
        <label for="my-textarea">Text</label>
        <textarea id="my-textarea" class="form-control" name="" rows="10">{!! break_string($page->content,5) !!}</textarea>
    </div>

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

    @include('clients::web.inc.clients')

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
