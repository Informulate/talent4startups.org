{{ Form::open(['route' => 'edit_profile','files'=>'true','name'=>'profile-form','id'=>'profile-form']) }}

	<div class="form-group">
		{{ Form::label('first_name', 'First Name:') }}
		{{ Form::text('first_name', isset( $user->profile ) ? $user->profile->first_name : null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::label('last_name', 'Last Name:') }}
		{{ Form::text('last_name', isset( $user->profile ) ? $user->profile->last_name : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('location', 'Your Location:') }}
		{{ Form::text('location', isset( $user->profile ) ? $user->profile->location : null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
	     {{ Form::label('agerange', 'Age Range:') }}
		<!-- {{ Form::select('agerange', ['Under 18', '19 to 30', 'Over 30']) }}-->
		{{ Form::select('agerange', [
				   '0-18' => 'Under 18',
				   '19-30' => '19 to 30',
				   '30-above' => 'Over 30'],
				   isset( $user->profile ) ? $user->profile->agerange : null
				) }}
	</div>
	<div class="form-group">
		{{ Form::label('describe', 'I\'m best describes as a:') }}
		 {{ Form::select('describe', $describes, isset( $user->profile ) ? $user->profile->describe : null); }}
	</div>
	<div class="form-group">
		{{ Form::label('skills', 'I\'m skilled in :') }}
		<!--{{ Form::text('skills',null, ['class' => 'form-control']) }}-->
		{{ Form::select('skills[]', $skills, isset( $user->profile ) ? $user->profile->skills : null,array('multiple')); }}

	</div>
	<div class="form-group">
		{{ Form::label('workexperience', 'Work Experience:') }}
		{{ Form::text('workexperience', isset( $user->profile ) ? $user->profile->workexperience : null, ['class' =>
		'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('about', 'Summary about who you are :') }}
		{{ Form::textarea('about',isset( $user->profile ) ? $user->profile->about : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('image', 'Profile Image :') }}
		{{ Form::file('image', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('facebook', 'Facebook:') }}
		{{ Form::text('facebook',isset( $user->profile ) ? $user->profile->facebook : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('linkedins', 'Linkedin:') }}
		{{ Form::text('linkedins', isset( $user->profile ) ? $user->profile->linkedins : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('twitter', 'Twitter:') }}
		{{ Form::text('twitter',isset( $user->profile ) ? $user->profile->twitter : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('meetup', 'Meetup:') }}
		{{ Form::text('meetup',isset( $user->profile ) ? $user->profile->meetup : null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{Form::hidden('user_type','',['id'=>'user_type'])}}
		{{ Form::submit('Continue', ['id' => 'submit-profile','class' => 'btn btn-primary']) }}
	</div>
{{ Form::close() }}

	<!-- Add user type to hidden variable -->
	<script>
	$('#profile-form').submit(function(){
	$('#user_type').val("{{isset( $user->profile ) ? $user->profile->user_type : null}}")
	});
	</script>
