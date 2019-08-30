@extends('admin::web.layout.main')

@section('title')
	{{ $sermon->title }}
@stop

@section('sidebar_left')
	page sidebar_left
@stop

@section('content')
<section class="py-5 mt-5 clearfix">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-uppercase">{{ $sermon->title }} <small>By {{ $sermon->sermon_by }}</small></h1>
				<p>Date: {!! date_create($sermon->sermon_at)->format('j\<\s\u\p\>S\<\/\s\u\p\> F, Y h:i:s A') !!}</p>
				<hr>
            </div>
            @php
                $hasPicVideo = $sermon->audio || $sermon->video;
            @endphp
            @if ($hasPicVideo)
                <div class="col-md-4">
                    <div class="border border-purple text-purple rounded-lg text-center shadow-lg p-4">
                        @if($sermon->audio)
                            <h5 class="py-2 text-uppercase">Listen to the recorded sermon</h5>
                            <audio src="{{ url('public/audio/sermons/'.$sermon->audio) }}" class="w-100 img-fluid shadow-lg mb-5" controls="true"></audio>
                        @endif
                        @if($sermon->video)
                            <h5 class="py-2 text-uppercase">Watch the sermon here</h5>
                            <video src="{{ url('public/video/sermons/'.$sermon->video) }}" class="w-100 img-fluid shadow-lg mb-5" controls="true"></video>
                        @endif
                    </div>
                </div>
            @endif
			<div class="{{ $hasPicVideo ? 'col-md-8' : 'col-md-12' }} mb-4">
                <img src="{{ url('public/images/sermons/'.$sermon->picture) }}" class="img-fluid w-100" alt="{{ $sermon->title }}">
			</div>
			<div class="col-md-12">
				<div class="text-justify"> {!! $sermon->content !!}</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p><a href="{{ url('/'.$page->name) }}">{{ $page->title }}</a></p>
			</div>
		</div>
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
