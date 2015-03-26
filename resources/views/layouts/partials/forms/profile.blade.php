{{ Form::open(['route' => 'edit_profile','files'=>'true','name'=>'profile-form','id'=>'profile-form','files' => true]) }}
	<div class="form-group">
		{{ Form::label('image', 'Image:') }}
		{{ Form::file('image', null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('first_name', 'First Name:') }}
		{{ Form::text('first_name',  is_object( $user->profile ) ? $user->profile->first_name : null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::label('last_name', 'Last Name:') }}
		{{ Form::text('last_name', is_object( $user->profile ) ? $user->profile->last_name : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('location', 'Your Location:') }}
		{{ Form::text('location', is_object( $user->profile ) ? $user->profile->location : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('describe', 'I\'m best described as a:') }}
		 {{ Form::select('describe', $describes, is_object( $user->profile ) ? $user->profile->describe : null); }}
	</div>
	<div class="form-group">
		{{ Form::label('skills', 'I\'m skilled and looking for experience in :') }}
		{{ Form::text('skills', is_object( $user->profile ) ? $user->profile->tags->implode('name', ',') : null, ['id' => 'skills', 'class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('about', 'Summary about who you are :') }}
		{{ Form::textarea('about',is_object( $user->profile ) ? $user->profile->about : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('facebook', 'Facebook:') }}
		{{ Form::text('facebook',is_object( $user->profile ) ? $user->profile->facebook : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('twitter', 'Twitter:') }}
		{{ Form::text('twitter',is_object( $user->profile ) ? $user->profile->twitter : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('youtube', 'YouTube:') }}
		{{ Form::text('youtube',is_object( $user->profile ) ? $user->profile->youtube : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('published', 'Allow others to find me in talent searches:') }}
		{{ Form::checkbox('published', '1', is_object( $user->profile ) ? $user->profile->published : null) }}
	</div>
	<div class="form-group">
		{{ Form::submit('Continue', ['id' => 'submit-profile','class' => 'btn btn-primary']) }}
	</div>

{{ Form::close() }}
