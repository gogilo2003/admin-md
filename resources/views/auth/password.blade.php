@extends('admin::layout.main')

@section('title')
    Change Password
@stop

@section('page_title')
    Change Password
@stop

@section('breadcrumbs')
    @parent
    <li class="active"><i class="fa fa-asterisk"></i> Password</li>
@stop

@section('toolbar')

@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-1 col-md-3 col-lg-3">

        </div>
        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
            <form class="well well-lg" method="post" action="{{ route('admin-password') }}" role="form"
                accept-charset="UTF-8" enctype="multipart/form-data">
                <div class="form-group{!! $errors->has('password') ? ' has-error' : '' !!}">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter password"{!! old('password') ? ' value="' . old('password') . '"' : '' !!}>
                    {!! $errors->has('password') ? '<span class="text-danger">' . $errors->first('password') . '</span>' : '' !!}
                </div>
                <div class="form-group{!! $errors->has('new_password') ? ' has-error' : '' !!}">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password"
                        placeholder="Enter new Password"{!! old('new_password') ? ' value="' . old('new_password') . '"' : '' !!}>
                    {!! $errors->has('new_password')
                        ? '<span class="text-danger">' . $errors->first('new_password') . '</span>'
                        : '' !!}
                </div>
                <div class="form-group{!! $errors->has('new_password_confirmation') ? ' has-error' : '' !!}">
                    <label for="new_password_confirmation">New Password Confirmation</label>
                    <input type="password" class="form-control" id="new_password_confirmation"
                        name="new_password_confirmation"
                        placeholder="Enter new Password Confirmation"{!! old('new_password_confirmation') ? ' value="' . old('new_password_confirmation') . '"' : '' !!}>
                    {!! $errors->has('new_password_confirmation')
                        ? '<span class="text-danger">' . $errors->first('new_password_confirmation') . '</span>'
                        : '' !!}
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary"><span class="fas fa-sync"></span> Change Password</button>
            </form>
        </div>
    </div>
@stop

@section('styles')
    <style type="text/css">

    </style>
@stop
@section('scripts_top')
    <script type="text/javascript"></script>
@stop

@section('scripts_bottom')
    <script type="text/javascript"></script>
@stop
