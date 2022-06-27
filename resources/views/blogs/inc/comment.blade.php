<div class="card" id="commentCard{{ $comment->id }}">
    <div class="card-body">
        <h4 class="card-title text-uppercase">{{ $comment->user->name }}</h4>
        <p class="category mb-2 text-muted">({{ $comment->user->email }}) - {!! $comment->created_at->format('j\<\s\u\p\>S\<\/\s\u\p\> F, Y g:i a') !!}</p>

        <p class="card-text">{{ $comment->message }}</p>

        @if ($comment->replies)
            <div class="card">
                @foreach ($comment->replies as $reply)
                    @include('admin::blogs.inc.comment',['comment'=>$reply])
                @endforeach
            </div>
        @endif
        <div class="card-footer">
            <div>
                <button class="btn btn-primary btn-round btn-sm approveButton"
                    comment_id="{{ $comment->id }}">{{ $comment->published ? 'Disapprove' : 'Approve' }}</button>
                <button class="btn btn-primary btn-round btn-sm replyButton" data-comment_id="{{ $comment->id }}"
                    data-toggle="modal" data-target="#replyModal">Reply</button>
                <button class="btn btn-primary btn-round btn-sm deleteButton"
                    comment_id="{{ $comment->id }}">Delete</button>
            </div>
        </div>

    </div>

</div>
