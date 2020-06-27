@extends('admin::layout.main')

@section('title')
	Edit Project Category
@stop

@section('page_title')
	Edit Project Category
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-project_categories') }}">Project Categories</a>
	</li>
	<li class="active"><span><i class="fa fa-edit"></i> Edit Project Category</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::project_categories.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-project_categories-edit-post')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
			<label for="title">Title</label>
			<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : ' value="'.$project_category->title.'"') !!}>
			{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('description') ? ' has-error':'' !!}">
			<label for="description">Description</label>
			<input type="text" class="form-control" id="description" name="description" placeholder="Enter description"{!! ((old('description')) ? ' value="'.old('description').'"' : ' value="'.$project_category->description.'"') !!}>
			{!! $errors->has('description') ? '<span class="text-danger">'.$errors->first('description').'</span>' : '' !!}
		</div>
		<input type="hidden" name="id" value="{{$project_category->id}}">
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