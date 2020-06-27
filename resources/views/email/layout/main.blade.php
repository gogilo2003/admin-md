<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ config('app.name') }}</title>
	@php
		print(file_get_contents(public_path('vendor/admin/css/email.css')));
	@endphp
</head>
<body>
	<div class="container">
		
	</div>
</body>
</html>