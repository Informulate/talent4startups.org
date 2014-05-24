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
				<li class="active"><a href="/">Home</a></li>
				<li><a href="#">Talents</a></li>
				<li><a href="#">Projects</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#contact">FAQ</a></li>
				<li><a href="#">Login</a></li>
				<li><button type="button" class="btn btn-primary navbar-btn">Sign Up</button></li>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</div>

<!-- Begin page content -->
<div class="container">
	<h1>Projects</h1>
	<div class="row" ng-controller="ProjectsController">
		<div ng-repeat="project in projects">
			<div class="col-xs-12 col-md-4">
				<div class="well">
					<h4>{{ project.name }} <br/><small>By: {{ project.owner.username }}</small></h4>
					<p>{{ project.description }}</p>
					<p><a class="btn btn-primary" href="#">Learn More</a></p>
				</div>
			</div>
			<div ng-if="$index % 3 == 2" class="clearfix"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<ul class="pager">
				<li class="previous"><a href="#">&larr; Previous</a></li>
				<li class="next"><a href="#">Next &rarr;</a></li>
			</ul>
		</div>
	</div>
</div>

<div id="footer">
	<div class="container">
		<p class="text-muted">Place sticky footer content here.</p>
	</div>
</div>

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
