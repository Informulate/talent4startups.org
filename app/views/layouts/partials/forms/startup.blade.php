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

<div class="form-group startup-needs">

	@if (isset( $startup ) and is_object( $startup ) and $startup->needs())
	    @foreach ($startup->needs as $i => $need)
	    <div class="need">
            <span class="btn btn-sm btn-default remove pull-right">remove</span>
            {{ Form::label('needs['.$i.'][role]', 'Role:') }}
            {{ Form::select('needs['.$i.'][role]', $needs, ['name' => 'role[]', 'selected' => $need->skill_id]) }}
            {{ Form::label('needs['.$i.'][commitment]', 'Commitment:') }}
            {{ Form::select('needs['.$i.'][commitment]', array('part-time' => 'Part Time', 'full-time' => 'Full Time'), ['name' => 'commitment[]', 'selected' => $need->commitment]) }}
            {{ Form::label('needs['.$i.'][quantity]', 'Quantity:') }}
            {{ Form::select('needs['.$i.'][quantity]', array_combine(range(1,10), range(1,10)), $need->quantity) }}
            <div class="form-group">
                {{ Form::label('needs['.$i.'][skills]', 'Skills:') }}
                {{ Form::text('needs['.$i.'][skills]', implode(',', $need->tags->lists('name')), ['class' => 'tags form-control']) }}
            </div>
            {{ Form::label('needs['.$i.'][description]', 'Description:') }}
            {{ Form::text('needs['.$i.'][description]', $need->description, ['class' => 'form-control']) }}
        </div>
	    @endforeach
	@endif
	<span class="btn btn-sm btn-success" id="add-need">Add Need</span>
</div>

<div class="form-group">
	{{ Form::label('video', 'link to startup video:') }}
	{{ Form::text('video', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::submit( isset( $startup ) ? 'Update Project' : 'Save Project', ['id' => 'submit-startup','class' => 'btn btn-primary']) }}
</div>

<div id="startup-needs-container" style="display:none">
    <div class="need">
        <span class="btn btn-sm btn-default remove pull-right">remove</span>
        {{ Form::label('role', 'Role:') }}
        {{ Form::select('role', $needs, ['name' => 'role[]']) }}
        {{ Form::label('commitment', 'Commitment:') }}
        {{ Form::select('commitment', array('part-time' => 'Part Time', 'full-time' => 'Full Time'), ['name' => 'commitment[]', 'selected' => 'Part-Time']) }}
        {{ Form::label('quantity', 'Quantity:') }}
        {{ Form::select('quantity', array_combine(range(1,10), range(1,10))) }}
        <div class="form-group">
            {{ Form::label('skills', 'Skills:') }}
            {{ Form::text('skills', '', ['class' => 'tags form-control']) }}
        </div>
        {{ Form::label('description', 'Description:') }}
        {{ Form::text('description', '', ['class' => 'form-control']) }}
    </div>
</div>