@extends('layouts.default')
@section('content')
			<h1>Forgot Password</h1>
			@include('layouts.partials.errors')			
				@if (Session::has('error'))
				<div class="alert alert-danger">
				<button aria-hidden="true" data-dismiss="alert" class="close" 					type="button">×</button>
				{{ Session::get('error') }}
			</div>
			@elseif (Session::has('success'))
				An email with the password reset has been sent.
			@endif
	 	<div class="row">
		 	<div class="col-md-6">
			  {{ Form::open(array('route' => 'password.request')) }}
		  		<div class="form-group">
				    	{{ Form::label('email', 'Email') }}
					    {{ Form::text('email',null, ['class' => 'form-control']) }}
					</div>
				<div class="form-group">
				{{ Form::submit('Submit') }}
					</div>
			  {{ Form::close() }}
		    </div> 
	    </div>
@stop
