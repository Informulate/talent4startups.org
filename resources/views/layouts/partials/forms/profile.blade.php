{!! Form::open(['route' => $route,'files'=>'true','name'=>'profile-form','id'=>'profile-form','files' => true]) !!}

<div class="form-group">
	{!! Form::label('image', 'Image:') !!}
	{!! Form::file('image', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('tagline', 'One line introduction:') !!}
	{!! Form::text('tagline', is_object( $user->profile ) ? $user->profile->tagline : null, ['class' =>
	'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('location', 'Your Location:') !!}
	{!! Form::text('location', is_object( $user->profile ) ? $user->profile->location : null, ['class' =>
	'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('describe', 'I\'m best described as a:') !!}
	{!! Form::select('describe', $describes, is_object( $user->profile ) ? $user->profile->describe : null, ['style' => 'width:100%']) !!}
</div>
<div class="form-group">
	{!! Form::label('profession', 'My industry is best described as:') !!}
	{!! Form::select('profession', $professions, (is_object( $user->profile ) and is_object( $user->profile->profession )) ? $user->profile->profession->id : null, ['style' => 'width:100%', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('skills', 'I\'m skilled and looking for experience in :') !!}
	{!! Form::text('skills', is_object( $user->profile ) ? $user->profile->tags->implode('name', ',') : null, ['id' =>
	'skills', 'class' => 'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('about', 'Summary about who you are :') !!}
	{!! Form::textarea('about',is_object( $user->profile ) ? $user->profile->about : null, ['class' => 'form-control'])
	!!}
</div>
<div class="form-group">
	{!! Form::label('facebook', 'Facebook:') !!}
	{!! Form::text('facebook',is_object( $user->profile ) ? $user->profile->facebook : null, ['class' =>
	'form-control']) !!}
</div>
<div class="form-group">
	{!! Form::label('twitter', 'Twitter:') !!}
	{!! Form::text('twitter',is_object( $user->profile ) ? $user->profile->twitter : null, ['class' => 'form-control'])
	!!}
</div>
<div class="form-group">
	{!! Form::label('youtube', 'YouTube:') !!}
	{!! Form::text('youtube',is_object( $user->profile ) ? $user->profile->youtube : null, ['class' => 'form-control'])
	!!}
</div>
<div class="form-group">
	{!! Form::label('published', 'Allow others to find me in talent searches:') !!}
	{!! Form::checkbox('published', '1', is_object( $user->profile ) ? $user->profile->published : null) !!}
</div>
<div class="form-group">
	{!! Form::submit('Continue', ['id' => 'submit-profile','class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}
