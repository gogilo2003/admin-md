@extends('admin::layout.main')

@section('title')
	@parent
	Articles
@endsection

@section('page_title')
	<i class="fa fa-files-o"></i> Articles
@endsection

@section('breadcrumbs')
	@parent
	<li><a href="{{ route('admin-article_categories') }}"><i class="fa fa-list-alt"></i> Article Categories</a></li>
	<li class="active"><span><i class="fa fa-files-o"></i> Articles</span></li>
@endsection

@section('sidebar')
	@parent
	@include('admin::articles.sidebar')
@endsection

@section('content')
	<div>
	<a href="{{route('admin-articles-add')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp; New Article</a>
	<a href="{{route('admin-pages')}}" class="btn btn-primary btn-sm"><span class="fa fa-file-o"></span>&nbsp;&nbsp; Pages</a>
	</div>
	<hr>
	<table id="articlesDataTable" class="table table-hover table-striped">
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
			@foreach ($articles as $article)
			<tr>
				<td>{{ $article->id }}</td>
				<td>{{ $article->name }}</td>
				<td>{{ $article->title }}</td>
				<td>{{ $article->category ? $article->category->name : '&nbsp;' }}</td>
				<td>
					<div class="btn-group">
						<a href="{{route('admin-articles-edit', $article->id)}}" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>&nbsp;&nbsp; Edit</a>
						<a href="javascript:" data-id="{{ $article->id }}" class="btn btn-primary btn-sm publishArticle"><span class="fa fa-arrow-{{ $article->published ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $article->published ? 'Un-publish' : 'Publish' }}</a>
						<a href="javascript:" data-id="{{ $article->id }}" class="btn btn-primary btn-sm featureArticle"><span class="fa fa-arrow-{{ $article->featured ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $article->featured ? 'Un-feature' : 'Feature' }}</a>
						<a href="javascript:" data-id="{{ $article->id }}" class="btn btn-danger btn-sm deleteArticle"><span class="fa fa-remove"></span>&nbsp;&nbsp; Delete</a>
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
			answer = confirm("Are you sure you want to delete this article?");

			if (answer) {

				$.ajax({
					url: '{{ route('admin-articles-delete') }}',
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
					// window.location = '{{ route('admin-articles') }}';
				});

			} else {
				alert('Article deletion canceled by article');
			}

		});

		document.querySelectorAll('a.publishArticle').forEach(function(item){
            item.addEventListener('click',function(e){
                answer = confirm("Are you sure you want to publish this article?");
                let btn = this
                if (answer) {

                    $.ajax({
                        url: '{{ route('admin-articles-publish') }}',
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
                answer = confirm("Are you sure you want to feature this article?");
                let btn = this
                if (answer) {

                    $.ajax({
                        url: '{{ route('admin-articles-feature') }}',
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
