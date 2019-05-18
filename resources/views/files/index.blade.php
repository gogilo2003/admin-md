@extends('admin::layout.main')

@section('title')
	Files
@stop

@section('page_title')
	Files
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-file_categories') }}"><i class="fa fa-folder-open-o"></i> File Categories</a>
	</li>
	<li class="active"><span><i class="fa fa-file-o"></i> Files</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::file_categories.sidebar')
@stop

@section('content')
	<a href="{{route('admin-files-add')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp; Add File</a>
	<hr>
	<div class="row">
		@foreach ($files as $file)
			<div class="col-md-6 col-lg-6">
				<div class="panel panel-default">
					<div class="row panel-body">
						<div class="col-md-3 text-center">
							<i class="{{ get_file_icon($file->name) }} fa-5x"></i><br>
						</div>
						<div class="col-md-9">
							<h3>{{ $file->title }}</h3>
							{{ $file->description }} <br>
							{{ $file->category->name }}
						</div>
						
						<div class="col-md-12 text-right">
							<hr>
							<a href="{{route('admin-files-edit',$file->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
							<a data-id="{{ $file->id }}" href="javascript:void(0)" class="publishButton btn btn-primary btn-sm"><span class="fa fa-arrow-{{ $file->published ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $file->published ? 'Un-Publish' : 'Publish' }}</a>
							<a data-id="{{ $file->id }}" href="javascript:void(0)" class="deleteButton btn btn-danger btn-sm"><span class="fa fa-times"></span>&nbsp;&nbsp; Delete</a>
							<br>
						</div>
					</div>
				</div>
			</div>
		@endforeach
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
		$(document).ready(function(){
			$('.deleteButton').click(function(){
				// alert($(this).data('id'))
				$.ajax({
					url: '{{ route('admin-files-delete') }}',
					type: 'post',
					data: {id: $(this).data('id'), '_token': '{{ csrf_token() }}'}
				}).then(function(xhr){
					// console.log(xhr)
					$.notify(
                            {
                                message:xhr.message,
                                icon: 'fa fa-check-circle'
                            },
                            {
                                type:'success',
                                onClosed: function(){
                                	window.location = '{{ route('admin-files') }}'
                                }
                            }
                        );
				})
			})

			$('.publishButton').click(function(){
				// alert($(this).data('id'))
				$.ajax({
					url: '{{ route('admin-files-publish') }}',
					type: 'post',
					data: {id: $(this).data('id'), '_token': '{{ csrf_token() }}'}
				}).then(function(xhr){
					// console.log(xhr)
					$.notify(
                            {
                                message:xhr.message,
                                icon: 'fa fa-check-circle'
                            },
                            {
                                type:'success',
                                onClosed: function(){
                                	window.location = '{{ route('admin-files') }}'
                                }
                            }
                        );
				})
			})
		});
		
	</script>
@stop