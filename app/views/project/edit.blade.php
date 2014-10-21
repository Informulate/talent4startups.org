@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>Edit Project</h1>

			@include('layouts.partials.errors')

			@include('layouts.partials.forms.project')
		</div>
	</div>
@stop