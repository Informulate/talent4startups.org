@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>New Startup</h1>

			@include('layouts.partials.errors')

			{{ Form::open(['route' => ['startups.store'], 'method' => 'POST']) }}
				@include('layouts.partials.forms.startup')
			{{ Form::close() }}
		</div>
	</div>
@stop
