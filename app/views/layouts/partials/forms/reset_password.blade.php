{{ Form::open() }}
	<div class="form-group">
		{{ Form::label('old_password', 'Old Password:') }}
		{{ Form::password('old_password', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::label('new_password', 'New Password:') }}
		{{ Form::password('new_password', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::label('password_confirmation', 'Confirm Password:') }}
		{{ Form::password('password_confirmation', null ,['class' => 'form-control']) }}
	</div>

	
	<div class="form-group">
		{{ Form::submit('Reset Password', ['id' => 'reset-password','class' => 'btn btn-primary']) }}
	</div>

{{ Form::close() }}