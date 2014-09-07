<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
		<link href="/css/vendors/glyphicons/glyphicons.css" rel="stylesheet">
		<link href="/css/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
		<link href="/css/main.css" rel="stylesheet">
	</head>
	<body>

		@include('layouts.partials.nav')

		@yield('wide-content')

		<div class="container-fluid">
			@include('flash::message')

			@yield('content')
		</div>

		<script src="/js/vendors/jquery/jquery-2.1.1.min.js"></script>
		<script src="/js/vendors/bootstrap/bootstrap.min.js"></script>
		<script src="/js/vendors/modernizr/modernizr.js"></script>
		<script src="/js/vendors/holder/docs.min.js"></script>

		@yield('javascript')

		@include('layouts.partials.modal.forms')

	</body>
</html>
