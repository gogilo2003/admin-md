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

@section('content')

	<div class="row">
		<div class="col-md-5">
			<div class="card card-profile">
				<div class="card-avatar">
					<a href="#pablo">
						<img class="img" src="{{ $user->photo ? url('public/images/users',$user->photo) : url('public','favicon.png') }}">
					</a>
				</div>
				<div class="card-body">
					<h6 class="card-category text-gray">Name: {{ $user->name }}</h6>
					<h4 class="card-title">Email: {{ $user->email }}</h4>
					<p>Role: {{ $user->role->name }}</p>
					<p>Ststus: {{ $user->status ? 'Active' : 'Inactive' }}</p>
					<p>Created: {{ date_create($user->created_at)->format('j M Y') }}</p>
					<p>Last Update: {{ $user->updated_at }}</p>
					<a href="https://www.facebook.com" class="btn btn-primary btn-round btn-fab"><i class="fa fa-facebook"></i></a>
					<a href="https://www.twitter.com" class="btn btn-info btn-round btn-fab"><i class="fa fa-twitter"></i></a>
					<a href="https://www.youtube.com" class="btn btn-danger btn-round btn-fab"><i class="fa fa-youtube"></i></a>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="card">
				<div class="card-header card-primary">
					<h4 class="card-title">Edit User Details</h4>
				</div>
				<div class="card-body">
					<form method="post" action="{{route('admin-profile')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
						<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : ' value="'.$user->name.'"') !!}>
							{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
						</div>
						<div class="form-group{!! $errors->has('email') ? ' has-error':'' !!}">
							<label for="email">Email</label>
							<input readonly type="text" class="form-control" id="email" name="email" placeholder="Enter email"{!! ((old('email')) ? ' value="'.old('email').'"' : ' value="'.$user->email.'"') !!}>
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