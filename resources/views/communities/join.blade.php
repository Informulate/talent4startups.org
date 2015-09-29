@extends('app')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h1 class="text-center">Welcome {{ $community->name }} Users
				<small>Join the Talent4Startups {{ $community->name }} Community</small>
			</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<h4 class="text-center">Sign up to continue to the {{ $community->name }} community</h4>

			<div class="well well-sm">
				<div class="text-center">
					<i class="social social-linked-in linked-in-btn"></i>
					<a id="sign-in-linked_in" class="btn btn-primary" href="{{ route("linked_in", ['join' => $community->url]) }}">Sign Up with LinkedIn</a>
				</div>
				<p class="text-muted text-divider"><span>Or</span></p>
				<form class="form" role="form" method="POST" action="{{ url('/auth/register') }}">
					{{-- Todo: Remove type all together --}}
					{!! Form::hidden('type', 'talent') !!}
					{!! Form::hidden('join', $community->url) !!}
					@include('partials.registration.form')
				</form>
				@include('partials.forms.agreement')
			</div>

			<div class="well well-sm">
				<p class="text-center">Already have an account? <a href="{{ route('community.login', ['url' => $community->url]) }}">Log in</a></p>
			</div>
		</div>
	</div>
@stop

@section('javascript')
	@include('partials.forms.js')
@endsection
