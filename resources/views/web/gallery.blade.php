@extends('admin::web.layout.main')

@section('title')
	Profile
@endsection

@section('sidebar_left')
	page sidebar_left
@endsection

@section('content')
	<div class="container py-5">
		<div class="row no-gutters">
            @php
                $cat = $page->picture_categories('name','photo-gallery')->first();
                $pictures = $cat ? $cat->pictures : [];
            @endphp
            @if($cat)
			@foreach ($pictures as $picture)
                <div class="col-md-4">
                    <img class="img-fluid w-100" src="{{ asset(config('admin.path_prefix').'images/pictures/thumbnails/'.$picture->name) }}" alt="">
                </div>
            @endforeach
            @endif
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
