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
				@if($video->name)
                <video src="{{ asset(config('admin.path_prefix').'videos/'.$video->name) }}" width="100%" controls></video>
				@endif
				@if($video->url)
                <iframe width="280" height="200" src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                @endif
                <div class="form-group form-file-upload form-file-multiple{!! $errors->has('name') ? ' has-error':'' !!}">
                    <input type="file" class="inputFileHidden" name="name" accept="video/*">
                    <div class="input-group">
                        <input type="text" class="form-control inputFileVisible" placeholder="Select a video here">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-fab btn-round btn-outline-primary">
                                <i class="fa fa-film"></i>
                            </button>
                        </span>
                    </div>
					{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : ''!!}
                </div>
                <p>OR</p>
                <div class="form-group{!! $errors->has('url') ? ' has-error':'' !!}">
                    <label for="url">Url</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Enter url"{!! ((old('url')) ? ' value="'.old('url').'"' : ' value="'.$video->url.'"') !!}>
                    {!! $errors->has('url') ? '<span class="text-danger">'.$errors->first('url').'</span>' : '' !!}
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
							<select class="form-control selectpicker" data-live-search="true" id="video_category" name="video_category" data-style="btn btn-link">
								@foreach ($video_categories as $video_category)
									<option value="{{ $video_category->id }}">{{ $video_category->title }}</option>
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
		$(document).ready(function(){
            $('select#video_category').selectpicker('val',{{ old('video_category') ? old('video_category') : $video->video_category_id }})
        })
	</script>
@stop
