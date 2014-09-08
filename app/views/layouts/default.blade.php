<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
		<link href="{{{ asset( 'css/vendors/bootstrap/bootstrap.min.css' ) }}}" rel="stylesheet">
		<link href="{{{ asset( 'css/main.css' ) }}}" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>

		@include('layouts.partials.nav')

		@yield('wide-content')

		<div class="container">
			@include('flash::message')

			@yield('content')
		</div>

		<script src="{{{ asset( 'js/vendors/jquery/jquery-2.1.1.min.js' ) }}}"></script>
		<script src="{{{ asset( 'js/vendors/bootstrap/bootstrap.min.js' ) }}}"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/jquery.colorbox-min.js"></script>
		<script src="{{{ asset( 'js/vendors/holder/docs.min.js' ) }}}"></script>
		<script src="{{{ asset( 'js/script.js' ) }}}"></script>

		@yield('javascript')

		@include('layouts.partials.modal.forms')

	</body>
</html>
