@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>{{ $project->name }}</h1>
			<p>{{ $project->description }}</p>
			@foreach($project->tags as $tag)
				{{ $tag->name }} &nbsp;
			@endforeach
		</div>
	</div>
@stop
