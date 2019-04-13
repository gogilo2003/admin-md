@extends('admin::layout.main')

@section('title')
	Add Event Category
@stop

@section('page_title')
	Add Event Category
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin-event_categories') }}"><i class="fa fa-folder"></i> Event Categories</a></li>
	<li class="active"><span><i class="fa fa-plus"></i> New Event Category</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::event_categories.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-event_categories-add')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : '') !!}>
					{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
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