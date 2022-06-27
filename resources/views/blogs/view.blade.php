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
                @include('admin::blogs.inc.comment',['comment'=>$comment])
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModal" aria-hidden="true"
        data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="card">
                    {{-- <div class="modal-header card-header card-header-primary">
                        <h5 class="modal-title">Reply</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputReply">Reply</label>
                                <textarea class="form-control" id="inputReply" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-warning btn-round" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-round" id="replyButton">Reply</button>
                    </div>
                </div>
            </div>
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
                if (confirm("You are about to delete a comment. Are you sure?")) {
                    $.post('{{ route('api-admin-comments-delete') }}', {
                        id,
                        api_token: '{{ api_token() }}'
                    }).then(response => {
                        if (response.success) {
                            let card = document.getElementById('commentCard' + id)
                            card.remove()
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
                }
            })
        })

        let reply = {
            id: null,
            name: '{{ request()->user()->name }}',
            email: '{{ request()->user()->email }}',
            reply: null,
            api_token: '{{ api_token() }}',
            article_id: '{{ $blog->id }}'
        }

        $('#replyModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('comment_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            reply.id = id
            // modal.find('.modal-title').text('New message to ' + id)
            // modal.find('.modal-body span').val(id)
        })

        document.getElementById('replyButton').addEventListener('click', e => {
            reply.reply = document.getElementById('inputReply').value
            $.post('{{ route('api-admin-comments-reply') }}', reply).then(response => {
                if (response.success) {
                    // let card = document.getElementById('commentCard' + id)
                    
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
    </script>
@stop
