@extends('admin::layout.main')

@section('title')
    @parent
    Setup
@endsection

@section('page_title')
    <i class="fa fa-cogs"></i> Applicattion Setup utilities
@endsection

@section('breadcrumbs')
    @parent
    <li class="active"><span><i class="fa fa-files-o"></i> Setup</span></li>
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <div>
        <a href="#" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#migrateDialog"><span class="fa fa-cogs"></span>&nbsp;&nbsp; Run Migration</a>
        <a href="#" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#sitemapDialog"><span class="fa fa-cogs"></span>&nbsp;&nbsp; Generate Sitemap</a>
    </div>
    <hr>
    <div id="setup_results"></div>
    @include('admin::setup.migrate')
    @include('admin::setup.sitemap')
@endsection

