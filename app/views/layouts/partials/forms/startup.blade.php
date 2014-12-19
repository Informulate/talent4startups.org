<div class="form-group">
	{{ Form::label('name', 'The startup is titled:') }}
	{{ Form::text('name', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::label('stage_id', 'Stage my startup is :') }}
	{{ Form::select('stage_id', $stages); }}
</div>

<div class="form-group">
	{{ Form::label('description', 'Description:') }}
	{{ Form::textarea('description', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::label('image', 'Image:') }}
	{{ Form::file('image', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::label('tags', 'Tags:') }}
	{{ Form::text('tags', isset( $startup ) and is_object( $startup ) ? $startup->tags->implode('name', ',') : null, ['id' => 'tags', 'class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::label('needs', 'Startup Needs:') }}
	{{ Form::text('needs', isset( $startup ) and is_object( $startup ) ? $startup->needs->implode('name', ',') : null, ['id' => 'needs', 'class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::label('video', 'link to startup video:') }}
	{{ Form::text('video', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::submit( isset( $startup ) ? 'Update Project' : 'Save Project', ['id' => 'submit-startup','class' => 'btn btn-primary']) }}
</div>
