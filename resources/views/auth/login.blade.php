@extends('admin::layout.main')

@section('title')
	Login
@stop

@section('page_title')
	Login
@stop

@section('breadcrumbs')
	<li class="active"><span><i class="fa fa-sign-in"></i>&nbsp;Login</span></li>
@stop

@section('sidebar')

@stop

@section('content')
	<div class="row">
		<div class="offset-md-3 col-sm-6 col-md-6 col-lg-6">
			<div class="card">
				<div class="card-header card-header-primary">
					<h3 class="card-title"><i class="material-icons">screen_lock_portrait</i>&nbsp;Login</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center text-primary">
							<i style="font-size: 9.5em" class="material-icons">screen_lock_portrait</i>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
							<form method="post" action="{{route('admin-login')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
								<div class="form-group{!! $errors->has('email') ? ' has-error':'' !!}">
									<input type="text" class="form-control" id="email" name="email" placeholder="Enter email"{!! ((old('email')) ? ' value="'.old('email').'"' : '') !!}>
									{!! $errors->has('email') ? '<span class="text-danger">'.$errors->first('email').'</span>' : '' !!}
								</div>
								<div class="form-group{!! $errors->has('password') ? ' has-error':'' !!}">
									<input type="password" class="form-control" id="password" name="password" placeholder="Enter password"{!! ((old('password')) ? ' value="'.old('password').'"' : '') !!}>
									{!! $errors->has('password') ? '<span class="text-danger">'.$errors->first('password').'</span>' : '' !!}
								</div>
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<button type="submit" class="btn btn-primary btn-block"><span class="fa fa-sign-in"></span>  Login</button>
							</form>
						</div>
					</div>
				</div>
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
		
	</script>
@stop