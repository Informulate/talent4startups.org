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
	<div class="col-lg-6">
		@foreach($startups as $index => $startup)
			@if ($index % 2 === 0 and $index > 0)
				<div class="col-sm-6 col-md-4 col-lg-4 adsense">
					<div class="thumbnail startups">
						<img class="center-block img-responsive" src="https://storage.googleapis.com/support-kms-prod/SNP_2922332_en_v0">
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 adsense">
					<div class="thumbnail startups">
						<img class="center-block img-responsive" src="https://storage.googleapis.com/support-kms-prod/SNP_2922332_en_v0">
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 adsense">
					<div class="thumbnail startups">
						<img class="center-block img-responsive" src="https://storage.googleapis.com/support-kms-prod/SNP_2922332_en_v0">
					</div>
				</div>
			@endif
			<div class="clearfix">
				<div class="thumbnail startups">
					<img data-src="holder.js/300x300" alt="...">
					<div class="caption">
						<h3>{{ $startup->name }} <br/><small>By: {{ $startup->owner->profile->first_name }} {{ $startup->owner->profile->last_name }}</small></h3>
						<h6><i class="glyphicons glyphicons-google-maps"></i>Orlando, FL.</h6>
						<p>Startup Needs: @foreach($startup->needs as $need ) {{ $need->quantity }} {{ $need->skill->name }} @endforeach</p>
						<p>{{ Str::limit( $startup->description, 50 ) }}</p>
						<p><a href="{{ route('startups.show', $startup->url) }}" class="btn btn-primary pull-right learn-more" role="button">Learn More</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		@endforeach()
	</div>
	<div class="col-lg-6">
		@foreach($talents as $index => $talent)
			@if ($index % 2 === 0 and $index > 0)
				<div class="col-sm-6 col-md-4 col-lg-4 adsense">
					<div class="thumbnail startups">
						<img class="center-block img-responsive" src="https://storage.googleapis.com/support-kms-prod/SNP_2922332_en_v0">
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 adsense">
					<div class="thumbnail startups">
						<img class="center-block img-responsive" src="https://storage.googleapis.com/support-kms-prod/SNP_2922332_en_v0">
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 adsense">
					<div class="thumbnail startups">
						<img class="center-block img-responsive" src="https://storage.googleapis.com/support-kms-prod/SNP_2922332_en_v0">
					</div>
				</div>
			@endif
			<div class="thumb clearfix">
				<div class="thumbnail">
					<img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $talent->email ) ) ) ?>?s=300&d=wavatar">
					<input data-id="{{ $talent->id }}" type="number" class="member-rating-view" value="{{ $talent->rating() }}" }}>
					<div class="caption">
						<h3><a href="{{ route('profile_path', $talent->username) }}">{{ $talent->profile->first_name }} {{ $talent->profile->last_name }}</a></h3>
						<h6><i class="glyphicons glyphicons-google-maps"></i>{{ $talent->profile->location }}</h6>
						<p>{{ $talent->profile->skill->name }}</p>
						<p>{{ Str::limit($talent->profile->about, 160) }}</p>
						<p><i class="glyphicon glyphicon-tags"></i>
							@foreach($talent->profile->tags as $tag)
								<span class="badge">{{ $tag->name }}</span>
							@endforeach
						</p>
						<p><a href="{{ route('profile_path', $talent->username) }}" class="btn btn-primary pull-right" role="button">Learn More</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
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
