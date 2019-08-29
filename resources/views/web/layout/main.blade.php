<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Georsamarts ICT Solutions">
        <meta name="description" content="Sites Description">
        <meta name="keywords" content="keywords separated by comma">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="{!! url('public/favicon.png') !!}">

        <title>{{ $page->title }}</title>

        <link href="{{ asset('public/vendor/admin/css/web.css') }}" rel="stylesheet">

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
    </head>

    <body>
        <header>
            @include('admin::web.layout.navigation')
        </header>

        <main role="main">

            @yield('content')

            <!-- FOOTER -->
            <footer class="py-5 bg-dark text-info">
                <div class="container">
                    <p class="float-right"><a href="#">Back to top</a></p>
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
                </div>
            </footer>
        </main>
        <script src="{{ url('public/vendor/admin/js/jquery.min.js') }}"></script>
        <script src="{{ url('public/vendor/admin/js/bootstrap.min.js') }}"></script>
    </body>

</html>
