@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $startup->name }}</h1>
			<p><input data-id="{{ $startup->id }}" type="number" class="rating startup-rating" min=0 max=5 step=0.5 data-size="xs" value="{{ $startup->rating() }}"></p>

			<img data-src="holder.js/750x300" alt="...">

			<p>{{ $startup->description }}</p>

			@if($startup->hasMember($currentUser))
				@if($startup->hasPendingInvitationFrom($currentUser))
					Your request is still been considered, would you like to <a href="{{ route('startup_membership_request_cancel', ['url' => $startup->url]) }}">cancel this request?</a>
				@endif
			@endif

			@if($startup->owner != $currentUser and false === $startup->hasPendingInvitationFrom($currentUser) and false == $startup->hasMember($currentUser))
				<a class="btn btn-primary" href="{{ route('startup_membership_request', ['url' => $startup->url]) }}">Join this startup</a>
			@endif

			<div>
				@foreach($startup->tags as $tag)
					<span class="badge">{{ $tag->name }}</span> &nbsp;
				@endforeach
			</div>
		</div>
		<div class="col-md-4">

			@if($startup->owner == $currentUser)
				<a class="btn btn-primary btn-xs pull-right" href="{{ route('startups.edit', $startup->url) }}">Edit Startup</a>
				<h2>Member requests</h2>

				@foreach($requests as $user)
					<div>
						<a href="{{ route('profile_path', $user->username) }}"><img class="img-circle" src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $user->email ) ) ) ?>?s=64&d=wavatar"> {{ $user->profile->first_name }} {{ $user->profile->last_name }}
						</a> <a class="btn btn-primary btn-xs" href="{{ route('startup_membership_update', ['startup' => $startup->url, 'userId' => $user->id, 'action' => 'approve']) }}">Approve</a> <a class="btn btn-primary btn-xs" href="{{ route('startup_membership_update', ['startup' => $startup->url, 'userId' => $user->id, 'action' => 'reject']) }}">Reject</a>
					</div>Messaging
				@endforeach

			@endif

			<h2>Startup Contributors</h2>
			@foreach($members as $user)
				<div class="row contributor">
					<a href="{{ route('profile_path', $user->username) }}">
						<div class="col-xs-2">
							<img class="img-circle" src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($user->email))) ?>?s=50&d=wavatar">
						</div>
						<div class="col-xs-10">
							{{ $user->profile->first_name }} {{ $user->profile->last_name }}
							<br/> TODO: Contribution Type
						</div>
					</a>
				</div>
				<div class="row contributor">
					<div class="col-xs-12">
						<input data-id="{{ $user->id }}" type="number" class="rating member-rating" min=0 max=5 step=0.5 data-size="xs" value="{{ $user->rating() }}" {{ $startup->owner == $currentUser ? "" : "disabled='true'" }}>
					</div>
				</div>
			@endforeach

		</div>
	</div>
@stop

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function() {
			$('.member-rating').on('rating.change', function(event, value) {
				rate($(this).attr('data-id'), 'user', {{ $startup->id }}, 'startup', value);
			});

			$('.startup-rating').on('rating.change', function(event, value) {
				rate($(this).attr('data-id'), 'startup', {{ $currentUser->id }}, 'user', value);
			});

			function rate(rated_id, rated_type, rated_by_id, rated_by_type, rating) {
				$.post("/rating", {
					rated_id: rated_id,
					rated_type: rated_type,
					rated_by_id: rated_by_id,
					rated_by_type: rated_by_type,
					rating: rating
				});
			}
		});
	</script>
@stop
