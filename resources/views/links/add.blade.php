@extends('admin::layout.main')

@section('title')
	New Link
@stop

@section('page_title')
	<i class="fa fa-plus"></i> New Link
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-links') }}"><i class="fa fa-link"></i> Links</a>
	</li>
	<li class="active"><span><i class="fa fa-plus"></i> New Link</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::links.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-links-add')}}" link="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : '') !!}>
			{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('caption') ? ' has-error':'' !!}">
			<label for="caption">Caption</label>
			<input type="text" class="form-control" id="caption" name="caption" placeholder="Enter value"{!! ((old('caption')) ? ' value="'.old('caption').'"' : '') !!}>
			{!! $errors->has('caption') ? '<span class="text-danger">'.$errors->first('caption').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('icon') ? ' has-error':'' !!}">
			<label for="icon">Icon</label>
			<select class="selectpicker form-control" name="icon" data-live-search="true" data-size="5">
				@foreach (get_icons() as $icon => $caption)
					<option data-icon="{{ $icon }}" value="{{ $icon }}" {{ $icon == old('icon') ? 'selected' : '' }}>{{ $caption }}</option>
				@endforeach
			</select>
			{!! $errors->has('icon') ? '<span class="text-danger">'.$errors->first('icon').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('url') ? ' has-error':'' !!}">
			<label for="url">URL</label>
			<input type="text" class="form-control" id="url" name="url" placeholder="Enter url"{!! ((old('url')) ? ' value="'.old('url').'"' : '') !!}>
			{!! $errors->has('url') ? '<span class="text-danger">'.$errors->first('url').'</span>' : '' !!}
		</div>
		<div class="form-group">
			<label for="menu">Menus</label>
			<select class="form-control" id="menu" name="menu">
				@foreach(Ogilo\AdminMd\Models\Menu::all() as $menu)
				<option value="{{ $menu->id }}">{{ $menu->caption }}</option>
				@endforeach
			</select>
		</div>

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