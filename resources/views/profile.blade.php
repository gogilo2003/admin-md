@extends('admin::layout.main')

@section('title')
	User Profile
@stop

@section('page_title')
	User Profile
@stop

@section('breadcrumbs')
	@parent
	<li class="active">Profile</li>
@stop

@section('toolbar')
	
@stop

@section('content')

	<div class="panel panel-primary tabpanel">
		<div class="panel-heading">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#home" aria-controls="home" role="tab" data-toggle="tab">View Profile</a>
				</li>
				<li role="presentation">
					<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">Edit Profile</a>
				</li>
			</ul>
		</div>
		<div class="panel-body">
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="home">
					<p>Name: {{ $user->name }}</p>
					<p>Email: {{ $user->email }}</p>
					<p>Role: {{ $user->role->name }}</p>
					<p>Ststus: {{ $user->status ? 'Active' : 'Inactive' }}</p>
					<p>Created: {{ date_create($user->created_at)->format('j M Y') }}</p>
					<p>Last Update: {{ $user->updated_at }}</p>
				</div>
				<div role="tabpanel" class="tab-pane" id="tab">
					<form method="post" action="{{route('admin-profile')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
						<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : ' value="'.$user->name.'"') !!}>
							{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
						</div>
						<div class="form-group{!! $errors->has('email') ? ' has-error':'' !!}">
							<label for="email">Email</label>
							<input type="text" class="form-control" id="email" name="email" placeholder="Enter email"{!! ((old('email')) ? ' value="'.old('email').'"' : '') !!}>
							{!! $errors->has('email') ? '<span class="text-danger">'.$errors->first('email').'</span>' : '' !!}
						</div>

						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<button type="submit" class="btn btn-primary"><span class="fa fa-save"></span>  Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
@stop

@section('styles')
	<style type="text/css">
		.tabpanel .panel-heading{
			padding-bottom: 0;
			padding-left: 0;
			padding-right: 0;
			border-bottom: none;
		}

		.panel-primary .panel-heading a{
			color: #fff;
		}

		.tabpanel .panel-heading .nav-tabs{
			border-bottom: none;
			padding-left: 15px;
			padding-right: 15px;
		}

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