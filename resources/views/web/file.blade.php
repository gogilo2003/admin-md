@extends('admin::web.layout.main')

@section('title')
	{{ $page->title }}
@endsection

@section('breadcrumbs')
    @if ($page->name === 'home')
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $file->title }}</li>
    @else
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url($page->name) }}">{{ $page->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $file->title }}</li>
    @endif

@endsection

@section('content')
<section class="mt-5 py-5 clearfix">
    <div class="container">
        <h3 class="text-center text-uppercase">{{ $file->title }}</h3>
        <img class="mr-5 mb-5 w-50 float-md-left" src="{{ $file->picture->url }}" alt="">
        {!! $file->content !!}
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
