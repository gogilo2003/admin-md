@extends('admin::web.layout.main')

@section('title')
	{{ $page->title }}
@stop

@section('breadcrumbs')
    @if ($page->name === 'home')
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
    @else
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url($page->name) }}">{{ $page->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
    @endif

@stop

@section('content')
<section class="mt-5 py-5 clearfix">
    <div class="container">
        <h3 class="text-center text-uppercase">{{ $article->title }}</h3>
        <img class="mr-5 mb-5 w-50 float-md-left" src="{{ asset(config('admin.path_prefix').'images/articles/'.$article->picture) }}" alt="">
        {!! $article->content !!}
    </div>
</section>

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
