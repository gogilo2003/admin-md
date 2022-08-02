@extends('admin::layout.main')

@section('title')
    @parent
    Settings
@endsection

@section('page_title')
    <i class="fa fa-wrench"></i> Settings
@endsection

@section('breadcrumbs')
    @parent
    <li class="active"><span><i class="fa fa-wrench"></i> Settings</span></li>
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <form class="row" action="{{ route('admin-settings') }}" method="post">
        <div class="form-group col-md-6">
            <input {{ $articles ? 'checked' : '' }} type="checkbox" name="has_articles" id="has_articles">
            <label for="has_articles">Has Article</label>
        </div>
        <div class="form-group col-md-6">
            <input {{ $pictures ? 'checked' : '' }} type="checkbox" name="has_pictures" id="has_pictures">
            <label for="has_pictures">Has Pictures</label>
        </div>
        <div class="form-group col-md-6">
            <input {{ $videos ? 'checked' : '' }} type="checkbox" name="has_videos" id="has_videos">
            <label for="has_videos">Has Videos</label>
        </div>
        <div class="form-group col-md-6">
            <input {{ $files ? 'checked' : '' }} type="checkbox" name="has_files" id="has_files">
            <label for="has_files">Has Files</label>
        </div>
        <div class="form-group col-md-6">
            <input {{ $projects ? 'checked' : '' }} type="checkbox" name="has_projects" id="has_projects">
            <label for="has_projects">Has Projects</label>
        </div>
        <div class="form-group col-md-6">
            <input {{ $profiles ? 'checked' : '' }} type="checkbox" name="has_profiles" id="has_profiles">
            <label for="has_profiles">Has Profiles</label>
        </div>
        <div class="form-group col-md-6">
            <input {{ $sermons ? 'checked' : '' }} type="checkbox" name="has_sermons" id="has_sermons">
            <label for="has_sermons">Has Sermons</label>
        </div>
        <div class="form-group col-md-6">
            <input {{ $events ? 'checked' : '' }} type="checkbox" name="has_events" id="has_events">
            <label for="has_events">Has Events</label>
        </div>
        <div class="form-group col-md-6">
            <input {{ $packages ? 'checked' : '' }} type="checkbox" name="has_packages" id="has_packages">
            <label for="has_packages">Has Packages</label>
        </div>
        <!--
            <div class="form-group col-md-6">
       <input {{ $products ? 'checked' : '' }} type="checkbox" name="has_products" id="has_products">
            <label for="has_products">Has Products</label>
            </div>
        -->
        <div class="form-group col-md-12">
            <label for="email">Contact Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $contact }}">
        </div>
        <div class="form-group col-md-12">
            <label for="content_css">TinyMCE content_css</label>
            <input type="content_css" name="content_css" id="content_css" class="form-control" value="{{ $content_css }}">
        </div>
        {{ csrf_field() }}
        <div class="col-md-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>
@endsection

@section('styles')
    <style type="text/css">
        .form-group>label {
            cursor: pointer;
        }
    </style>
@endsection
