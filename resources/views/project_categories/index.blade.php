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
					<a href="{{ route('admin-project_categories-edit',$category->id) }}" class="btn btn-primary btn-round"><span class="material-icons">edit</span> Edit</a>
					<button data-id="{{ $category->id }}" data-pages="{{ implode(',', $category->pageIds()) }}" data-toggle="modal" data-target='#pagesModal' class="btn btn-info btn-round"><span class="material-icons">assignment</span> Pages</button>
					<!-- <a data-id="{{ $category->id }}" href="javascript:void(0)" class="deleteProjectCategory btn btn-danger btn-sm"><span class="material-icons"></span> Delete</a> -->
				</div>
			</div>
		</div>
	@endforeach
	</div>

	<div class="modal fade" id="pagesModal" data-backdrop="static">
		<div class="modal-dialog modal-dialog-center">
			<form method="post" action="{{route('admin-project_categories-pages')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <button type="button" class="close btn btn-danger btn-fab btn-sm btn-round" data-dismiss="modal" aria-hidden="true"><span class="material-icons">close</span></button>
                            <h4 class="card-title text-uppercase">Pages</h4>
                        </div>
                        <div class="card-body">
                            <select name="pages[]" id="pages" data-live-search="true" multiple data-size="5" data-width="100%" data-style="btn btn-round btn-outline-primary">
                            @foreach (\Ogilo\AdminMd\Models\Page::all() as $page)
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger btn-round" data-dismiss="modal"><span class="material-icons">close</span> Cancel</button>
                            <button type="submit" class="btn btn-primary btn-round"><span class="material-icons">save</span> Save</button>
                        </div>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
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
			let rcvdData = button.data('pages');
			console.log(rcvdData)
			let pages = null;
			if(Array.isArray(rcvdData))
				pages = rcvdData.split(',');
			else
				pages = rcvdData

			// console.log(pages)
			$('form select#pages').selectpicker('val', pages);

		})
	</script>
@stop
