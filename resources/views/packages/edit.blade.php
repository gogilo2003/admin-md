@extends('admin::layout.main')

@section('title')
	Edit Tour Package
@stop

@section('page_title')
	Edit Tour Package
@stop

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin-packages') }}"><i class="fa fa-list"></i> List Packages</a></li>
	<li class="active"><span><i class="fa fa-edit"></i> Edit ({{ $package->title }})</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::packages.sidebar')
@stop

@section('content')
	
	<form method="post" action="{{route('admin-packages-edit-post')}}" page="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
					<label for="title">Title</label>
					<input type="text" autofocus required class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : ' value="'.$package->title.'"') !!}>
					{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('price') ? ' has-error':'' !!}">
					<label for="price">Price</label>
					<input type="text" class="form-control" id="price" name="price" placeholder="Enter price"{!! ((old('price')) ? ' value="'.old('price').'"' : ' value="'.$package->price.'"') !!}>
					{!! $errors->has('price') ? '<span class="text-danger">'.$errors->first('price').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('from') ? ' has-error':'' !!}">
					<label for="from">From</label>
					<input type="text" class="form-control datetimepicker" id="from" name="from" placeholder="Enter from"{!! ((old('from')) ? ' value="'.old('from').'"' : ' value="'.$package->start_at.'"') !!}>
					{!! $errors->has('from') ? '<span class="text-danger">'.$errors->first('from').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('to') ? ' has-error':'' !!}">
					<label for="to">To</label>
					<input type="text" class="form-control datetimepicker" id="to" name="to" placeholder="Enter to"{!! ((old('to')) ? ' value="'.old('to').'"' : ' value="'.$package->end_at.'"') !!}>
					{!! $errors->has('to') ? '<span class="text-danger">'.$errors->first('to').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group{!! $errors->has('summary') ? ' has-error':'' !!}">
					<label for="summary">Summary</label>
					{!! $errors->has('summary') ? '<span class="text-danger">'.$errors->first('summary').'</span>' : '' !!}
					<textarea name="summary" id="summary" class="form-control" rows="3">{!! old('summary') ? old('summary') : $package->summary !!}</textarea>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group{!! $errors->has('details') ? ' has-error':'' !!}">
					<label for="details">Details</label>
					{!! $errors->has('details') ? '<span class="text-danger">'.$errors->first('details').'</span>' : '' !!}
					<textarea name="details" id="details" class="tinymce" rows="10">{!! old('details') ? old('details') : $package->details !!}</textarea>
				</div>
			</div>
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
			</div>
		</div>
		{{ csrf_field() }}
		<input type="hidden" name="id" id="inputId" class="form-control" value="{{ $package->id }}">

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