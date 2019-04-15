@extends('admin::layout.main')

@section('title')
	Event Categories
@stop

@section('page_title')
	Event Categories
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-folder-open-o"></i> Event Categories</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::event_categories.sidebar')
@stop

@section('content')
	<a href="{{ route('admin-event_categories-add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Event Category</a>
	<hr>
	<div class="row">
	@foreach ($event_categories as $category)
		<div class="col-sm-6 col-md-4 col-lg-4">
			<div class="thumbnail text-center text-default">
				<h3>{{ $category->name }}</h3>
				<i class="fa fa-folder-o fa-5x"></i><br>
				<hr>
				@if ($category->pages->count())
					@foreach ($category->pages as $page)
						<span class="badge">{{ $page->title }}</span>
					@endforeach
					<hr>
				@endif
				<p>
					<a href="{{route('admin-event_categories-edit',$category->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
					<a data-id="{{ $category->id }}" data-pages="{{ json_encode($category->pageIds() )  }}" class="btn btn-primary btn-sm" data-toggle="modal" href='#pagesModal'><i class="fa fa-files-o"></i> Pages</a>
				</p>
			</div>
		</div>
	@endforeach
	</div>
	
	<div class="modal fade" id="pagesModal">
		<form class="modal-dialog" method="post" action="{{route('admin-event_categories-pages')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
			<input type="hidden" name="id" value="">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Select Pages</h4>
				</div>
				<div class="modal-body">
					<select name="pages[]" id="pages" data-live-search="true" data-size="5" data-tick-icon="fa fa-check-square" multiple data-width="100%">
						@foreach (Ogilo\AdminMd\Models\Page::all() as $page)
							<option value="{{ $page->id }}">{{ $page->title }}</option>
						@endforeach
					</select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
				</div>
			</div>
		</form>
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

			var pages = button.data('pages');
			// console.log(pages)
			$('form select#pages').selectpicker('val', pages);
			
		})
	</script>
@stop