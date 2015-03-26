@extends('app')

@section('wide-content')
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<div align="center" class="embed-responsive embed-responsive-16by9">
					<video id="videos" autoplay="autoplay" loop="loop" class="embed-responsive-item">
						<source id="ss" src=<?php echo URL::asset('videos/clip.mp4') ?> type="video/mp4">
					</video>
				</div>
				<div class="container">
					<div class="carousel-caption">
						<h1>Join the community. We do better, together!</h1>
						<p id="sub-caption">Are you ready to take control?</p>
						<p><a class="btn btn-lg btn-primary signup-link" href="#" role="button">Sign up for free</a></p>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.carousel -->
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<h1 class="text-center">Grow your startup. Join a team.</h1>
		</div>
	</div>
	<div class="row">
		@foreach($startups as $index => $startup)
			<div class="col-md-3 col-xs-12 thumb">
				@include('startups.thumb')
			</div>
		@endforeach()
		@foreach($talents as $index => $talent)
			<div class="col-md-3 col-xs-12 thumb">
				@include('talent.thumb')
			</div>
		@endforeach()
	</div>
	@include('layouts.partials.socialshare')
@endsection
