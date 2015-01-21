<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
		<link href="{{{ asset( 'css/vendors/glyphicons/glyphicons.css' ) }}}" rel="stylesheet">
		<link href="{{{ asset( 'css/vendors/glyphicons/social.css' ) }}}" rel="stylesheet">
		<link href="{{{ asset( 'css/vendors/bootstrap/bootstrap.min.css' ) }}}" rel="stylesheet">
        <link href="{{{ asset( 'css/vendors/star-rating/star-rating.min.css' ) }}}" rel="stylesheet">
        <link href="{{{ asset( 'css/main.css' ) }}}" rel="stylesheet">
		@yield('css')
	</head>
	<body>

		@include('layouts.partials.nav')

		@yield('wide-content')

		<div id="main-container" class="container">
			@include('flash::message')

			@yield('content')
		</div>

		<script src="{{{ asset( 'js/vendors/jquery/jquery-2.1.1.min.js' ) }}}"></script>
		<script src="{{{ asset( 'js/vendors/bootstrap/bootstrap.min.js' ) }}}"></script>
		<script src="{{{ asset('/js/vendors/modernizr/modernizr.js' ) }}}"></script>
		<script src="{{{ asset( 'js/vendors/holder/docs.min.js' ) }}}"></script>
        <script src="{{{ asset( 'js/vendors/star-rating/star-rating.min.js' ) }}}"></script>
        <script src="{{{ asset( 'js/script.js' ) }}}"></script>
        @yield('javascript')

		@include('layouts.partials.modal.forms')

		@include('layouts.partials.footer')
	
	</body>
</html>
