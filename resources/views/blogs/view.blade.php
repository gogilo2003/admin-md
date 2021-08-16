@extends('admin::layout.main')

@section('title')
    View Post
@stop

@section('page_title')
    <i class="fa fa-pencil"></i> {{ $blog->title }}
@stop

@section('breadcrumbs')
    @parent
    <li>
        <a href="{{ route('admin-blogs') }}"><i class="fa fa-files-o"></i> Blog</a>
    </li>
    <li class="active"><span><i class="fa fa-pencil"></i> Edit Blog ({{ $blog->title }})</span></li>
@stop

@section('sidebar')
    @parent
    @include('admin::blogs.sidebar')
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $blog->picture->original }}" alt="" style="width: 100%">
        </div>
        <div class="col-md-8">
            <p>{{ str_words($blog->content, 120) }}</p>
        </div>
        <div class="col-md-12">
            <hr>
            <h3 class="text-uppercase">Comments</h3>
            @foreach ($blog->comments as $comment)
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-uppercase">{{ $comment->name }}</h4>
                        <p class="category mb-2 text-muted">({{ $comment->email }})</p>

                        <p class="card-text">{{ $comment->message }}</p>

                        <button class="btn btn-primary btn-round btn-sm approveButton"
                            comment_id="{{ $comment->id }}">{{ $comment->published ? 'Disapprove' : 'Approve' }}</button>
                        <button class="btn btn-primary btn-round btn-sm replyButton"
                            comment_id="{{ $comment->id }}">Reply</button>
                        <button class="btn btn-primary btn-round btn-sm deleteButton"
                            comment_id="{{ $comment->id }}">Delete</button>
                    </div>
                </div>
            @endforeach
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
    <script>
        document.querySelectorAll('.approveButton').forEach(approve => {
            approve.addEventListener('click', e => {
                let button = e.target;
                let id = button.getAttribute('comment_id')
                $.post('{{ route('api-admin-comments-approve') }}', {
                    id,
                    api_token: '{{ api_token() }}'
                }).then(response => {
                    if (response.success) {
                        if (response.comment.published) {
                            button.innerHTML = 'Disapprove'
                        } else {
                            button.innerHTML = 'Approve'
                        }

                        $.notify({
                            message: response.message,
                            icon: 'check_circle'
                        }, {
                            type: 'success'
                        });
                    } else {
                        $.notify({
                            message: response.message,
                            icon: 'check_circle'
                        }, {
                            type: 'danger'
                        });
                    }
                })
            })
        })
        document.querySelectorAll('.deleteButton').forEach(item => {
            item.addEventListener('click', e => {
                let button = e.target;
                let id = button.getAttribute('comment_id')
                $.post('{{ route('api-admin-comments-delete') }}', {
                    id,
                    api_token: '{{ api_token() }}'
                }).then(response => {
                    if (response.success) {
                        
                        $.notify({
                            message: response.message,
                            icon: 'check_circle'
                        }, {
                            type: 'success'
                        });
                    } else {
                        $.notify({
                            message: response.message,
                            icon: 'check_circle'
                        }, {
                            type: 'danger'
                        });
                    }
                })
            })
        })
    </script>
@stop
