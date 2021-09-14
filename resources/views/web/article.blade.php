@extends('admin::web.layout.main')

@section('title')
    {{ $page->title }}
@endsection

@section('breadcrumbs')
    @if ($page->name === 'home')
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
    @else
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url($page->name) }}">{{ $page->title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
    @endif

@endsection

@section('content')
    <section class="mt-5 py-5 clearfix">

        @dump($article->author)
        <div class="container">
            <h3 class="text-center text-uppercase">{{ $article->title }}<br><small>{{ $article->author ? $article->author->name : '' }}</small></h3>
            <img class="mr-5 mb-5 w-50 float-md-left" src="{{ $article->picture->url }}" alt="">
            {!! $article->content !!}
            @if ($article->category->name == 'blog' or $article->category->name == 'blogs')
                <div class="be-comment-block">
                    <form class="form-block" method="POST" action="{{ route('post-comment') }}">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group fl_icon">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <input class="form-input" type="text" placeholder="Your name" name="name">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 fl_icon">
                                <div class="form-group fl_icon">
                                    <div class="icon"><i class="fa fa-envelope-o"></i></div>
                                    <input class="form-input" type="text" placeholder="Your email" name="email">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <textarea class="form-input" required="" placeholder="Your text" rows="3"
                                        name="message"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                @csrf
                                <button class="btn btn-primary pull-right">submit</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <h1 class="comments-title">Comments ({{ $article->comments->count() }})</h1>
                    <hr>
                    @foreach ($article->comments as $comment)
                        @include('admin::web.inc.comment',['comment'=>$comment])
                    @endforeach

                </div>
            @endif
        </div>
    </section>

@endsection


@push('styles')
    <style>
        /* body {
                            margin-top: 20px;
                            background-color: #e9ebee;
                        } */

        .be-comment-block {
            margin-bottom: 50px !important;
            border: 1px solid #edeff2;
            border-radius: 2px;
            padding: 50px 70px;
            border: 1px solid #ffffff;
            background-color: #e9ebee;
        }

        .comments-title {
            font-size: 16px;
            color: #262626;
            margin-bottom: 15px;
            font-family: 'Conv_helveticaneuecyr-bold';
        }

        .be-img-comment {
            width: 60px;
            height: 60px;
            float: left;
            margin-bottom: 15px;
        }

        .be-ava-comment {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .be-comment-content {
            margin-left: 80px;
        }

        .be-comment-content span {
            display: inline-block;
            width: 49%;
            margin-bottom: 15px;
        }

        .be-comment-name {
            font-size: 13px;
            font-family: 'Conv_helveticaneuecyr-bold';
        }

        .be-comment-content a {
            color: #383b43;
        }

        .be-comment-content span {
            display: inline-block;
            width: 49%;
            margin-bottom: 15px;
        }

        .be-comment-time {
            text-align: right;
        }

        .be-comment-time {
            font-size: 11px;
            color: #b4b7c1;
        }

        .be-comment-text {
            font-size: 13px;
            line-height: 18px;
            color: #7a8192;
            display: block;
            background: #f6f6f7;
            border: 1px solid #edeff2;
            padding: 15px 20px 20px 20px;
        }

        .form-group.fl_icon .icon {
            position: absolute;
            top: 1px;
            left: 16px;
            width: 48px;
            height: 48px;
            background: #f6f6f7;
            color: #b5b8c2;
            text-align: center;
            line-height: 50px;
            -webkit-border-top-left-radius: 2px;
            -webkit-border-bottom-left-radius: 2px;
            -moz-border-radius-topleft: 2px;
            -moz-border-radius-bottomleft: 2px;
            border-top-left-radius: 2px;
            border-bottom-left-radius: 2px;
        }

        .form-group .form-input {
            font-size: 13px;
            /* line-height: 50px; */
            font-weight: 400;
            color: #b4b7c1;
            width: 100%;
            height: 50px;
            padding-left: 20px;
            padding-right: 20px;
            border: 1px solid #edeff2;
            border-radius: 3px;
        }

        .form-group.fl_icon .form-input {
            padding-left: 70px;
        }

        .form-group textarea.form-input {
            height: auto;
            width: 100%;
            padding: 10px 20px;
        }

    </style>
@endpush

@section('scripts_top')
    <script type="text/javascript">

    </script>
@endsection

@section('scripts_bottom')
    <script type="text/javascript">

    </script>
@endsection
