@extends('admin::layout.main')

@section('title')
	New Role
@stop

@section('page_title')
	New Role
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-roles') }}">Roles</a>
	</li>
	<li class="active">New Role</li>
@stop

@section('toolbar')
	
@stop

@section('content')
	<form method="post" action="{{route('admin-roles-add')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		
		<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : '') !!}>
			{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
		</div>

		<div class="row">
			<div class="form-group{!! $errors->has('roles') ? ' has-error':'' !!}">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<label for="roles">Roles</label>
					<a id="checkall" href="javascript:">Check All</a>
				</div>

				<div class="col-sm-12 col-md-12 col-lg-12">
					{!! $errors->has('roles') ? '<span class="text-danger">'.$errors->first('roles').'</span>' : '' !!}
				</div>
				<?php $index = 0; ?>
				@foreach (admin_roles(false,false) as $value => $caption)
					<div class="col-sm-3 col-md-3 col-lg-3">
						<div class="checkbox">
							<label>
								<input class="rolesCheckBox" type="checkbox" value="{{ $value }}" name="roles[]">
								{{ $caption }}
							</label>
						</div>
					</div>
						
				@endforeach

			</div>
		</div>
	
		<!-- <pre><?php var_dump(admin_roles(false,true)); ?></pre> -->
		<hr>
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
		var varChecked = false;
		jQuery(document).ready(function($) {
			$('#checkall').click(
					function(){
						// alert('Check All Clicked - '+varChecked);
						if(varChecked){
							$('input.rolesCheckBox').attr('checked',null);
							varChecked = false;
						}else{
							$('input.rolesCheckBox').attr('checked','checked');
							varChecked = true;
						}
					}
				);
		});
	</script>
@stop