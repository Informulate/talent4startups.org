@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>Login</h1>
			@if(Session::has('error'))
				<div class="alert alert-danger">
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
					{{Session::get('error')}}
				</div>
			@endif
			@include('layouts.partials.errors')

			@include('layouts.partials.forms.login')
		</div>
	</div>
@stop
