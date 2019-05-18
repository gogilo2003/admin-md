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
	<table id="picturesTable" class="table table-striped">
		<thead class="thead-light">
			<tr>
				<th></th>
				<th>Picture</th>
				<th>Title</th>
				<th>Caption</th>
				<th></th>
			</tr>
		</thead>
		@foreach ($pictures as $key => $picture)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>
					<img src="{{ url('public/images/pictures/thumbnails/'.$picture->name) }}" class="img-responsive img-fluid" alt="{{ $picture->alt }}">
				</td>
				<td>
					{{ $picture->title }}
				</td>
				<td>
					{{ $picture->caption }}
				</td>
				<td>
					<div class="btn-group">
						<a href="{{route('admin-pictures-edit',$picture->id)}}" class="btn btn-success btn-sm btn-round"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
						<a href="javascript:publishPicture({{ $picture->id }})" class="btn btn-warning btn-sm btn-round"><span class="fa fa-arrow-{{ $picture->published ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $picture->published ? ' Unpublish' : 'Publish' }}</a>
						<a href="javascript:deletePicture({{ $picture->id }})" class="btn btn-danger btn-sm btn-round"><span class="fa fa-remove"></span>&nbsp;&nbsp; Delete</a>
					</div>
				</td>
			</tr>
		@endforeach
		{{-- 
		<div class="row">
			<div class="col-md-12 col-lg-12 text-center">{{ $pictures->links() }}</div>
		</div>
		 --}}
	</table>
	@else
	<p>No Pictures</p>
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
                        window.setTimeout(function() {
                        	window.location = '{{ route('admin-pictures') }}'
                        }, 10);
					}
				})
			}else{
				alert("picture delete request was canceled by user")
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
                        window.setTimeout(function() {
                        	window.location = '{{ route('admin-pictures') }}'
                        }, 10);
					}
				})
			}else{
				alert("picture publish request was canceled by user")
			}
		}

		$(document).ready(function(){
			$('#picturesTable').dataTable();
		})
	</script>
@stop