@extends('admin::layout.main')

@section('title')
	New Sermon
@stop

@section('page_title')
	New Sermon
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-sermons') }}"><i class="fa fa-book"></i> Sermons</a>
	</li>
	<li class="active"><span><i class="fa fa-plus"></i> New Sermon</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::sermons.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-sermons-add')}}" sermon="form" accept-charset="UTF-8" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<div class="form-group">
					<label for="pages">Pages</label>
					<select class="selectpicker" id="pages" name="pages[]" data-live-search="true" data-size="5" data-width="100%" data-tick-icon="fa fa-check-square-o" multiple>
						@foreach(Ogilo\AdminMd\Models\Page::all() as $page)
						<option value="{{ $page->id }}">{{ $page->title }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('picture') ? ' has-error':'' !!}">
					<label for="picture">Picture</label><br>
					<input class="form-control" type="file" id="picture" name="picture" title="click to select sermon's picture" data-filename-placement="inside">
					{!! $errors->has('picture') ? '<span class="text-danger">'.$errors->first('picture').'</span>' : ''!!}
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('sermon_date') ? ' has-error':'' !!}">
					<label for="sermon_date">Sermon Date</label>
					<input type="text" class="form-control datetimepicker" id="sermon_date" name="sermon_date" placeholder="Enter sermon date"{!! ((old('sermon_date')) ? ' value="'.old('sermon_date').'"' : '') !!}>
					{!! $errors->has('sermon_date') ? '<span class="text-danger">'.$errors->first('sermon_date').'</span>' : '' !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('sermon_by') ? ' has-error':'' !!}">
					<label for="sermon_by">Sermon By</label>
					<input type="text" class="form-control" id="sermon_by" name="sermon_by" placeholder="Enter preachers name"{!! ((old('sermon_by')) ? ' value="'.old('sermon_by').'"' : '') !!}>
					{!! $errors->has('sermon_by') ? '<span class="text-danger">'.$errors->first('sermon_by').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-8 col-lg-8">
				<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : '') !!}>
					{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('content') ? ' has-error':'' !!}">
					<!-- <label for="content">Content</label> -->
					{!! $errors->has('content') ? '<br><span class="text-danger">'.$errors->first('content').'</span>' : '' !!}
					<textarea rows="5" class="form-control tinymce" rows="10" id="content" name="content" placeholder="Enter content">{!! ((old('content')) ? old('content') : '') !!}</textarea>
				</div>
			</div>
		</div>

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