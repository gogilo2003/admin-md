@extends('admin::layout.main')

@section('title')
	Edit {{ $menu->name }}
@stop

@section('page_title')
	<i class="fa fa-pencil"></i> Edit {{ $menu->name }}
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-menus') }}"><i class="fa fa-list-alt"></i> Menus</a>
	</li>
	<li class="active"><span><i class="fa fa-pencil"></i> Edit {{ $menu->name }}</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::menus.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-menus-edit-post')}}" menu="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : ' value="'.$menu->name.'"') !!}>
			{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('caption') ? ' has-error':'' !!}">
			<label for="caption">Caption</label>
			<input type="text" class="form-control" id="caption" name="caption" placeholder="Enter value"{!! ((old('caption')) ? ' value="'.old('caption').'"' : ' value="'.$menu->caption.'"') !!}>
			{!! $errors->has('caption') ? '<span class="text-danger">'.$errors->first('caption').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('icon') ? ' has-error':'' !!}">
			<label for="icon">Icon</label>
			<input type="text" class="form-control" id="icon" name="icon" placeholder="Enter icon"{!! ((old('icon')) ? ' value="'.old('icon').'"' : ' value="'.$menu->icon.'"') !!}>
			{!! $errors->has('icon') ? '<span class="text-danger">'.$errors->first('icon').'</span>' : '' !!}
		</div>
		<input type="hidden" name="id" value="{{$menu->id}}">
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