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
				<li><a href="/projects">Projects</a></li>
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
<!-- Carousel
	================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<div class="item active">
			<img src="/images/picjumbo.com_Smooth-Touch-Workspace.jpg" alt="First slide">
			<div class="container">
				<div class="carousel-caption">
					<h1>Example headline.</h1>
					<p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
					<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
				</div>
			</div>
		</div>
		<div class="item">
			<img src="/images/1ep0IRX.jpg" alt="Second slide">
			<div class="container">
				<div class="carousel-caption">
					<h1>Another example headline.</h1>
					<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
					<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
				</div>
			</div>
		</div>
		<div class="item">
			<img src="/images/picjumbo.com_IMG_4953.jpg" alt="Third slide">
			<div class="container">
				<div class="carousel-caption">
					<h1>One more for good measure.</h1>
					<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
					<p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
				</div>
			</div>
		</div>
	</div>
	<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div><!-- /.carousel -->
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h1 class="text-center">Build a team. Grow your startup.</h1>
			<h1 class="text-center"><small>Sub header section to reinforce the section title. Doesn’t have to be fancy. But should be relevant.</small></h1>
		</div>
	</div>
</div>
<div class="container-fluid students">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
			</div>
			<div class="col-sm-8">
				<h2>To the students, the professionals - The Doers</h2>
				<p>You know exactly what your career path should be. You are already doing the best you can to get trained and stay current but the opportunities to flex your muscles are hard to come by.</p>
				<p>Students cannot get placed because of lack of experience. Professionals looking to broaden their skill set, cannot leverage past, unrelated experience. We can help. From now on, let there be no limit to your career aspirations.</p>
				<p>Find the right projects to polish the specific skill you are looking for, bulk up your resume, and make real connections by delivering results. With each skill you acquire, with every level you attain... your ambitions get closer to reality.</p>
				<a class="btn btn-success" href="#">See Current Opportunities</a>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid creators">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<h2>To the startups, the entrepreneurs - The Creators</h2>
				<p>An idea is like a seed. It has great potential but needs many things to grow: funding (or management buy-in), talented resources, market timing, network, marketing etc.</p>
				<p>Many startups never take off because of a vicious cycle: you need something tangible to get funding, you need resources to build things, but its hard to get resources without the funding in the first place. T4S gives you that impetus to break the cycle.</p>
				<p>Use free resources to build out your concept, fine tune your strategy, test it in the market, and use real results to attract investment. Now you have no excuse. The universe awaits... Make that ripple!</p>
				<a class="btn btn-success" href="#">Launch your own Project</a>
			</div>
			<div class="col-sm-4">
				<img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="col-md-4" ng-controller="SkillsController">
		<h1>Skills</h1>
		<ul>
			<li ng-repeat="skill in skills">{{ skill.name }}</li>
		</ul>
	</div>
	<div class="col-md-4" ng-controller="UsersController">
		<h1>Users</h1>
		<ul>
			<li ng-repeat="user in users">{{ user.username }} {{ user.email }}</li>
		</ul>
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
