@extends('layouts.default')

@section('wide-content')
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<img src="{{{ asset( 'images/picjumbo.com_Smooth-Touch-Workspace.jpg' ) }}}" alt="First slide">
				<div class="container">
					<div class="carousel-caption">
						<h1>Example headline.</h1>
						<p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.carousel -->
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<h1 class="text-center">Build a team. Grow your startup.</h1>
			<h1 class="text-center"><small>Sub header section to reinforce the section title. Doesn’t have to be fancy. But should be relevant.</small></h1>
		</div>
	</div>
	<div class="row feature">
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
	<div class="row feature">
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
@stop
