@extends('admin::layout.main')

@section('title')
    @parent
    Tags
@endsection

@section('page_title')
    <i class="fas fa-tags"></i> Tags
@endsection

@section('breadcrumbs')
    @parent
    <li class="active"><span><i class="fas fa-tags"></i> Tags</span></li>
@endsection

@section('sidebar')
    @parent
    @include('admin::articles.sidebar')
@endsection

@section('content')
    <div id="tags_app"></div>
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/admin/css/tailwind.css">
    <style type="text/css">

    </style>
@endsection

@section('scripts_bottom')
    <script type="text/javascript" src="{{ asset('vendor/admin/js/tags.js') }}"></script>
@endsection
