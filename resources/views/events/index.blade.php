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
					<img src="{{ asset(config('admin.path_prefix').'images/events/'.$event->picture) }}" class="img-responsive img-fluid" alt="Image">
					<p class="text-justify">{{ str_words($event->content) }}</p>
					{{ $event->category->name }}
					<hr>
					<div class="drdpdown">
                        <button class="btn btn-outline-primary btn-round dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">settings</i>
                            Tasks
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="{{route('admin-events-edit',$event->id)}}" class="dropdown-item"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
                            <a href="#" data-event="{{ $event->id }}" class="dropdown-item" data-toggle="modal" data-target="#speakersModal">
                                <i class="material-icons">person_outline</i>&nbsp;&nbsp;
                                Event Speakers
                            </a>
                            <a href="#" data-event="{{ $event->id }}" class="dropdown-item" data-toggle="modal" data-target="#shedulesModal">
                                <i class="material-icons">schedule</i>&nbsp;&nbsp;
                                Event Schedules
                            </a>
                            <a data-id="{{ $event->id }}" href="javascript:void(0)" class="dropdown-item featureButton"><span class="fa fa-arrow-{{ $event->featured ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $event->featured ? 'Un-Feature' : 'Feature' }}</a>
                            <a data-id="{{ $event->id }}" href="javascript:void(0)" class="dropdown-item publishButton"><span class="fa fa-arrow-{{ $event->published ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $event->published ? 'Un-Publish' : 'Publish' }}</a>

                            <a data-id="{{ $event->id }}" href="javascript:void(0)" class="dropdown-item deleteButton text-danger"><span class="fa fa-times"></span>&nbsp;&nbsp; Delete</a>
                        </div>
                    </div>
				</div>
			</div>
		@endforeach
    </div>
    @include('admin::events.speakers')
    @include('admin::events.schedule')
@stop

@push('scripts_bottom')
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
                            icon: 'check_circle'
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
                            icon: 'check_circle'
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
@endpush
