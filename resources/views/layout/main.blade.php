<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{!! url('public/favicon.png') !!}">
    <link rel="icon" type="image/png" href="{!! url('public/favicon.png') !!}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title')</title>
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
    <!--     Fonts and icons     -->
    <!--<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />-->
    <link rel="stylesheet" href="/public/vendor/admin/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/vendor/admin/material-design-icons/material-icons.css">
    <!-- CSS Files -->
    <!--<link rel="stylesheet" href="{{ url('public/vendor/admin/css/bootstrap-select.min.css') }}">-->
    <link href="/public/vendor/admin/material-dashboard-master/assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />

    <!--<link rel="stylesheet" href="{{ url('public/vendor/admin/css/bootstrap-datetimepicker.min.css') }}">-->
    <!--<link rel="stylesheet" href="{{ url('public/vendor/admin/css/file-input.css') }}">-->
    <link rel="stylesheet" href="{{ url('public/vendor/admin/iconmoon/linea-icon.css') }}">
    <link rel="stylesheet" href="{{ url('public/vendor/admin/cropper/cropper.min.css') }}">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <!--<link href="/public/vendor/admin/material-dashboard-master/assets/demo/demo.css" rel="stylesheet" />-->
    <script type="text/javascript" src="{{ url('public/vendor/admin/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('public/vendor/admin/js/tinymce.min.js') }}"></script>
    @yield('styles')
    @yield('scripts_top')
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="green" data-image="/public/vendor/admin/material-dashboard-master/assets/img/sidebar-1.jpg">
            <!-- Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
Tip 2: you can also add an image using data-image tag-->
            <div class="logo">
                <a href="{{ url('/') }}" class="simple-text logo-normal">
                    <img src="{!! file_exists(public_path('favicon.png')) ? url('public/favicon.png') : (file_exists(public_path('logo.png')) ? url('public/logo.png') : (file_exists(public_path('images/favicon.png') ? url('images/favicon.png') : (file_exists('images/logo.png') ? url('images/logo.png') : '')))) !!}" alt="" class="img-fluid" style="max-width: 5em">
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
                <div class="container-fluid">
                    @if (is_current_path('admin-dashboard') || is_current_path('admin-profile') || is_current_path('admin-login'))
                        @yield('content')
                    @else
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">@yield('title')</h4>
                                <p class="category">@yield('page_title')</p>
                            </div>
                            <div class="card-body">
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
                                <a href="https://www.gogilo.com" class="btn btn-round btn-fab btn-danger">
                                    <i class="material-icons">http</i>
                                </a>
                            </li>
                            <li>
                                <a href="https://wa.me/254735388704" class="btn btn-fab btn-success btn-round" target="_NEW">
                                    <i class="fa fa-whatsapp"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://web.facebook.com/ogilogeorge" class="btn btn-fab btn-facebook btn-round" target="_NEW">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/GeorgeOgilo" class="btn btn-fab btn-twitter btn-round" target="_NEW">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.gogilo.com" class="btn btn-fab btn-danger btn-round" target="_NEW">
                                    <i class="fa fa-book"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright float-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, Themed by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/core/jquery.min.js"></script>
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/core/popper.min.js"></script>
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Plugin for the momentJs  -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/moment.min.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/sweetalert2.js"></script>
    <!-- Forms Validations Plugin -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/jquery.validate.min.js"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/bootstrap-selectpicker.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/jquery.dataTables.min.js"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/bootstrap-tagsinput.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/jquery-jvectormap.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/nouislider.min.js"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>-->
    <!-- Library for adding dinamically elements -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/arrive.min.js"></script>
    <!--  Google Maps Plugin    -->
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
    <!-- Chartist JS -->
    <!--<script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/chartist.min.js"></script>-->
    <!--  Notifications Plugin    -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/public/vendor/admin/material-dashboard-master/assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
    <script type="text/javascript" src="{{ url('public/vendor/admin/js/main.js') }}"></script>
    <!--<script type="text/javascript" src="{{ url('public/vendor/admin/js/jquery.dataTables.min.js') }}"></script>-->
    <!--<script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap-notify.min.js') }}"></script>-->
    <!--<script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap-select.min.js') }}"></script>-->
    <!--<script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap.file-input.js') }}"></script>-->
    <script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <!--<script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap-datetimepicker.min.js') }}"></script>-->
    <script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap3-typeahead.min.js') }}"></script>
    <!--<script type="text/javascript" src="{{ url('public/vendor/admin/js/file-input.js') }}"></script>-->
    <script type="text/javascript" src="{{ url('public/vendor/admin/cropper/cropper.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            plugins: 'code link image lists table paste preview print anchor fullscreen',
            selector: ".tinymce",
            toolbar: 'styleselect | bold italic underline strikethrough removeformat | alignleft aligncenter alignright alignjustify lists | cut copy paste | bullist numlist | outdent indent blockquote | subscript superscript | undo redo | link unlink image table| code print preview fullscreen',
            menubar: false,
            allow_conditional_comments: false,
            content_css: '{{ config('admin.content_css') }}',
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ route('admin-images_upload_url') }}');

                xhr.onload = function () {
                    var json;

                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.location);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                formData.append('_token', '{{ csrf_token() }}');

                xhr.send(formData);
            }
        });

        // $('input[type=file]').bootstrapFileInput();

        @if(Session::has('global-info'))
        {!! "$.notify( { message: '".Session::get('global-info')."',icon: 'info_outline'}, {type: 'info'})" !!}
        @endif

        @if(Session::has('global-success'))
        {!! "$.notify( { message: '".Session::get('global-success')."',icon: 'check_circle'}, {type: 'success'})" !!}
        @endif

        @if(Session::has('global-warning'))
        {!! "$.notify( { message: '".Session::get('global-warning')."',icon: 'error_outline'}, {type: 'warning'})" !!}
        @endif

        @if(Session::has('global-danger'))
        {!! "$.notify( { message: '".Session::get('global-danger')."',icon: 'not_interested'}, {type: 'danger'})" !!}
        @endif

        $(document).ready(function () {
            $('.selectpicker').selectpicker({
                "style": "btn btn-link",
                "liveSearch": true,
                "size": 5
            });
            $('.navbar .dropdown-toggle').dropdownHover();

            let icons = {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }

            $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                sideBySide: true,
                icons
            });
            $('.timepicker').datetimepicker({
                locale: 'en',
                format: 'LT',
                icons
            });

            $(".datepicker").datetimepicker({
                format: 'YYYY-MM-DD',
                icons
            });

            $('.typeahead').typeahead()

            $('.datatable').dataTable();

        })
    </script>

    @yield('scripts_bottom')
</body>

</html>
