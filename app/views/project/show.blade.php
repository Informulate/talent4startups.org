@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>Project Detail Page</h1>

			@include('layouts.partials.errors')

			@include('layouts.partials.forms.project', [ 'project' => $project ])
		</div>
	</div>
@stop
