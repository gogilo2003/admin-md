@extends('admin::layout.main')

@section('title')
	Edit Project
@stop

@section('page_title')
	Edit Project
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-project_categories') }}">Project Categories</a>
	</li>
	<li>
		<a href="{{ route('admin-projects') }}">Projects</a>
	</li>
	<li class="active"><span>Edit Project ({{ $project->title }})</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::project_categories.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-projects-edit-post')}}" project="form" accept-charset="UTF-8" enctype="multipart/form-data">
		
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<div class="form-group">
					<label for="category">Category</label>
					<select class="selectpicker" id="category" name="category" data-live-search="true" data-size="5">
						<option></option>
						@foreach(Ogilo\AdminMd\Models\ProjectCategory::all() as $category)
						<option value="{{ $category->id }}" {{ old('category') ? (old('category') === $category->id ? 'selected' : '' ) : ( $project->project_category_id === $category->id ? 'selected' : '' ) }}>{{ $category->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group">
					<label for="icon">Icon</label>
					<select class="selectpicker" id="icon" name="icon" data-live-search="true" data-size="5">
						
						@foreach (get_icons() as $icon=>$caption)
							<option value="{{ $icon }}" data-icon="{{ $icon }}">{{ $caption }}</option>
						@endforeach
						
					</select>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('picture') ? ' has-error':'' !!}">
					<label for="picture">Picture</label><br>
					<input class="form-control" type="file" id="picture" name="picture" title="Select project's picture" data-filename-placement="inside">
					{!! $errors->has('picture') ? '<span class="text-danger">'.$errors->first('picture').'</span>' : ''!!}
				</div>
			</div>
			<div class="col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : ' value="'.$project->title.'"') !!}>
					{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('content') ? ' has-error':'' !!}">
					<label for="content">Content</label>
					{!! $errors->has('content') ? '<br><span class="text-danger">'.$errors->first('content').'</span>' : '' !!}
					<textarea class="form-control tinymce" rows="10" id="content" name="content" placeholder="Enter content">{!! ((old('content')) ? old('content') : $project->content) !!}</textarea>
				</div>
			</div>
		</div>
		<input type="hidden" name="id" value="{{ $project->id }}">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<button type="submit" class="btn btn-primary"><span class="fa fa-floppy-o"></span>  Save</button>
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