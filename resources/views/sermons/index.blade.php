@extends('admin::layout.main')

@section('title')
	Sermons
@stop

@section('page_title')
	Sermons
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-book"></i> Sermons</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::sermons.sidebar')
@stop

@section('content')

	@if ($errors->has('picture') || $errors->has('audio') || $errors->has('video') || $errors->has('id') )
		<ul type="-">
			{!! $errors->has('id') ? '<li class="text-danger">'.$errors->first('id').'</li>' : '' !!}
			{!! $errors->has('picture') ? '<li class="text-danger">'.$errors->first('picture').'</li>' : '' !!}
			{!! $errors->has('audio') ? '<li class="text-danger">'.$errors->first('audio').'</li>' : '' !!}
			{!! $errors->has('video') ? '<li class="text-danger">'.$errors->first('video').'</li>' : '' !!}
		</ul>

		<hr>
	@endif
	<table id="sermonsDataTable" class="table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Title</th>
				<!-- <th>Author</th> -->
				<th>Date</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach ($sermons as $key => $sermon)
			<tr>
				<td>{{ $key + 1 }}</td>
				<td>{{ $sermon->title }}</td>
				<!-- <td>{{ $sermon->sermon_by }}</td> -->
				<td>{{ date_format(date_create($sermon->sermon_at),'d M Y') }}</td>
				<td>
					<div class="btn-group">
						<a data-picture="{{ $sermon->picture ? asset(config('admin.path_prefix').'images/sermons/'.$sermon->picture) : asset(config('admin.path_prefix').'vendor/admin/img/placeholder.png') }}" data-id="{{ $sermon->id }}" class="btn btn-primary btn-sm btn-round" data-toggle="modal" href='#pictureModal'><span class="material-icons">add_a_photo</span> Picture</a>
						<a data-id="{{ $sermon->id }}" class="btn btn-primary btn-sm btn-round" data-toggle="modal" href='#audioModal'><span class="material-icons">audiotrack</span> Audio</a>
						<a data-id="{{ $sermon->id }}" class="btn btn-primary btn-sm btn-round" data-toggle="modal" href='#videoModal'><span class="material-icons">video_call</span> Video</a>
						<a data-id="{{ $sermon->id }}" class="publishSermon btn btn-primary btn-sm" href='javascript:'><span class="material-icons">cloud_{{ $sermon->published ? 'download' : 'upload' }}</span> {{ $sermon->published ? 'Un-Publish' : 'Publish' }}</a>
						<a href="{{route('admin-sermons-edit',$sermon->id)}}" class="btn btn-primary btn-sm btn-round"><span class="material-icons">edit</span>&nbsp;&nbsp; Edit</a>
					</div>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

	<div class="modal fade" id="pictureModal" data-backdrop="static">
		<div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="post" action="{{route('admin-sermons-picture')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data" class="modal-content">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <button type="button" class="close btn btn-danger btn-sm btn-fab btn-round" data-dismiss="modal" aria-hidden="true"><span class="material-icons">close</span></button>
                            <h4 class="card-title">Add/Update Picture</h4>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            <div style="text-align: center">

                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-raised">
                                        <img id="currentPicture" src="{{ asset(config('admin.path_prefix').'vendor/admin/img/placeholder.png') }}" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                    {!! $errors->has('picture') ? '<p><span class="text-danger">'.$errors->first('picture').'</span></p>' : ''!!}
                                    <p class="help-block">Select a new Picture To replace current. Maximum file size is {{ ini_get('post_max_size') }}</p>
                                    <div>
                                        <span class="btn btn-raised btn-round btn-info btn-file">
                                            <span class="fileinput-new"><span class="material-icons">add_a_photo</span> Select image</span>
                                            <span class="fileinput-exists"><span class="material-icons">refresh</span> Change</span>
                                            <input type="file" name="picture" accept=".png, .jpg, .jpeg"/>
                                        </span>
                                        <a href="JavaScript:" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="">

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger btn-round" data-dismiss="modal"><span class="material-icons">cancel</span> Cancel</button>
                            <button type="submit" class="btn btn-primary btn-round"><span class="material-icons">cloud_upload</span> Upload</button>
                        </div>
                    </div>
                </form>
            </div>
		</div>
	</div>

	<div class="modal fade" id="audioModal" data-backdrop="static">
		<div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="post" action="{{route('admin-sermons-audio')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data" class="modal-content">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <button type="button" class="close btn btn-danger btn-sm btn-fab btn-round" data-dismiss="modal" aria-hidden="true"><span class="material-icons">close</span></button>
                            <h4 class="card-title">Add/Update Audio</h4>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            <div class="form-group form-file-upload form-file-multiple{!! $errors->has('audio') ? ' has-error':'' !!}">
                                <input type="file" name="audio" class="inputFileHidden" accept="audio/*">
                                <div class="input-group">
                                    <input type="text" class="form-control inputFileVisible" placeholder="Select audio file"/>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-fab btn-round btn-primary">
                                            <i class="material-icons">audiotrack</i>
                                        </button>
                                    </span>
                                </div>
                                {!! $errors->has('audio') ? '<span class="text-danger">'.$errors->first('audio').'</span>' : ''!!}
                                <p class="help-block">Select an audio file to replace current one. Maximum file size is {{ ini_get('post_max_size') }}</p>
                            </div>
                            <input type="hidden" name="id" value="">

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger btn-round" data-dismiss="modal"><span class="material-icons">cancel</span> Cancel</button>
                            <button type="submit" class="btn btn-primary btn-round"><span class="material-icons">cloud_upload</span> Upload</button>
                        </div>
                    </div>
                </form>
            </div>

		</div>
	</div>

	<div class="modal fade" id="videoModal" data-backdrop="static">
		<div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="post" action="{{route('admin-sermons-video')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data" class="modal-content">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <button type="button" class="close btn btn-danger btn-sm btn-fab btn-round" data-dismiss="modal" aria-hidden="true"><span class="material-icons">close</span></button>
                            <h4 class="card-title">Add/Update Video</h4>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            <div class="form-group form-file-upload form-file-multiple{!! $errors->has('video') ? ' has-error':'' !!}">
                                <input type="file" name="video" class="inputFileHidden" accept="video/*">
                                <div class="input-group">
                                    <input type="text" class="form-control inputFileVisible" placeholder="Select Video clip">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-fab btn-round btn-primary">
                                            <i class="material-icons">video_call</i>
                                        </button>
                                    </span>
                                </div>
                                {!! $errors->has('video') ? '<span class="text-danger">'.$errors->first('video').'</span>' : ''!!}
                                <p class="help-block">Select a video clip to replace the current one. Maximum file size is {{ ceil(((int)ini_get('post_max_size')) *.8) }}M</p>
                            </div>
                            <input type="hidden" name="id" value="">

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger btn-round" data-dismiss="modal"><span class="material-icons">cancel</span> Cancel</button>
                            <button type="submit" class="btn btn-primary btn-round"><span class="material-icons">cloud_upload</span> Upload</button>
                        </div>
                    </div>
                </form>
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
	jQuery(document).ready(function($) {

        $('#sermonsDataTable').dataTable();

		$('a.deleteSermon').click(function(){
			answer = confirm("Are you sure you want to delete this sermon?");

			if (answer) {

				$.ajax({
					url: '{{ route('admin-sermons-delete') }}',
					type: 'POST',
					data: {
						id:$(this).data('id'),
						_token:'{{ csrf_token() }}'
					}
				}).done(function(xhr){
					// alert('Sermon Deleted');
					$.notify(
                            {
                                message:xhr.message,
                                icon: 'fa fa-check-circle'
                            },
                            {
                                type:'success'
                            }
                        );
					// window.location = '{{ route('admin-sermons') }}';
				});

			} else {
				alert('Sermon deletion canceled by sermon');
			}

		});

		$('a.publishSermon').click(function(){
			answer = confirm("Are you sure you want to publish this sermon?");

			if (answer) {

				$.ajax({
					url: '{{ route('admin-sermons-publish') }}',
					type: 'POST',
					data: {
						id:$(this).data('id'),
						_token:'{{ csrf_token() }}'
					}
				}).done(function(xhr){
					$.notify(
                            {
                                message:xhr.message,
                                icon: 'fa fa-check-circle'
                            },
                            {
                                type:'success',
                                onClosed: function(){
                                	window.location = '{{ route('admin-sermons') }}'
                                }
                            }
                        );
				});

			} else {;
				$.notify(
                        {
                            message:'Sermon publishing canceled by user',
                            icon: 'fa fa-check-circle'
                        },
                        {
                            type:'success',
                            onClosed: function(){
                            	window.location = '{{ route('admin-sermons') }}'
                            }
                        }
                    );
			}

		});

		$('#pictureModal').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget) // Button that triggered the modal
		  	var id = button.data('id')
            $('#pictureModal form input[name="id"]').val(id)
            let picture = button.data('picture')
            console.log(picture)
			$('#pictureModal #currentPicture').attr('src',picture)
		})

		$('#audioModal').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget) // Button that triggered the modal
		  	var id = button.data('id')
			$('#audioModal form input[name="id"]').val(id)
		})

		$('#videoModal').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget) // Button that triggered the modal
		  	var id = button.data('id')
			$('#videoModal form input[name="id"]').val(id)
		})

	});
	</script>
@stop
