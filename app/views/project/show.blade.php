@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $project->name }}</h1>

			<img data-src="holder.js/800x300" alt="...">

			<p>{{ $project->description }}</p>

			@if($project->hasMember($currentUser))
				@if($project->hasPendingInvitationFrom($currentUser))
					Your request is still been considered, would you like to <a href="{{ route('project_membership_request_cancel', ['url' => $project->url]) }}">cancel this request?</a>
				@endif
			@endif

			@if($project->owner != $currentUser and false === $project->hasPendingInvitationFrom($currentUser) and false == $project->hasMember($currentUser))
				<a class="btn btn-primary" href="{{ route('project_membership_request', ['url' => $project->url]) }}">Join this project</a>
			@endif

			<div>
				@foreach($project->tags as $tag)
					<span class="badge">{{ $tag->name }}</span> &nbsp;
				@endforeach
			</div>
		</div>
		<div class="col-md-4">

			@if($project->owner == $currentUser)
				<a class="btn btn-primary btn-xs pull-right" href="{{ route('projects.edit', $project->url) }}">Edit Project</a>
				<h2>Member requests</h2>

				@foreach($requests as $user)
					<div><img class="img-circle" data-src="holder.js/64x64/auto"> {{ $user->profile->first_name }} {{ $user->profile->last_name }} <a class="btn btn-primary btn-xs" href="{{ route('project_membership_update', ['projectUrl' => $project->url, 'userId' => $user->id, 'action' => 'approve']) }}">Approve</a> <a class="btn btn-primary btn-xs" href="{{ route('project_membership_update', ['projectUrl' => $project->url, 'userId' => $user->id, 'action' => 'reject']) }}">Reject</a></div>
				@endforeach

			@endif

			<h2>Project Contributors</h2>
			@foreach($members as $user)
							<div><img class="img-circle" data-src="holder.js/64x64/auto"> {{ $user->profile->first_name }} {{ $user->profile->last_name }}</div>
			@endforeach

		</div>
	</div>
@stop
