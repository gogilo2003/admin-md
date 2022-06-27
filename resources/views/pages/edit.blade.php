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
			<div class="col-md-5">
				<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
					<label for="title_image">Title Image</label>
					<div class="form-row no-gutters">
						<div class="col-md-2 form-group bmd-form-group text-right">
							Width:
						</div>
						<div class="col-md-4 form-group bmd-form-group">
							<input id="image_width" type="number" class="form-control scale" value="1">
						</div>
						<div class="col-md-2 form-group bmd-form-group text-right">
							Length:
						</div>
						<div class="col-md-4 form-group bmd-form-group">
							<input id="image_height" type="number" class="form-control scale" value="1">
						</div>
					</div>
                    <div>
                        <img id="image_preview" class="image_preview" src="{{ $page->title_image ? asset(config('admin.path_prefix').'images/pages/'.$page->title_image) : asset(config('admin.path_prefix').'vendor/admin/img/placeholder.png') }}" class="img-responsive img-fluid" alt="Preview">
                    </div>
					<input type="file" name="title_image" id="title_image">
                </div>

                <a href="JavaScript:" id="load_image" class="btn btn-round btn-primary btn-block"><i class="material-icons">search</i> Browse</a>
			</div>
			<div class="col-md-7">
				<div class="form-row">
					<div class="col-sm-6 col-md-4 col-lg-4 bmd-form-group form-group">
						<label for="link" class="bmd-label-static">Link</label>
						<select class="form-control selectpicker" id="link" name="link" data-style="btn btn-link">
							@foreach(Ogilo\AdminMd\Models\Link::all() as $link)
							<option value="{{ $link->id }}" {{ $page->isSelected((old('link') ? old('link') : $link->id)) ? 'selected' : '' }}>{{ $link->caption }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-6 col-md-8 col-lg-8 form-group{!! $errors->has('name') ? ' has-error':'' !!}">
						<label for="name">Name</label>
						<input type="text" readonly class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : ' value="'.$page->name.'"') !!}>
						{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
					</div>
					<div class="col-md-12 form-group{!! $errors->has('title') ? ' has-error':'' !!}">
						<label for="title">Title</label>
						<input type="text" class="form-control" id="title" name="title" placeholder="Enter value"{!! ((old('title')) ? ' value="'.old('title').'"' : ' value="'.$page->title.'"') !!}>
						{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
					</div>
					<div class="col-md-12 col-lg-12">
						<textarea class="tinymce" name="content" id="editPageContent" cols="30" rows="14">{{ old('content') ? old('content') : $page->content }}</textarea>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<hr>
			</div>
			<div class="col-md-7 offset-md-5">
				<input type="hidden" name="id" value="{{$page->id}}">
				<input type="hidden" name="image_cropdetails" id="image_cropdetails" value="">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<button type="submit" class="btn btn-primary btn-round"><span class="fa fa-floppy-o"></span>  Save</button>
			</div>
		</div>
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
	// CKEDITOR.replace( 'editPageContent' );
		$(document).ready(function(){
			var image = $('#image_preview').cropper({
                aspectRatio: 4/3,
                scalable:false,
            })

            $('.scale').change(function(event){
                let width = parseInt(document.getElementById('image_width').value)
                let height = parseInt(document.getElementById('image_height').value)

                image.cropper('setAspectRatio',width/height)
                // image.cropper('setData',{width,height})
            })

            $('.scale').change()

			$('#load_image').click(function(){
				$('input[type="file"]#title_image').click()
			})

			$('input[type="file"]#title_image').change(function(){
				let src = window.URL.createObjectURL($(this).prop('files')[0])
				$('.image_preview').cropper('replace',src)
			})

			$('#image_preview').on('cropend',function(){
				let data = $('#image_preview').cropper('getData')
				$('input#image_cropdetails').val(JSON.stringify(data))
			})
		})
	</script>
@stop
