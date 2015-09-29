@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-4">
				@include('partials.registration.steps')

				<div class="well well-sm">
					<div class="text-center">
						<i class="social social-linked-in linked-in-btn"></i>
						<a id="sign-in-linked_in" class="btn btn-primary" href="{{ route("linked_in") }}">Sign Up with LinkedIn</a>
					</div>

					<p class="text-muted text-divider"><span>Or</span></p>

					<form class="form" role="form" method="POST" action="{{ url('/auth/register') }}">
						{!! Form::hidden('type', $type) !!}
						@include('partials.registration.form')
					</form>
					@include('partials.forms.agreement')
				</div>
			</div>
		</div>
	</div>
@endsection

@section('javascript')
	@include('partials.forms.js')
@endsection

@section('footer')
@overwrite
