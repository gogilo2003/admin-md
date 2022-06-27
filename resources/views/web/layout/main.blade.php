<!doctype html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @section('meta')
        <meta name="author" content="Georsamarts ICT Solutions">
        <meta name="description" content="{{ str_words_alt($page->content, 160) }}">
        <meta name="keywords" content="keywords separated by comma">
        <title>{{ $page->title }}</title>
    @show

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{!! asset(config('admin.path_prefix') . 'favicon.png') !!}">

    <link href="{{ asset(config('admin.path_prefix') . 'vendor/admin/css/web.css') }}" rel="stylesheet">
    <link href="{{ asset(config('admin.path_prefix') . 'vendor/admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset(config('admin.path_prefix') . 'vendor/admin/material-design-icons/material-icons.css') }}"
        rel="stylesheet">
    <link href="{{ asset(config('admin.path_prefix') . 'vendor/admin/iconmoon/linea-icon.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>
    <!-- Custom styles for this template -->
    <!--<link href="carousel.css" rel="stylesheet">-->
    @stack('styles')
</head>

<body class="d-flex flex-column h-100">
    <div id="app">
        @include('admin::web.layout.navigation')

        @include('admin::web.inc.breadcrumbs')

        <main class="flex-shrink-0" role="main">

            @include('admin::web.inc.messages')
            @yield('content')

        </main>
        <!-- FOOTER -->
        <footer class="mt-auto py-5 bg-dark text-info">
            <div class="container">
                <p class="float-right"><a href="#">Back to top</a></p>
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}, Inc. &middot; <a href="#">Privacy</a> &middot;
                    <a href="#">Terms</a></p>
            </div>
        </footer>
    </div>

    <script src="{{ asset(config('admin.path_prefix') . 'vendor/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset(config('admin.path_prefix') . 'vendor/admin/js/bootstrap.min.js') }}"></script>
    
    @stack('scripts_bottom')
</body>

</html>
