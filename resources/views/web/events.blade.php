@extends('admin::web.layout.main')

@section('title')
	Events
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Events</li>
@endsection

@section('content')
	@foreach ($events as $event)
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">{{ $event->title }}</div>
				<div class="card-body">
					<p>{{ str_words($event->content,35) }}</p>
				</div>
			</div>
		</div>
	@endforeach
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
