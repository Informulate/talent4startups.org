<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label for="first_name" class="control-label">First Name</label>
			<input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"/>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="last_name" class="control-label">Last Name</label>
			<input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"/>
		</div>
	</div>
</div>

<div class="form-group">
	<label for="email" class="control-label">E-Mail Address</label>
	<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"/>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label for="password" class="control-label">Password</label>
			<input id="password" type="password" class="form-control" name="password"/>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="password_confirmation" class="control-label">Confirm Password</label>
			<input id="password_confirmation" type="password" class="form-control" name="password_confirmation"/>
		</div>
	</div>
</div>

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
	<button type="submit" class="btn btn-primary">Sign up</button>
</div>
