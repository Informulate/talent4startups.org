@extends('app')

@section('wide-content')
	<div id="community-header" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<div class="container">
					<div class="carousel-caption">
						<h1>OIX Welcome Text</h1>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.carousel -->
	<div class="community-sub-header carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<div class="container">
					<div class="carousel-caption">
						<h1>Call to action</h1>
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
	<script type="text/javascript">
		$(document).ready(function() {
			$('#email-form-link').on('click', function(event){
				event.preventDefault();
				$('#email-form').slideDown("slow");
			})
		});
	</script>
@endsection

@section('footer')
@overwrite
