@extends('admin::layout.main')

@section('title')
	Add Video
@stop

@section('page_title')
	Add Video
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-video_categories') }}"><i class="fa fa-folder-open-o"></i> Video Categories</a>
	</li>
	<li>
		<a href="{{ route('admin-videos') }}"><i class="fa fa-film"></i> Videos</a>
	</li>
	<li class="active"><span><i class="fa fa-plus"></i> New Video</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::video_categories.sidebar')

@stop

@section('content')

	<form method="post" action="{{route('admin-videos-add')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-6 col-md-3 col-lg-3">
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
                    <input type="text" class="form-control" id="url" name="url" placeholder="Enter url"{!! ((old('url')) ? ' value="'.old('url').'"' : '') !!}>
                    {!! $errors->has('url') ? '<span class="text-danger">'.$errors->first('url').'</span>' : '' !!}
                </div>
			</div>
			<div class="col-md-9 col-lg-9">
				<div class="row">
					<div class="col-md-8 col-lg-8">
						<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
							<label for="title">Title</label>
							<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : '') !!}>
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
							<input type="text" class="form-control" id="description" name="description" placeholder="Enter description"{!! ((old('description')) ? ' value="'.old('description').'"' : '') !!}>
							{!! $errors->has('description') ? '<span class="text-danger">'.$errors->first('description').'</span>' : '' !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		{{ csrf_field() }}
		<div class="">
		    <button type="submit" class="btn btn-primary btn-round"><span class="fa fa-save"></span>  Save</button>
		</div>
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
            $('select#video_category').selectpicker('val',{{ old('video_category') ? old('video_category') : 'null' }})
        })
	</script>
@stop
