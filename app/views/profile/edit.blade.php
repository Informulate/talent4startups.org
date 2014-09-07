@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			@include('layouts.partials.errors')

			@include('layouts.partials.forms.profile')
		</div>
	</div>
@stop
