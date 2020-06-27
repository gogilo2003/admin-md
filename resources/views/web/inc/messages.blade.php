@if(Session::has('global-info'))
	<div class="alert alert-dismissible alert-info" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{Session::get('global-info')}}
	</div>
@endif

@if(Session::has('global-success'))
	<div class="alert alert-dismissible alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{Session::get('global-success')}}
	</div>
@endif

@if(Session::has('global-warning'))
	<div class="alert alert-dismissible alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{Session::get('global-warning')}}
	</div>
@endif

@if(Session::has('global-danger'))
	<div class="alert alert-dismissible alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{Session::get('global-danger')}}
	</div>
@endif