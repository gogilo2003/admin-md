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

    @includeIf('admin::web.inc.services')

    @includeIf('admin::web.inc.profiles')

    @includeIf('admin::web.inc.sermons')

    @includeIf('admin::web.inc.projects')

    @includeIf('admin::web.inc.events')

    @includeIf('admin::web.inc.gallery')

    @includeIf('admin::web.inc.file')

    @includeIf('admin::web.inc.blogs')

    @includeIf('clients::web.inc.clients')

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
