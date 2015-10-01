@extends('app')

@section('navbar')
@overwrite

@section('wide-content')
	<div class="overlay">
		<div id="community-header" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="item active">
					<div class="container">
						<div class="carousel-caption">
							<img class="logo" src="/images/oix/OiX_mark_countdown2.png" alt="OiX mark countdown2">
							<h1>Welcome OrlandoIX Attendees</h1>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.carousel -->
	</div>
	<div class="community-sub-header carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<div class="container">
					<div class="carousel-caption">
						<h1>What is T4S?</h1>
						<h2>We are a local community that connects audacious startups to brilliant talent.</h2>
						<h2>Joining the Orlando Chapter is easy, quick and free.</h2>
						<h2>Scroll down and sign up.</h2>
						<h2><span class="round-border"><i class="glyphicons glyphicons-chevron-down"></i></span></h2>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.carousel -->
@stop

@section('content')
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<div class="well well-sm">
				@include('partials.forms.agreement')
				<div class="text-center">
					<a id="sign-in-linked_in" href="{{ route("linked_in", ['join' => $community->url]) }}" alt="Sign Up with LinkedIn"><img src="{{ asset('images/signin-linkedin.png') }}" alt="" /></a>
				</div>
				<p class="text-muted text-center"><a id="email-form-link" href="#">Or Signup with email</a></p>
				<div class="clearfix"></div>
				<form id="email-form" class="form" style="display: none;" role="form" method="POST" action="{{ url('/auth/register') }}">
					{{-- Todo: Remove type all together --}}
					{!! Form::hidden('type', 'talent') !!}
					{!! Form::hidden('join', $community->url) !!}
					@include('partials.registration.form')
				</form>
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

@section('footer')
@overwrite
