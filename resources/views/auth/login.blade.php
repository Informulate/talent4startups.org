@extends('app')

@section('navbar')
@overwrite

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<h4 class="text-center">Login to continue to the talent4startups</h4>

			<div class="well well-sm">
				@include('partials.forms.agreement')
				<div class="text-center">
					<a id="sign-in-linked_in" href="{{ route("linked_in") }}" alt="Signin with LinkedIn"><img src="{{ asset('images/signin-linkedin.png') }}" alt="" /></a>
				</div>
				<p class="text-muted text-center"><a id="email-form-link" href="#">Or Signin with email</a></p>
				<div class="clearfix"></div>
				<form id="email-form" style="display: none;" class="form" role="form" method="POST" action="{{ url('/auth/login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					@include('partials.login.form')
				</form>

			</div>

			<div class="well well-sm">
				<p class="text-center">Don't have an account? <a href="{{ url('/auth/register') }}">Sign up</a></p>
				<p class="text-center"><a href="/password/email/">Forgot your password?</a></p>
			</div>
		</div>
	</div>
</div>
@stop

@section('javascript')
	@include('partials.forms.js')
@endsection

@section('footer')
@overwrite
