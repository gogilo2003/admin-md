@extends('admin::layout.main')

@section('title')
	Article Categories
@stop

@section('page_title')
	<i class="fa fa-list-alt"></i> Article Categories
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-list-alt"></i> Article Categories</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::article_categories.sidebar')
@stop

@section('content')
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Title</th>
				<th>Description</th>
				<th>Pages</th>
				<th>Articles</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($article_categories as $key => $article_category)
				<tr>
					<td></td>
					<td>{{ $article_category->name }}</td>
					<td>{{ $article_category->description }}</td>
					<td>{{ $article_category->pages->count() }}</td>
					<td>{{ $article_category->articles->count() }}</td>
					<td>
						<a href="{{ route('admin-article_categories-edit',$article_category->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>&nbsp;Edit</a>
						<a data-pages="{{ json_encode($article_category->pageIds()) }}" data-id="{{ $article_category->id }}" class="btn btn-primary btn-xs" data-toggle="modal" href='#pagesModal'><i class="fa fa-file-o"></i>&nbsp;Pages</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="modal fade" id="pagesModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="{{route('admin-article_categories-pages')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Select Pages</h4>
					</div>
					<div class="modal-body">
						<select id="pages" name="pages[]" multiple class="selectpicker" data-size="5" data-width="100%" data-tick-icon="fa fa-check-square">
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
	$('#pagesModal').on('show.bs.modal', function (e) {
		var button = $(e.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('id')
		$('form input[name="id"]').val(recipient)
		// console.log(button.data('pages'));
		var pages = button.data('pages');
		console.log(pages)
		$('form select#pages').selectpicker('val', pages);
	})
	</script>
@stop