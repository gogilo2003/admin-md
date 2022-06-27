@extends('admin::layout.main')

@section('title')
	@parent
	Users
@endsection

@section('page_title')
	Users
@endsection

@section('breadcrumbs')
	@parent
	<li class="active"><span>Users</span></li>
@endsection

@section('toolbar')
	
@endsection

@section('content')
	<div>
	<a href="{{route('admin-users-add')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp; New User</a>
	<a href="{{route('admin-roles')}}" class="btn btn-primary btn-sm"><span class="fa fa-list"></span>&nbsp;&nbsp; Roles</a>
	</div>
	<hr>
	<table id="usersDataTable" class="table table-hover table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->role->name }}</td>
				<td>{{ $user->active ? 'Active' : 'Inactive' }}</td>
				<td>
					<div class="btn-group">
						<a href="{{route('admin-users-edit',$user->id)}}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
						<a href="javascript:" data-id="{{ $user->id }}" class="btn btn-warning btn-sm resetPassword"><span class="fa fa-refresh"></span>&nbsp;&nbsp; Reset Password</a>
						<a href="javascript:" data-id="{{ $user->id }}" class="btn btn-info btn-sm activateUser"><span class="fa fa-refresh"></span>&nbsp;&nbsp; Activate</a>
						<a href="javascript:" data-id="{{ $user->id }}" class="btn btn-danger btn-sm deleteUser"><span class="fa fa-remove"></span>&nbsp;&nbsp; Delete</a>
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
		$('#usersDataTable').dataTable();

		$('a.deleteUser').click(function(){
			answer = confirm("Are you sure you want to delete this user?");

			if (answer) {
				
				$.ajax({
					url: '{{ route('admin-users-delete') }}',
					type: 'POST',
					data: {
						id:$(this).data('id'),
						_token:'{{ csrf_token() }}'
					}
				}).done(function(){
					alert('User Deleted');
					window.location = '{{ route('admin-users') }}';
				});

			} else {
				alert('User deletion canceled by user');
			}
			
		});

		$('a.activateUser').click(function(){
			answer = confirm("Are you sure you want to activate this user?");

			if (answer) {
				
				$.ajax({
					url: '{{ route('admin-users-activate') }}',
					type: 'POST',
					data: {
						id:$(this).data('id'),
						_token:'{{ csrf_token() }}'
					}
				}).done(function(){
					alert('User Activated');
					window.location = '{{ route('admin-users') }}';
				});

			} else {
				alert('User activation canceled by user');
			}
			
		});

		$('a.resetPassword').click(function(){
			answer = confirm("Are you sure you want to rest password for this user?");

			if (answer) {
				
				$.ajax({
					url: '{{ route('admin-users-password') }}',
					type: 'POST',
					data: {
						id:$(this).data('id'),
						_token:'{{ csrf_token() }}'
					}
				}).done(function(){
					alert('User Password reset');
					window.location = '{{ route('admin-users') }}';
				});

			} else {
				alert('User password reset canceled');
			}
			
		});
	});
	</script>
@endsection