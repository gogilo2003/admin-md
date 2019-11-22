@extends('admin::layout.main')

@section('title')
	Edit Event
@stop

@section('page_title')
	<i class="fa fa-pencil"></i> Edit Event
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-event_categories') }}"><i class="fa fa-folder-open-o"></i> Event Categories</a>
	</li>
	<li>
		<a href="{{ route('admin-events') }}"><i class="fa fa-calendar"></i> Events</a>
	</li>
	<li class="active"><span><i class="fa fa-edit"></i> Edit Event</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::event_categories.sidebar')
@stop

@section('content')

	<form method="post" action="{{route('admin-events-edit-post')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="form-group{!! $errors->has('picture') ? ' has-error':'' !!}">
					<input type="file" id="picture" name="picture" class="form-control">
                </div>
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail img-raised">
                        <img src="{{ asset($event->picture ? asset(config('admin.path_prefix').'images/events/'.$event->picture) : config('admin.path_prefix').'/vendor/admin/img/placeholder.png') }}" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
					{!! $errors->has('picture') ? '<span class="text-danger">'.$errors->first('picture').'</span>' : ''!!}
					<p class="help-block">Select picture here</p>
                    <div>
                        <span class="btn btn-raised btn-round btn-default btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="picture" accept="image/*" />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                </div>
			</div>
			<div class="col-sm-6 col-md-8 col-lg-9">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
							<label for="title">Title</label>
							<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : ' value="'.$event->title.'"') !!}>
							{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
						</div>
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="form-group">
							<label for="event_category">Event Category</label>
							<select class="form-control selectpicker" id="event_category" name="event_category" data-live-search="true" data-style="btn btn-link">
								@foreach ($event_categories as $event_category)
									<option value="{{ $event_category->id }}"{{ $event_category->id == $event->event_category_id ? 'selected' : '' }}>{{ $event_category->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="form-group{!! $errors->has('leader') ? ' has-error':'' !!}">
							<label for="leader">Leader</label>
							<input type="text" class="form-control" id="leader" name="leader" placeholder="Enter leader"{!! ((old('leader')) ? ' value="'.old('leader').'"' : ' value="'.$event->leader.'"') !!}>
							{!! $errors->has('leader') ? '<span class="text-danger">'.$errors->first('leader').'</span>' : '' !!}
						</div>
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="form-group{!! $errors->has('event_date') ? ' has-error':'' !!}">
							<label for="event_date">Event Date</label>
							<input type="text" class="form-control datetimepicker" id="event_date" name="event_date" placeholder="Enter event date"{!! ((old('event_date')) ? ' value="'.old('event_date').'"' : ' value="'.$event->held_at.'"') !!}>
							{!! $errors->has('event_date') ? '<span class="text-danger">'.$errors->first('event_date').'</span>' : '' !!}
						</div>
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="form-group{!! $errors->has('location') ? ' has-error':'' !!}">
							<label for="location">Location</label>
							<input type="text" class="form-control" id="location" name="location" placeholder="Enter location"{!! ((old('location')) ? ' value="'.old('location').'"' : ' value="'.$event->location.'"') !!}>
							{!! $errors->has('location') ? '<span class="text-danger">'.$errors->first('location').'</span>' : '' !!}
						</div>
					</div>
					<div class="col-md-12 col-lg-12">
						<div class="form-group{!! $errors->has('content') ? ' has-error':'' !!}">
							<label for="content">Description</label>
							<textarea class="form-control tinymce" id="content" name="content" placeholder="Enter content">{!! ((old('content')) ? old('content') : $event->content) !!}</textarea>
							{!! $errors->has('content') ? '<span class="text-danger">'.$errors->first('content').'</span>' : '' !!}
						</div>
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" name="id" value="{{ $event->id }}">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="text-right"><button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Save</button></div>
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
