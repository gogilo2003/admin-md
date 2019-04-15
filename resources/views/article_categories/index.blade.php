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
						<div class="btn-group">
							<a href="{{ route('admin-article_categories-edit',$article_category->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>
							<button data-pages="{{ json_encode($article_category->pageIds()) }}" data-id="{{ $article_category->id }}" class="btn btn-info btn-sm" data-toggle="modal" href='#pagesModal'><i class="fa fa-file-o"></i>&nbsp;Pages</button>
						</div>
						
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@include('admin::article_categories.pages_modal')
	
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