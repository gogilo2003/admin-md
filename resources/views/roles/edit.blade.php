@extends('admin::layout.main')

@section('title')
	Edit {{ $role->name }}
@stop

@section('page_title')
	Edit {{ $role->name }}
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-roles') }}">Roles</a>
	</li>
	<li class="active">Edit {{ $role->name }}</li>
@stop

@section('toolbar')

@stop

@section('content')
	<form method="post" action="{{route('admin-roles-edit-post')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : ' value="'.$role->name.'"') !!}>
			{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
		</div>

		<div class="form-group{!! $errors->has('roles') ? ' has-error':'' !!}">
            <label for="roles">Roles</label>
            <div class="col-sm-12 col-md-12 col-lg-12">
			    <div class="form-group{!! $errors->has('roles') ? ' has-error':'' !!}">
					<label for="roles">Roles</label>
					<a id="checkall" href="javascript:">Check All</a>

					{!! $errors->has('roles') ? '<span class="text-danger">'.$errors->first('roles').'</span>' : '' !!}
                </div>
			</div>
			<div class="row">
			@foreach (admin_roles(false,false) as $value => $caption)
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input rolesCheckBox" type="checkbox" value="{{ $value }}" name="roles[]" {{ $role->hasRole($value) ? 'checked' : '' }}>
                        {{ $caption }}
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </div>
			@endforeach
			</div>
			{!! $errors->has('roles') ? '<span class="text-danger">'.$errors->first('roles').'</span>' : '' !!}
		</div>
		<input type="hidden" name="id" value="{{$role->id}}">
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
							$('.rolesCheckBox').attr('checked',null);
							varChecked = false;
						}else{
							$('.rolesCheckBox').attr('checked','checked');
							varChecked = true;
						}
					}
				);
		});
	</script>
@stop
