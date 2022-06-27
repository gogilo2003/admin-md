@extends('admin::layout.main')

@section('title')
	Videos
@stop

@section('page_title')
	Videos
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-video_categories') }}"><i class="fa fa-folder-open-o"></i> Video Categories</a>
	</li>
	<li class="active"><span><i class="fa fa-film"></i> Videos</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::video_categories.sidebar')

@stop

@section('content')
	<a href="{{route('admin-videos-add')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp; Add Video</a>
	<hr>
	<div class="row">
		@foreach ($videos as $video)
			<div class="col-xs-12 col-sm-6 col-md-4">
				<div class="thumbnail text-center">
					<i class="fa fa-file-video-o fa-5x"></i><br>
					<div style="height:180px; margin: 15px auto; overflow-y: hidden;">
						<h3>{{ $video->title }}</h3>
						<em>{{ $video->caption }}</em> <br>
						<h4 class="text-info"><hr>{{ $video->category->title }}<hr></h4>
					</div>

					<p>
						<a href="{{route('admin-videos-edit',$video->id)}}" class="btn btn-outline-primary btn-sm rounded-pill"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
						<button class="publishVideoButton btn btn-sm btn-outline-success rounded-pill" data-id="{{ $video->id }}"><i class="material-icons">{{ $video->published ? 'get_app' : 'publish' }}</i> <span>{{ $video->published ? 'Un-publish' : 'Publish' }}</span></button>
						<button class="featureVideoButton btn btn-sm btn-outline-info rounded-pill" data-id="{{ $video->id }}"><i class="material-icons">{{ $video->featured ? 'get_app' : 'publish' }}</i> <span>{{ $video->featured ? 'Un-feature' : 'Feature' }}</span></button>
					</p>
				</div>
			</div>
		@endforeach
	</div>
@stop

@push('styles')
	<style type="text/css">

	</style>
@endpush
@push('scripts_top')
	<script type="text/javascript">

	</script>
@endpush

@push('scripts_bottom')
	<script type="text/javascript">
		document.querySelectorAll('button.publishVideoButton').forEach(function(item){
			item.addEventListener('click', function(e){
				let btn = this
				let url = '{{ route('api-admin-videos-publish') }}'
				let data = {
					id: this.getAttribute('data-id'),
					api_token: '{{ api_token() }}'
				}
				$.post(url,data).then(function(response){
					if (response.success) {
						let icon = btn.querySelector('i')
						icon.innerHTML = response.video.published ? 'get_app' : 'publish'
						let caption = btn.querySelector('span')
						caption.innerHTML = response.video.published ? 'Un-publish' : 'Publish'
						$.notify({message:response.message,icon:'done'},{type: 'success'})
					}
				})
			})
		})
		document.querySelectorAll('button.featureVideoButton').forEach(function(item){
			item.addEventListener('click', function(e){
				let btn = this
				let url = '{{ route('api-admin-videos-feature') }}'
				let data = {
					id: this.getAttribute('data-id'),
					api_token: '{{ api_token() }}'
				}
				$.post(url,data).then(function(response){
					if (response.success) {
						let icon = btn.querySelector('i')
						icon.innerHTML = response.video.featured ? 'get_app' : 'publish'
						let caption = btn.querySelector('span')
						caption.innerHTML = response.video.featured ? 'Un-feature' : 'Feature'
						$.notify({message:response.message,icon:'done'},{type: 'success'})
					}
				})
			})
		})
	</script>
@endpush
