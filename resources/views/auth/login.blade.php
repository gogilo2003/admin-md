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
    <div class="loader-body" v-show="show">
        <div class="center">
            <div class="ring"></div>
            <span>loading...</span>
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
        .loader-body {
            margin: 0;
            padding: 0;
            font-family: montserrat;
            background: rgba(0, 0, 0, 0.75);
            display: block;
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: none;
        }

        .loader-body .center {
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .loader-body .center .ring {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            animation: ring 2s linear infinite;

        }

        .loader-body .center .ring::before {
            position: absolute;
            content: '';
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
        }


        .loader-body .center span {
            color: #737373;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 200px;
            font-weight: 600 !important;
            animation: text 3s ease-in-out infinite;
        }

        @keyframes ring {
            0% {
                transform: rotate(0deg);
                box-shadow: 1px 5px 2px #e62300;
            }

            50% {
                transform: rotate(180deg);
                box-shadow: 1px 5px 2px #7cb342;
            }

            100% {
                transform: rotate(360deg);
                box-shadow: 1px 5px 2px #0456C8;
            }
        }

        @keyframes text {
            50% {
                color: rgba(0, 0, 0, 0.75);
            }
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
        var loader = document.querySelector('.loader-body')

        loginButton.addEventListener('click', function(e) {
            e.preventDefault();
            loader.style.display = 'block'

            axios.get('/sanctum/csrf-cookie').then(response => {
                // Login...
                axios.post('/admin/login', {
                    email: emailInput.value,
                    password: passwordInput.value,
                    _token: "{{ csrf_token() }}"
                }).then(response => {
                    loader.style.display = 'none'
                    localStorage.setItem('admin_access_token', response.data.token)
                    window.location = "/admin"
                }).catch(error => {
                    console.log(error);
                    loader.style.display = 'none'
                })
            });
        })
    </script>
@endpush
