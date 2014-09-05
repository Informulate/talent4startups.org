{{ Form::open(['route' => 'new_project_path']) }}

	<div class="form-group">
		{{ Form::label('name', 'Name:') }}
		{{ Form::text('name', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::label('description', 'Description:') }}
		{{ Form::text('description', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::submit('Save Project', ['id' => 'submit-project','class' => 'btn btn-primary']) }}
	</div>

{{ Form::close() }}
