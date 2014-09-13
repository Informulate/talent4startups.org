@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>{{ $project->name }}</h1>
			<p>{{ $project->description }}</p>
			@foreach($project->tags as $tag)
				<span class="badge">{{ $tag->name }}</span> &nbsp;
			@endforeach
			@foreach($project->members as $member)
				<div><img class="img-circle" data-src="holder.js/64x64/auto"> {{ $member->profile->first_name }} {{ $member->profile->last_name }}</div>
			@endforeach
		</div>
	</div>
@stop
