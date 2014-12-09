@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>Edit Startup</h1>

			@include('layouts.partials.errors')

			{{ Form::model($startup, ['route' => ['startups.update', $startup->url], 'method' => 'PUT']) }}
				@include('layouts.partials.forms.startup')
			{{ Form::close() }}
		</div>
	</div>
@stop
