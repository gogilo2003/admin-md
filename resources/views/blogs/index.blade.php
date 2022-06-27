@extends('admin::layout.main')

@section('title')
	@parent
	Blogs
@endsection

@section('page_title')
	<i class="fa fa-files-o"></i> Blogs
@endsection

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-files-o"></i> Blogs</span></li>
@endsection

@section('sidebar')
	@parent
	@include('admin::blogs.sidebar')
@endsection

@section('content')
	<div>
	<a href="{{route('admin-blogs-add')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp; New Blog</a>
	<a href="{{route('admin-pages')}}" class="btn btn-primary btn-sm"><span class="fa fa-file-o"></span>&nbsp;&nbsp; Pages</a>
	</div>
	<hr>
	<table id="articlesDataTable" class="table table-hover table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Title</th>
				<th>Comments</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($blogs as $blog)
			<tr>
				<td>{{ $blog->id }}</td>
				<td>{{ $blog->name }}</td>
				<td>{{ $blog->title }}</td>
				<td>{{ $blog->comments->count() }}</td>
				<td>
					<div class="btn-group">
						<a href="{{route('admin-blogs-edit', $blog->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
						<a href="{{route('admin-blogs-view', $blog->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-list"></span>&nbsp;&nbsp; View</a>
						<a href="javascript:" data-id="{{ $blog->id }}" class="btn btn-primary btn-sm publishArticle"><span class="fa fa-arrow-{{ $blog->published ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $blog->published ? 'Un-publish' : 'Publish' }}</a>
						<a href="javascript:" data-id="{{ $blog->id }}" class="btn btn-primary btn-sm featureArticle"><span class="fa fa-arrow-{{ $blog->featured ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $blog->featured ? 'Un-feature' : 'Feature' }}</a>
						<a href="javascript:" data-id="{{ $blog->id }}" class="btn btn-danger btn-sm deleteArticle"><span class="fa fa-remove"></span>&nbsp;&nbsp; Delete</a>
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

		$('a.deleteArticle').click(function(){
			answer = confirm("Are you sure you want to delete this blog?");

			if (answer) {

				$.ajax({
					url: '{{ route('admin-blogs-delete') }}',
					type: 'POST',
					data: {
						id:$(this).data('id'),
						_token:'{{ csrf_token() }}'
					}
				}).done(function(xhr){
					// alert('Article Deleted');
					$.notify(
                            {
                                message:xhr.message,
                                icon: 'check_circle'
                            },
                            {
                                type:'success'
                            }
                        );
					// window.location = '{{ route('admin-blogs') }}';
				});

			} else {
				alert('Article deletion canceled by blog');
			}

		});

		document.querySelectorAll('a.publishArticle').forEach(function(item){
            item.addEventListener('click',function(e){
                answer = confirm("Are you sure you want to publish this blog?");
                let btn = this
                if (answer) {

                    $.ajax({
                        url: '{{ route('admin-blogs-publish') }}',
                        type: 'POST',
                        data: {
                            id:$(this).data('id'),
                            _token:'{{ csrf_token() }}'
                        }
                    }).then(function(xhr){
                        // console.log(xhr);
                        if (xhr.success) {
                            btn.innerHTML = null
                            let icon = document.createElement('i')
                            icon.className = "fa fa-arrow-" + (xhr.published ? 'down' : 'up')
                            btn.appendChild(icon)
                            let text = "  " + (xhr.published ? 'Un-publish' : 'Publish')
                            btn.appendChild(document.createTextNode(text))
                            $.notify(
                                {
                                    message:xhr.message,
                                    icon: 'check_circle'
                                },
                                {
                                    type:'success'
                                }
                            );
                        } else {
                            $.notify(
                                {
                                    message:xhr.message,
                                    icon: 'not_interested'
                                },
                                {
                                    type:'danger'
                                }
                            );
                        }

                    });

                } else {
                    alert('Article publishing canceled by user');
                }

            })
        })

		document.querySelectorAll('a.featureArticle').forEach(function(item){
            item.addEventListener('click',function(e){
                answer = confirm("Are you sure you want to feature this blog?");
                let btn = this
                if (answer) {

                    $.ajax({
                        url: '{{ route('admin-blogs-feature') }}',
                        type: 'POST',
                        data: {
                            id:$(this).data('id'),
                            _token:'{{ csrf_token() }}'
                        }
                    }).then(function(xhr){
                        // console.log(xhr);
                        if (xhr.success) {
                            btn.innerHTML = null
                            let icon = document.createElement('i')
                            icon.className = "fa fa-arrow-" + (xhr.featured ? 'down' : 'up')
                            btn.appendChild(icon)
                            let text = "  " + (xhr.featured ? 'Un-feature' : 'Feature')
                            btn.appendChild(document.createTextNode(text))
                            $.notify(
                                {
                                    message:xhr.message,
                                    icon: 'check_circle'
                                },
                                {
                                    type:'success'
                                }
                            );
                        } else {
                            $.notify(
                                {
                                    message:xhr.message,
                                    icon: 'not_interested'
                                },
                                {
                                    type:'danger'
                                }
                            );
                        }

                    });

                } else {
                    alert('Article publishing canceled by user');
                }

            })
        })

		$('#articlesDataTable').dataTable();

	});
	</script>
@endsection
