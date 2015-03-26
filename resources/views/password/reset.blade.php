@extends('app')
@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>Forgot Password</h1>
			@include('layouts.partials.errors')
		  	@if (Session::has('error'))
				<div class="alert alert-danger">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				{{ Session::get('error') }}
			</div>
		   	 @endif

				{{ Form::open(array('route' => array('password.update', $token))) }}
				 	<div class="form-group">
				 {{ Form::label('email', 'Email') }}
				  {{ Form::text('email',null, ['class' => 'form-control']) }}
				 </div>
				 	<div class="form-group">
				{{ Form::label('password', 'Password') }}
				{{ Form::password('password', ['class' => 'form-control']) }}
				  				 </div>
				 	<div class="form-group">
				 {{ Form::label('password_confirmation', 'Password confirm') }}
				  {{ Form::password('password_confirmation', ['class' => 'form-control']) }}

				  {{ Form::hidden('token', $token) }}
				 </div>
				 	<div class="form-group">
				 {{ Form::submit('Submit') }}
				 </div>
				{{ Form::close() }}
	</div>
	</div>
@stop
