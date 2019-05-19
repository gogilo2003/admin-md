@extends('admin::layout.main')

@section('title')
	New Picture
@stop

@section('page_title')
	New Picture
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-picture_categories') }}"><i class="fa fa-image"></i> Picture Categories</a>
	</li>
	<li>
		<a href="{{ route('admin-pictures') }}"><i class="fa fa-image"></i> Pictures</a>
	</li>
	<li class="active"><span><i class="fa fa-plus"></i> New Picture</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::picture_categories.sidebar')
@stop

@section('content')
	<a href="{{route('admin-pictures')}}" class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;&nbsp; Pictures</a>
	<hr>
	<form method="post" action="{{route('admin-pictures-add')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6">
				<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
					<label for="name">Picture</label>
					<div>
						<img id="image_preview" src="{{ url('public/vendor/admin/img/placeholder.png') }}" class="img-responsive img-fluid" alt="Preview">
					</div>

					<a href="JavaScript:" id="load_image" class="btn btn-block btn-round btn-primary"><i class="material-icons">search</i> Browse</a>

					<input 
						data-filename-placement="inside" 
						title="Select a picture to upload" 
						type="file" 
						id="name" 
						name="name" 
						class="form-control"
						>
					{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : ''!!}
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-6">

				<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" {!! ((old('title')) ? ' value="'.old('title').'"' : '') !!}>
					{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
				</div>

				<div class="form-group{!! $errors->has('alt') ? ' has-error':'' !!}">
					<label for="alt">Alt Text</label>
					<input type="text" class="form-control" id="alt" name="alt" {!! ((old('alt')) ? ' value="'.old('alt').'"' : '') !!}>
					{!! $errors->has('alt') ? '<span class="text-danger">'.$errors->first('alt').'</span>' : '' !!}
				</div>

				<div class="form-group{!! $errors->has('caption') ? ' has-error':'' !!}">
					<label for="caption">Caption</label>
					<input type="text" class="form-control" id="caption" name="caption" {!! ((old('caption')) ? ' value="'.old('caption').'"' : '') !!}>
					{!! $errors->has('caption') ? '<span class="text-danger">'.$errors->first('caption').'</span>' : '' !!}
				</div>

				<div class="form-group{!! $errors->has('url') ? ' has-error':'' !!}">
					<label for="url">Url</label>
					<input type="text" class="form-control" id="url" name="url"{!! ((old('url')) ? ' value="'.old('url').'"' : '') !!}>
					{!! $errors->has('url') ? '<span class="text-danger">'.$errors->first('url').'</span>' : '' !!}
				</div>

				<div class="form-group">
					<label for="picture_category">Picture Category</label>
					<select data-style="btn btn-link" {{ ($categories->count() > 5) ? 'data-live-search="true" data-size="5"' : '' }} class="selectpicker form-control" id="picture_category" name="picture_category">
						@foreach ($categories as $category)
							<option value="{{ $category->id }}">{{ $category->title }}</option>
						@endforeach
					</select>
				</div>

			</div>
		</div>
		<input type="hidden" name="cropdetails" id="cropdetails" value="">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<button type="submit" class="btn btn-primary"><span class="fa fa-save"></span>  Save</button>
	</form>
	
@stop

@section('styles')
	<style type="text/css">
		#image_preview{
			cursor: pointer;
		}
	</style>
@stop
@section('scripts_top')
	<script type="text/javascript">
		
	</script>
@stop

@section('scripts_bottom')
	<script type="text/javascript">
		$(document).ready(function(){
			var cropper = $('#image_preview').cropper({
				aspectRatio: 1/1
			})

			$('#load_image').click(function(){
				$('input[type="file"]#name').click()
			})

			$('input[type="file"]#name').change(function(){
				let src = window.URL.createObjectURL($(this).prop('files')[0])
				// document.querySelector('.cropper-canvas img').src = src
				$('#image_preview').cropper('replace',src)
			})

			$('#image_preview').on('cropend',function(){
				let data = $('#image_preview').cropper('getData')
				// console.log(data.height)
				$('input#cropdetails').val(JSON.stringify(data))
			})
		})
	</script>
@stop