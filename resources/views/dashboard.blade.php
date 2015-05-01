@extends('app')

@section('content')
	<header class="header">
		<div class="container">
			<img class="profile-image img-responsive img-circle img-thumbnail pull-left" src="{{{ Auth::user()->avatar() }}}?s=180&d=mm" width="180" height="180" alt="{{ Auth::user()->profile->first_name }} {{ Auth::user()->profile->last_name }}">
			<div class="profile-content pull-left">
				<h1 class="name">{{ Auth::user()->profile->first_name }} {{ Auth::user()->profile->last_name }}</h1>
				<h2 class="desc">{{ Auth::user()->profile->skill->name }}</h2>
				<ul class="social list-inline">
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
					<li class="last-item"><a href="#"><i class="fa fa-youtube"></i></a></li>
				</ul>
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
						60%
					</div>
				</div>
			</div><!--//profile-->
		</div><!--//container-->
	</header><!--//header-->
@endsection
