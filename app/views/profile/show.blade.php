@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<img class="img-circle img-responsive img-rounded" data-src="holder.js/150x150" alt="...">
		</div>
		<div class="col-md-9">
			<h1>Hi, I’m {{ $user->profile->first_name }} {{ $user->profile->last_name }} located in {{ $user->profile->location }}.</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<h2>My Interests</h2>
			@foreach($user->profile->skills as $skill)
				<a href="#"><span class="badge">{{ $skill->name }}</span></a>
			@endforeach
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<h2>Projects I’m involved in</h2>
			@if(count($contributions) > 0)
				@foreach($contributions as $project)
				<div class="col-sm-3">
					<div class="clearfix">
						<h4><a href="{{ route('projects.show', $project->url) }}">{{ $project->name }}</a> <small>By: {{ $project->owner->profile->first_name }} {{ $project->owner->profile->last_name }}</small></h4>
						<p>{{ Str::limit( $project->description, 50 ) }}</p>
					</div>
					<div class="clearfix">
						<p><a href="" class="btn btn-primary btn-xs pull-right" role="button">Learn More</a></p>
					</div>
				</div>
				@endforeach
			@else
				<div class="alert alert-info">
					I'm not currently involved in any project.
				</div>
			@endif
		</div>
	</div>
@stop
