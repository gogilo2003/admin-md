@extends('admin::layout.main')

@section('title')
	Package Pictures
@endsection

@section('page_title')
	Pictures for {{ $package->title }}
@endsection

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin-packages') }}"><i class="fa fa-list"></i> List Packages</a></li>
	<li class="active"><span><i class="fa fa-list-alt"></i> Pictures</span></li>
@endsection

@section('sidebar')
	@parent
	@include('admin::packages.sidebar')
@endsection

@section('content')
	@if ($package->pictures->count())

	<div class="row"> 
		@foreach ($package->pictures as $picture)
			<div class="col-md-4">
				<diiv class="thumbnail">
					<img src="{{ url('public/images/packages/'.$picture->picture) }}" alt="">
					<div class="caption">{{ $picture->title }}</div>
				</diiv>
			</div>
		@endforeach
		<idv class="col-md-12">
			<hr>
		</idv>
	</div>

	@endif
	
	<form method="post" action="{{route('admin-packages-pictures-post')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
	    <div class="row">
	    	<div class="col-md-12 col-lg-12">
	    		<div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
			    	<label for="title">Title</label>
			    	<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : '') !!}>
			    	{!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
			    </div>
	    	</div>
	    	<div class="col-md-8 col-lg-8">
	    		<div class="form-group{!! $errors->has('picture') ? ' has-error':'' !!}">
					<input data-filename-placement="inside" title="Select a picture to upload" type="file" id="picture" name="picture" class="form-control">
					{!! $errors->has('picture') ? '<span class="text-danger">'.$errors->first('picture').'</span>' : ''!!}
				</div>
	    	</div>
	    	<div class="col-md-4 col-lg-4">
	    		<div class="form-group{!! $errors->has('primary_picture') ? ' has-error':'' !!}">
	    			<div class="checkbox">
	    				<label>
	    					<input type="checkbox" value="" name="primary_picture">
	    					Primary Picture
	    				</label>
	    			</div>

	    		</div>
	    	</div>
	    </div>

		
		{{ csrf_field() }}
		<input type="hidden" name="package_id" id="inputPackage_id" class="form-control" value="{{ $package->id }}">

		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span>  Upload</button>

	</form>

@endsection