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
	<!-- 
	<p>max_execution_time: {{ ini_get('max_execution_time') }}</p>
	<p>max_input_time: {{ ini_get('max_input_time') }}</p>
	<p>memory_limit: {{ ini_get('memory_limit') }}</p>
	<p>post_max_size: {{ ini_get('post_max_size') }}</p>
	<hr>
	 -->
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
						<a data-id="{{ $sermon->id }}" class="btn btn-primary btn-sm" data-toggle="modal" href='#pictureModal'><i class="fa fa-upload"></i> Picture</a>
						<a data-id="{{ $sermon->id }}" class="btn btn-primary btn-sm" data-toggle="modal" href='#audioModal'><i class="fa fa-upload"></i> Audio</a>
						<a data-id="{{ $sermon->id }}" class="btn btn-primary btn-sm" data-toggle="modal" href='#videoModal'><i class="fa fa-upload"></i> Video</a>
						<a data-id="{{ $sermon->id }}" class="publishSermon btn btn-primary btn-sm" href='javascript:'><i class="fa fa-arrow-{{ $sermon->published ? 'down' : 'up' }}"></i> {{ $sermon->published ? 'Un-Publish' : 'Publish' }}</a>
						<a href="{{route('admin-sermons-edit',$sermon->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
					</div>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	
	<div class="modal fade" id="pictureModal">
		<div class="modal-dialog modal-md">
			<form method="post" action="{{route('admin-sermons-picture')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data" class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add/Update Picture</h4>
				</div>
				<div class="modal-body">
					{{ csrf_field() }}
					<div class="form-group{!! $errors->has('picture') ? ' has-error':'' !!}">
						<label for="picture">Select Picture</label>
						<input class="form-control" type="file" name="picture" id="picture" data-filename-placement="inside">
						{!! $errors->has('picture') ? '<span class="text-danger">'.$errors->first('picture').'</span>' : ''!!}
						<p class="help-block">Select a new Picture To replace current. Maximum file size is {{ ini_get('post_max_size') }}</p>
					</div>
					<input type="hidden" name="id" value="">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
				</div>
			</form>
		</div>
	</div>
	
	<div class="modal fade" id="audioModal">
		<div class="modal-dialog modal-md">
			<form method="post" action="{{route('admin-sermons-audio')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data" class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add/Update Audio</h4>
				</div>
				<div class="modal-body">
					{{ csrf_field() }}
					<div class="form-group{!! $errors->has('audio') ? ' has-error':'' !!}">
						<label for="audio">Select Audio File</label>
						<input class="form-control" type="file" name="audio" id="audio" data-filename-placement="inside">
						{!! $errors->has('audio') ? '<span class="text-danger">'.$errors->first('audio').'</span>' : ''!!}
						<p class="help-block">Select an audio file to replace current one. Maximum file size is {{ ini_get('post_max_size') }}</p>
					</div>
					<input type="hidden" name="id" value="">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
				</div>
			</form>
		</div>
	</div>
	
	<div class="modal fade" id="videoModal">
		<div class="modal-dialog modal-md">
			<form method="post" action="{{route('admin-sermons-video')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data" class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add/Update Video</h4>
				</div>
				<div class="modal-body">
					{{ csrf_field() }}
					<div class="form-group{!! $errors->has('video') ? ' has-error':'' !!}">
						<label for="video">Select Video clip</label>
						<input class="form-control" type="file" name="video" id="video" data-filename-placement="inside">
						{!! $errors->has('video') ? '<span class="text-danger">'.$errors->first('video').'</span>' : ''!!}
						<p class="help-block">Select a video clip to replace the current one. Maximum file size is {{ ceil(((int)ini_get('post_max_size')) *.8) }}M</p>
					</div>
					<input type="hidden" name="id" value="">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
				</div>
			</form>
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