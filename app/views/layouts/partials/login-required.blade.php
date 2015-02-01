@extends('layouts.default')

@section('content')
	<div class="alert alert-danger" role="alert">
		<strong>Login Required!</strong> Please <a href="{{ route('register_path') }}" class="alert-link signup-link">register</a> or <a href="{{ route('login_path') }}" class="alert-link login-link">login</a> to access our community members.
	</div>
@stop
