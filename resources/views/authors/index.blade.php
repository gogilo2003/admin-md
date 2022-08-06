@extends('admin::layout.main')

@section('title')
    @parent
    Authors
@endsection

@section('page_title')
    <i class="fas fa-users"></i> Manage Authors
@endsection

@section('breadcrumbs')
    @parent
    <li class="active"><span><i class="fas fa-users"></i> Authors</span></li>
@endsection

@section('sidebar')
    @parent
    @include('admin::articles.sidebar')
@endsection

@section('content')
    <div id="authors_app"></div>
@endsection

@section('styles')
    <style type="text/css">

    </style>
@endsection

@section('scripts_bottom')
    <script type="text/javascript" src="{{ asset('vendor/admin/js/authors.js') }}"></script>
@endsection
