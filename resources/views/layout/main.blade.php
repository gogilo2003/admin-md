<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		@section('meta')
		<meta name="author" content="Georsamarts ICT Solutions">
		<meta name="description" content="Sites Description">
		<meta name="keywords" content="keywords separated by comma">
		@show
		@yield('meta-fb')
		@yield('meta-twitter')
		<title>@yield('title')</title>
		<link rel="icon" type="image/png" href="{!! url('public/favicon.png') !!}">

		<!-- CSS -->
		<link href="{{ url('public/vendor/admin/css/style.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ url('public/vendor/admin/css/jquery.dataTables.min.css') }}">
	<!--<link rel="stylesheet" href="{{ url('public/vendor/admin/css/dataTables.bootstrap.min.css') }}">-->
		<link rel="stylesheet" href="{{ url('public/vendor/admin/css/bootstrap-select.min.css') }}">
		<link rel="stylesheet" href="{{ url('public/vendor/admin/css/bootstrap-datetimepicker.min.css') }}">
		<link rel="stylesheet" href="{{ url('public/vendor/admin/css/file-input.css') }}">
		<link rel="stylesheet" href="{{ url('public/vendor/admin/iconmoon/linea-icon.css') }}">
		
		@yield('styles')
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/moment.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/tinymce.min.js') }}"></script>
		{{-- <script type="text/javascript" src="{{ url('public/vendor/admin/js/ckeditor/ckeditor.js') }}"></script> --}}
		
		@yield('scripts_top')

	</head>
	<body>
		@include('admin::layout.navbar')
		<div class="container">
			
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ol class="breadcrumb breadcrumb-arrow" style="margin-top: 5px">
						@section('breadcrumbs')
						<li>
							<a href="{{ route('admin-dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
						</li>
						@show
					</ol>
				</div>
				
				@if(is_current_path('admin-login'))
				<div class="col-sm-12 col-md-12 col-lg-12">
					@yield('content')
				</div>
				@else
				<div class="col-sm-3 col-md-3 col-lg-3">

					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">@yield('page_title')</h3>
						</div>
						<div class="list-group">
							@section('sidebar')
							@include('admin::layout.sidebar')
							@show
						</div>
					</div>
						
				</div>
				<div class="col-sm-9 col-md-9 col-lg-9">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h1 class="panel-title">@yield('page_title')</h1>
						</div>
						<div class="panel-body">
							@yield('content')
						</div>

					</div>
				</div>
				@endif
			</div>
			<hr>
		</div>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/main.js') }}"></script>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/jquery.dataTables.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap-notify.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap-select.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap.file-input.js') }}"></script>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap-hover-dropdown.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap-datetimepicker.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/bootstrap3-typeahead.min.js') }}"></script>
		<script type="text/javascript" src="{{ url('public/vendor/admin/js/file-input.js') }}"></script>
		<script type="text/javascript">
		tinymce.init({
			plugins: 'code link image lists table paste preview print anchor fullscreen',
		    selector: ".tinymce",
		    toolbar:'styleselect | bold italic underline strikethrough removeformat | alignleft aligncenter alignright alignjustify lists | cut copy paste | bullist numlist | outdent indent blockquote | subscript superscript | undo redo | link unlink image table| code print preview fullscreen',
		    menubar: false,
			allow_conditional_comments: false,
			content_css: '{{ config('admin.content_css') }}',
			images_upload_handler: function (blobInfo, success, failure) {
				var xhr, formData;

				xhr = new XMLHttpRequest();
				xhr.withCredentials = false;
				xhr.open('POST', '{{ route('admin-images_upload_url') }}');

				xhr.onload = function() {
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
				formData.append('_token','{{ csrf_token() }}');

				xhr.send(formData);
			}
		});

		$('input[type=file]').bootstrapFileInput();

		@if(Session::has('global-info'))
            {!! "$.notify(
                            {
                                message:'".Session::get('global-info')."',
                                icon: 'fa fa-info-circle'
                            },
                            {
                                type:'info'
                            }
                        )" 
            !!}
        @endif

        @if(Session::has('global-success'))
            {!! "$.notify(
                            {
                                message:'".Session::get('global-success')."',
                                icon: 'fa fa-check-circle'
                            },
                            {
                                type:'success'
                            }
                        )" 
            !!}
        @endif

        @if(Session::has('global-warning'))
            {!! "$.notify(
                            {
                                message:'".Session::get('global-warning')."',
                                icon: 'fa fa-exclamation-circle'
                            },
                            {
                                type:'warning'
                            }
                        )" 
            !!}
        @endif

        @if(Session::has('global-danger'))
            {!! "$.notify(
                            {
                                message:'".Session::get('global-danger')."',
                                icon: 'fa fa-ban'
                            },
                            {
                                type:'danger'
                            }
                        )" 
            !!}
        @endif

        $(document).ready(function(){
        	// $('select').selectpicker();
	        $('.navbar .dropdown-toggle').dropdownHover();
	        $('.datetimepicker').datetimepicker({
	                    format: 'YYYY-MM-DD HH:mm:ss',
	                    sideBySide: true
	                });
	        $('.timepicker').datetimepicker({
	                    locale: 'en',
	                    format: 'LT'
	                });

	        $('.typeahead').typeahead()

	        $(".datepicker").datetimepicker({
				format: 'YYYY-MM-DD'
			});
        })
	        
		
		</script>
		@yield('scripts_bottom')
	</body>
</html>