@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>{{ $project->name }}</h1>
			<p>{{ $project->description }}</p>
			@foreach($project->tags as $tag)
				<span class="badge">{{ $tag->name }}</span> &nbsp;
			@endforeach
		</div>
	</div>
@stop
