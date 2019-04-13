@extends('admin::layout.main')

@section('title')
	Video Categories
@stop

@section('page_title')
	Video Categories
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-film"></i> Video Categories</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::video_categories.sidebar')
	
@stop

@section('content')
	<a href="{{route('admin-video_categories-add')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp; Add Video Category</a>
	<hr>
	@foreach ($video_categories as $video_category)
		<div class="col-sm-6 col-md-4 col-lg-4">
			<div class="thumbnail text-center">
				<h3>{{ $video_category->title }}</h3>
				<i class="fa fa-film fa-5x"></i>
				<hr>
				@if($video_category->pages->count())
				<div>
					@foreach ($video_category->pages as $page)
						<span class="badge">{{ $page->title }}</span>&nbsp;
					@endforeach
				</div>
				<hr>
				@endif
				<p>
					<a href="{{route('admin-video_categories-edit',$video_category->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
					<a data-pages="{{ implode(',', $video_category->pageIds()) }}" data-id="{{ $video_category->id }}" class="btn btn-primary btn-sm" data-toggle="modal" href='#pagesModal'><i class="fa fa-file"></i> Pages</a>
				</p>
			</div>
		</div>
	@endforeach
	
	<div class="modal fade" id="pagesModal">
		<div class="modal-dialog">
			<form class="modal-content" method="post" action="{{route('admin-video_categories-pages')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Select Pages</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="pages">Pages</label>
						<select class="form-control" id="pages" name="pages[]" data-size="5" data-live-search="true" data-tick-icon="fa fa-check" multiple>
							@foreach (\Ogilo\AdminMd\Models\Page::all() as $page)
								<option value="{{ $page->id }}">{{ $page->title }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id" value="">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
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
		jQuery(document).ready(function($) {
			$('.deletePictureCategory').click(function(){
				if(confirm('Do you want to delete this Picture category ' + $(this).data('title'))){
					var varData = {
						id: $(this).data('id'),
						_token: '{{ csrf_token() }}'
					}

					var varUrl = '{{ route('admin-video_categories-delete') }}'

					$.ajax({
						url:varUrl,
						type: 'POST',
						data: varData
					}).done(function(){
						alert('Picture category deleted' );
						window.location = '{{ route('admin-video_categories') }}'
					});
				}

			});
		});

		$('#pagesModal').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget) // Button that triggered the modal
		  	var id = button.data('id')
			$('form input[name="id"]').val(id)

			var pages = button.data('pages').split(',');
			// console.log(pages)
			$('form select#pages').selectpicker('val', pages);
			
		})
	</script>
@stop