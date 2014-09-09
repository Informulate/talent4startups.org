@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>{{ $project->name }}</h1>
			<p>{{ $project->description }}</p>
		</div>
	</div>
@stop
