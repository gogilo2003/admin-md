@extends('admin::layout.main')

@section('title')
	@parent
	Pages
@endsection

@section('page_title')
	<i class="fa fa-files-o"></i> Pages
@endsection

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-files-o"></i> Pages</span></li>
@endsection

@section('sidebar')
	@parent
	@include('admin::pages.sidebar')
@endsection

@section('content')
	<div>
	<a href="{{route('admin-pages-add')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp; New Page</a>
	<a href="{{route('admin-links')}}" class="btn btn-primary btn-sm"><span class="fa fa-link"></span>&nbsp;&nbsp; Links</a>
	</div>
	<hr>
	<table id="pagesDataTable" class="table table-hover table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Caption</th>
				<th>Icon</th>
				<th>Url</th>
				<th>Link</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($pages as $page)
			<tr>
				<td>{{ $page->id }}</td>
				<td>{{ $page->name }}</td>
				<td>{{ $page->title }}</td>
				<td><i class="fa {{ $page->link ? $page->link->icon : '' }}"></i></td>
				<td>{{ $page->link ? ($page->link->url ? $page->link->url : ''): '' }}</td>
				<td>{{ $page->link ? ($page->link->name ? $page->link->name : '') : '' }}</td>
				<td>
					<div class="btn-group">
						<a href="{{route('admin-pages-edit',$page->id)}}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
						<a href="javascript:" data-id="{{ $page->id }}" class="btn btn-danger btn-sm deletePage"><span class="fa fa-remove"></span>&nbsp;&nbsp; Delete</a>
					</div>
				</td>
			</tr>
			@endforeach

		</tbody>
	</table>
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
		$('#pagesDataTable').dataTable();

		$('a.deletePage').click(function(){
			answer = confirm("Are you sure you want to delete this page?");

			if (answer) {

				$.ajax({
					url: '{{ route('admin-pages-delete') }}',
					type: 'POST',
					data: {
						id:$(this).data('id'),
						_token:'{{ csrf_token() }}'
					}
				}).done(function(){
					alert('Page Deleted');
					window.location = '{{ route('admin-pages') }}';
				});

			} else {
				alert('Page deletion canceled by page');
			}

		});

	});
	</script>
@endsection
