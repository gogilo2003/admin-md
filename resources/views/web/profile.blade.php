@extends('admin::web.layout.main')

@section('title')
	Profile
@endsection

@section('sidebar_left')
	page sidebar_left
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="thumbnail">
					<img src="{{ asset(config('admin.path_prefix').'images/profiles/'.$profile->picture) }}" class="img-responsive img-fluid" alt="{{ $profile->name }}">
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
