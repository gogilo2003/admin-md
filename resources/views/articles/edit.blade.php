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
			<div class="col-md-4 col-lg-4">
				<div class="form-group">
					<label for="category">Category</label>
					<select class="selectpicker" id="category" name="category" data-live-search="true" data-size="5">
						@foreach(Ogilo\AdminMd\Models\ArticleCategory::all() as $category)
						<option value="{{ $category->id }}" {{ old('category') ? (old('category') === $category->id ? 'selected' : '' ) : ( $article->article_category_id === $category->id ? 'selected' : '' ) }}>{{ $category->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group">
					<label for="icon">Icon</label>
					<select class="selectpicker" id="icon" name="icon" data-live-search="true" data-size="5">
						
						@foreach (get_icons() as $icon=>$caption)
							<option value="{{ $icon }}" data-icon="{{ $icon }}"{{ old('icon') ? (old('icon') == $icon ? 'selected' : '' ) : ( $article->icon == $icon ? 'selected' : '' ) }}>{{ $caption }}</option>
						@endforeach
						
					</select>
				</div>
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="form-group{!! $errors->has('picture') ? ' has-error':'' !!}">
					<label for="picture">Picture</label><br>
					<input class="form-control" type="file" id="picture" name="picture" title="Select article's picture" data-filename-placement="inside">
					{!! $errors->has('picture') ? '<span class="text-danger">'.$errors->first('picture').'</span>' : ''!!}
				</div>
			</div>
			<div class="col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : ' value="'.$article->title.'"') !!}>
					{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
				</div>
			</div>
			<div class="col-md-12 col-lg-12">
				<div class="form-group{!! $errors->has('content') ? ' has-error':'' !!}">
					<label for="content">Content</label>
					{!! $errors->has('content') ? '<br><span class="text-danger">'.$errors->first('content').'</span>' : '' !!}
					<textarea class="form-control tinymce" rows="10" id="content" name="content" placeholder="Enter content">{!! ((old('content')) ? old('content') : $article->content) !!}</textarea>
				</div>
			</div>
		</div>
		<input type="hidden" name="id" value="{{ $article->id }}">
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