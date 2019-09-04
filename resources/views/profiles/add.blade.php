@extends('admin::layout.main')

@section('title')
	Add Profile
@stop

@section('page_title')
	<i class="fa fa-plus"></i> Add Profile
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-profiles') }}"><i class="fa fa-address-card"></i> Profiles</a>
	</li>
	<li class="active"><span><i class="fa fa-plus"></i> New Profile</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::profiles.sidebar')
@stop

@section('content')
	<form method="post" action="{{route('admin-profiles-add')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-4 col-lg-4">

                <div class="form-group{!! $errors->has('picture') ? ' has-error':'' !!}">
                    <label for="picture">Picture</label>
                    {!! $errors->has('picture') ? '<span class="text-danger">'.$errors->first('picture').'</span>' : ''!!}
                    <img id="picture_preview" class="picture_preview w-100 h100" src="{{ url('public/vendor/admin/img/placeholder.png') }}" alt="Preview">

                    <input
                        data-filename-placement="inside"
                        title="Select a picture to upload"
                        type="file"
                        id="picture"
                        name="picture"
                        class="form-control"
                        >
                </div>

                <a href="JavaScript:" id="load_picture" class="btn btn-round btn-outline-info btn-block"><i class="material-icons">search</i> Browse</a>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : '') !!}>
                            {!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group">
                            <label for="pages">Pages</label>
                            <select class="form-control selectpicker" id="pages" name="pages[]" data-live-search="true" data-size="5" data-width="100%" data-tick-icon="fa fa-check-square-o" multiple data-style="btn btn-link">
                                @foreach(Ogilo\AdminMd\Models\Page::all() as $page)
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('position') ? ' has-error':'' !!}">
                            <label for="position">Position</label>
                            <input type="text" class="form-control typeahead" id="position" name="position" placeholder="Enter position"{!! ((old('position')) ? ' value="'.old('position').'"' : '') !!} autocomplete="off" data-provide="typeahead">
                            {!! $errors->has('position') ? '<span class="text-danger">'.$errors->first('position').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('facebook') ? ' has-error':'' !!}">
                            <label for="facebook">Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Enter facebook"{!! ((old('facebook')) ? ' value="'.old('facebook').'"' : '') !!}>
                            {!! $errors->has('facebook') ? '<span class="text-danger">'.$errors->first('facebook').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('twitter') ? ' has-error':'' !!}">
                            <label for="twitter">Twitter</label>
                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Enter twitter"{!! ((old('twitter')) ? ' value="'.old('twitter').'"' : '') !!}>
                            {!! $errors->has('twitter') ? '<span class="text-danger">'.$errors->first('twitter').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('youtube') ? ' has-error':'' !!}">
                            <label for="youtube">Youtube</label>
                            <input type="text" class="form-control" id="youtube" name="youtube" placeholder="Enter Youtube"{!! ((old('youtube')) ? ' value="'.old('youtube').'"' : '') !!}>
                            {!! $errors->has('youtube') ? '<span class="text-danger">'.$errors->first('youtube').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('linkedin') ? ' has-error':'' !!}">
                            <label for="linkedin">Linkedin</label>
                            <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Enter Linkedin"{!! ((old('linkedin')) ? ' value="'.old('linkedin').'"' : '') !!}>
                            {!! $errors->has('linkedin') ? '<span class="text-danger">'.$errors->first('linkedin').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('dribble') ? ' has-error':'' !!}">
                            <label for="dribble">Dribble</label>
                            <input type="text" class="form-control" id="dribble" name="dribble" placeholder="Enter dribble"{!! ((old('dribble')) ? ' value="'.old('dribble').'"' : '') !!}>
                            {!! $errors->has('dribble') ? '<span class="text-danger">'.$errors->first('dribble').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('phone') ? ' has-error':'' !!}">
                            <label for="phone">Phone No</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number"{!! ((old('phone')) ? ' value="'.old('phone').'"' : '') !!}>
                            {!! $errors->has('phone') ? '<span class="text-danger">'.$errors->first('phone').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('email') ? ' has-error':'' !!}">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"{!! ((old('email')) ? ' value="'.old('email').'"' : '') !!}>
                            {!! $errors->has('email') ? '<span class="text-danger">'.$errors->first('email').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('box_no') ? ' has-error':'' !!}">
                            <label for="box_no">Box No</label>
                            <input type="text" class="form-control" id="box_no" name="box_no" placeholder="Enter box no"{!! ((old('box_no')) ? ' value="'.old('box_no').'"' : '') !!}>
                            {!! $errors->has('box_no') ? '<span class="text-danger">'.$errors->first('box_no').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('post_code') ? ' has-error':'' !!}">
                            <label for="post_code">Post Code</label>
                            <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Enter postCode"{!! ((old('post_code')) ? ' value="'.old('post_code').'"' : '') !!}>
                            {!! $errors->has('post_code') ? '<span class="text-danger">'.$errors->first('post_code').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group{!! $errors->has('town') ? ' has-error':'' !!}">
                            <label for="town">Town</label>
                            <input type="text" class="form-control" id="town" name="town" placeholder="Enter town"{!! ((old('town')) ? ' value="'.old('town').'"' : '') !!}>
                            {!! $errors->has('town') ? '<span class="text-danger">'.$errors->first('town').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <div class="form-group{!! $errors->has('address') ? ' has-error':'' !!}">
                            <label for="address">Physical Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter physical address"{!! ((old('address')) ? ' value="'.old('address').'"' : '') !!}>
                            {!! $errors->has('address') ? '<span class="text-danger">'.$errors->first('address').'</span>' : '' !!}
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group{!! $errors->has('details') ? ' has-error':'' !!}">
                            <label for="details">Details</label>
                            <textarea rows="5" class="form-control" id="details" name="details" placeholder="Enter details">{!! ((old('details')) ? old('details') : '') !!}</textarea>
                            {!! $errors->has('details') ? '<span class="text-danger">'.$errors->first('details').'</span>' : '' !!}
                        </div>
                    </div>
                </div>
            </div>
		</div>
        <div class="text-center">
            <input type="hidden" name="image_cropdetails" id="picture_cropdetails" value="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-lg btn-primary btn-round"><span class="fa fa-save"></span>  Save</button>
        </div>
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
		$(document).ready(function(){
			$('.typeahead').typeahead('destroy');
			$.ajax({
				url: '{{ route('admin-profiles-positions') }}',
				complete: function(xhr){
					// console.log(xhr);
					$('.typeahead').typeahead({source: xhr.responseJSON});
					// console.log(xhr.responseJSON)
				}
			})

            var image = $('#picture_preview').cropper({
                aspectRatio: {{ config('admin.profile_picture.w') }}/{{ config('admin.profile_picture.h') }},
                scalable:false,
            })

            $('#load_picture').click(function(){
                $('input[type="file"]#picture').click()
            })

            $('input[type="file"]#picture').change(function(){
                let src = window.URL.createObjectURL($(this).prop('files')[0])
                $('.picture_preview').cropper('replace',src)
            })

            $('#picture_preview').on('cropend',function(){
                data = $('#picture_preview').cropper('getData')
                $('input#picture_cropdetails').val(JSON.stringify(data))
            })
		})
	</script>
@stop
