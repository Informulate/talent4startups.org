{{ Form::open(['route' => 'edit_profile','enctype'=>"multipart/form-data"]) }}

	<div class="form-group">
		{{ Form::label('first_name', 'First Name:') }}
		{{ Form::text('first_name', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
		{{ Form::label('last_name', 'Last Name:') }}
		{{ Form::text('last_name', null, ['class' => 'form-control']) }}
	</div>	
	<div class="form-group">
		{{ Form::label('location', 'Your Location:') }}
		{{ Form::text('location',null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
	     {{ Form::label('agerange', 'Age Range:') }}
		<!-- {{ Form::select('agerange', ['Under 18', '19 to 30', 'Over 30']) }}-->
		{{ Form::select('age', [
				   '0-18' => 'Under 18',
				   '19-30' => '19 to 30',
				   '30-above' => 'Over 30']
				) }}
	</div>
	<div class="form-group">
		{{ Form::label('describes', 'I\'m best describes as a:') }}
		 {{ Form::select('describes', $describes ); }}
	</div>
	<div class="form-group">
		{{ Form::label('skills', 'I\'m skilled in :') }}
		<!--{{ Form::text('skills',null, ['class' => 'form-control']) }}-->
		{{ Form::select('skills[]', $skills,null,  array('multiple')); }}

	</div>
	<div class="form-group">
		{{ Form::label('workexperience', 'Work Experience:') }}
		{{ Form::text('workexperience',null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('about', 'Summary about who you are :') }}
		{{ Form::textarea('about',null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('image', 'Profile Image :') }}
		{{ Form::file('image', ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('facebook', 'Facebook:') }}
		{{ Form::text('facebook',null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('linkedin', 'Linkedin:') }}
		{{ Form::text('linkedin',null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('twitter', 'Twitter:') }}
		{{ Form::text('twitter',null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('meetup', 'Meetup:') }}
		{{ Form::text('meetup',null, ['class' => 'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::submit('Continue', ['id' => 'submit-profile','class' => 'btn btn-primary']) }}
	</div>
{{ Form::close() }}
