@extends('admin::web.layout.main')

@section('title')
	{{ $page->title }}
@stop

@section('sidebar_left')
	page sidebar_left
@stop

@section('content')
<section class="mt-5 py-5 clearfix">
    <div class="container">
        <h3 class="text-center text-uppercase">{{ $article->title }}</h3>
        <img class="mr-5 mb-5 w-50 float-md-left" src="{{ asset('public/images/articles/'.$article->picture) }}" alt="">
        {!! $article->content !!}
    </div>
</section>

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
