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
                <div class="card bg-dark text-white">
                    <img class="card-img" src="{{ asset(config('admin.path_prefix').'images/packages/'.$picture->picture) }}" alt="{{ $picture->title }}">
                    <div class="card-img-overlay">
                        <h4 class="card-title">{{ $picture->title }}</h4>
                    </div>
                </div>
			</div>
		@endforeach
		<div class="col-md-12">
			<hr>
		</div>
	</div>

	@endif

    <form method="post" action="{{route('admin-packages-pictures-post')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">New Picture</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 col-lg-3">

                        <div class="form-group{!! $errors->has('picture') ? ' has-error':'' !!}">
                            {!! $errors->has('picture') ? '<span class="text-danger">'.$errors->first('picture').'</span>' : ''!!}
                        </div>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail img-raised">
                                <img src="{{ asset(config('admin.path_prefix').'vendor/admin/img/placeholder.png') }}" alt="">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                            <div>
                                <span class="btn btn-raised btn-round btn-default btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="picture" accept="image/*"/>
                                </span>
                                <a href="JavaScript:" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-9">
                        <div class="form-group{!! $errors->has('title') ? ' has-error':'' !!}">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"{!! ((old('title')) ? ' value="'.old('title').'"' : '') !!}>
                            {!! $errors->has('title') ? '<span class="text-danger">'.$errors->first('title').'</span>' : '' !!}
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="" name="primary_picture">
                                Is Primary Picture
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                {{ csrf_field() }}
                <input type="hidden" name="package_id" id="inputPackage_id" class="form-control" value="{{ $package->id }}">
                <button type="submit" class="btn btn-primary btn-round"><span class="material-icons">cloud_upload</span>  Upload</button>
            </div>
        </div>
	</form>

@endsection
