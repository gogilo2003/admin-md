@extends('admin::web.layout.main')

@section('title')
	Home Page
@stop

@section('breadcrumbs')
	@parent
@stop

@section('content')
	<?php $slides = $page->picture_categories->where('name','=','slideshow')->first(); ?>
	@if ($slides)
	<?php $slides = $slides->pictures; ?>
	<div id="front_slideshow" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
		@foreach ($slides as $key => $slide)
			<li data-target="#front_slideshow" data-slide-to="{{ $key }}" class="{{ ($key == ($slides->count()-1)) ? 'active': '' }}"></li>
		@endforeach
			
		</ol>
		<div class="carousel-inner">
			@foreach ($slides as $key => $slide)
			<div class="item{{ ($key == ($slides->count()-1)) ? ' active': '' }}">
				<img alt="{{ $slide->alt }}" src="{{ url('public/images/pictures/'.$slide->name) }}">
				<div class="container">
					<div class="carousel-caption">
						<h1>{{$slide->title}}</h1>
						<p>{{ $slide->caption }}</p>
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<a class="left carousel-control" href="#front_slideshow" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#front_slideshow" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
	@endif

	<div class="container">
		{!! $page->content !!}
	</div>
	

	@if ($page->article_categories())
	<div class="container">
		<div class="row">
		@foreach ($page->article_categories as $category)
			<div class="col-md-12"><h3>{{ $category->name }} <small>{{ $category->description }}</small></h3></div>
			<!-- <pre>{{ $category->articles }}</pre> -->
			@foreach ($category->articles as $article)
				<div class="col-md-4 col-lg-4">
					<div class="thumbnail">
						<h4>{{ $article->title }}</h4>
						<img src="{{ url('public/images/articles/160x120/'.$article->picture) }}" alt="">
						<p>{{ str_words(strip_tags($article->content),25) }}</p>
						<div style="padding: 15px"><a href="{{ route('article',[$article->name,$page->name]) }}">Read more <i class="fa fa-arrow-right"></i></a></div>
					</div>
				</div>
			@endforeach
		@endforeach
		</div>
	</div>
	@endif
	
	@if ($page->profiles->count())
	<div class="container">
		<div class="row">
		@foreach ($page->profiles as $profile)
			<div class="col-md-4">
				<div class="thumbnail">
					<img src="{{ url('public/images/profiles/'.$profile->picture) }}" class="img-responsive" alt="{{ $profile->name }}">
					<h3>{{ $profile->name }} <small>{{ $profile->position }}</small></h3>
					<p class="text-justify">{{ str_words($profile->details) }}</p>
					<p><a href="{{ route('profile',[$profile->id,$page->name]) }}">Read More...</a></p>
				</div>
			</div>
		@endforeach
		</div>
	</div>
	@endif
	
	@if ($page->sermons->count())
	<div class="container">
		<div class="row">
		@foreach ($page->sermons as $sermon)
			<div class="col-md-4">
				<div class="thumbnail">
					<img src="{{ url('public/images/sermons/'.$sermon->picture) }}" class="img-responsive" alt="{{ $sermon->name }}">
					<h3>{{ $sermon->title }} <small>By {{ $sermon->sermon_by }}</small></h3>
					<p class="text-justify">{{ str_words($sermon->content) }}</p>
					<p><a href="{{ route('sermon',[$sermon->name,$page->name]) }}">Read More...</a></p>
				</div>
			</div>
		@endforeach
		</div>
	</div>
	@endif
	<hr>
	@if ($page->events->count())
	<div class="container">
		<div class="row">
		@foreach ($page->events as $event)
			<div class="col-md-4">
				<div class="thumbnail">
					<img src="{{ url('public/images/events/'.$event->picture) }}" class="img-responsive" alt="{{ $event->title }}">
					<h3>{{ $event->title }} <small>By {{ $event->leader }}</small></h3>
					<p class="text-justify">{{ str_words($event->content) }}</p>
					<p><a href="{{ route('event',[$event->name,$page->name]) }}">Read More...</a></p>
				</div>
			</div>
		@endforeach
		</div>
	</div>
	@endif

	<div class="container">
		@if ($pictures = $page->picture_categories->where('name','=','gallery')->first())
			<h3 class="page-header">Recent Pictures</h3>
			@foreach ($pictures->pictures as $key => $picture)
				<div class="col-md-4 col-lg-4">
					<img src="{{ url('public/images/pictures/'.$picture->name) }}" class="img-responsive" alt="{{ $picture->alt }}">
				</div>
			@endforeach
		@endif
	</div>
	
@stop

@section('sidebar_right')
	Home Page sidebar_right
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