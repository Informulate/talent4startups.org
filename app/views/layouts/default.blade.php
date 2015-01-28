<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>{{ isset($pageTitle) ? $pageTitle : 'Talent4Startups' }}</title>
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

			@if(Route::current()->getName() == 'home')
				<div class="row">
					<div class="col-sm-12">
						@yield('content')
					</div>
				</div>
			@else
				<div class="row">
					<div class="col-sm-9">
						@yield('content')
					</div>
					<div class="col-sm-3">
						@include('layouts.partials.adsense-right')
					</div>
				</div>
			@endif



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
