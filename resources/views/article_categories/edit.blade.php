@extends('admin::layout.main')

@section('title')
	Edit Article Category
@stop

@section('page_title')
	<i class="fa fa-pencil"></i> Edit Article Category
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-article_categories') }}"><i class="fa fa-list-alt"></i> Article Categories</a>
	</li>
	<li class="active"><span><i class="fa fa-check"></i> {{ $article_category->name }}</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::article_categories.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-article_categories-edit-post')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : ' value="'.$article_category->name.'"') !!}>
			{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('description') ? ' has-error':'' !!}">
			<label for="description">Description</label>
			<input type="text" class="form-control" id="description" name="description" placeholder="Enter description"{!! ((old('description')) ? ' value="'.old('description').'"' : ' value="'.$article_category->description.'"') !!}>
			{!! $errors->has('description') ? '<span class="text-danger">'.$errors->first('description').'</span>' : '' !!}
		</div>
		
		<input type="hidden" name="id" value="{{ $article_category->id }}">
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