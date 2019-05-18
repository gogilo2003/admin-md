@extends('admin::web.layout.main')

@section('content')
	<form method="post" action="{{route('post-contact')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : '') !!}>
			{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('email') ? ' has-error':'' !!}">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Enter email"{!! ((old('email')) ? ' value="'.old('email').'"' : '') !!}>
			{!! $errors->has('email') ? '<span class="text-danger">'.$errors->first('email').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('comment') ? ' has-error':'' !!}">
			<label for="comment">Message</label>
			<input type="text" class="form-control" id="comment" name="comment" placeholder="Enter message"{!! ((old('comment')) ? ' value="'.old('comment').'"' : '') !!}>
			{!! $errors->has('comment') ? '<span class="text-danger">'.$errors->first('comment').'</span>' : '' !!}
		</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span>  Save</button>
	</form>
@endsection