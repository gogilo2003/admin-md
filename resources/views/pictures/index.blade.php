@extends('admin::layout.main')

@section('title')
	Pictures
@stop

@section('page_title')
	Pictures
@stop

@section('breadcrumbs')
	@parent
	<li>
		<a href="{{ route('admin-picture_categories') }}"><i class="fa fa-image"></i> Picture Categories</a>
	</li>
	<li class="active"><span><i class="fa fa-image"></i> Pictures</span></li>
@stop

@section('sidebar')
	@parent
	@include('admin::picture_categories.sidebar')
@stop

@section('content')

	<a href="{{route('admin-pictures-add')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp; Add Picture</a>
	<hr>
	@if ($pictures->count())
		@foreach ($pictures as $key => $picture)
			<div class="row">
				<div class="col-md-3 col-lg-3">
					<img style="width: 100%" src="{{ url('public/images/pictures/thumbnails/'.$picture->name) }}" class="img-responsive" alt="{{ $picture->alt }}">
				</div>
				<div class="col-md-9 col-lg-9">
					<h3>{{ $picture->title }}</h3>
					<p>{{ $picture->caption }}</p>
					<hr>
					<a href="{{route('admin-pictures-edit',$picture->id)}}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
					<a href="javascript:publishPicture({{ $picture->id }})" class="btn btn-warning btn-sm"><span class="fa fa-arrow-{{ $picture->published ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $picture->published ? ' Unpublish' : 'Publish' }}</a>
					<a href="javascript:deletePicture({{ $picture->id }})" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span>&nbsp;&nbsp; Delete</a>
				</div>
			</div>
			<hr>
		@endforeach
		<div class="row">
			<div class="col-md-12 col-lg-12 text-center">{{ $pictures->links() }}</div>
		</div>
	@endif
		
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
		var deletePicture = function (pID){
			if(confirm("Do you want to delete the selected picture?")){
				alert("Picture Deleted")
				$.ajax({
					url: '{{ route('admin-pictures-delete') }}',
					type: 'post',
					data: { id: pID, _token: '{{ csrf_token() }}' },
					complete: function(xhr){
						$.notify(
                            {
                                message:xhr.responseJSON.message,
                                icon: 'fa fa-check-circle'
                            },
                            {
                                type:'success'
                            }
                        );
					}
				})
			}else{
				alert("picture not deleted")
			}
		}

		var publishPicture = function (pID){
			if(confirm("Do you want to publish the selected picture?")){
				$.ajax({
					url: '{{ route('admin-pictures-publish') }}',
					type: 'post',
					data: { id: pID, _token: '{{ csrf_token() }}' },
					complete: function(xhr){
						// console.log(xhr)
						$.notify(
                            {
                                message:xhr.responseJSON.message,
                                icon: 'fa fa-check-circle'
                            },
                            {
                                type:'success'
                            }
                        );
					}
				})
			}else{
				alert("picture not deleted")
			}
		}
	</script>
@stop