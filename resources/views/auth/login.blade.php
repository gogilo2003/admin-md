@extends('admin::layout.main')

@section('title')
    Login
@stop

@section('page_title')
    Login
@stop

@section('breadcrumbs')
    <li class="active"><span><i class="fa fa-sign-in"></i>&nbsp;Login</span></li>
@stop

@section('sidebar')

@stop

@section('content')
    <div class="loader-wrap">
        <div class="loader">
            <img src="{{ asset('images/loader.gif') }}" alt="">
        </div>
    </div>
    <div class="row" style="min-height: 50vh; display: flex; justify-content: center; align-items: center">
        <div class="col-sm-6 col-md-6 col-lg-6">
            <form id="loginForm" method="post" action="{{ route('admin-login') }}" role="form" accept-charset="UTF-8"
                enctype="multipart/form-data"
                style="padding: 2rem; box-shadow: 0 0 5px rgba(0,0,0,0.35); border-radius: 1rem">
                <div class="form-group{!! $errors->has('email') ? ' has-error' : '' !!}">
                    <input type="text" class="form-control" id="emailInput" name="email"
                        placeholder="Enter email"{!! old('email') ? ' value="' . old('email') . '"' : '' !!}>
                    {!! $errors->has('email') ? '<span class="text-danger">' . $errors->first('email') . '</span>' : '' !!}
                </div>
                <div class="form-group{!! $errors->has('password') ? ' has-error' : '' !!}">
                    <input type="password" class="form-control" id="passwordInput" name="password"
                        placeholder="Enter password"{!! old('password') ? ' value="' . old('password') . '"' : '' !!}>
                    {!! $errors->has('password') ? '<span class="text-danger">' . $errors->first('password') . '</span>' : '' !!}
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button id="loginButton" type="submit" class="btn btn-primary btn-round"><span
                        class="fa fa-sign-in"></span>
                    Login</button>
            </form>
        </div>
    </div>
@stop

@section('styles')
    <style type="text/css">
        .loader-wrap {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.75);
            z-index: 1030;
            display: none;
            justify-content: center;
            align-items: center;
        }

        .loader-wrap .loader {
            color: #333;
            text-align: center;
            height: 128px;
            width: 128px;
            /* background-color: #fff; */
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%
        }

        .loader-wrap .loader img {
            width: 100%;
        }
    </style>
@stop

@section('scripts_top')
    <script type="text/javascript"></script>
@stop

@push('scripts_bottom')
    <script type="text/javascript">
        var loginButton = document.getElementById('loginButton')
        var loginForm = document.getElementById('loginForm')
        var emailInput = document.getElementById('emailInput')
        var passwordInput = document.getElementById('passwordInput')
        var loader = document.querySelector('.loader-wrap')

        loginButton.addEventListener('click', function(e) {
            e.preventDefault();
            loader.style.display = 'flex'

            axios.get('/sanctum/csrf-cookie').then(response => {
                // Login...
                axios.post('/admin/login', {
                    email: emailInput.value,
                    password: passwordInput.value
                }).then(response => {
                    loader.style.display = 'none'
                    window.location = "/admin"
                }).catch(error => {
                    console.log(error);
                    loader.style.display = 'none'
                })
            });
        })
    </script>
@endpush
