{{ Form::open(['route' => 'projects.store']) }}

	<div class="form-group">
		{{ Form::label('name', 'Name:') }}
		{{ Form::text('name', isset( $project ) ? $project->name : null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::label('description', 'Description:') }}
		{{ Form::textarea('description', isset( $project ) ? $project->description : null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::submit( isset( $project ) ? 'Update Project' : 'Save Project', ['id' => 'submit-project','class' => 'btn btn-primary']) }}
	</div>

{{ Form::close() }}