{{ Form::open(['route' => 'login_path']) }}

	<div class="form-group">
		{{ Form::label('email', 'Email:') }}
		{{ Form::text('email', Session::has('email')?Session::get('email'):null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Password:') }}
		{{ Form::password('password', ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::submit('Login', ['id' => 'submit-login','class' => 'btn btn-primary']) }}
		<a id="forgot_password" href="{{ route('password.remind') }}">Forgot Password</a>
	</div>

	<div class="form-group">
		<a id="register-linked_in" class="btn btn-primary" href="{{ route("login_linked_in") }}">Linked <i class="social-icon social linked_in white"></i></a>
	</div>

{{ Form::close() }}
