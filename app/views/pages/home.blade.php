@extends('layouts.default')

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
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up for free</a></p>
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
			<div class="col-md-3 col-xs-6 thumb">
				@include('startups.thumb')
			</div>
		@endforeach()
		@foreach($talents as $index => $talent)
			<div class="col-md-3 col-xs-6 thumb">
				@include('talent.thumb')
			</div>
		@endforeach()
	</div>
	<div class="row feature">
		<div class="col-sm-10 col-sm-offset-2">
			<img src="https:////storage.googleapis.com/support-kms-prod/SNP_40CDC3FE322AB07CD3E5860E126FF906B05D_2922298_en_v3">
		</div>
	</div>
	@include('layouts.partials.socialshare')
@stop

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function () {
			$('.member-rating-view').rating({
				readonly: true,
				showClear: false,
				showCaption: false,
				hoverEnabled: false,
				size: 'xs'
			});
		});
	</script>
@stop
