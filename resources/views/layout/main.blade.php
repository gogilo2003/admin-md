<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{!! asset(config('admin.path_prefix') . 'favicon.png') !!}">
    <link rel="icon" type="image/png" href="{!! asset(config('admin.path_prefix') . 'favicon.png') !!}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
    'baseUrl' => url('/'),
    'routes' => collect(\Route::getRoutes())->mapWithKeys(function ($route) {
        return [$route->getName() => $route->uri()];
    }),
]) !!};
    </script>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    @section('meta')
        <meta name="author" content="Georsamarts ICT Solutions">
        <meta name="description" content="Sites Description">
        <meta name="keywords" content="keywords separated by comma">
    @show
    @yield('meta-fb')
    @yield('meta-twitter')
    <title>@yield('title')</title>

    <!-- CSS Files -->
    <link
        href="{{ asset(config('admin.path_prefix') . 'vendor/admin/material-dashboard-master/assets/css/material-dashboard.css') }}"
        rel="stylesheet" />
    <link href="{{ asset(config('admin.path_prefix') . 'vendor/admin/css/admin.css') }}" rel="stylesheet" />

    @stack('styles')
    @yield('styles')
    @stack('scripts_top')
    @yield('scripts_top')

</head>

<body class="">

    <div class="wrapper " id="app">
        <div class="sidebar" data-color="purple" data-background-color="green"
            data-image="{{ asset(config('admin.path_prefix') . 'vendor/admin/material-dashboard-master/assets/img/sidebar-1.jpg') }}">
            <!-- Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
Tip 2: you can also add an image using data-image tag-->
            <div class="logo">
                <a href="{{ url('/') }}" class="simple-text logo-normal">
                    <img src="{!! file_exists(public_path('favicon.png')) ? asset(config('admin.path_prefix') . 'favicon.png') : (file_exists(public_path('logo.png')) ? asset(config('admin.path_prefix') . 'logo.png') : file_exists(public_path('images/favicon.png') ? url('images/favicon.png') : (file_exists('images/logo.png') ? url('images/logo.png') : ''))) !!}" alt="" class="img-fluid" style="max-width: 5em">
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    @section('sidebar')
                        @include('admin::layout.sidebar')
                    @show
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include('admin::layout.navbar')
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid" id="app">
                    @if (is_current_path('admin-dashboard') || is_current_path('admin-profile') || is_current_path('admin-login'))
                        @yield('content')
                    @else
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">@yield('title')</h4>
                                <p class="category">@yield('page_title')</p>
                            </div>
                            <div class="card-body @yield('content_classes')">
                                @yield('content')
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="float-left">
                        <ul>
                            <li>
                                <a href="https://www.micartech.co.ke" class="btn btn-round btn-fab btn-danger">
                                    <i class="material-icons">http</i>
                                </a>
                            </li>
                            <li>
                                <a href="https://wa.me/254735388704" class="btn btn-fab btn-success btn-round"
                                    target="_NEW">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://web.facebook.com/ogilogeorge"
                                    class="btn btn-fab btn-facebook btn-round" target="_NEW">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/GeorgeOgilo" class="btn btn-fab btn-twitter btn-round"
                                    target="_NEW">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.gogilo.com" class="btn btn-fab btn-danger btn-round" target="_NEW">
                                    <i class="fas fa-book"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright float-right">
                        &copy; {{ date('Y') }}, Themed by <a href="https://www.creative-tim.com"
                            target="_blank">Creative Tim</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script type="text/javascript">
        var contentCSS = "{{ config('admin.content_css') }}"
        let images_upload_url = '{{ route('admin-images_upload_url') }}'
    </script>
    <script type="text/javascript" src="{{ asset(config('admin.path_prefix') . 'vendor/admin/js/admin.js') }}"></script>
    @include('admin::inc.notify')
    @stack('body_scripts')
    @yield('scripts_bottom')
    @stack('scripts_bottom')
</body>

</html>
