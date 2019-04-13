@extends('admin::layout.main')

@section('title')
	Picture Categories
@endsection

@section('page_title')
	Picture Categories
@endsection

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-image"></i> Picture Categories</span></li>
@endsection

@section('sidebar')
	@parent
	@include('admin::picture_categories.sidebar')
@endsection

@section('content')
	<a href="{{ route('admin-picture_categories-add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; New Picture Category</a>
	<a href="{{ route('admin-pictures') }}" class="btn btn-primary btn-sm"><i class="fa fa-image"></i>&nbsp; Pictures</a>
	<hr>
	<table id="pictureCategoriesDataTable" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Title</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach ($categories as $category)
			<tr>
				<td>{{ $category->id }}</td>
				<td>{{ $category->name }}</td>
				<td>{{ $category->title }}</td>
				<td>{{ $category->description }}</td>
				<td>
					<div  class="btn-group">
						<a href="{{ route('admin-picture_categories-edit',$category->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>
						<a href="javascript:" class="btn btn-danger btn-sm deletePictureCategory" data-title="{{ $category->title }}" data-id="{{ $category->id }}"><span class="fa fa-remove"></span>&nbsp; Delete</a>
						<a data-pages="{{ json_encode($category->pageIds()) }}" data-id="{{ $category->id }}" class="btn btn-primary btn-sm" data-toggle="modal" href='#pagesModal'><i class="fa fa-file-o"></i>&nbsp;Pages</a>
					</div>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

	<div class="modal fade" id="pagesModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="{{route('admin-picture_categories-pages')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Select Pages</h4>
						</div>
						<div class="modal-body">
							<select name="pages[]" id="pages" class="selectpicker" data-tick-icon="fa fa-check-square" multiple data-width="100%" data-size="5"> 
							@foreach (\Ogilo\AdminMd\Models\Page::all() as $key => $page)
								<option value="{{ $page->id }}">{{ $page->title }}</option>
							@endforeach
							</select>
							<input type="hidden" name="id" value="">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">&times;Close</button>
							<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
						</div>
					</form>
						
				</div>
			</div>
		</div>
@endsection

@section('styles')
	<style type="text/css">
		
	</style>
@endsection
@section('scripts_top')
	<script type="text/javascript">
		
	</script>
@endsection

@section('scripts_bottom')
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#pictureCategoriesDataTable').dataTable();

			$('.deletePictureCategory').click(function(){
				if(confirm('Do you want to delete this Picture category ' + $(this).data('title'))){
					var varData = {
						id: $(this).data('id'),
						_token: '{{ csrf_token() }}'
					}

					var varUrl = '{{ route('admin-picture_categories-delete') }}'

					$.ajax({
						url:varUrl,
						type: 'POST',
						data: varData
					}).done(function(){
						alert('Picture category deleted' );
						window.location = '{{ route('admin-picture_categories') }}'
					});
				}

			});
		});

		$('#pagesModal').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget) // Button that triggered the modal
		  	var id = button.data('id')
			$('form input[name="id"]').val(id)

			var pages = button.data('pages');
			$('form select#pages').selectpicker('val', pages);
			// console.log(pages)
		})
	</script>
@endsection