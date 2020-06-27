@extends('admin::web.layout.main')

@section('title')
	{{ $page->title }}
@endsection

@section('breadcrumbs')
    @if ($page->name === 'home')
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
    @else
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url($page->name) }}">{{ $page->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
    @endif

@endsection

@section('content')
<section class="mt-5 py-5 clearfix">
    <div class="container">
        <h3 class="text-center text-uppercase">{{ $article->title }}</h3>
        <img class="mr-5 mb-5 w-50 float-md-left" src="{{ $article->picture->url }}" alt="">
        {!! $article->content !!}
    </div>
</section>

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
