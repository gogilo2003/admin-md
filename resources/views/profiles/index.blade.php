@extends('admin::layout.main')

@section('title')
	Profiles
@stop

@section('page_title')
	<i class="fa fa-address-card"></i> Profiles
@stop

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-address-card"></i> Profiles</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::profiles.sidebar')
@stop

@section('content')
	<div class="row">
		@foreach ($profiles as $key => $profile)
			<div class="col-md-4 col-lg-4 text-center">
				<img src="{{ url('public/images/profiles/'.$profile->picture) }}" alt="{{ $profile->name }}" class="img-responsive">
				<hr>
				<h4 class="text-uppercase">{{ $profile->name }}<br><small>{{ $profile->position }}</small></h4>
				<hr>
				<div class="btn-group">
					<a href="{{route('admin-profiles-edit',$profile->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp; Edit</a>
					<a data-id="{{ $profile->id }}" href="javascript:void(0)" class="publishButton btn btn-warning btn-sm"><i class="fa fa-arrow-{{ $profile->published ? 'down' : 'up' }}"></i>&nbsp;{{ $profile->published ? "Un-piblish" : "Publish" }}</a>
					<a data-id="{{ $profile->id }}" href="javascript:void(0)" class="deleteButton btn btn-danger btn-sm"><i class="fa fa-times"></i>&nbsp;&nbsp; Delete</a>
				</div>
				<hr>
			</div>
			@if ($key && (($key % 3) == 2))
				</div>
				<div class="row">
			@endif
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

			$('.deleteButton').click(function(e){
				console.log($(this).data('id'))
				$.post('{{ route('admin-profiles-delete') }}',{id:$(this).data('id'), _token:'{{ csrf_token() }}'}).then(function(xhr){
					// console.log(xhr)
					$.notify(
                            {
                                message:xhr.message,
                                icon: 'fa fa-check-circle'
                            },
                            {
                                type:'success',
                                onClosed: function(){
                                	window.location = '{{ route('admin-profiles') }}'
                                }
                            }
                        );
				})
			})

			$('.publishButton').click(function(e){
				console.log($(this).data('id'))
				$.post('{{ route('admin-profiles-publish') }}',{id:$(this).data('id'), _token:'{{ csrf_token() }}'}).then(function(xhr){
					// console.log(xhr)
					$.notify(
                            {
                                message:xhr.message,
                                icon: 'fa fa-check-circle'
                            },
                            {
                                type:'success',
                                onClosed: function(){
                                	window.location = '{{ route('admin-profiles') }}'
                                }
                            }
                        );
				})
			})

		})
	</script>
@stop