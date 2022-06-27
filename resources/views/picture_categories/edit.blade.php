@extends('admin::layout.main')

@section('title')
	Edit Picture Category
@endsection

@section('page_title')
	<i class="fa fa-pencil"></i> Edit Picture Category
@endsection

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-picture_categories') }}"><i class="fa fa-image"></i> Picture Categories</a>
	</li>
	<li class="active"><span><i class="fa fa-pencil"></i> Edit Category</span></li>
@endsection

@section('sidebar')
	@parent
	@include('admin::picture_categories.sidebar')
@endsection

@section('content')
	<form method="post" action="{{route('admin-picture_categories-edit-post')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">

		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : ' value="'.$category->title.'"') !!}>
					{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('description') ? ' has-error':'' !!}">
					<label for="description">Description</label>
					<input type="text" class="form-control" id="description" name="description" placeholder="Enter description"{!! ((old('description')) ? ' value="'.old('description').'"' : ' value="'.$category->description.'"') !!}>
					{!! $errors->has('description') ? '<span class="text-danger">'.$errors->first('description').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('file_extensions') ? ' has-error':'' !!}">
					<label for="file_extensions">File Extensions</label>
					<input type="text" class="form-control" id="file_extensions" name="file_extensions" placeholder="Enter file extensions"{!! ((old('file_extensions')) ? ' value="'.old('file_extensions').'"' : ' value="'.$category->mimes.'"') !!}>
					{!! $errors->has('file_extensions') ? '<span class="text-danger">'.$errors->first('file_extensions').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('max_file_size') ? ' has-error':'' !!}">
					<label for="max_file_size">Max File Size</label>
					<input type="text" class="form-control" id="max_file_size" name="max_file_size" placeholder="Enter max file size"{!! ((old('max_file_size')) ? ' value="'.old('max_file_size').'"' : ' value="'.$category->max_size.'"') !!}>
					{!! $errors->has('max_file_size') ? '<span class="text-danger">'.$errors->first('max_file_size').'</span>' : '' !!}
				</div>
			</div>

			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('min_height') ? ' has-error':'' !!}">
					<label for="min_height">Min Height</label>
					<input type="text" class="form-control" id="min_height" name="min_height" placeholder="Enter min height"{!! ((old('min_height')) ? ' value="'.old('min_height').'"' : ' value="'.$category->min_height.'"') !!}>
					{!! $errors->has('min_height') ? '<span class="text-danger">'.$errors->first('min_height').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('min_width') ? ' has-error':'' !!}">
					<label for="min_width">Min Width</label>
					<input type="text" class="form-control" id="min_width" name="min_width" placeholder="Enter min width"{!! ((old('min_width')) ? ' value="'.old('min_width').'"' : ' value="'.$category->min_width.'"') !!}>
					{!! $errors->has('min_width') ? '<span class="text-danger">'.$errors->first('min_width').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('max_height') ? ' has-error':'' !!}">
					<label for="max_height">Max Height</label>
					<input type="text" class="form-control" id="max_height" name="max_height" placeholder="Enter max height"{!! ((old('max_height')) ? ' value="'.old('max_height').'"' : ' value="'.$category->max_height.'"') !!}>
					{!! $errors->has('max_height') ? '<span class="text-danger">'.$errors->first('max_height').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('max_width') ? ' has-error':'' !!}">
					<label for="max_width">Max Width</label>
					<input type="text" class="form-control" id="max_width" name="max_width" placeholder="Enter max width"{!! ((old('max_width')) ? ' value="'.old('max_width').'"' : ' value="'.$category->max_width.'"') !!}>
					{!! $errors->has('max_width') ? '<span class="text-danger">'.$errors->first('max_width').'</span>' : '' !!}
				</div>
			</div>
		</div>
		
		<input type="hidden" name="id" value="{{ $category->id }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<button type="submit" class="btn btn-primary">
			<span class="fa fa-floppy-o"></span>&nbsp;Save
		</button>
	</form>
@endsection

@section('styles')
	<style type="text/css">
		
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