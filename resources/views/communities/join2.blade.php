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
								<img src="/images/logo-white.png" alt="T4S White Logo" width="45%" style="margin: 20px 0;"/>
								<h4 style="font-size: 2.2em; font-weight: bold; margin-bottom: 23px;">We connect audacious startups to brilliant talent</h4>
								<hr width="55%"/>
								<h4 style="font-weight: bold; margin-bottom: 25px;">Talent4Startups is proud to welcome OiX attendees to our community!</h4>
								<div class="text-center">
									<div style="margin-bottom: 20px;">
										<a id="sign-in-linked_in" href="{{ route("linked_in", ['join' => $community->url]) }}" alt="Sign Up with LinkedIn"><img src="{{ asset('images/signin-linkedin.png') }}" alt="" /></a>
									</div>
									<p class="" style="font-weight: normal; font-size: 1.5em; "><a id="email-form-link" href="#" style="text-decoration: none">Or Signup with email</a></p>
									<p class="text-center">Already have an account? <a href="{{ route('community.login', ['url' => $community->url]) }}">Log in</a></p>
									<div class="clearfix"></div>
									<form id="email-form" class="form" style="display: none;" role="form" method="POST" action="{{ url('/auth/register') }}">
										{{-- Todo: Remove type all together --}}
										{!! Form::hidden('type', 'talent') !!}
										{!! Form::hidden('join', $community->url) !!}
										@include('partials.registration.form')
									</form>
								</div>
								<p style="font-weight: bold" class="col-lg-6 col-md-offset-3">OiX attendee, register during the event October 2-6, 2015 and tweet your profile to win one of our fabulous T4S T-Shirts!</p>
								<div class="clearfix"></div>
								<img class="community-logo" src="/images/oix/OiX_mark_countdown2.png" alt="OiX mark countdown2">
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
