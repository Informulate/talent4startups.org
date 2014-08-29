@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>Register</h1>

			@include('layouts.partials.errors')

			@include('layouts.partials.forms.signup')
		</div>
	</div>
@stop
