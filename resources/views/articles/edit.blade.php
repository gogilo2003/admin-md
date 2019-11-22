@extends('admin::layout.main')

@section('title')
	Edit Article
@stop

@section('page_title')
	<i class="fa fa-pencil"></i> Edit Article
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-article_categories') }}"><i class="fa fa-list-alt"></i> Article Categories</a>
	</li>
	<li>
		<a href="{{ route('admin-articles') }}"><i class="fa fa-files-o"></i> Articles</a>
	</li>
	<li class="active"><span><i class="fa fa-pencil"></i> Edit Article ({{ $article->title }})</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::articles.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-articles-edit-post')}}" article="form" accept-charset="UTF-8" enctype="multipart/form-data">

		<div class="row">
			<div class="col-md-5 col-lg-3">
				<div class="form-group">
					<label for="category">Category</label>
					<select class="selectpicker form-control" id="category" name="category" data-live-search="true" data-size="5" data-style="btn btn-link">
						@foreach(Ogilo\AdminMd\Models\ArticleCategory::all() as $category)
						<option value="{{ $category->id }}" {{ old('category') ? (old('category') === $category->id ? 'selected' : '' ) : ( $article->article_category_id === $category->id ? 'selected' : '' ) }}>{{ $category->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="icon">Icon</label>
					<select class="selectpicker form-control" id="icon" name="icon" data-live-search="true" data-size="5" data-style="btn btn-link">

						@foreach (get_icons() as $icon=>$caption)
							<option value="{{ $icon }}" data-icon="{{ $icon }}"{{ old('icon') ? (old('icon') == $icon ? 'selected' : '' ) : ( $article->icon == $icon ? 'selected' : '' ) }}>{{ $caption }}</option>
						@endforeach

					</select>
				</div>
				<div class="form-group{!! $errors->has('picture') ? ' has-error':'' !!}">
					<label for="picture">Picture</label>
                    <img id="picture_preview" class="picture_preview" src="{{ url($article->picture ? config('admin.path_prefix').'/images/articles/'.$article->picture : config('admin.path_prefix').'/vendor/admin/img/placeholder.png') }}" alt="Preview">
                    {!! $errors->has('picture') ? '<span class="text-danger">'.$errors->first('picture').'</span>' : ''!!}
                    <input
                        data-filename-placement="inside"
                        title="Select a picture to upload"
                        type="file"
                        id="picture"
                        name="picture"
                        class="form-control"
                        >
                </div>

                <a href="JavaScript:" id="load_picture" class="btn btn-round btn-outline-info btn-block"><i class="material-icons">search</i> Browse</a>
			</div>
			<div class="col-md-7 col-lg-9">
				<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : ' value="'.$article->title.'"') !!}>
					{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
				</div>
				<div class="form-group{!! $errors->has('content') ? ' has-error':'' !!}">
					<label for="content" class="d-block pb-5">Content</label>
					{!! $errors->has('content') ? '<br><span class="text-danger">'.$errors->first('content').'</span>' : '' !!}
					<textarea class="form-control tinymce" rows="16" id="content" name="content" placeholder="Enter content">{!! ((old('content')) ? old('content') : $article->content) !!}</textarea>
				</div>
			</div>
        </div>
        <div class="offset-md-5 offset-lg-3">
            <input type="hidden" name="image_cropdetails" id="picture_cropdetails" value="">
            <input type="hidden" name="id" value="{{ $article->id }}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="submit" class="btn btn-primary btn-lg btn-round"><span class="fa fa-floppy-o"></span>  Save</button>
        </div>
	</form>
@stop

@section('styles')
	<style type="text/css">
    .picture_preview{
        width: 100%;
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
        $('select#category').selectpicker('val',{{ old('category') ? old('category') : ($article->article_category_id ? $article->article_category_id : 'null') }})
        $('select#icon').selectpicker('val',{!! old('icon') ? "'".old('icon')."'" : ($article->icon ? "'".$article->icon."'" : 'null') !!})

        var image = $('#picture_preview').cropper({
            aspectRatio: 4/3,
            scalable:false,
            viewMode: 3,
        })

        $('#load_picture').click(function(){
            $('input[type="file"]#picture').click()
        })

        $('input[type="file"]#picture').change(function(){
            let src = window.URL.createObjectURL($(this).prop('files')[0])
            $('.picture_preview').cropper('replace',src)
        })

        $('#picture_preview').on('cropend',function(){
            data = $('#picture_preview').cropper('getData')
            $('input#picture_cropdetails').val(JSON.stringify(data))
        })
    })
	</script>
@stop
