@extends('admin::layout.main')

@section('title')
	Add Video Category
@stop

@section('page_title')
	Add Video Category
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin-video_categories') }}"><i class="fa fa-film"></i> Video Categories</a></li>
	<li class="active"><span><i class="fa fa-plus"></i> New Video Category</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::video_categories.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-video_categories-add')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : '') !!}>
					{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-sm-6 col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('max_size') ? ' has-error':'' !!}">
					<label for="max_size">Maximum File Size</label>
					<input type="text" class="form-control" id="max_size" name="max_size" placeholder="Enter maximum file size"{!! ((old('max_size')) ? ' value="'.old('max_size').'"' : ' value="150"') !!}>
					{!! $errors->has('max_size') ? '<span class="text-danger">'.$errors->first('max_size').'</span>' : '' !!}
					<div class="help-block">Enter Size in Mega Bytes</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-8 col-lg-8">
				<div class="form-group{!! $errors->has('file_types') ? ' has-error':'' !!}">
					<label for="file_types">Video Types</label>
					<input type="text" class="form-control" id="file_types" name="file_types" placeholder="Enter file types"{!! ((old('file_types')) ? ' value="'.old('file_types').'"' : ' value="mp4,3gp, avi, mkv, flv"') !!}>
					{!! $errors->has('file_types') ? '<span class="text-danger">'.$errors->first('file_types').'</span>' : '' !!}
					<div class="help-block">For multiple file types, enter separated by comas e.g. txt,doc,xls etc</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('description') ? ' has-error':'' !!}">
					<label for="description">Description</label>
					<input type="text" class="form-control" id="description" name="description" placeholder="Enter description"{!! ((old('description')) ? ' value="'.old('description').'"' : '') !!}>
					{!! $errors->has('description') ? '<span class="text-danger">'.$errors->first('description').'</span>' : '' !!}
				</div>
			</div>
		</div>
				
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