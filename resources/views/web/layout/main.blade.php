<!DOCTYPE html>
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

		<!-- Bootstrap -->
		<link href="{{ url('public/vendor/admin/css/web.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ url('public/vendor/admin/iconmoon/linea-icon.css') }}">
		<link rel="stylesheet" href="/public/vendor/admin/material-design-icons/material-icons.css">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
			.img-responsive{
				width: 100%;
			}
		</style>
	</head>
	<body style="padding-top: 70px">
		@include('admin::web.layout.navigation')

		<div>
			@yield('content')
		</div>
		<div id="footer">
			<div class="container">
				<hr>
				<div class="row">
					<div class="col-md-4 col-lg-4">
						<p>Catch me on <a href="https://www.facebook.com/GeorgeOgilo">Facebook</a>, <a href="https//www.twitter.com/GeorgeOgilo">Twitter</a></p>
					</div>
					<div class="col-md-4 col-lg-4">
						<p>&copy; George Ogilo {{ date('Y') }}</p>
					</div>
					<div class="col-md-4 col-lg-4">
						{!! get_hits(true) !!}
					</div>
				</div>
			</div>
		</div>
		

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="{{ url('public/vendor/admin/js/jquery.min.js') }}"></script>
		<script src="{{ url('public/vendor/admin/js/bootstrap.min.js') }}"></script>
	</body>
</html>