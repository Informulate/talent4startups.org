{{ Form::open(['route' => 'edit_profile']) }}

	<div class="form-group">
		{{ Form::label('first_name', 'First Name:') }}
		{{ Form::text('first_name', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::label('last_name', 'Last Name:') }}
		{{ Form::text('last_name', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::submit('Continue', ['id' => 'submit-profile','class' => 'btn btn-primary']) }}
	</div>

{{ Form::close() }}
