@extends('admin::layout.main')

@section('title')
	Edit File
@stop

@section('page_title')
	Edit File
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-file_categories') }}"><i class="fa fa-folder-open-o"></i> File Categories</a>
	</li>
	<li>
		<a href="{{ route('admin-files') }}"><i class="fa fa-file-o"></i> Files</a>
	</li>
	<li class="active"><span><i class="fa fa-edit"></i> Edit File</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::file_categories.sidebar')
@stop

@section('content')

	<form method="post" action="{{route('admin-files-edit-post')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-6 col-md-3 col-lg-3">
				<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
					<label for="name">File</label>
					<input type="file" id="name" name="name" class="form-control">
					{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : ''!!}
					<p class="help-block">select file here</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-8 col-lg-8">
						<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
							<label for="title">Title</label>
							<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : ' value="'.$file->title.'"') !!}>
							{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
						</div>
					</div>
					<div class="col-md-4 col-lg-4">
						<div class="form-group">
							<label for="file_category">File Category</label>
							<select class="form-control" id="file_category" name="file_category" data-live-search="true">
								@foreach ($file_categories as $file_category)
									<option value="{{ $file_category->id }}"{{ $file_category->id == $file->file_category_id ? 'selected' : '' }}>{{ $file_category->title }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-12 col-lg-12">
						<div class="form-group{!! $errors->has('description') ? ' has-error':'' !!}">
							<label for="description">Description</label>
							<input type="text" class="form-control" id="description" name="description" placeholder="Enter description"{!! ((old('description')) ? ' value="'.old('description').'"' : ' value="'.$file->description.'"') !!}>
							{!! $errors->has('description') ? '<span class="text-danger">'.$errors->first('description').'</span>' : '' !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" name="id" value="{{ $file->id }}">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="text-right"><button type="submit" class="btn btn-primary"><span class="fa fa-save"></span>  Save</button></div>
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