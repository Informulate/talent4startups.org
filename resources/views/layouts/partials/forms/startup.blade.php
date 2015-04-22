{!! Form::hidden('startup_id', isset($startup) ? $startup->id : null) !!}
<div class="form-group">
	{!! Form::label('name', 'The startup is titled:') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('stage_id', 'Stage my startup is :') !!}
	{!! Form::select('stage_id', $stages); !!}
</div>

<div class="form-group">
    {!! Form::label('published', 'Allow others to find startup in startup searches:') !!}
    {!! Form::checkbox('published', '1', isset( $startup ) ? $startup->published : null) !!}
</div>

<div class="form-group">
	{!! Form::label('description', 'Description:') !!}
    <small>1000 character limit</small>
	{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('image', 'Image:') !!}
	{!! Form::file('image', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('tags', 'Tags:') !!}
	{!! Form::text('tags', isset( $startup ) ? $startup->tags->implode('name', ',') : null, ['id' => 'tags', 'class' => 'form-control']) !!}
</div>

<div class="col-sm-12 text-center">
    <p class="btn btn-lg btn-success" id="add-need">Add the roles you need for your startup</p>
</div>

<div class="form-group startup-needs">
	@if (isset( $startup ) and is_object( $startup ) and $startup->needs())
	    @foreach ($startup->needs as $i => $need)
	    <div class="need col-md-5 thumbnail {{ strtolower($need->skill->name) }}">
            <div class="need-header form-group">
                <span class="btn btn-sm btn-default remove pull-right">X</span>
                {!! Form::select('needs['.$i.'][role]', $needs, ['name' => 'role[]', 'selected' => $need->skill_id, 'class' => 'role-select']) !!}
                {!! Form::select('needs['.$i.'][quantity]', array_combine(range(1,10), range(1,10)), $need->quantity) !!}
                {!! Form::select('needs['.$i.'][commitment]', array('part-time' => 'Part Time', 'full-time' => 'Full Time'), ['name' => 'commitment[]', 'selected' => $need->commitment]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('needs['.$i.'][skills]', 'Skills:') !!}
                {!! Form::text('needs['.$i.'][skills]', implode(',', $need->tags->lists('name')), ['class' => 'tags form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('needs['.$i.'][desc]', 'Description:') !!}
                {!! Form::textArea('needs['.$i.'][desc]', $need->description, ['class' => 'form-control']) !!}
            </div>
        </div>
	    @endforeach
	@endif
</div>

<div class="clearfix"></div>

<div class="form-group">
	{!! Form::label('video', 'link to startup video:') !!}
	{!! Form::text('video', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('facebook', 'Facebook:') !!}
    {!! Form::text('facebook', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('twitter', 'Twitter Username:') !!}
    {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('linked_in', 'LinkedIn:') !!}
    {!! Form::text('linked_in', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit( isset( $startup ) ? 'Update Project' : 'Save Project', ['id' => 'submit-startup','class' => 'btn btn-primary']) !!}
</div>

<div id="startup-needs-container" style="display:none">
    <div class="need col-md-5 thumbnail designer">
        <div class="need-header form-group">
            <span class="btn btn-sm btn-default remove pull-right">X</span>
            {!! Form::select('role', $needs, ['name' => 'role[]', 'class' => 'role-select']) !!}
            {!! Form::select('quantity', array_combine(range(1,10), range(1,10))) !!}
            {!! Form::select('commitment', array('part-time' => 'Part Time', 'full-time' => 'Full Time'), ['name' => 'commitment[]', 'selected' => 'Part-Time']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('skills', 'Skills:') !!}
            {!! Form::text('skills', '', ['class' => 'tags form-control']) !!}
        </div>
        <div>
            {!! Form::label('desc', 'Description:') !!}
            {!! Form::textArea('desc', '', ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
