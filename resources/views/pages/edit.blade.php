@extends('admin::layout.main')

@section('title')
	Edit {{ $page->name }}
@stop

@section('page_title')
	<i class="fa fa-pencil"></i> Edit {{ $page->name }}
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-pages') }}"><i class="fa fa-files-o"></i> Pages</a>
	</li>
	<li class="active"><span><i class="fa fa-pencil"></i> Edit {{ $page->name }}</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::pages.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-pages-edit-post')}}" page="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
					<label for="name">Name</label>
					<input type="text" readonly class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : ' value="'.$page->name.'"') !!}>
					{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-5 col-lg-5">
				<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
					<label for="title">Caption</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter value"{!! ((old('title')) ? ' value="'.old('title').'"' : ' value="'.$page->title.'"') !!}>
					{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-3 col-lg-3">
				<div class="form-group">
					<label for="link">Link</label>
					<select class="form-control" id="link" name="link">
						@foreach(Ogilo\Admin\Models\Link::all() as $link)
						<option value="{{ $link->id }}" {{ $page->isSelected((old('link') ? old('link') : $link->id)) ? 'selected' : '' }}>{{ $link->caption }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="title_image">Title Image</label>
					<input type="file" name="title_image">
				</div>
			</div>
			<div class="col-md-12 col-lg-12">
				<textarea class="tinymce" name="content" id="editPageContent" cols="30" rows="10">{{ old('content') ? old('content') : $page->content }}</textarea>
			</div>
		</div>

		<br>

		<input type="hidden" name="id" value="{{$page->id}}">
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
	// CKEDITOR.replace( 'editPageContent' );
	</script>
@stop
