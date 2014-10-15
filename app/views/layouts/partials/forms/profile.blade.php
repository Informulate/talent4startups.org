{{ Form::open(['route' => 'edit_profile','files'=>'true','name'=>'profile-form','id'=>'profile-form']) }}

	<div class="form-group">
		{{ Form::label('first_name', 'First Name:') }}
		{{ Form::text('first_name', $profileInfo['first_name'], ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::label('last_name', 'Last Name:') }}
		{{ Form::text('last_name', $profileInfo['last_name'], ['class' => 'form-control']) }}
	</div>	
	<div class="form-group">
		{{ Form::label('location', 'Your Location:') }}
		{{ Form::text('location',$profileInfo['location'], ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
	     {{ Form::label('agerange', 'Age Range:') }}
		<!-- {{ Form::select('agerange', ['Under 18', '19 to 30', 'Over 30']) }}-->
		{{ Form::select('agerange', [
				   '0-18' => 'Under 18',
				   '19-30' => '19 to 30',
				   '30-above' => 'Over 30'],
				   $profileInfo['agerange']
				) }}
	</div>
	<div class="form-group">
		{{ Form::label('describe', 'I\'m best describes as a:') }}
		 {{ Form::select('describe', $describes,$profileInfo['describe']); }}
	</div>
	<div class="form-group">
		{{ Form::label('skills', 'I\'m skilled in :') }}
		<!--{{ Form::text('skills',null, ['class' => 'form-control']) }}-->
		{{ Form::select('skills[]', $skills,$profileSkills,array('multiple')); }}

	</div>
	<div class="form-group">
		{{ Form::label('workexperience', 'Work Experience:') }}
		{{ Form::text('workexperience',$profileInfo['workexperience'], ['class' => 
		'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('about', 'Summary about who you are :') }}
		{{ Form::textarea('about',$profileInfo['about'], ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('image', 'Profile Image :') }}
		{{ Form::file('image', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('facebook', 'Facebook:') }}
		{{ Form::text('facebook',$profileInfo['facebook'], ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('linkedins', 'Linkedin:') }}
		{{ Form::text('linkedins', $profileInfo['linkedins'], ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('twitter', 'Twitter:') }}
		{{ Form::text('twitter',$profileInfo['twitter'], ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('meetup', 'Meetup:') }}
		{{ Form::text('meetup',$profileInfo['meetup'], ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{Form::hidden('user_type','',['id'=>'user_type'])}}
		{{ Form::submit('Continue', ['id' => 'submit-profile','class' => 'btn btn-primary']) }}
	</div>
{{ Form::close() }}

	<!-- Add user type to hidden variable -->
	<script>
	$('#profile-form').submit(function(){
	$('#user_type').val("{{$profileInfo['user_type']}}")
	});
	</script>
