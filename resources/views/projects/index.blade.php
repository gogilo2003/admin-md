@extends('admin::layout.main')

@section('title')
	@parent
	Projects
@endsection

@section('page_title')
	Projects
@endsection

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin-project_categories') }}"><i class="fa fa-list-alt"></i> Project Categories</a></li>
	<li class="active"><span><i class="fa fa-cog"></i> Projects</span></li>
@endsection

@section('sidebar')
	@parent
	@include('admin::project_categories.sidebar')
@stop

@section('content')
	<div>
	<a href="{{route('admin-projects-add')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp; New Project</a>
	<a href="{{route('admin-pages')}}" class="btn btn-primary btn-sm"><span class="fa fa-file-o"></span>&nbsp;&nbsp; Pages</a>
	</div>
	<hr>
	<table id="projectsDataTable" class="table table-hover table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Title</th>
				<th>Category</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($projects as $project)
			<tr>
				<td>{{ $project->id }}</td>
				<td>{{ $project->name }}</td>
				<td>{{ $project->title }}</td>
				<td>{{ $project->category ? $project->category->name : '&nbsp;' }}</td>
				<td>
					<div class="btn-group">
						<a href="{{route('admin-projects-edit', $project->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
						<a href="javascript:" data-id="{{ $project->id }}" class="btn btn-primary btn-sm publishProject"><span class="fa fa-arrow-{{ $project->published ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $project->published ? 'Un-Publish' : 'Publish' }}</a>
						<a href="javascript:" data-id="{{ $project->id }}" class="btn btn-danger btn-sm deleteProject"><span class="fa fa-remove"></span>&nbsp;&nbsp; Delete</a>
					</div>
				</td>
			</tr>
			@endforeach

		</tbody>
	</table>
@endsection

@section('styles')
	<style type="text/css">

	</style>
@endsection
@section('scripts_top')
	<script type="text/javascript">

	</script>
@endsection

@section('scripts_bottom')
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#projectsDataTable').dataTable();

		$('a.deleteProject').click(function(){
			answer = confirm("Are you sure you want to delete this project?");

			if (answer) {

				$.ajax({
					url: '{{ route('admin-projects-delete') }}',
					type: 'POST',
					data: {
						id:$(this).data('id'),
						_token:'{{ csrf_token() }}'
					}
				}).done(function(xhr){
					// alert('Project Deleted');
					$.notify(
                            {
                                message:xhr.message,
                                icon: 'check_circle'
                            },
                            {
                                type:'success',
                                onClosed: function(){
                                	window.location = '{{ route('admin-projects') }}'
                                }
                            }
                        );
					// window.location = '{{ route('admin-projects') }}';
				});

			} else {
				alert('Project deletion canceled by project');
			}

		});

		$('a.publishProject').click(function(){
			answer = confirm("Are you sure you want to publish this project?");

			if (answer) {

				$.ajax({
					url: '{{ route('admin-projects-publish') }}',
					type: 'POST',
					data: {
						id:$(this).data('id'),
						_token:'{{ csrf_token() }}'
					}
				}).done(function(xhr){
					// alert('Project Deleted');
					// console.log(xhr.message);
					$.notify(
                            {
                                message:xhr.message,
                                icon: 'check_circle'
                            },
                            {
                                type:'success',
                                onClosed: function(){
                                	window.location = '{{ route('admin-projects') }}'
                                }
                            }
                        );
					// window.location = '{{ route('admin-projects') }}';
				});

			} else {
				alert('Project deletion canceled by project');
			}

		});

	});
	</script>
@endsection
