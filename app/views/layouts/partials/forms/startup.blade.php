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
	{{ Form::label('tags[]', 'Tags:') }}
	{{ Form::select('tags[]', $tags, isset($startup) ? $startup->tags->lists('id', 'name') : null, ['multiple']); }}
</div>

<div class="form-group">
	{{ Form::label('needs[]', 'Startup Needs:') }}
	{{ Form::select('needs[]', $needs, isset($startup) ? $startup->needs->lists('id', 'name') : null, ['multiple']); }}
</div>

<div class="form-group">
	{{ Form::label('video', 'link to startup video:') }}
	{{ Form::text('video', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::submit( isset( $startup ) ? 'Update Project' : 'Save Project', ['id' => 'submit-startup','class' => 'btn btn-primary']) }}
</div>
