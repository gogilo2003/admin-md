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
			<div class="col-sm-12 col-md-8 col-lg-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
                            <label for="name">Thumbnail</label>
                            <div>
                                <img id="thumbnail_preview" class="image_preview" src="{{ asset(config('admin.path_prefix').'vendor/admin/img/placeholder.png') }}" class="img-responsive img-fluid" alt="Preview">
                            </div>

                            <input
                                data-filename-placement="inside"
                                title="Select a picture to upload"
                                type="file"
                                id="name"
                                name="name"
                                class="form-control"
                                >
                        </div>

                        <a href="JavaScript:" id="load_image" class="btn btn-round btn-primary btn-block"><i class="material-icons">search</i> Browse</a>

                    </div>
                    <div class="col-md-8">
                        <div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
                            <label for="name">Thumbnail</label>
                            <div>
                                <img id="image_preview" class="image_preview" src="{{ asset(config('admin.path_prefix').'vendor/admin/img/placeholder.png') }}" class="img-responsive img-fluid" alt="Preview">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        {!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : ''!!}
                    </div>
                </div>


			</div>
			<div class="col-sm-12 col-md-4 col-lg-4">

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
							<option data-width="{{ $category->max_width}}" data-height="{{ $category->max_height }} }" value="{{ $category->id }}">{{ $category->title }}</option>
						@endforeach
					</select>
				</div>

			</div>
		</div>
		<input type="hidden" name="thumbnail_cropdetails" id="thumbnail_cropdetails" value="">
		<input type="hidden" name="image_cropdetails" id="image_cropdetails" value="">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<button type="submit" class="btn btn-primary btn-round"><span class="fa fa-save"></span>  Save</button>
	</form>

@stop

@section('styles')
	<style type="text/css">
		.image_preview{
			cursor: pointer;
            width: 100%
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
			let thumbnail = $('#thumbnail_preview').cropper({
                aspectRatio: 2/2,
                cropBoxResizable:false,
                data: {
                    height: 128,
                    width: 128
                }
            })

			var image = $('#image_preview').cropper({
                aspectRatio: 4/3,
                scalable:false,
            })

            $('#picture_category').change(function(event){
                let width = parseInt($('#picture_category option:selected').data('width'))
                let height = parseInt($('#picture_category option:selected').data('height'))

                image.cropper('setAspectRatio',width/height)
                image.cropper('setData',{width,height})
            })

            $('#picture_category').change()

			$('#load_image').click(function(){
				$('input[type="file"]#name').click()
			})

			$('input[type="file"]#name').change(function(){
				let src = window.URL.createObjectURL($(this).prop('files')[0])
				$('.image_preview').cropper('replace',src)
			})

			$('#image_preview').on('cropend',function(){
				let data = $('#thumbnail_preview').cropper('getData')
                $('input#thumbnail_cropdetails').val(JSON.stringify(data))

				data = $('#image_preview').cropper('getData')
				$('input#image_cropdetails').val(JSON.stringify(data))
			})
		})
	</script>
@stop
