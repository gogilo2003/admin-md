<div class="be-comment">

    <div class="be-img-comment">
        <a href="#">
            <img src="{{ $comment->user->avatar }}" alt="" class="be-ava-comment">
        </a>
    </div>
    <div class="be-comment-content">

        <span class="be-comment-name">
            <a href="#">{{ $comment->user->name }}</a>
        </span>
        <span class="be-comment-time">
            <i class="fa fa-clock-o"></i>
            {{-- May 27, 2015 at 3:14am --}}
            {{ $comment->created_at->format('M j, Y \a\t g:ia') }}
        </span>

        <p class="be-comment-text">{{ $comment->message }}</p>

        @foreach ($comment->replies as $reply)
            @include('admin::web.inc.comment',['comment'=>$reply])
        @endforeach
    </div>
</div>