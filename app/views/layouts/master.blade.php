<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Starter Template for Bootstrap</title>

	<!-- Bootstrap core CSS -->
	<link href="/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="/css/site.css" rel="stylesheet">

	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]>
	<script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Talent4Startups</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li @if (Request::path() === '/') class="active" @endif><a href="/">Home</a></li>
				<li @if (Request::path() === 'talents') class="active" @endif><a href="#talents">Talents</a></li>
				<li @if (Request::path() === 'projects') class="active" @endif><a href="/projects">Projects</a></li>
				<li @if (Request::path() === 'about') class="active" @endif><a href="#about">About</a></li>
				<li @if (Request::path() === 'contact') class="active" @endif><a href="#contact">FAQ</a></li>
				@if (Auth::check())
					<li><a href="{{ URL::to('/logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout :: {{ Auth::user()->email }}</a></li>
				@else
					<li><a href="#" data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					<li><button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#signup"><span class="glyphicon glyphicon-cog"></span> Sign Up</button></li>
				@endif
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</div>

<!-- Begin page content -->
@yield('content')

<div id="footer">
	<div class="container">
		<p class="text-muted">Place sticky footer content here.</p>
	</div>
</div>

@if (! Auth::check())
<div id="login" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Login</h4>
			</div>
			<div class="modal-body">
				{{ Confide::makeLoginForm()->render() }}
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="signup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Login</h4>
			</div>
			<div class="modal-body">
				{{ Confide::makeSignupForm()->render() }}
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endif

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/angular.min.js"></script>
<script src="/js/main.js"></script>
<script src="/js/docs.min.js"></script>
</body>
</html>
