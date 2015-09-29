@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<h4 class="text-center">Login to continue to the talent4startups</h4>

			<div class="well well-sm">
				<div class="text-center">
					<i class="social social-linked-in linked-in-btn"></i>
					<a id="sign-in-linked_in" class="btn btn-primary" href="{{ route("linked_in") }}">Sign In with LinkedIn</a>
				</div>
				<p class="text-muted text-divider"><span>Or</span></p>
				<form class="form" role="form" method="POST" action="{{ url('/auth/login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					@include('partials.login.form')
				</form>
				@include('partials.forms.agreement')
			</div>

			<div class="well well-sm">
				<p class="text-center">Don't have an account? <a href="{{ url('/auth/register') }}">Sign up</a></p>
			</div>
		</div>
	</div>
</div>
@stop

@section('javascript')
	@include('partials.forms.js')
@endsection
