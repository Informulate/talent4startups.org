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
								<img class="community-logo" src="/images/oix/OiX_mark_countdown2.png" alt="OiX mark countdown2">
								<h1>Welcome OrlandoIX Attendees</h1>
							</div>
							<div class="col-md-4 col-md-offset-2" style="border-right: 1px solid #fff;">
								<div>
									<div class="text-center">
										<h2 style="margin-top: 0; margin-bottom: 30px;">Sign up is free and easy</h2>
										<div style="margin-bottom: 20px;">
											<a id="sign-in-linked_in" href="{{ route("linked_in", ['join' => $community->url]) }}" alt="Sign Up with LinkedIn"><img src="{{ asset('images/signin-linkedin.png') }}" alt="" /></a>
										</div>
										<p class="text-muted"><a id="email-form-link" href="#">Or Signup with email</a></p>
										<div class="clearfix"></div>
										<form id="email-form" class="form" style="display: none;" role="form" method="POST" action="{{ url('/auth/register') }}">
											{{-- Todo: Remove type all together --}}
											{!! Form::hidden('type', 'talent') !!}
											{!! Form::hidden('join', $community->url) !!}
											@include('partials.registration.form')
										</form>
									</div>

									<div>
										<p class="text-center">Already have an account? <a href="{{ route('community.login', ['url' => $community->url]) }}">Log in</a></p>
									</div>
								</div>
							</div>
							<div class="col-md-4 text-center">
								<img src="/images/logo-white.png" alt="T4S White Logo" width="75%" />
								<p>T4S.US builds local communities that connects audacious startups to brilliant talent</p>
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

				});
		@endif
	</script>
@endsection

@section('footer')
@overwrite
