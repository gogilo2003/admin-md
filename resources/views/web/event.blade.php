@extends('admin::web.layout.main')

@section('title')
	{{ $event->title }}
@endsection

@section('sidebar_left')
	{{ $event->title }}
@endsection

@section('content')
	<div class="container"> {{ $event->title }}</div>
@endsection

@section('sidebar_right')
	{{ $event->title }}
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
