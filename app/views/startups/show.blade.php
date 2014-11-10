@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $startup->name }}</h1>

			<img data-src="holder.js/800x300" alt="...">

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
					<div><img class="img-circle" src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $user->email ) ) ) ?>?s=64"> {{ $user->profile->first_name }} {{ $user->profile->last_name }} <a class="btn btn-primary btn-xs" href="{{ route('startup_membership_update', ['startup' => $startup->url, 'userId' => $user->id, 'action' => 'approve']) }}">Approve</a> <a class="btn btn-primary btn-xs" href="{{ route('startup_membership_update', ['startup' => $startup->url, 'userId' => $user->id, 'action' => 'reject']) }}">Reject</a></div>
				@endforeach

			@endif

			<h2>Startup Contributors</h2>
			@foreach($members as $user)
							<div><img class="img-circle" src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $user->email ) ) ) ?>?s=64"> {{ $user->profile->first_name }} {{ $user->profile->last_name }}</div>
			@endforeach

		</div>
	</div>
@stop
