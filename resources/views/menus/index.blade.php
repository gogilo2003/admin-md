@extends('admin::layout.main')

@section('title')
	@parent
	Menus
@endsection

@section('page_title')
	Menus
@endsection

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-list-alt"></i> Menus</span></li>
@endsection

@section('sidebar')
	@parent
	@include('admin::menus.sidebar')
@stop

@section('content')
	<div>
	<a href="{{route('admin-menus-add')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp; New Menu</a>
	<a href="{{route('admin-links')}}" class="btn btn-primary btn-sm"><span class="fa fa-link"></span>&nbsp;&nbsp; Links</a>
	</div>
	<hr>
	<table id="menusDataTable" class="table table-hover table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Caption</th>
				<th>Icon</th>
				<th>Links</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($menus as $menu)
			<tr>
				<td>{{ $menu->id }}</td>
				<td>{{ $menu->name }}</td>
				<td>{{ $menu->caption }}</td>
				<td><i class="fa {{ $menu->icon }}"></i></td>
				<td><a href="{{ route('admin-menus') }}">{{ $menu->links()->count() }}</a></td>
				<td>
					<div class="btn-group">
						<a href="{{route('admin-menus-edit',$menu->id)}}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
						<a href="javascript:" data-id="{{ $menu->id }}" class="btn btn-danger btn-sm deleteMenu"><span class="fa fa-remove"></span>&nbsp;&nbsp; Delete</a>
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
		$('#menusDataTable').dataTable();

		$('a.deleteMenu').click(function(){
			answer = confirm("Are you sure you want to delete this menu?");

			if (answer) {
				
				$.ajax({
					url: '{{ route('admin-menus-delete') }}',
					type: 'POST',
					data: {
						id:$(this).data('id'),
						_token:'{{ csrf_token() }}'
					}
				}).done(function(){
					alert('Menu Deleted');
					window.location = '{{ route('admin-menus') }}';
				});

			} else {
				alert('Menu deletion canceled by menu');
			}
			
		});

	});
	</script>
@endsection