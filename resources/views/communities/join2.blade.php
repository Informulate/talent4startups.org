@extends('app')

@section('navbar')
@overwrite

@section('css')
	<style media="screen">
		body {
		  	margin-bottom: 0;
		}
		#main-container {
     		margin-top: 0;
		}
	</style>
@endsection

@section('wide-content')
	<div class="overlay">
		<div id="community-header" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="item active">
					<div class="container">
						<div id="community-join">
							<div class="col-lg-12 text-center">
								<img src="/images/logo-white.png" alt="T4S White Logo" width="65%" />
								<h4 style="font-size: 1.7em; font-weight: bold; margin-bottom: 30px;">T4S.US builds local communities that connects audacious startups to brilliant talent</h4>
								<h4 style="font-weight: bold; margin-bottom: 25px;">Talent4Startups is proud to welcome OiX attendees</h4>
								<h2 style="margin-top: 0; margin-bottom: 30px; font-size: 3.3em">Sign up is free and easy</h2>
								<div class="text-center">
									<div style="margin-bottom: 20px;">
										<a id="sign-in-linked_in" href="{{ route("linked_in", ['join' => $community->url]) }}" alt="Sign Up with LinkedIn"><img src="{{ asset('images/signin-linkedin.png') }}" alt="" /></a>
									</div>
									<p class="" style="font-weight: normal; font-size: 1.5em;"><a id="email-form-link" href="#">Or Signup with email</a></p>
									<p class="text-center">Already have an account? <a href="{{ route('community.login', ['url' => $community->url]) }}">Log in</a></p>
									<div class="clearfix"></div>
									<form id="email-form" class="form" style="display: none;" role="form" method="POST" action="{{ url('/auth/register') }}">
										{{-- Todo: Remove type all together --}}
										{!! Form::hidden('type', 'talent') !!}
										{!! Form::hidden('join', $community->url) !!}
										@include('partials.registration.form')
									</form>
								</div>
								<img class="community-logo" src="/images/oix/OiX_mark_countdown2.png" alt="OiX mark countdown2">
								<p>OiX attendees registering during the event October 2-6th will be automatically entered in a drawing to win one of our fabulous T4S T-Shirts!</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.carousel -->
	</div>
@stop

@section('content')
	{{-- Not used because this page contains all the information on the wide section --}}
@stop

@section('javascript')
	@include('partials.forms.js')
	<script type="text/javascript">
		@if(getenv('APP_ENV') == 'prod')
			mixpanel.track("OIXLanding2:View", {
					"UrlReferrer": '{{ $referrer }}'
				});
		@endif
	</script>
@endsection

@section('footer')
@overwrite
