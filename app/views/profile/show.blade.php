@extends('layouts.default')

@section('content')
    <div class="pull-right">
        <a href="{{ route('messages.create', $user->username) }}" class="btn btn-primary">Contact</a>
		@if ($currentUser->id == $user->id)
			<a href="{{ route('edit_profile') }}" class="btn btn-primary">Edit</a>
		@endif
	</div>
	<div class="row">
		<div class="col-md-3">
			<img class="img-circle img-responsive img-rounded" src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $user->email ) ) ) ?>?s=150&d=wavatar">
			<input data-id="{{ $user->id }}" type="number" class="member-rating-view" value="{{ $user->rating() }}" }}>
		</div>
		<div class="col-md-9">
			<h1>Hi, I’m {{ $user->profile->first_name }} {{ $user->profile->last_name }} located in {{ $user->profile->location }}.</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<h2>My Interests</h2>
			@if(count($user->profile->skills) > 0)
				@foreach($user->profile->skills as $skill)
					<a href="#"><span class="badge">{{ $skill->name }}</span></a>
				@endforeach
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<h2>Startups I’m involved in</h2>
			@if(count($contributions) > 0 || count($startups) > 0)
				@foreach($contributions as $startup)
				<div class="col-sm-3">
					<div class="clearfix">
						<h4><a href="{{ route('startups.show', $startup->url) }}">{{ $startup->name }}</a> <small>By: {{ $startup->owner->profile->first_name }} {{ $startup->owner->profile->last_name }}</small></h4>
						<p>{{ Str::limit( $startup->description, 50 ) }}</p>
					</div>
					<div class="clearfix">
						@if ($currentUser and $currentUser->username == $user->username)
							<p><a href="{{ route('edit_profile') }}" class="btn btn-primary btn-xs pull-right" role="button">Edit</a></p>
						@endif
					</div>
				</div>
				@endforeach
					@foreach($startups as $startup)
						<div class="col-sm-3">
							<div class="clearfix">
								<h4><a href="{{ route('startups.show', $startup->url) }}">{{ $startup->name }}</a> <small>By: {{ $startup->owner->profile->first_name }} {{ $startup->owner->profile->last_name }}</small></h4>
								<p>{{ Str::limit( $startup->description, 50 ) }}</p>
							</div>
							<div class="clearfix">
								@if ($currentUser and $currentUser->username == $user->username)
									<p><a href="{{ route('edit_profile') }}" class="btn btn-primary btn-xs pull-right" role="button">Edit</a></p>
								@endif
							</div>
						</div>
					@endforeach
			@else
				<div class="alert alert-info">
					I'm not currently involved in any startup.
				</div>
			@endif
		</div>
		@include('layouts.partials.socialshare')
	</div>
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
