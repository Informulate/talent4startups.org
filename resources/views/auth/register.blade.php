@extends('app')

@section('navbar')
@overwrite

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-4">
				@include('partials.registration.steps')

				<div class="well well-sm">
					@include('partials.forms.agreement')
					<div class="text-center">
						<a id="sign-in-linked_in" href="{{ route("linked_in") }}" alt="Sign Up with LinkedIn"><img src="{{ asset('images/signin-linkedin.png') }}" alt="" /></a>
					</div>
					<p class="text-muted text-center"><a id="email-form-link" href="#">Or Signup with email</a></p>
					<div class="clearfix"></div>
					<form id="email-form" class="form" style="display: none;" role="form" method="POST" action="{{ url('/auth/register') }}">
						{!! Form::hidden('type', $type) !!}
						@include('partials.registration.form')
					</form>
					@include('partials.forms.agreement')
				</div>

				<div class="well well-sm">
					<p class="text-center">Already have an account? <a href="{{ url('/auth/login') }}">Log in</a></p>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('javascript')
	@include('partials.forms.js')
	<script type="text/javascript">
		@if(getenv('APP_ENV') == 'prod')
			mixpanel.track("Register:View");
		@endif
	</script>
@endsection

@section('footer')
@overwrite
