@extends('admin::layout.main')

@section('title')
	Events
@stop

@section('page_title')
	<i class="fa fa-calendar"></i> Events
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-event_categories') }}"><i class="fa fa-folder-open-o"></i> Event Categories</a>
	</li>
	<li class="active"><span><i class="fa fa-calendar"></i> Events</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::event_categories.sidebar')
@stop

@section('content')
	<a href="{{route('admin-events-add')}}" class="btn btn-info btn-round"><span class="fa fa-plus"></span>&nbsp;&nbsp; Add Event</a>
	<hr>
	<div class="row">
		@foreach ($events as $event)
			<div class="col-md-4 col-lg-4">
				<div class="thumbnail text-center">
					<h3>{{ $event->title }}</h3>
					<img src="{{ url('public/images/events/'.$event->picture) }}" class="img-responsive img-fluid" alt="Image">
					<p class="text-justify">{{ str_words($event->content) }}</p>
					{{ $event->category->name }}
					<hr>
					<div class="btn-group">
						<a href="{{route('admin-events-edit',$event->id)}}" class="btn btn-primary btn-sm btn-round"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
						<a data-id="{{ $event->id }}" href="javascript:void(0)" class="publishButton btn btn-primary btn-sm btn-round"><span class="fa fa-arrow-{{ $event->published ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $event->published ? 'Un-Publish' : 'Publish' }}</a>
						<a data-id="{{ $event->id }}" href="javascript:void(0)" class="deleteButton btn btn-danger btn-sm btn-round"><span class="fa fa-times"></span>&nbsp;&nbsp; Delete</a>
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
					url: '{{ route('admin-events-delete') }}',
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
                                	window.location = '{{ route('admin-events') }}'
                                }
                            }
                        );
				})
			})

			$('.publishButton').click(function(){
				// alert($(this).data('id'))
				$.ajax({
					url: '{{ route('admin-events-publish') }}',
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
                                	window.location = '{{ route('admin-events') }}'
                                }
                            }
                        );
				})
			})
		});

	</script>
@stop
