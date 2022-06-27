@extends('admin::layout.main')

@section('title')
	@parent
	Roles
@endsection

@section('page_title')
	Roles
@endsection

@section('breadcrumbs')
	@parent
	<li class="active"><span>Roles</span></li>
@endsection

@section('toolbar')
	
@endsection

@section('content')
	<div>
	<a href="{{route('admin-roles-add')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp; New Role</a>
	<a href="{{route('admin-users')}}" class="btn btn-primary btn-sm"><span class="fa fa-users"></span>&nbsp;&nbsp; Users</a>
	</div>
	<hr>
	<table id="rolesDataTable" class="table table-hover table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Users</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($roles as $role)
			<tr>
				<td>{{ $role->id }}</td>
				<td>{{ $role->name }}</td>
				<td>{{ $role->activeAdmins()->count() }}/{{ $role->admins()->count() }}</td>
				<td>
					<div class="btn-group">
						<a href="{{route('admin-roles-edit',$role->id)}}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
						<a href="javascript:" data-id="{{ $role->id }}" class="btn btn-danger btn-sm deleteRole"><span class="fa fa-remove"></span>&nbsp;&nbsp; Delete</a>
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
		$('#rolesDataTable').dataTable();
		$('a.deleteRole').click(function(){
			answer = confirm("Are you sure you want to delete this role?");

			if (answer) {
				
				$.ajax({
					url: '{{ route('admin-roles-delete') }}',
					type: 'POST',
					data: {
						id:{{ $role->id }},
						_token:'{{ csrf_token() }}'
					}
				}).done(function(){
					alert('Deleted');
					window.location = '{{ route('admin-roles') }}';
				});

			} else {
				alert('Role deletion canceled by user');
			}
			
		});
	});
	</script>
@endsection