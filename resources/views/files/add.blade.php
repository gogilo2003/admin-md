@extends('admin::layout.main')

@section('title')
	Add File
@stop

@section('page_title')
	Add File
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-file_categories') }}"><i class="fa fa-folder-open-o"></i> File Categories</a>
	</li>
	<li>
		<a href="{{ route('admin-files') }}"><i class="fa fa-file-o"></i> Files</a>
	</li>
	<li class="active"><span><i class="fa fa-plus"></i> New File</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::file_categories.sidebar')
@stop

@section('content')

	<form method="post" action="{{route('admin-files-add')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-6 col-md-3 col-lg-3">
                <div class="form-group form-file-upload form-file-multiple{!! $errors->has('file') ? ' has-error':'' !!}">
                    <input type="file" class="inputFileHidden" name="file">
                    <div class="input-group">
                        <input type="text" class="form-control inputFileVisible" placeholder="Select a file">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-fab btn-round btn-outline-primary">
                                <i class="material-icons">attach_file</i>
                            </button>
                        </span>
                    </div>
					{!! $errors->has('file') ? '<span class="text-danger">'.$errors->first('file').'</span>' : ''!!}
                </div>
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-8 col-lg-8">
						<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
							<label for="title">Title</label>
							<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : '') !!}>
							{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
						</div>
					</div>
					<div class="col-md-4 col-lg-4">
						<div class="form-group">
							<label for="file_category">File Category</label>
							<select class="form-control selectpicker" id="file_category" name="file_category" data-live-search="true" data-style="btn btn-link">
								@foreach ($file_categories as $file_category)
									<option value="{{ $file_category->id }}">{{ $file_category->title }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-12 col-lg-12">
						<div class="form-group{!! $errors->has('description') ? ' has-error':'' !!}">
							<label for="description">Description</label>
							<input type="text" class="form-control" id="description" name="description" placeholder="Enter description"{!! ((old('description')) ? ' value="'.old('description').'"' : '') !!}>
							{!! $errors->has('description') ? '<span class="text-danger">'.$errors->first('description').'</span>' : '' !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="text-right"><button type="submit" class="btn btn-primary"><span class="fa fa-save"></span>  Save</button></div>
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
        $(document).ready(function(){
            $('select#file_category').selectpicker('val',{{ old('file_category') ? old('file_category') : 'null' }});
        })
	</script>
@stop
