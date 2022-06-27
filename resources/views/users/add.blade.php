@extends('admin::layout.main')

@section('title')
	New User
@stop

@section('page_title')
	New User
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-users') }}">Users</a>
	</li>
	<li class="active">New User</li>
@stop

@section('toolbar')
	
@stop

@section('content')
	<form method="post" action="{{route('admin-users-add')}}" user="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : '') !!}>
			{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('email') ? ' has-error':'' !!}">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Enter value"{!! ((old('email')) ? ' value="'.old('email').'"' : '') !!}>
			{!! $errors->has('email') ? '<span class="text-danger">'.$errors->first('email').'</span>' : '' !!}
		</div>
		<div class="form-group">
			<label for="role">Role</label>
			<select class="form-control" id="role" name="role">
				@foreach (Ogilo\AdminMd\Models\AdminRole::all() as $role)
					<option value="{{ $role->id }}">{{ $role->name }}</option>
				@endforeach
			</select>
		</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<button type="submit" class="btn btn-primary"><span class="fa fa-floppy-o"></span>  Save</button>
	</form>
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
		
	</script>
@stop