@extends('admin::layout.main')

@section('title')
	New Article Category
@stop

@section('page_title')
	<i class="fa fa-plus-circle"></i>&nbsp;New Article Category
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-article_categories') }}"><i class="fa fa-list-alt"></i>&nbsp;Article Categories</a>
	</li>
	<li class="active"><span><i class="fa fa-plus"></i>&nbsp;New Article Category</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::article_categories.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-article_categories-add')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : '') !!}>
			{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('description') ? ' has-error':'' !!}">
			<label for="description">Description</label>
			<input type="text" class="form-control" id="description" name="description" placeholder="Enter description"{!! ((old('description')) ? ' value="'.old('description').'"' : '') !!}>
			{!! $errors->has('description') ? '<span class="text-danger">'.$errors->first('description').'</span>' : '' !!}
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