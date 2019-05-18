@extends('admin::layout.main')

@section('title')
	Edit Video
@stop

@section('page_title')
	Edit Video
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-video_categories') }}"><i class="fa fa-folder-open-o"></i> Video Categories</a>
	</li>
	<li>
		<a href="{{ route('admin-videos') }}"><i class="fa fa-film"></i> Videos</a>
	</li>
	<li class="active"><span><i class="fa fa-edit"></i> Edit Video</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::video_categories.sidebar')
	
@stop

@section('content')

	<form method="post" action="{{route('admin-videos-edit-post')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
					<label for="name">Video</label>
					<video src="{{ url('public/videos/'.$video->name) }}" width="100%" controls></video>
					<input type="file" id="name" name="name" class="form-control" title="Select video here">
					{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : ''!!}
				</div>
			</div>
			<div class="col-md-8 col-lg-8">
				<div class="row">
					<div class="col-md-8 col-lg-8">
						<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
							<label for="title">Title</label>
							<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : ' value="'.$video->title.'"') !!}>
							{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
						</div>
					</div>
					<div class="col-md-4 col-lg-4">
						<div class="form-group">
							<label for="video_category">Video Category</label>
							<select class="form-control selectpicker" data-live-search="true" id="video_category" name="video_category">
								@foreach ($video_categories as $video_category)
									<option value="{{ $video_category->id }}" {{ old('video_category') == $video_category->id ? 'selected' : '' }}>{{ $video_category->title }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-12 col-lg-12">
						<div class="form-group{!! $errors->has('description') ? ' has-error':'' !!}">
							<label for="description">Description</label>
							<input type="text" class="form-control" id="description" name="description" placeholder="Enter description"{!! ((old('description')) ? ' value="'.old('description').'"' : ' value="'.$video->caption.'"') !!}>
							{!! $errors->has('description') ? '<span class="text-danger">'.$errors->first('description').'</span>' : '' !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" name="id" value="{{ $video->id }}">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<button type="submit" class="btn btn-primary"><span class="fa fa-save"></span>  Save</button>
	</form>
	
@stop

@section('styles')
	<style type="text/css">
		
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