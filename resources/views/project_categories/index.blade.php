@extends('admin::layout.main')

@section('title')
	Project Categories
@stop

@section('page_title')
	Project Categories
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-cogs"></i> Project Categories</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::project_categories.sidebar')
@stop

@section('content')
	<div class="row">
	@foreach ($project_categories as $category)
		<div class="col-md-4 col-lg-4 text-center">
			<div class="panel panel-default">
				<div class="panel-body">
					<h3>{{ $category->title }}</h3>
					<i class="fa fa-cogs fa-5x"></i>
					@if ($category->pages->count())
						<hr>
						@foreach ($category->pages as $page)
							<span class="badge">{{ $page->title }}</span>
						@endforeach
					@endif
				</div>
				<div class="panel-footer">
					<a href="{{ route('admin-project_categories-edit',$category->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
					<a data-id="{{ $category->id }}" data-pages="{{ implode(',', $category->pageIds()) }}" data-toggle="modal" href='#pagesModal' class="btn btn-primary btn-sm"><i class="fa fa-file-o"></i> Pages</a>
					<!-- <a data-id="{{ $category->id }}" href="javascript:void(0)" class="deleteProjectCategory btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</a> -->
				</div>
			</div>
		</div>
	@endforeach
	</div>

	<div class="modal fade" id="pagesModal">
		<div class="modal-dialog">
			<form method="post" action="{{route('admin-project_categories-pages')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pages</h4>
				</div>
				<div class="modal-body">
					<select name="pages[]" id="pages" data-live-search="true" multiple data-size="5" data-width="100%">
					@foreach (\Ogilo\AdminMd\Models\Page::all() as $page)
						<option value="{{ $page->id }}">{{ $page->title }}</option>
					@endforeach
					</select>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
				<input type="hidden" name="id" value="">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
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
			$('.deleteProjectCategory').click(function(){
				if(confirm('Do you want to delete this Project category ' + $(this).data('title'))){
					var varData = {
						id: $(this).data('id'),
						_token: '{{ csrf_token() }}'
					}

					var varUrl = '{{ route('admin-project_categories-delete') }}'

					$.ajax({
						url:varUrl,
						type: 'POST',
						data: varData
					}).done(function(xhr){
						console.log(xhr)
						// window.location = '{{ route('admin-project_categories') }}'
					});
				}

			});
		});

		$('#pagesModal').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget) // Button that triggered the modal
		  	var id = button.data('id')
			$('form input[name="id"]').val(id)
			console.log(button.data('pages'))
			var pages = button.data('pages').split(',');
			// console.log(pages)
			$('form select#pages').selectpicker('val', pages);
			
		})
	</script>
@stop